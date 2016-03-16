<?php 
@session_start();

$pub = 0;
if(!isset($_SESSION['i'])) {
	@session_destroy();
	@session_start();
	$_SESSION['i'] = 0;
	$_SESSION['t'] = time();
}
if(isset($_SESSION['t'])) {
	if(time() >= $_SESSION['t']+300) {
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
echo('<!DOCTYPE html>');
echo('<html>');
echo('<head>');
echo('<title>VIP Studios >> Convert @ny iOS App, Android App or Website into a WebApp; Go mobile today!</title>');
$css = '
a:link {
font-family: Myriad Pro;
font-size: 16px;
color: #FFFFFF;
font-weight: normal;
text-decoration : none;
}
a:visited {
font-family: Myriad Pro;
font-size: 16px;
color: #FFFFFF;
font-weight: normal;
text-decoration : none;
}
a:hover {
font-family: Myriad Pro;
font-size: 16px;
color: #FFFFFF;
font-weight: normal;
text-decoration : underline;
}
a:active {
font-family: Myriad Pro;
font-size: 16px;
color: #FFFFFF;
font-weight: normal;
text-decoration : none;
}
img {
margin: 0px 0px 0px 0px;
padding: 0px 0px0px 0px;
border: 0px;	
}
.input {
font-family: Arial;
font-size: 22px;
font-color: #FFFFFF;		
}
#clientLoginPage {
cursor: pointer;		
}
#VIPstudiosPage {
cursor: pointer;		
}
html {
margin: 0px 0px 0px 0px;
padding: 0px 0px 0px 0px;
height: 100%;
min-height: 100%;
background: #000000 url('.$tpl.') no-repeat center center fixed;
background-color: #000000;
-webkit-background-size: cover;
-moz-background-size: cover;
-o-background-size: cover;
background-size: cover;
text-align: center;
}
body {
margin: 0px 0px 0px 0px;
padding: 0px 0px 0px 0px;
text-align: center;
}
div.nav {
margin: 0px 0px 0px 0px;
padding: 0px 0px 0px 0px;
width: 100%;
height: 46px;
border-width: 1px;
border-color: #333333;
border-style: solid;
background-color: #663300;
z-index: 99;
position: fixed;
text-align: left;
}
div.cloudMenu {
margin: 0px 6px 0px 0px;
padding: 0px 0px 0px 0px;
width: 45px;
height: 45px;
z-index: 99;
position: relative;
float: right;
cursor: pointer;
}
div.cloudMenuNav {
margin: 47px 0px 0px 0px;
padding: 0px 0px 0px 0px;
width: 175px;
height: 75px;
z-index: 89;
text-align: left;
position: absolute;
border-width: 1px;
border-color: #333333;
border-style: solid;
background-color: #000000;
display: none;
right: 0px;
-webkit-opacity: 0.8;
-moz-opacity: 0.8;
-o-opacity: 0.8;
opacity: 0.8;
}
div.opacity10 {
margin: 0px 0px 0px 0px;
padding: 0px 0px 0px 0px;
width: 100%;
height: 100%;
-webkit-opacity: 1.0;
-moz-opacity: 1.0;
-o-opacity: 1.0;
opacity: 1.0;
}
div.acontent {
margin: 65px auto 0px auto;
padding: 3px 3px 3px 3px;
width: 300px;
height: 300px;
border-width: 1px;
border-color: #333333;
border-style: solid;
background-color: #000000;
position: absolute;
z-index: 1;
left: 46%;
-webkit-border-radius: 15px;
-webkit-opacity: 0.8;
-moz-border-radius: 15px;
-moz-opacity: 0.8;
-o-border-radius: 15px;
-o-opacity: 0.8;
border-radius: 15px;
opacity: 0.8;
text-align: left;
overflow-x: hidden;
overflow-y: hidden;
}
div.bcontent {
margin: 385px auto 0px auto;
padding: 3px 3px 3px 3px;
width: 300px;
height: 300px;
border-width: 1px;
border-color: #333333;
border-style: solid;
background-color: #000000;
position: absolute;
z-index: 1;
left: 46%;
-webkit-border-radius: 15px;
-webkit-opacity: 0.8;
-moz-border-radius: 15px;
-moz-opacity: 0.8;
-o-border-radius: 15px;
-o-opacity: 0.8;
border-radius: 15px;
opacity: 0.8;
text-align: left;
overflow-x: hidden;
overflow-y: scroll;
}
div.ccontent {
margin: 705px auto 0px auto;
padding: 3px 3px 3px 3px;
width: 300px;
height: 300px;
border-width: 1px;
border-color: #333333;
border-style: solid;
background-color: #000000;
position: absolute;
z-index: 1;
left: 46%;
-webkit-border-radius: 15px;
-webkit-opacity: 0.8;
-moz-border-radius: 15px;
-moz-opacity: 0.8;
-o-border-radius: 15px;
-o-opacity: 0.8;
border-radius: 15px;
opacity: 0.8;
text-align: left;
overflow-x: hidden;
overflow-y: scroll;
}
div.dcontent {
margin: 65px auto 0px auto;
padding: 3px 3px 3px 3px;
width: 300px;
height: 300px;
border-width: 1px;
border-color: #333333;
border-style: solid;
background-color: #000000;
position: absolute;
z-index: 2;
left: 46%;
-webkit-border-radius: 15px;
-webkit-opacity: 0.8;
-moz-border-radius: 15px;
-moz-opacity: 0.8;
-o-border-radius: 15px;
-o-opacity: 0.8;
border-radius: 15px;
opacity: 0.8;
text-align: left;
overflow-x: hidden;
overflow-y: hidden;
display: none;
}
div.GitHub {
margin: auto auto 5px 5px;
padding: 0px 0px 0px 0px;
width: 55px;
height: 125px;
z-index: 25;
position: fixed;
bottom: 0;
left: 0;
}
div.clientLoginResponse {
margin: 0px 0px 0px 0px;
padding: 3px 3px 3px 3px;
font-family: Arial;
font-size: 12px;
color: #FFFFFF;		
}
div.clientLogin {
margin: 0px 0px 0px 0px;
padding: 3px 3px 3px 3px;
font-family: Arial;
font-size: 14px;
color: #FFFFFF;		
}
span.f_arial12 {
font-family: Arial;
font-size: 12px;		
}
span.f_arial14 {
font-family: Arial;
font-size: 14px;		
}
span.f_arial12 {
font-family: Arial;
font-size: 16px;		
}
span.f_bold {
font-weight: bold;		
}
span.c_ffffff {
color: #FFFFFF;
}
';
$css = str_replace(array("\t","\n","\r"),"",$css);
echo('<meta name="viewport" content="width=100%; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;"/>');
echo('<script src="./www-cgi/jquery-1.9.1.min.js"></script>');
//echo('<script src="./www-cgi/jquery-1.12.1.min.js"></script>');
//echo('<script src="./www-cgi/jquery-2.2.1.min.js"></script>');
//echo('<script src="./www-cgi/jquery-ui.min.js"></script>');
//echo('<script src="./www-cgi/jquery-ui.min.css"></script>');
//echo('<script src="./www-cgi/jquery-ui.structure.min.css"></script>');
//echo('<script src="./www-cgi/jquery-ui.theme.min.css"></script>');
//echo('<script src="./www-cgi/jquery.mobile-1.4.5.min.js"></script>');
echo('<link rel="stylesheet" href="./www-cgi/vegas.min.css">');
echo('<script src="./www-cgi/vegas.min.js"></script>');
echo('<style type="text/css">'.$css.'</style>');
$scripts = ('
<script>
$(document).ready(function(){
    $("p").click(function(){
        $(this).hide();
    });
	$("#cloudMenu").click(function() {
		if($("#acontent").css("display") != "none") {
			$("#acontent").toggle();
		}
  		if($("#bcontent").css("display") != "none") {
			$("#bcontent").toggle();
		}
		if($("#ccontent").css("display") != "none") {
			$("#ccontent").toggle();
		}
		if($("#dcontent").css("display") != "none") {
			$("#dcontent").toggle();
		}
		$("#cloudMenuNav").toggle();
	});
	$("#VIPstudiosPage").click(function() {
		$("#acontent").toggle();
		$("#bcontent").toggle();
		$("#ccontent").toggle();
		$("#cloudMenuNav").toggle();
	});
	$("#clientLoginPage").click(function() {
		$("#dcontent").toggle();
		$("#cloudMenuNav").toggle();
	});
	$("#clientLogin").load("./www-cgi/fastsaas.php?vu=1:1",function(){
        $("#clientLogin").on("submit", "#d01", function(e){
            e.preventDefault();
			$("#clientLoginResponse").show();
            $.ajax({
        	data: $(this).serialize(),
        	type: $(this).attr("method"),
        	url: $(this).attr("action"),
        	success: function(response) {
            	$("#clientLoginResponse").html(response);
				$("#clientLoginResponse").delay(999).fadeOut();
				$("#clientLogin").load("./www-cgi/fastsaas.php?vu=1:1");
        	}
   			});
			$(document).ajaxComplete(function() {
  				if($("#success").length){
					$("#clientLoginPageli2").text("ClientLogout");
				}
			});
    		return false;
        });
    });
	$("#body, body").vegas({
		overlay: "./www-cgi/overlays/02.png",
		animation: "random",
		transition: ["fade","fade2","slideLeft","slideLeft2","slideRight","slideRight2"],
		delay: 6999,
    	slides: [{src: "./www-img/vipAustin1.jpg"},{src: "./www-img/vipCayman1.jpg"},{src: "./www-img/vipHouston2.jpg"},{src: "./www-img/vipParis1.jpg"},{src: "./www-img/vipTokyo1.jpg"}]
	});
});
</script>
');
$scripts = str_replace(array(" ","\t","\n","\r"),"",$scripts);
echo($scripts);

echo('</head>');
echo('<body>');
echo('<div class="nav"><a href="'.$_SERVER['PHP_SELF'].'"><img src="./www-img/vipLogo.png"></a>');

echo('<div class="cloudMenu" id="cloudMenu"><img src="./www-img/vipCloudMenu.png"></div>');

echo('</div>');

echo('<div class="cloudMenuNav" id="cloudMenuNav">');

echo('<span class="c_ffffff"><span class="f_arial14">');

echo('<ul class="cloudMenuList" id="cloudMenuList">');
echo('<li><span id="VIPstudiosPage"><span id="clientLoginPageli1">VIP</span></span></li><br>');
echo('<li><span id="clientLoginPage"><span id="clientLoginPageli2">ClientLogin</span></span></li><br>');
echo('</ul>');

echo('</span></span>');

echo('</div>');

echo('<div class="acontent" id="acontent">');

echo('<span class="c_ffffff"><h3>#VIPstudios</h3></span>');

echo('<img src="./www-img/gmobile.png">');

echo('<span class="c_ffffff"><em>#AmazingPrices!</em>&nbsp;<em>#FastService!</em><br><em>#FullStackDevelopment!</em><br><em><a href="mailto:vipstudios@gmx.com" style="color:#FFFF00;">#InquireToday!</a></em></span>');

echo('</div>');

echo('<div class="bcontent" id="bcontent">');

echo('<span class="c_ffffff"><h5>#Apps</h5></span>');

echo('<img src="./www-img/vip9.png">');

echo('<img src="./www-img/vip2.png">');

echo('<span class="f_arial12"><span class="c_ffffff">Custom iOS & Android apps starting at only $<b><i>2999</i></b> custom coded in Objective-C for iOS or Java for Android. Inquire today for a FREE quote!</span></span>');

echo('<span class="c_ffffff"><p><em>If you click on me, I will disappear.</em></p>');
echo('<p><em>Click me away!</em></p>');
echo('<p><em>Click me too!</em></p></span>');

echo('</div>');

echo('<div class="ccontent" id="ccontent">');

echo('<span class="c_ffffff"><h5>#Websites</h5></span>');

echo('<img src="./www-img/vipWebsites.png" width="300" height="125">');

echo('<span class="f_arial12"><span class="c_ffffff">Custom templates to work with any CMS starting at only $<b><i>999</i></b> custom coded in HTML5, CSS3 and Javascript!</span></span>');

echo('<span class="f_arial16"><span class="c_ffffff"><span class="f_bold"><ul><li><img src="./www-img/vipLogoWordpress.png">&nbsp;&nbsp;Works w/Wordpress</li><li><img src="./www-img/vipLogoJoomla.png">&nbsp;&nbsp;Joomla</li><li><img src="./www-img/vipLogoMagento.png">&nbsp;&nbsp;Magento</li><li><img src="./www-img/vipLogoShopify.png">&nbsp;&nbsp;Shopify</li><li><img src="./www-img/vipLogoDrupal.png">&nbsp;&nbsp;Drupal</li><li><img src="./www-img/vipLogoBlogger.png">&nbsp;&nbsp;Blogger</li><li><img src="./www-img/vipLogoTypo3.png">&nbsp;&nbsp;TYPO3</li><li><img src="./www-img/vipLogoPrestaShop.png">&nbsp;&nbsp;PrestaShop</li><li><img src="./www-img/vipLogoBitrix.png">&nbsp;&nbsp;Bitrix</li><li><img src="./www-img/vipLogoOpenCart.png">&nbsp;&nbsp;OpenCart</li><li><img src="./www-img/vipLogoVbulletin.png">&nbsp;&nbsp;vBulletin</li><li>and more!</li></ul></span></span></span>');

echo('<span class="c_ffffff"><h5>#WebApps</h5></span>');

echo('<img src="./www-img/vipWebApps.png" width="300" height="175">');

echo('<span class="f_arial12"><span class="c_ffffff">Custom WebApps starting at only $<b><i>1999</i></b> custom coded in PHP5, HTML5, CSS3, SQL, MySQL and Javascript! Your WebApp will run on iOS, Android, Blackberry, Windows, Mac, and Linux running natively on any browser so stop targeting individual devices and go pro with an enterprise level WebApp today!</span></span><br><br>');

echo('</div>');

echo('<div class="dcontent" id="dcontent">');

echo('<span class="c_ffffff"><h5>#ClientLogin;{></h5></span>');

echo('<div class="clientLoginResponse" id="clientLoginResponse"></div>');

echo('<div class="clientLogin" id="clientLogin"></div>');

echo('</div>');

echo('<div class="GitHub"><a href="http://www.github.com/vipstudios" target="_blank"><img src="./www-img/vipLogoGitHub.png"></a></id>');

for($i=0;$i<55;$i++) {
	echo('<br>');
}
echo('</body>');
echo('</html>');
$_SESSION['tpl']++;
if($_SESSION['tpl'] == '6') {
	$_SESSION['tpl'] = '1';
}
?>
