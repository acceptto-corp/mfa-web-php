<?php

$app = new Silex\Application(); 

$app->get('/', function() {
    home(); 
	die;
});

$app->get('/assets/stylesheets/{file_name}', function($file_name) {
    return file_get_contents(getConfig()['client_path'].$file_name); 
	die;
});

$app->get('/sign_in', function() { 
    sign_in('get'); 
	die;
});

$app->post('/sign_in', function() { 
    sign_in('post'); 
	die;
});

$app->get('/sign_up', function() { 
    sign_up('get'); 
	die;
});

$app->post('/sign_up', function() { 
    sign_up('post'); 
	die;
});

$app->get('/sign_out', function() { 
    sign_out(); 
	die;
});

$app->get('/callback', function() { 
    callback(); 
	die;
}); 

$app->get('/enable_mfa', function() { 
    enable_mfa(); 
});

$app->get('/create', function() { 
    create(); 
}); 

$app->get('/mfa_check/channel/{channel}', function($channel) { 
    mfa_check($channel); 
	die;
}); 

$app->run(); 

?>