<?php
session_start();
foreach (glob("libs/*.php") as $filename)
{
    include $filename;
}
require_once 'vendor/autoload.php';
require_once 'config/routes.php';

function home() {
	$data['bg_image'] = getConfig()['client_url']. '/assets/images/'.'home_bg.png';
	render_view('home', $data);
}
  
function enable_mfa() {
	require_sign_in();
	$email = $_SESSION['name'];
	$conf = getConfig();
	$client_id = $conf['client_id'];
	$enable_mfa_url = $conf['app_url'] . $conf['enable_mfa_url'];
	
	$params = "?uid=".$client_id."&email=".$email;
	$req_url = $enable_mfa_url.$params;	

	header('Location: ' . $req_url);
	die;
}

function callback() {
	require_sign_in();
	if(isset($_GET['access_token'])) {
		$email = $_SESSION['name'];
		$access_token = $_GET['access_token'];

		$crd = getCrud();
		$crd->insertAccessToken($email, $access_token);
		
		$answer = "Access Token Got Saved!";
	}
	else {
		$answer = "Error! No Access Token Found!";
	}
	
	$data['answer'] = $answer;
	
	render_view('mfa_check', $data);
	
}

function create() {
	require_sign_in();
	$access_token = getAccessToken();
	$conf = getConfig();
	
	$server_url = $conf['server_url'];
	$client_url = $conf['client_url'];
	$auth_url = $conf['auth_url'];
	$mfa_check_client_url = $conf['mfa_check_client_url'];

	$fields = array(
		'message' => 'Php Client want to authorize.',
		'type' => 'Test',
	);
	
	$url = $server_url . $auth_url;
	$ans = accepttoOauth($url, $access_token, $fields);
	
	$_SESSION['channel'] = $ans->channel;
	
	header('Location: ' . $server_url . "/mfa/index?channel=" . $ans->channel . "&callback_url=" . $client_url . $mfa_check_client_url . "/channel/" . $ans->channel);
	die;
}

function mfa_check($channel) {
	require_sign_in();
	$access_token = getAccessToken();
	$conf = getConfig();
	
	$server_url = $conf['server_url'];
	$mfa_check_url = $conf['mfa_check_url'];

	$fields = array(
		'channel' => $channel,
	);
	
	$url = $server_url . $mfa_check_url;
	$ans = accepttoOauth($url, $access_token, $fields);
	
	$data['answer'] = $ans->status;
	
	render_view('mfa_check', $data);
}

?>
