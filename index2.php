<?php
	header('Content-Type: text/html; charset=utf-8');
	include("../config.php");
	include("includes/code/functions.php");
	checkSession();
	
	if ($title=="Login"){
		$htmlTitle = $appName;
	} 
	else{
		$htmlTitle = $title." | ".$appName;
	} 
	
	if (isset($_SESSION["UserName"])) {
		if ($cssClass=="index"){ 
			$cssClass = "home-page";
		}
		$isTeacher = false;
		if ($_SESSION["userType"]=="emTeacher" || $_SESSION["userType"]=="emDirector"){
			$isTeacher = true;
		} 
		$IdConexion=ConnectToDataBase();
	}
	
	if (isLoggedIn()) {
		$loggedUser = $_SESSION["UserName"];
		if (in_array($loggedUser, $usersWithFullHTML)) {
			$editorSettings = $editorAdvancedSettings;
		}		
	}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title><?php echo htmlspecialchars($htmlTitle, ENT_QUOTES, 'UTF-8'); ?></title>	<meta name="robots" content="noindex,nofollow" />
	<link rel="shortcut icon" href="https://boletines.educa.madrid.org/favicon.ico" type="image/x-icon" />
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<meta http-equiv="content-language" content="es" /> 
	<meta http-equiv="content-style-type" content="text/css" />
	<meta http-equiv="content-script-type" content="text/javascript" /> 
	<link href="css/styles.css?v=20240206" type="text/css" rel="stylesheet" media="all" />
	<!--[if lt IE 9]>
	<style type="text/css">.image-cropper{display:none}.image-cropper-warning{display:block}</style>
	<![endif]-->	
	<link href="js/exe_lightbox/exe_lightbox.css" type="text/css" rel="stylesheet" media="all" />
	<script type="text/javascript" src="<?php echo htmlspecialchars($jQueryPath, ENT_QUOTES, 'UTF-8'); ?>"></script>
	<script type="text/javascript" src="js/jquery.form.js"></script>	
	<script type="text/javascript" src="js/common.js?v=20240206"></script>
	<script type="text/javascript">$app.timeout=<?php echo $timer*60; ?></script>
	<?php if (isset($hasEditor) && $hasEditor==true) { ?><script type="text/javascript" src="<?php echo htmlspecialchars($editorPath, ENT_QUOTES, 'UTF-8'); ?>"></script><?php } ?>	
	<script type="text/javascript" src="js/exe_lightbox/exe_lightbox.js"></script>
	<?php if (isset($hasColorPicker) && $hasColorPicker==true) { ?><script type="text/javascript" src="js/jpicker-1.1.6.min.js"></script><?php } ?>
	<script>
		var EducaMadridHead={
			setBodyClass:function(){
				document.body.className+=" "+this.getClass()
			},getClass:function(e){
				var a=!1;
				"function"==typeof window.matchMedia&&(a=window.matchMedia("(prefers-color-scheme: dark)").matches);
				var d=EducaMadridHead.getCookie("emDarkModeOn");
				if(a){
					if(""==d||"1"==d)
					return"js em-dark-mode"
				}else if("1"==d)
					return"js em-dark-mode";
				return"js"
			},getCookie:function(e){
				e=document.cookie.match(new RegExp("(^| )"+e+"=([^;]+)"));
				return e?e[2]:""
			}
		}
	</script>
</head>
<body class="<?php echo htmlspecialchars($cssClass, ENT_QUOTES, 'UTF-8'); ?>">
<script type="text/javascript">EducaMadridHead.setBodyClass()</script>
<div id="app">
    <div id="header" class="autoclear">
    		<div id="logo"><a href="<?php echo htmlspecialchars($adminPath, ENT_QUOTES, 'UTF-8'); ?>" rel="home" title="P&aacute;gina de inicio">
				<span><?php echo htmlspecialchars($appName, ENT_QUOTES, 'UTF-8');?></span></a>
			</div>
			<?php 
				if(isLoggedIn()){
					echo '<div id="logout">'.mb_convert_encoding($_SESSION['User'],"UTF-8","ISO-8859-1") .
					' - <span class="js-required"><a href="#" class="help show-help" id="helpLink" onclick="$app.toggleHelp(this)">Ayuda</a> - </span>
					<a href="index.php?action=exit" onclick="$app.exit.confirm();return false;" class="exit">Salir</a></div>';
				}
            ?>			
    </div>    
    <div id="content">
		<h1><?php 
			if ($title!="Login") echo '<a href="./">Inicio</a> &raquo; <span id="blockLink"></span>';
			echo htmlspecialchars($title, ENT_QUOTES, 'UTF-8');
		?></h1>
		<div id="main-content"<?php if ($title!="Login") { ?> class="autoclear"<?php } ?>
