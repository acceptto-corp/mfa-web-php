<?php

function sign_up($method) {
	
	check_already_logged();	
	
	if( $method == 'get')
		render_view('auth/sign_up');
	else {
		if (empty($_POST['name']))
			$error = 'Email must be filled out<br>';
		if (empty($_POST['password']))
			$error = 'Password must be filled out';
		if ($_POST['password']!=$_POST['confirmation'])
			$error = 'Passwords doesn\'t confirm each other';
		
		if($error) {
			$data['error'] = $error;
			render_view('auth/sign_up', $data);
			die;
		}
		
		$crd = getCrud();
		
	    $values = array(
        	array('name'=>$_POST['name'], 'password'=>md5($_POST['password'])),
        );
		
		$crd->dbInsert('users', $values);
		
		header('Location: ' . getConfig()['client_url'] . '/sign_in');
		die;
	}
}

function sign_in($method) {
	
	check_already_logged();
	
	if( $method == 'get')
		render_view('auth/sign_in');
	else {
		if (empty($_POST['name']))
			$error = 'Email must be filled out<br>';
		if (empty($_POST['password']))
			$error = 'Password must be filled out';
		
		if($error) {
			$data['error'] = $error;
			render_view('auth/sign_in', $data);
			die;
		}
		
		$crd = getCrud();
		
		$name = $_POST['name'];
		$password = md5($_POST['password']);
		
		$query = "SELECT * FROM users WHERE name='".$name."' AND password='".$password."' LIMIT 1;";

		$record = $crd->rawSelect($query);
		$row = $record->fetchAll(PDO::FETCH_ASSOC);
		
		if($row[0]['name']) {
			$_SESSION['name'] = $row[0]['name'];
			$_SESSION['id'] = $row[0]['id'];
			header('Location: ' . getConfig()['client_url']);
			die;
		}
		else {
			$data['error'] = "Wrong Email or Password";
			render_view('auth/sign_in', $data);
		}		
	}
}

function sign_out() {
	
	$_SESSION['name'] = NULL;
	header('Location: ' . getConfig()['client_url'] . '/sign_in');
	die;
}

function isLogged() {
	
	return ($_SESSION['name'] != NULL);
}

function getId() {
	if(isLogged()) {
		return $_SESSION['id'];
	} else {
		return NULL;
	}
}

function check_already_logged(){
	
	if(isLogged()) {
		header('Location: ' . getConfig()['client_url']);
		die;	
	}	
}

function require_sign_in(){
	
	if(!isLogged()) {
		header('Location: ' . getConfig()['client_url'] . '/sign_in');
		die;	
	}	
}

?>