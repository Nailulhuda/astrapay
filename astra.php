<?php

function urut($length) 
    {
        $str = "";
        
            $characters = array_merge(range('0','9'),range('a','z'));
        
        $max = count($characters) - 1;
        for ($i = 0; $i < $length; $i++) {
            $rand = mt_rand(0, $max);
            $str .= $characters[$rand];
        }
        return $str;
    }

$headers = array();
$headers[] = 'X-Application-Token: AznrcUZAgMrCmG8uMYmqw7u4';
$headers[] = 'Content-Type: application/json; charset=utf-8';
$headers[] = 'User-Agent: Dalvik/2.1.0 (Linux; U; Android 10; MI 6 Build/QQ2A.200405.005)';
$headers[] = 'Host: orion.astrapay.com';

echo " ASTRAPAY Account Creator - by BakulOpak \n";
echo "          DO WITH YOUR OWN RISK          \n";
regis:
echo " NOMER: ";
$nomer = trim(fgets(STDIN));
echo " REFF: ";
$reff = trim(fgets(STDIN));


	get:
	$data = file_get_contents("https://wirkel.com/data.php?qty=1&domain=gmail.com");
	$datas = json_decode($data);
	$email = $datas->result[0]->email;
	$nama = $datas->result[0]->firstname;


	$cek = curl('https://orion.astrapay.com/astrapay/fif/member/chekAccount/mobile', '{"account":"'.$nomer.'"}', $headers);
	if (strpos($cek[1], '"isAccountExist":true')) goto regis;

	$reg = curl('https://orion.astrapay.com/astrapay/fif/member/checkEmail/mobile', '{"email":"'.$email.'"}', $headers);
	if (strpos($reg[1], '"failure":true')) goto get;

	$reg2 = curl('https://orion.astrapay.com/astrapay/fif/checkReferralCode/mobile?referralCode='.$reff, null, $headers);
	if (strpos($reg2[1], '"failure":true')) {
		echo " KODE REFF SALAH \n";
		goto regis;
	} else {
		echo " PIN : ";
		$pin = trim(fgets(STDIN));


	$sec = "c5bef796".urut(32);

	$reg3 = curl('https://orion.astrapay.com/astrapay/fif/register/mobile', '{"birthday":"1990-11-11","email":"'.$email.'","issuer":"850500","name":"'.$nama.'","otp":"","password":"'.$pin.'","phoneNumber":"'.$nomer.'","securityKey":"'.$sec.'","usedReferralCode":"'.$reff.'"}', $headers);
	
	echo " OTP : ";
	$otp = trim(fgets(STDIN));
	$reg4 = curl('https://orion.astrapay.com/astrapay/fif/register/mobile', '{"birthday":"1990-11-11","email":"'.$email.'","issuer":"850500","name":"'.$nama.'","otp":"'.$otp.'","password":"'.$pin.'","phoneNumber":"'.$nomer.'","securityKey":"'.$sec.'","usedReferralCode":"'.$reff.'"}', $headers);
	if (strpos($reg4[1], '"failure":true')) {
		echo " GAGAL \n";
		goto regis;
	} else {
		$xixi = array();
$xixi[] = 'X-Application-Token: AznrcUZAgMrCmG8uMYmqw7u4';
$xixi[] = 'Content-Type: application/json; charset=utf-8';
$xixi[] = 'User-Agent: Dalvik/2.1.0 (Linux; U; Android 10; MI 6 Build/QQ2A.200405.005)';
$xixi[] = 'Host: orion.astrapay.com';
		$login = curl('https://orion.astrapay.com/astrapay/fif/login/mobile', '{"account":"'.$nomer.'","issuer":"850500","password":"'.$pin.'","securityKey":"'.$sec.'"}', $xixi);
		if (strpos($login[1], '"failure":true')) {
			echo " LOGIN GAGAL";
		} else {
		$xx = json_decode($login[1]);
		$token = $xx->token;
		$xixio = array();
$xixio[] = 'X-Application-Token: '.$token;
$xixio[] = 'Content-Type: application/json; charset=utf-8';
$xixio[] = 'User-Agent: Dalvik/2.1.0 (Linux; U; Android 10; MI 6 Build/QQ2A.200405.005)';
$xixio[] = 'Host: orion.astrapay.com';
$profil = curl('https://orion.astrapay.com/astrapay/fif/getprofile/mobile', '{"account":"'.$nomer.'","issuer":"850500","securityKey":"'.$sec.'"}', $xixio);
$xxx = json_decode($profil[1]);
print_r($xxx);
	}
	}
}

function curl($url,$post,$headers,$follow=false,$method=null)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		if ($follow == true) curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_HEADER, 1);
		if ($method !== null) curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
		if ($headers !== null) curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		if ($post !== null) curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
		$result = curl_exec($ch);
		$header = substr($result, 0, curl_getinfo($ch, CURLINFO_HEADER_SIZE));
		$body = substr($result, curl_getinfo($ch, CURLINFO_HEADER_SIZE));
		preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', $result, $matches);
		$cookies = array();
		foreach($matches[1] as $item) {
		  parse_str($item, $cookie);
		  $cookies = array_merge($cookies, $cookie);
		}
		return array (
		$header,
		$body,
		$cookies
		);
	}

function save($data, $file) 
	{
		$handle = fopen($file, 'a+');
		fwrite($handle, $data);
		fclose($handle);
	}
