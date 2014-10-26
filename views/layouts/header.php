<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Acceptto PHP Client</title>

  <link rel="apple-touch-icon-precomposed" sizes="120x120" href="<?php image_path('apple-touch-icon-58x58-precomposed.png')?>">
  <link rel="apple-touch-icon-precomposed" sizes="80x80" href="<?php image_path('apple-touch-icon-80x80-precomposed.png')?>">
  <link rel="apple-touch-icon-precomposed" sizes="58x58" href="<?php image_path('apple-touch-icon-120x120-precomposed.png')?>">
  <link rel="shortcut icon" href="<?php image_path('favicon.png') ?>">
  <?php getStyleLink('application'); ?>
  <?php getJSLink('jquery.min'); ?>
  <?php getJSLink('application'); ?>
</head>
<body background="">
<a href="#" class="scrollup"></a>
<div class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/"></a>
    </div>
    <div class="navbar-collapse collapse">
      <ul class="nav navbar-nav">
        <?php if(isLogged()) : ?>
          <li><a href="<?php print $app_var['home']; ?>/">Home</a></li>
          <li><a href="http://www.acceptto.com/overview/index">Overview</a></li>
          <li><a href="http://www.acceptto.com/products/index">Solution</a></li>
        <?php endif; ?>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <?php if(!isLogged()) : ?>
            <li> <a href="<?php print $app_var['home']; ?>/sign_in" class="login">Login</a> </li>
        <?php else :?>
            <li><a href="#"><?php print $name; ?></a></li>
            <?php if(empty(getAccessToken())) : ?>
              <li><a href="<?php print $app_var['home']; ?>/enable_mfa">Enable MFA</a></li>
              <li><a href="<?php print $app_var['server']; ?>/mfa/email?uid=<?php print getConfig()['client_id']; ?>">Enable MFA By Email</a></li>
            <?php else :?>
              <li><a href="<?php print $app_var['home']; ?>/create">Test MFA</a></li>
            <?php endif; ?>
	        <li><a href="<?php print $app_var['home']; ?>/sign_out">Sign Out</a></li>
	    <?php endif; ?>
        </ul>
    </div><!--/.nav-collapse -->
  </div>
</div>
<img src="<?php image_path('Dij-Hand.png'); ?>" alt="final" class="hand img-responsive" />
<img src="<?php image_path('icon.png'); ?>" alt="" class="app-icon img-responsive" />
<img src="<?php image_path('Apple-AppStore.png'); ?>" alt="" class="app-store img-responsive" />
<img src="<?php image_path('googleplay.png'); ?>" alt=""  class="google-play img-responsive" />
<div class="container-fluid">
<div class="row-fluid">

<?php if(isset($notice)) : ?>
    <div id="notice">
        <?php print $notice; ?>
    </div>
<?php endif; ?>

<div style="z-index: 2000;">