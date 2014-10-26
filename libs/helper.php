<?php

function render_view($view, $data = array()) {
	extract($data);
	$app_var['home'] = getConfig()['client_url'];
	$app_var['server'] = getConfig()['server_url'];
	include('views/layouts/header.php');	
	$root = getConfig()['client_url'];
    include('views/'.$view.'.php');
	include('views/layouts/footer.php');
}

function image_path($name) {
	
	$assets_images_path = getConfig()['client_url'].'/assets/images/';	
	print($assets_images_path.$name);
}

function getStyleLink($name, $media='all') {
	
	$assets_styles_path = 'assets/stylesheets/';
	if($name != 'application') {
	
	print("\n");	
	print('<LINK rel="stylesheet" media="'.$media.'" href="'.$assets_styles_path.$name.'.css" type="text/css" />');
	} else {
		
		foreach (glob($assets_styles_path."*.css") as $filename)
		{
			print("\n");
		    print('<LINK rel="stylesheet" media="'.$media.'" href="'.getConfig()['client_url'].'/'.$filename.'" type="text/css" />');
		}
		
		
		$scss = new scssc();
		$scss->setFormatter("scss_formatter_compressed");

		print("\n");
		echo '<style>';
		
		foreach (glob($assets_styles_path."*.scss") as $filename)
		{
			print("\n");
		    echo $scss->compile('@import "'.$filename.'"');
		}
		
		echo '</style>';
	}
}

function getJSLink($name) {
	
	$assets_javascripts_path = 'assets/javascripts/';
	
	if($name != 'application') {
		
		print("\n");	
		print('<script type="text/javascript" src="'.$assets_javascripts_path.$name.'.js"></script>');
		} else {
			
			foreach (glob($assets_javascripts_path."*.js") as $filename)
			{
				if(strpos($filename, 'jquery.min') == FALSE){
					print("\n");
					print('<script type="text/javascript" src="'.getConfig()['client_url'].'/'.$filename.'"></script>');
				}
				
			}	
	}
}

function getConfig() {
		
	$ENV = 'development';
	define('APP_PATH', dirname(__FILE__));

	return Spyc::YAMLLoad($APP_PATH . 'config/acceptto.yml')[$ENV];
}

function getCrud() {
	
	$conf = getConfig();
	$crud = new crud();
	
	$crud->dsn = $conf['dsn'];
	$crud->username = $conf['db_username'];
	$crud->password = $conf['db_password'];
	
	return $crud;
}

function getAccessToken() {
	require_sign_in();
	$email = $_SESSION['name'];

	$crd = getCrud();
	
	return $crd->getAccessToken($email);
}

function m2m_authenticated() {
	require_sign_in();
	$email = $_SESSION['name'];

	$crd = getCrud();
}

function accepttoOauth($url, $access_token, $fields) {
	require_sign_in();
	
	foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
	rtrim($fields_string, '&');
	
	$crl = curl_init();

	curl_setopt( $crl, CURLOPT_HTTPHEADER, array( 'Authorization: Bearer ' . $access_token ) );

	curl_setopt($crl, CURLOPT_URL, $url);
	
	curl_setopt($crl,CURLOPT_POST, count($fields));
	curl_setopt($crl,CURLOPT_POSTFIELDS, $fields_string);
	curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);
	$ret = curl_exec($crl);
    curl_close($crl);
	
	return json_decode($ret);	
}

function mfa_enabled() {
	
	if(getAccessToken())
		return TRUE;
	else 
		return FALSE;
	
}

?>