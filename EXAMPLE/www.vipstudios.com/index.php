<?php 
@session_start();

$pub = 1;/*PUBLIC 0,1 0=LOCAL DEVELOPMENT , 1=LIVE; FIRE UP SESSION, SET RANDOM WALLPAPPER AND REDIRECT*/

if(!isset($_SESSION['i'])) {
	@session_destroy();
	@session_start();
	$_SESSION['i'] = 0;
	$_SESSION['t'] = time();
}
if(isset($_SESSION['t'])) {
	if(time() >= $_SESSION['t']+600) {
		@session_destroy();
		@session_start();
		$_SESSION['i'] = 0;
		$_SESSION['t'] = time();
	}
}
if($_SERVER['HTTP_HOST'] != 'www.vipstudios.com' && $pub == '1') {
	$_SESSION['i']++;
	header('Location: http://www.vipstudios.com/index.php?');
	exit;
}
if($_SESSION['i'] < '1' && $pub == '1') {
	$_SESSION['i']++;
	header('Location: http://www.vipstudios.com/index.php?');
	exit;
}

if(!isset($_SESSION['tpl'])) {
	$_SESSION['tpl'] = rand(1,5);
}
switch($_SESSION['tpl']) {
	case '1':
		$tpl = './www-img/vipAustin1.jpg';
	break;
	case '2':
		$tpl = './www-img/vipCayman1.jpg';
	break;
	case '3':
		$tpl = './www-img/vipHouston2.jpg';
	break;
	case '4':
		$tpl = './www-img/vipParis1.jpg';
	break;
	case '5':
		$tpl = './www-img/vipTokyo1.jpg';
	break;
}
$start_s = file_get_contents('./www-cgi/fastsaas.php');
echo($start_s);
?>
