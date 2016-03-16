# FaStSAAS
PHP Session Management Framework

//-----------------------------------------------------------------------------------------------------
//--FaStSAAS v.3.1*"#HaulsAas!"
//-----------------------------------------------------------------------------------------------------
//--*FaStSAAS By James Schulze ;{>
//--"Fast Software as a Service"
//--Dynamic Objects allow you to do anything w/PHP 
//--Create a login form object d01 on page vu=1:1 and a signup form d02 on page 1:2
//--Create a data loop on 2:1 that allows logged in members a home page or redirected to login
//--Pages are dynamic and can go up to vu=9999:9999:9999:9999:9999
//--Drop fastsaas.php into a folder that can be protected from the www
//--Then make Jquery Ajax calls to include dynamic content into @ny div
//--Call the logout url to destroy the session: ./www-cgi/fastsaas.php?vu=9999
//--Name "d01_usrid_1_1_113_2_1_1" each variable is as follows: explode('_',$variable);
//-----------------------------------------------------------------------------------------------------
//--:::::::::::::::::::::::::VARIABLE NAMING PATTERN EXPLAINED BELOW:::::::::::::::::::::::::::::::::::
//-----------------------------------------------------------------------------------------------------
//--object#d01-d9999_varName_stackOrder_activeElement_regexPattern_inputType_addToObject_required
//-----------------------------------------------------------------------------------------------------
//--object: array[0]
//--The dynamic object this variable belongs to d01-d9999.
//--_
//--varName: array[1]
//--{varName: displayed onScreen}
//--{data:,
//-- slirid:Merchant,
//-- searc:Search,
//-- pricr:Reserve,
//-- prics:Start Price,
//-- price:Price,
//-- fname:First Name,
//-- mname:Middle Name,
//-- lname:Last Name,
//-- wname:Full Name,
//-- bname:Name,
//-- pname:Email or ID to send payment to,
//-- ptrid:Transaction ID,
//-- email:Email,
//-- addra:Address 1,
//-- addrb:Address 2,
//-- zipce:Zip Code,
//-- propn:Proposal Number,
//-- subjf:Subject / Question,
//-- usrid:User ID,
//-- usrpd:Password,
//-- radio:Radio,
//-- tarea:Message,
//-- darea,Description
//-- title:Title,
//-- descr:Description,
//-- phone:Phone,
//-- ddfax:Fax,
//-- image:Image,
//-- curla:Current site http://,
//-- curlb:Example http://,
//-- curlc:Web://,
//-- curld:Tracking URL,
//-- r-radio-type:Radio Type,
//-- c-checkbox-list:Checkbox List}
//-- Anything you append seperated by '--' will become the options (ie.d20_r-listing-type_8_2_107_4_1_1_free--premium)
//--_
//--stackOrder: array[2]
//--1-999 Position in form element (ie. First Name: can be moved in a form from position 1 to 6)
//--_
//--activeElement: array[3]
//--1, Active
//--2, disabled
//--*Makes form elements active or disabled
//--_
//--regexPattern: array[4]
//--1-3 digits pointing to Regex patterns in rgx() to sanitize input against
//--_
//--inputType: array[5]
//--1,nothing
//--2,<input type="text"
//--3,<input type="password"
//--4,radio buttons
//--5,checkboxes
//--6,<textarea
//--7,<input type="file"
//--_
//--addToObject: array[6]
//--1,yes; this is part of a form object
//--2,no; this is a data object
//--_
//--required: array[7]
//--1,yes
//--2,no
//--_
//--The optional 8th position on the array is used to name form radio buttons and checkboxes seperated by a '--' double dash

//--For every object you create you will have to write the corresponding code in mod5 that gets executed along with redirects
//--d01 is a login form and d02 a signup form already in the array-->
/* 
								///DYNAMIC OBJECTS
	    						case 'd03':
	    							
	    						break;
	    						case 'd04':
	    							
	    						break;
	    						case 'd05':
	    							
	    						break;
	    						///DYNAMIC OBJECTS
	    						case 'd9999'://LOGOUT;{>
	    							switch($_SESSION['d9999_data_1_1_999_1_2_1']) {
	    								case '1':
	    									session_destroy();
	    									$_SESSION['d9999_data_1_1_999_1_2_1'] = '2';
	    									header('Location: '.$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);
	    									exit;
	    								break;
	    								case '2':
	    									echo('<span id="success">You have been logged out...</span>');
	    								break;
	    							}
	    						break;
 */

//   function dbi() needs your database nfo (ie.database,userid,password)

//-- CREATE TABLE account (acct int(255) UNSIGNED AUTO_INCREMENT PRIMARY KEY,seclvl int(3),secmsg int(3),seckey varchar(255),secipl varchar(255),email varchar(255),userid varchar(255),passwd varchar(255),cashier decimal(10,2),subscription_start bigint(255) UNSIGNED,subscription_end bigint(255) UNSIGNED,subscription_typ int(3),pref1 int(3),pref2 int(3),pref3 int(3),pref4 int(3),pref5 int(3),pref6 int(3));

//-- vipstudios@gmx.com for support.
