<?php
@session_start();
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
echo('<title>Web apps @ vipstudios = responsive web design.</title>');
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
a.phone:link {
	font-family: Myriad Pro;
	font-size: 12px;
	color: #FFFFFF;
	font-weight: normal;
	text-decoration : none;
}
a.phone:visited {
	font-family: Myriad Pro;
	font-size: 12px;
	color: #FFFFFF;
	font-weight: normal;
	text-decoration : none;
}
a.phone:hover {
	font-family: Myriad Pro;
	font-size: 12px;
	color: #FFFFFF;
	font-weight: normal;
	text-decoration : none;
}
a.phone:active {
	font-family: Myriad Pro;
	font-size: 12px;
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
#VIPStudiosLink {
	cursor: pointer;		
}
#HotDealsLink {
	cursor: pointer;		
}
#ContactUsLink {
	cursor: pointer;		
}
#InquireToday {
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
	background-color: #000000;
	z-index: 99;
	position: fixed;
	text-align: left;
	-webkit-opacity: 0.8;
	-moz-opacity: 0.8;
	-o-opacity: 0.8;
	opacity: 0.8;
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
	margin: 0px 0px 0px 0px;
	padding: 0px 0px 0px 0px;
	width: 175px;
	height: 100%;
	z-index: 89;
	text-align: left;
	position: fixed;
	top: 47px;
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
div.vipConcierge {
	margin: 0px 0px 0px 0px;
	padding: 0px 0px 0px 0px;
	width: 175px;
	height: 25px;
	z-index: 89;
	position: fixed;
	bottom: 3px;
}
div.vipWiFi {
	margin: 0px 0px 0px 0px;
	padding: 0px 0px 0px 0px;
	width: 65px;
	height: 45px;
	z-index: 90;
	position: fixed;
	bottom: 11px;
	right: 11px;
}
div.phone {
	margin: 3px 0px 0px 0px;
	padding: 0px 0px 0px 0px;
	width: 100%;
	height: 45px;
	z-index: 89;		
}
div.CustomerSupport {
	margin: 0px 0px 0px 0px;
	padding: 0px 0px 0px 0px;
	font-family: Arial;
	font-size: 12px;
	color: #FFFFFF;
	display: none;
	overflow-x: hidden;
	overflow-y: hidden;
	z-index: 87;
	border-width: 0px;
	border-color: #FF0000;
	border-style: solid;
	position: relative;	
}
div.MakeMoney {
	margin: 0px 0px 0px 0px;
	padding: 0px 0px 0px 0px;
	font-family: Arial;
	font-size: 12px;
	color: #FFFFFF;
	overflow-x: hidden;
	overflow-y: hidden;
	z-index: 9;
	border-width: 0px;
	border-color: #FF0000;
	border-style: solid;
	position: relative;	
}
div.HelpDesk {
	margin: 68px 0px 0px 5px;
	padding: 0px 0px 0px 0px;
	width: 300px;
	height: 45px;
	z-index: 85;
	text-align: left;
	vertical-align: top;
	position: fixed;
	border-width: 0px;
	border-color: #333333;
	border-style: solid;
	background-color: #000000;
	font-family: Arial;
	font-size: 12px;
	color: #FFFFFF;
	display: none;
	left: 0px;
	-webkit-opacity: 1.0;
	-moz-opacity: 1.0;
	-o-opacity: 1.0;
	opacity: 1.0;
	-o-border-radius: 8px;
	-webkit-border-radius: 8px;
	-moz-border-radius: 8px;
	border-radius: 8px;
}
div.acontent {
	margin: 90px auto 0px auto;
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
	-webkit-opacity: 0.8;
	-moz-opacity: 0.8;
	-o-opacity: 0.8;
	opacity: 0.8;
	-o-border-radius: 15px;
	-webkit-border-radius: 15px;
	-moz-border-radius: 15px;
	border-radius: 15px;
	text-align: left;
	overflow-x: hidden;
	overflow-y: hidden;
}
div.bcontent {
	margin: 410px auto 0px auto;
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
	-webkit-opacity: 0.8;
	-moz-opacity: 0.8;
	-o-opacity: 0.8;
	opacity: 0.8;
	-o-border-radius: 15px;
	-webkit-border-radius: 15px;
	-moz-border-radius: 15px;
	border-radius: 15px;
	text-align: left;
	overflow-x: hidden;
	overflow-y: scroll;
}
div.ccontent {
	margin: 730px auto 0px auto;
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
	-webkit-opacity: 0.8;
	-moz-opacity: 0.8;
	-o-opacity: 0.8;
	opacity: 0.8;
	-o-border-radius: 15px;
	-webkit-border-radius: 15px;
	-moz-border-radius: 15px;
	border-radius: 15px;
	text-align: left;
	overflow-x: hidden;
	overflow-y: scroll;
}
div.dcontent {
	margin: 90px auto 0px auto;
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
	-webkit-opacity: 0.8;
	-moz-opacity: 0.8;
	-o-opacity: 0.8;
	opacity: 0.8;
	-o-border-radius: 15px;
	-webkit-border-radius: 15px;
	-moz-border-radius: 15px;
	border-radius: 15px;
	text-align: left;
	overflow-x: hidden;
	overflow-y: hidden;
	display: none;
}
div.econtent {
	margin: 90px auto 0px auto;
	padding: 3px 3px 3px 3px;
	width: 300px;
	height: 300px;
	border-width: 1px;
	border-color: #333333;
	border-style: solid;
	background-color: #000000;
	position: absolute;
	z-index: 3;
	left: 46%;
	-webkit-opacity: 0.8;
	-moz-opacity: 0.8;
	-o-opacity: 0.8;
	opacity: 0.8;
	-o-border-radius: 15px;
	-webkit-border-radius: 15px;
	-moz-border-radius: 15px;
	border-radius: 15px;
	text-align: left;
	overflow-x: hidden;
	overflow-y: hidden;
	display: none;
}
div.EmailMe {
	margin: 49px 0px 0px 5px;
	padding: 3px 3px 3px 3px;
	width: 120px;
	height: 12px;
	vertical-align: top;
	text-align: center;
	position: fixed;
	z-index: 99;
	background-color: #000000;
	-webkit-opacity: 0.2;
	-moz-opacity: 0.2;
	-o-opacity: 0.2;
	opacity: 0.2;
}
div.Jackpot {
	margin: 70px 0px 0px 7px;
	padding: 0px 0px 0px 0px;
	width: 75px;
	height: 75px;
	position: absolute;
	z-index: 9;	
}
div.JackpotBanner {
	margin: 0px 0px 0px 0px;
	padding: 7px 0px 0px 0px;
	width: 300px;
	height: 25px;
	position: absolute;
	z-index: 9;
	text-align: center;
	background-color: #000000;
	-webkit-opacity: 0.6;
	-moz-opacity: 0.6;
	-o-opacity: 0.6;
	opacity: 0.6;
}
div.SocialBar {
	margin: auto auto 5px 5px;
	padding: 0px 0px 0px 0px;
	width: 45px;
	height: 150px;
	z-index: 25;
	position: fixed;
	bottom: 0px;
	left: 0px;
	float: bottom;
}
div.Facebook {
	margin: 0px 0px 0px 0px;
	padding: 0px 0px 0px 0px;
	width: 45px;
	height: 45px;
	z-index: 25;
	position: relative;
}
div.Twitter {
	margin: 0px 0px 0px 0px;
	padding: 0px 0px 0px 0px;
	width: 45px;
	height: 45px;
	z-index: 25;
	position: relative;
}
div.GitHub {
	margin: 0px 0px 0px 0px;
	padding: 0px 0px 0px 0px;
	width: 45px;
	height: 45px;
	z-index: 25;
	position: relative;
}
div.HotDeals {
	margin: 0px 0px 0px 0px;
	padding: 3px 3px 3px 3px;
	font-family: Arial;
	font-size: 14px;
	color: #FFFFFF;
	overflow-x: hidden;
	overflow-y: hidden;
	z-index: 3;
	border-width: 0px;
	border-color: #FF0000;
	border-style: solid;
	position: relative;
}
div.ContactUs {
	margin: 0px 0px 0px 0px;
	padding: 3px 3px 3px 3px;
	font-family: Arial;
	font-size: 14px;
	color: #FFFFFF;
	overflow-x: hidden;
	overflow-y: hidden;
	z-index: 3;
	border-width: 0px;
	border-color: #FF0000;
	border-style: solid;
	position: relative;	
}
div.copyright {
	margin: 0px 0px 0px 0px;
	padding: 0px 0px 0px 0px;
	text-align: right;
	vertical-align: middle;
	width: 100%;
	height: 15px;
	z-index: 89;
}
span.f_arial10 {
	font-family: Arial;
	font-size: 10px;		
}
span.f_arial11 {
	font-family: Arial;
	font-size: 11px;		
}
span.f_arial12 {
	font-family: Arial;
	font-size: 12px;		
}
span.f_arial13 {
	font-family: Arial;
	font-size: 13px;		
}
span.f_arial14 {
	font-family: Arial;
	font-size: 14px;		
}
span.f_arial15 {
	font-family: Arial;
	font-size: 15px;		
}
span.f_arial16 {
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
//echo('<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">');
echo('<script src="./www-cgi/jquery-1.9.1.min.js"></script>');
//echo('<script src="./www-cgi/jquery-1.12.1.min.js"></script>');
//echo('<script src="./www-cgi/jquery-2.2.1.min.js"></script>');
//echo('<script src="./www-cgi/jquery-ui.min.js"></script>');
//echo('<script src="./www-cgi/jquery-ui.min.css"></script>');
//echo('<script src="./www-cgi/jquery-ui.structure.min.css"></script>');
//echo('<script src="./www-cgi/jquery-ui.theme.min.css"></script>');
echo('<link rel="stylesheet" href="./www-cgi/vegas.min.css">');
echo('<script src="./www-cgi/vegas.min.js"></script>');
echo('<style type="text/css">'.$css.'</style>');
$scripts = ('
<script>
$(document).ready(function() {
	$("p").click(function() {
		$(this).hide();
	});
	$("#cloudMenu").click(function() {
		if($("#acontent").css("display") != "none") {
			$("#acontent").hide();
		}
		if($("#bcontent").css("display") != "none") {
			$("#bcontent").hide();
		}
		if($("#ccontent").css("display") != "none") {
			$("#ccontent").hide();
		}
		if($("#dcontent").css("display") != "none") {
			$("#dcontent").hide();
		}
		if($("#econtent").css("display") != "none") {
			$("#econtent").hide();
		}
		$("#HotDeals").empty();
		$("#ContactUs").empty();
		$("#cloudMenuNav").show();
	});
	$("#VIPStudiosLink").click(function() {
		$("#cloudMenuNav").hide();
		$("#acontent").show();
		$("#bcontent").show();
		$("#ccontent").show();
		$("#MakeMoney").empty();
		$("#MakeMoney").load("./www-cgi/fastsaas.php?vu=1:2");
		$("#MakeMoney").load("./www-cgi/fastsaas.php?vu=1:2");
		$("#MakeMoney").show();
	});
	$("#HotDealsLink").click(function() {
		$("#cloudMenuNav").hide();
		$("#dcontent").show();
		$("#HotDeals").empty();
		$("#HotDeals").load("./www-cgi/fastsaas.php?vu=1:1");
		$("#HotDeals").load("./www-cgi/fastsaas.php?vu=1:1");
		$("#HotDeals").show();
	});
	$("#ContactUsLink").click(function() {
		$("#cloudMenuNav").hide();
		$("#econtent").show();
		$("#ContactUs").empty();
		$("#ContactUs").load("./www-cgi/fastsaas.php?vu=3:1");
		$("#ContactUs").load("./www-cgi/fastsaas.php?vu=3:1");
		$("#ContactUs").show();
	});
	$("#InquireToday").click(function() {
		$("#acontent").hide();
		$("#bcontent").hide();
		$("#ccontent").hide();
		$("#econtent").show();
		$("#ContactUs").empty();
		$("#ContactUs").load("./www-cgi/fastsaas.php?vu=3:1");
		$("#ContactUs").load("./www-cgi/fastsaas.php?vu=3:1");
		$("#ContactUs").show();
	});
	$("#CustomerSupport").empty();
	$("#CustomerSupport").load("./www-cgi/fastsaas.php?vu=4:1");
	$("#CustomerSupport").load("./www-cgi/fastsaas.php?vu=4:1");
	$("#CustomerSupport").show();
	$("#HelpDesk").delay(5000).fadeIn(function() {
		$("#MakeMoney").empty();
		$("#MakeMoney").load("./www-cgi/fastsaas.php?vu=1:2");
		$("#MakeMoney").load("./www-cgi/fastsaas.php?vu=1:2");
		$("#MakeMoney").show();
	});
	$("#HotDeals").on("submit", "#d01", function(e){
		e.preventDefault();
		$.ajax({
			data: $(this).serialize(),
			type: $(this).attr("method"),
			url: $(this).attr("action"),
			success: function(response) {
				$("#HotDeals").html(response);
				$("#HotDeals").delay(999).fadeOut(function() {
					$("#HotDeals").empty();
					$("#HotDeals").load("./www-cgi/fastsaas.php?vu=1:1");
					$("#HotDeals").load("./www-cgi/fastsaas.php?vu=1:1");
					$("#HotDeals").show();
				});
			}
		});
		return false;
	});
	$("#MakeMoney").on("submit", "#d02", function(e){
		e.preventDefault();
		$.ajax({
			data: $(this).serialize(),
			type: $(this).attr("method"),
			url: $(this).attr("action"),
			success: function(response) {
				$("#MakeMoney").html(response);
				$("#MakeMoney").delay(999).fadeOut(function() {
					$("#MakeMoney").empty();
					$("#MakeMoney").load("./www-cgi/fastsaas.php?vu=1:2");
					$("#MakeMoney").load("./www-cgi/fastsaas.php?vu=1:2");
					$("#MakeMoney").show();
				});
			}
		});
		return false;
	});
	$("#ContactUs").on("submit", "#d04", function(e){
		e.preventDefault();
		$.ajax({
			data: $(this).serialize(),
			type: $(this).attr("method"),
			url: $(this).attr("action"),
			success: function(response) {
				$("#ContactUs").html(response);
				$("#ContactUs").delay(999).fadeOut(function() {
					$("#ContactUs").empty();
					$("#ContactUs").load("./www-cgi/fastsaas.php?vu=3:1");
					$("#ContactUs").load("./www-cgi/fastsaas.php?vu=3:1");
					$("#ContactUs").show();
				});
			}
		});
		return false;
	});
	$("#CustomerSupport").on("change", "#dbq_f", function(e){
		e.preventDefault();
		$.ajax({
			data: $(this).serialize(),
			type: $(this).attr("method"),
			url: $(this).attr("action"),
			success: function(response) {
				$("#CustomerSupport").html(response);
				$("#CustomerSupport").delay(999).fadeOut(function() {
					$("#CustomerSupport").empty();
					$("#CustomerSupport").load("./www-cgi/fastsaas.php?vu=4:1");
					$("#CustomerSupport").load("./www-cgi/fastsaas.php?vu=4:1");
					$("#CustomerSupport").show();
				});
			}
		});
		return false;
	});
	$("body").vegas( {
		overlay: "./www-cgi/overlays/02.png",
		animation: "random",
		transition: ["fade","fade2","slideLeft","slideLeft2","slideRight","slideRight2"],
		delay: 6999,
		slides: [{src: "./www-img/vipAustin1.jpg"},{src: "./www-img/vipCayman1.jpg"},{src: "./www-img/vipHouston2.jpg"},{src: "./www-img/vipParis1.jpg"},{src: "./www-img/vipTokyo1.jpg"}]
	});
});
</script>
');
/*
		1AND1 WEB HOSTING USES A PHP SESSION WRAPPER FOR TRACKING THAT FASTSAAS DOES NOT LIKE;
		A DOUBLE CALL SOMEWHAT FIXED IT. IF YOU SIGNUP FOR WEB HOSTING THEN QUIT AT THE PAYMENT
		PAGE @1AND1.COM THEY WILL EMAIL YOU A $10 OFF COUPON WHICH WILL GET YOU A YEAR OF HOSTING
		FOR $1.88 AFTER APPLYING THE COUPON TO THE $11.88 YEARLY SALE PRICE ON THE LINUX UNLIMITED;
		I WOULD NOT RECOMMEND USING FOR COMPLICATED FASTSAAS DEVELOPMENT!!!
		
		*ON A NORMAL DEDICATED SERVER ERASE 1 OF THE DOUBLE LINES
		$("#clientLogin").load("./www-cgi/fastsaas.php?vu=1:1");
		$("#clientLogin").load("./www-cgi/fastsaas.php?vu=1:1");
		
		*TO THIS->
		$("#clientLogin").load("./www-cgi/fastsaas.php?vu=1:1");
		
		@NYWHERE YOU SEE A DOUBLE LOAD.
		
		$("#HotDeals").on("submit", "#d01", function(e){
			e.preventDefault();
			$.ajax({
				data: $(this).serialize(),
				type: $(this).attr("method"),
				url: $(this).attr("action"),
				success: function(response) {
					$("#HotDeals").html(response);
					$("#HotDeals").delay(999).fadeOut(function() {
						$("#HotDeals").empty();
						$("#HotDeals").load("./www-cgi/fastsaas.php?vu=1:1");
						$("#HotDeals").load("./www-cgi/fastsaas.php?vu=1:1");
						$("#HotDeals").show();
					});
				}
			});
			return false;
		});
*/
$scripts = str_replace(array("\t","\n","\r"),"",$scripts);
echo($scripts);

echo('</head>');
echo('<body>');
echo('<div class="nav"><a href="'.$_SERVER['PHP_SELF'].'?"><img src="./www-img/vipLogo.png"></a>');

echo('<div class="cloudMenu" id="cloudMenu"><img src="./www-img/vipCloudMenu.png"></div>');

echo('</div>');

echo('<div class="cloudMenuNav" id="cloudMenuNav">');

echo('<span class="c_ffffff"><span class="f_arial14">');

echo('<ul class="cloudMenuList" id="cloudMenuList">');
echo('<li><span id="VIPStudiosLink"><span id="link1">VIP ;{></span></span></li><br>');
echo('<li><span id="HotDealsLink"><span id="link2">HotDeals</span></span></li><br>');
echo('<li><span id="ContactUsLink"><span id="link3">ContactUs</span></span></li><br>');
echo('</ul>');

echo('</span></span>');

echo('<div class="vipWiFi"><img src="./www-img/vipWiFi.png"></div>');

echo('<div class="vipConcierge"><img src="./www-img/vipConcierge.jpg"></div>');

echo('</div>');

echo('<div class="EmailMe" id="emailMe"><a href="mailto:vipstudios@gmx.com" style="font-size: 10px; vertical-align: top; text-decoration: none;">vipstudios@gmx.com</a></div>');

echo('<div class="HelpDesk" id="HelpDesk">');

echo('<div class="CustomerSupport" id="CustomerSupport"></div>');
		
echo('</div>');

echo('<div class="acontent" id="acontent">');

echo('<span class="c_ffffff"><h3>#VIPstudios</h3></span>');

echo('<img src="./www-img/gmobile.png">');

echo('<span class="c_ffffff"><em>#AmazingPrices!</em>&nbsp;<em>#FastService!</em><br><em>#FullStackDevelopment!</em><br><em><span id="InquireToday" style="color:#FFFF00;">#InquireToday!</span></em></span>');

echo('</div>');

echo('<div class="bcontent" id="bcontent">');

echo('<span class="c_ffffff">');

echo('<h5>#FreeCash?</h5>');

echo('<span class="f_arial12">');

echo('<img src="./www-img/vipMakeMoney.jpg" width="300" height="95">');

echo('<span class="f_arial14"><span class="f_bold">Step 1.</span></span> Fill out the form below.<br><span class="f_arial14"><span class="f_bold">Step 2.</span></span> *Get paid <span class="f_arial16"><span class="f_bold"><em>$500</em></span></span> dollars!<br>');

echo('*If your tip leads to a sale we\'ll mail a check out to you today for every sale you refer!');

echo('<div class="MakeMoney" id="MakeMoney"></div>');

echo('</span></span>');

echo('</div>');

echo('<div class="ccontent" id="ccontent">');

echo('<span class="c_ffffff"><h5>#Websites</h5></span>');

echo('<img src="./www-img/vipWebsites.png" width="300" height="125">');

echo('<span class="f_arial12"><span class="c_ffffff">Custom templates to work with any CMS starting at only $<b><i>999</i></b> custom coded in HTML5, CSS3 and Javascript!</span></span>');

echo('<span class="f_arial16"><span class="c_ffffff"><span class="f_bold"><ul><li><img src="./www-img/vipLogoWordpress.png">&nbsp;&nbsp;Works w/Wordpress</li><li><img src="./www-img/vipLogoJoomla.png">&nbsp;&nbsp;Joomla</li><li><img src="./www-img/vipLogoMagento.png">&nbsp;&nbsp;Magento</li><li><img src="./www-img/vipLogoShopify.png">&nbsp;&nbsp;Shopify</li><li><img src="./www-img/vipLogoDrupal.png">&nbsp;&nbsp;Drupal</li><li><img src="./www-img/vipLogoBlogger.png">&nbsp;&nbsp;Blogger</li><li><img src="./www-img/vipLogoTypo3.png">&nbsp;&nbsp;TYPO3</li><li><img src="./www-img/vipLogoPrestaShop.png">&nbsp;&nbsp;PrestaShop</li><li><img src="./www-img/vipLogoBitrix.png">&nbsp;&nbsp;Bitrix</li><li><img src="./www-img/vipLogoOpenCart.png">&nbsp;&nbsp;OpenCart</li><li><img src="./www-img/vipLogoVbulletin.png">&nbsp;&nbsp;vBulletin</li><li>and more!</li></ul></span></span></span>');

echo('<span class="c_ffffff"><h5>#WebApps</h5></span>');

echo('<img src="./www-img/vipWebApps.png" width="300" height="175">');

echo('<span class="f_arial12"><span class="c_ffffff">Custom WebApps starting at only $<b><i>1999</i></b> custom coded in PHP5, HTML5, CSS3, SQL, MySQL and Javascript! Your WebApp will run on iOS, Android, Blackberry, Windows, Mac, and Linux running natively on any browser so stop targeting individual devices and go pro with an enterprise level WebApp today!</span></span><br><br>');

echo('<span class="c_ffffff"><h5>#Apps</h5></span>');

echo('<img src="./www-img/vip9.png">');

echo('<img src="./www-img/vip2.png">');

echo('<span class="f_arial12"><span class="c_ffffff">Custom iOS & Android apps starting at only $<b><i>2999</i></b> custom coded in Objective-C for iOS or Java for Android. Inquire today for a FREE quote!</span></span>');

echo('<span class="c_ffffff"><p><em>If you click on me, I will disappear.</em></p>');
echo('<p><em>Click me away!</em></p>');
echo('<p><em>Click me too!</em></p></span>');

for($i=0;$i<3;$i++) {
    echo('<br>');
}

echo('<div class="copyright"><a href="./" target="_blank" style="text-decoration: none;font-size: 12px;">&copy;vipstudios.com</a></div>');

echo('</div>');

echo('<div class="dcontent" id="dcontent">');

echo('<span class="c_ffffff"><h5>#HotDeals</h5></span>');

echo('<div class="JackpotBanner"><span class="f_arial12"><span class="c_ffffff"><span class="f_bold">Signup today and win FREE STUFF!!!</span></span></span></div>');

echo('<div class="Jackpot"><img src="./www-img/vipJackpot.png" width="75" height="75"></div>');

echo('<img src="./www-img/vipWinBigEveryday.jpg" width="300" height="160">');

echo('<div class="HotDeals" id="HotDeals"></div>');

echo('</div>');

echo('<div class="econtent" id="econtent">');

echo('<span class="c_ffffff"><h5>#ContactUs</h5></span>');

echo('<img src="./www-img/vipCustomerService.jpg" width="300" height="95">');

echo('<div class="ContactUs" id="ContactUs"></div>');

echo('</div>');

echo('<div class="SocialBar">');

echo('<div class="Facebook"><a href="http://www.facebook.com/profile.php?id=100011477327155" target="_blank"><img src="./www-img/vipLogoFacebook.png"></a></id>');

echo('<div class="Twitter"><a href="http://www.twitter.com/realVIPstudios" target="_blank"><img src="./www-img/vipLogoTwitter.png"></a></id>');

echo('<div class="GitHub"><a href="http://www.github.com/vipstudios" target="_blank"><img src="./www-img/vipLogoGitHub2.png"></a></id>');

echo('</div>');

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
