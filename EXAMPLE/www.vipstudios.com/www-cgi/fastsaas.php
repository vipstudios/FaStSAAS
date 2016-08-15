<?php
//--Distributed under the MIT License./////////////////////////////////////////////////////////////////
//-----------------------------------------------------------------------------------------------------
//--FaStSAAS v.3.1
//-----------------------------------------------------------------------------------------------------
//--FaStSAAS By James Schulze http://www.vipstudios.com 20160606
//--            "Create a WebApp in minutes!"
//--"Virtual Website API <-::-> Deliver Anything To Any Div"
//--                     WebApp
//--                      777
//--                      151
//--                      302
//--_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_
//--
//--Imagine making a virtual website with no template like so:
//--
//--./www-cgi/fastsaas.php?vu=1:1 Account Login Page (ie. d01 = MemberLogin.html = Ajax: ./PATH_TO/fastsaas.php?vu=1:1)
//--./www-cgi/fastsaas.php?vu=1:2 Account Signup Page (ie. d02 = SignUp.html = Ajax: ./PATH_TO/fastsaas.php?vu=1:2)
//--./www-cgi/fastsaas.php?vu=2:1 Members Home Page (ie. d03 =  Members.html = Ajax: ./PATH_TO/fastsaas.php?vu=2:1)
//--./www-cgi/fastsaas.php?vu=3:1 Home Page (ie. d04 = Index.html = Ajax: ./PATH_TO/fastsaas.php?vu=3:1)
//--./www-cgi/fastsaas.php?vu=4:1 Auctions Page
//--./www-cgi/fastsaas.php?vu=5:1 Classifieds Page
//--./www-cgi/fastsaas.php?vu=6:1 Networking Page
//--./www-cgi/fastsaas.php?vu=7:1 Games Page
//--./www-cgi/fastsaas.php?vu=8:1 Events Page
//--./www-cgi/fastsaas.php?vu=9999 Logout Page (ie. d9999 =  Logout.html = Ajax: ./PATH_TO/fastsaas.php?vu=9999)
//--
//--Now to create content for these pages just decide what you need to do.
//--
//--For example,
//--Let's say on the Home Page we only need to create a data loop to get a html layout from a db, well, then
//--create a data loop. It's up to you to track dynamic objects and what you've used and what you havn't. You
//--can also have multiple objects per page (ie. d04,d05,d06 all exist on Home Page).
//--
//--If you create a form it will NOT hit the dynamic object loop until all form elements pass their reg expression
//--patterns.
//--
//--Data Objects test true and will go straight into executing code in whatever loop you create.
//--
//--1) First you need to create all session variables in the constructor class $this->vrs (vrs=variables)
//--
//--        $this->vrs =   array(
//--        					 array('pg'=>'page','sl'=>'securityLevel','pd'=>'paid','vr'=>'variable','vl'=>'value','bg'=>'background','vi'=>'visualEffects','rx'=>'regExpression','rt'=>'requestType'),
//--        					 array('pg'=>'1:1','sl'=>'0:notLoggedIn,1:loggedIn','pd'=>'0:no,1:yes','vr'=>'d04_dataa_1_1_999_1_2_1','vl'=>'','bg'=>'','vi'=>'false','rx'=>'111','rt'=>'g:get,p:post,r:request,s:server'),
//--
//--So to create the data loop we need to add the following to the vrs array:
//--array('pg'=>'3:1','sl'=>'0','pd'=>'0','vr'=>'d04_dataa_1_1_999_1_2_1','vl'=>'','bg'=>'','vi'=>'false','rx'=>'','rt'=>'s'),
//--		
//--If you only have 1 data loop to create on a page you can just call it data however, if you need multiple data loops append anything after data
//--d04_dataa_1_1_999_1_2_1 , d04_datab_1_1_999_1_2_1 , d04_datac_1_1_999_1_2_1 , d04_dataWhatever1_1_1_999_1_2_1 , d04_dataWhatever2_1_1_999_1_2_1
//--
//--@NYTHING IN THE $THIS->VRS ARRAY WILL EXIST IN SESSION AS $_SESSION['variable'] (ie. $_SESSION['d01_usrid_1_1_113_2_1_1'])
//--@NYTHING IN THE $THIS->VRS ARRAY WILL EXIST IN SESSION AS $_SESSION['variable'] (ie. $_SESSION['d01_usrpd_2_1_106_3_1_1'])
//--
//--@IF CALL ./PATH_TO/fastsaas.php?vu=1:1 THE FRAMEWORK WILL CREATE ALL VARIABLES THAT SHOULD EXIST ON THAT VIEW WHICH IN THIS CASE
//--CREATES THE SESSION VARS ABOVE CREATING THE USER LOGIN FORM. ONCE YOU ADD YOUR DATABASE INFO TO function dbi() AND CREATE 
//--THE FOLLOWING TABLE YOU CAN LOGIN WITH YOUR CREDENTIALS YOU ADD TO THE DATABASE.
//--
//-- CREATE TABLE account (acct int(255) UNSIGNED AUTO_INCREMENT PRIMARY KEY,seclvl int(3),secmsg int(3),seckey varchar(255),secipl varchar(255),email varchar(255),userid varchar(255),passwd varchar(255),cashier decimal(10,2),subscription_start bigint(255) UNSIGNED,subscription_end bigint(255) UNSIGNED,subscription_typ int(3),pref1 int(3),pref2 int(3),pref3 int(3),pref4 int(3),pref5 int(3),pref6 int(3));
//--
//--@NYTHING ON PAGE 0 WILL EXIST EVERYWHERE THROUGHOUT THE SESSION!!!
//--
//--Now in mod5 locate the DYNAMIC OBJECTS section and in the switch statement either locate or create the switch options named
//--d01 , d02, d03, d04, d05 , d06 or whatever your creating then use a switch,if,else,for,foreach or whatever to create desired
//--effects whether that is querying a database or handling data.
//--
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
//-- rname:Your Name,
//-- pname:Email or ID to send payment to,
//-- ptrid:Transaction ID,
//-- email:Email,
//-- raddr:Your Address,
//-- addrs:Address,
//-- addra:Address 1,
//-- addrb:Address 2,
//-- cityy:City,
//-- rcity:Your City,
//-- state:State,
//-- rstat:Your State,
//-- zipce:Zip Code,
//-- rzipc:Your Zip Code,
//-- conta:Contact,
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
	    									@session_destroy();
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

//-- function dbi() needs your database nfo (ie.database,userid,password)

//-- CREATE TABLE account (acct int(255) UNSIGNED AUTO_INCREMENT PRIMARY KEY,seclvl int(3),secmsg int(3),seckey varchar(255),secipl varchar(255),email varchar(255),userid varchar(255),passwd varchar(255),cashier decimal(10,2),subscription_start bigint(255) UNSIGNED,subscription_end bigint(255) UNSIGNED,subscription_typ int(3),pref1 int(3),pref2 int(3),pref3 int(3),pref4 int(3),pref5 int(3),pref6 int(3));
		
//-- CREATE TABLE email (id bigint(255) AUTO_INCREMENT PRIMARY KEY,email varchar(255),offers varchar(255),signups varchar(255),affid bigint(255));
		
//-- CREATE TABLE makeMoney (id bigint(255) AUTO_INCREMENT PRIMARY KEY,bname varchar(255),baddr varchar(255),bcity char(155),bstate char(155),bzip varchar(25),bphone varchar(25),bemail varchar(255),bcontact varchar(255),yname varchar(255),yaddr varchar(255),ycity char(155),ystate char(155),yzip varchar(25),yphone varchar(25),yemail varchar(255));

//-- vipstudios@gmx.com for support.

@session_start();
class Lunnatti {
    function __CONSTRUCT($aa) {
        global $vue;
        $this->q             = $_SERVER['QUERY_STRING'];
        $this->qv            = explode('&',$this->q);
        $this->qvo           = '';
        $this->qva           = '';
        $this->vrs =   array(
        					 array('pg'=>'0','sl'=>'','pd'=>'','vr'=>'vu','vl'=>'','bg'=>'','vi'=>'false','rx'=>'1','rt'=>'r'),
        					 array('pg'=>'0','sl'=>'','pd'=>'','vr'=>'vur','vl'=>'','bg'=>'','vi'=>'false','rx'=>'1','rt'=>'s'),
        					 array('pg'=>'0','sl'=>'','pd'=>'','vr'=>'vuc','vl'=>'','bg'=>'','vi'=>'false','rx'=>'1','rt'=>'s'),
        					 array('pg'=>'0','sl'=>'','pd'=>'','vr'=>'rq','vl'=>'','bg'=>'','vi'=>'false','rx'=>'5','rt'=>'r'),
        					 array('pg'=>'0','sl'=>'1','pd'=>'','vr'=>'pd','vl'=>'0','bg'=>'','vi'=>'false','rx'=>'999','rt'=>'s'),
        					 array('pg'=>'0','sl'=>'','pd'=>'','vr'=>'dbb','vl'=>'0','bg'=>'','vi'=>'false','rx'=>'4','rt'=>'s'),
        					 array('pg'=>'0','sl'=>'','pd'=>'','vr'=>'dbf','vl'=>'20','bg'=>'','vi'=>'false','rx'=>'4','rt'=>'s'),
        					 array('pg'=>'0','sl'=>'','pd'=>'','vr'=>'dbr','vl'=>'20','bg'=>'','vi'=>'false','rx'=>'4','rt'=>'s'),
        					 array('pg'=>'0','sl'=>'','pd'=>'','vr'=>'dbq','vl'=>'0','bg'=>'','vi'=>'false','rx'=>'4','rt'=>'s'),
        					 array('pg'=>'0','sl'=>'','pd'=>'','vr'=>'d_sys_status','vl'=>'0','bg'=>'','vi'=>'false','rx'=>'','rt'=>'s'),
        					 array('pg'=>'0','sl'=>'','pd'=>'','vr'=>'d_sys_code','vl'=>'0','bg'=>'','vi'=>'false','rx'=>'','rt'=>'s'),
        					 array('pg'=>'0','sl'=>'','pd'=>'','vr'=>'d_sys_data','vl'=>array(),'bg'=>'','vi'=>'false','rx'=>'','rt'=>'s'),
        					 array('pg'=>'0','sl'=>'','pd'=>'','vr'=>'d_sys_rgx','vl'=>array(),'bg'=>'','vi'=>'false','rx'=>'','rt'=>'s'),
        					 array('pg'=>'0','sl'=>'','pd'=>'','vr'=>'d_sys_out','vl'=>array(),'bg'=>'','vi'=>'false','rx'=>'','rt'=>'s'),
        					 array('pg'=>'0','sl'=>'','pd'=>'','vr'=>'qry_last','vl'=>'','bg'=>'','vi'=>'false','rx'=>'','rt'=>'s'),
        					 array('pg'=>'0','sl'=>'','pd'=>'','vr'=>'qvo_last','vl'=>'','bg'=>'','vi'=>'false','rx'=>'','rt'=>'s'),
        					 array('pg'=>'0','sl'=>'','pd'=>'','vr'=>'qvo_lall','vl'=>'','bg'=>'','vi'=>'false','rx'=>'','rt'=>'s'),
        					 array('pg'=>'0','sl'=>'','pd'=>'','vr'=>'secact','vl'=>'0','bg'=>'','vi'=>'false','rx'=>'','rt'=>'s'),
        					 array('pg'=>'0','sl'=>'','pd'=>'','vr'=>'seclvl','vl'=>'0','bg'=>'','vi'=>'false','rx'=>'','rt'=>'s'),
        					 array('pg'=>'0','sl'=>'','pd'=>'','vr'=>'secmsg','vl'=>'0','bg'=>'','vi'=>'false','rx'=>'','rt'=>'s'),
        					 array('pg'=>'0','sl'=>'','pd'=>'','vr'=>'seceml','vl'=>'0','bg'=>'','vi'=>'false','rx'=>'','rt'=>'s'),
        					 array('pg'=>'0','sl'=>'','pd'=>'','vr'=>'secusr','vl'=>'0','bg'=>'','vi'=>'false','rx'=>'','rt'=>'s'),
        					 array('pg'=>'0','sl'=>'','pd'=>'','vr'=>'logout','vl'=>'','bg'=>'','vi'=>'false','rx'=>'2','rt'=>'r'),
        					 array('pg'=>'1:1','sl'=>'','pd'=>'','vr'=>'d01_email_1_1_202_2_1_1','vl'=>'','bg'=>'','vi'=>'false','rx'=>'','rt'=>'s'),
        					 array('pg'=>'1:2','sl'=>'','pd'=>'','vr'=>'d02_bname_1_1_109_2_1_1','vl'=>'','bg'=>'','vi'=>'false','rx'=>'','rt'=>'s'),
        					 array('pg'=>'1:2','sl'=>'','pd'=>'','vr'=>'d02_addrs_2_1_116_2_1_1','vl'=>'','bg'=>'','vi'=>'false','rx'=>'','rt'=>'s'),
        					 array('pg'=>'1:2','sl'=>'','pd'=>'','vr'=>'d02_cityy_3_1_116_2_1_1','vl'=>'','bg'=>'','vi'=>'false','rx'=>'','rt'=>'s'),
        					 array('pg'=>'1:2','sl'=>'','pd'=>'','vr'=>'d02_state_4_1_116_2_1_1','vl'=>'','bg'=>'','vi'=>'false','rx'=>'','rt'=>'s'),
        					 array('pg'=>'1:2','sl'=>'','pd'=>'','vr'=>'d02_zipce_5_1_117_2_1_1','vl'=>'','bg'=>'','vi'=>'false','rx'=>'','rt'=>'s'),
        					 array('pg'=>'1:2','sl'=>'','pd'=>'','vr'=>'d02_phone_6_1_110_2_1_1','vl'=>'','bg'=>'','vi'=>'false','rx'=>'','rt'=>'s'),
        					 array('pg'=>'1:2','sl'=>'','pd'=>'','vr'=>'d02_email_7_1_113_2_1_1','vl'=>'','bg'=>'','vi'=>'false','rx'=>'','rt'=>'s'),
        					 array('pg'=>'1:2','sl'=>'','pd'=>'','vr'=>'d02_conta_8_1_109_2_1_1','vl'=>'','bg'=>'','vi'=>'false','rx'=>'','rt'=>'s'),
        					 array('pg'=>'1:2','sl'=>'','pd'=>'','vr'=>'d02_rname_9_1_109_2_1_1','vl'=>'','bg'=>'','vi'=>'false','rx'=>'','rt'=>'s'),
        					 array('pg'=>'1:2','sl'=>'','pd'=>'','vr'=>'d02_raddr_10_1_116_2_1_1','vl'=>'','bg'=>'','vi'=>'false','rx'=>'','rt'=>'s'),
        					 array('pg'=>'1:2','sl'=>'','pd'=>'','vr'=>'d02_rcity_11_1_116_2_1_1','vl'=>'','bg'=>'','vi'=>'false','rx'=>'','rt'=>'s'),
        					 array('pg'=>'1:2','sl'=>'','pd'=>'','vr'=>'d02_rstat_12_1_116_2_1_1','vl'=>'','bg'=>'','vi'=>'false','rx'=>'','rt'=>'s'),
        					 array('pg'=>'1:2','sl'=>'','pd'=>'','vr'=>'d02_rzipc_13_1_117_2_1_1','vl'=>'','bg'=>'','vi'=>'false','rx'=>'','rt'=>'s'),
        					 array('pg'=>'1:2','sl'=>'','pd'=>'','vr'=>'d02_rphne_14_1_110_2_1_1','vl'=>'','bg'=>'','vi'=>'false','rx'=>'','rt'=>'s'),
        					 array('pg'=>'1:2','sl'=>'','pd'=>'','vr'=>'d02_rmail_15_1_113_2_1_1','vl'=>'','bg'=>'','vi'=>'false','rx'=>'','rt'=>'s'),
        					 //array('pg'=>'2:1','sl'=>'','pd'=>'','vr'=>'d03_data_1_1_999_1_2_1','vl'=>'1','bg'=>'','vi'=>'false','rx'=>'','rt'=>'s'),
        					 array('pg'=>'3:1','sl'=>'','pd'=>'','vr'=>'d04_nname_1_1_109_2_1_1','vl'=>'','bg'=>'','vi'=>'false','rx'=>'','rt'=>'s'),
        					 array('pg'=>'3:1','sl'=>'','pd'=>'','vr'=>'d04_email_2_1_202_2_1_1','vl'=>'','bg'=>'','vi'=>'false','rx'=>'','rt'=>'s'),
        					 array('pg'=>'3:1','sl'=>'','pd'=>'','vr'=>'d04_descr_3_1_203_6_1_1','vl'=>'','bg'=>'','vi'=>'false','rx'=>'','rt'=>'s'),
        					 //array('pg'=>'3:1:1','sl'=>'','pd'=>'','vr'=>'d05_data_1_1_999_1_2_1','vl'=>'1','bg'=>'','vi'=>'false','rx'=>'','rt'=>'s'),
        					 array('pg'=>'4:1','sl'=>'','pd'=>'','vr'=>'d06_data_1_1_999_1_2_1','vl'=>'1','bg'=>'','vi'=>'false','rx'=>'','rt'=>'s'),
        					 array('pg'=>'9999','sl'=>'','pd'=>'','vr'=>'d9999_data_1_1_999_1_2_1','vl'=>'1','bg'=>'','vi'=>'false','rx'=>'','rt'=>'s')
                             );
        $this->qvc           = count($this->qv);
        $this->aa            = count($this->vrs);
        $this->ai            = 0;
        $this->aii           = 0;
        $this->aiii          = 0;
        $this->aiiii         = 0;
        $this->aiiiii        = 0;
        $this->aiiiiii       = 0;
        $this->aiiiiiii      = 0;
        $this->aiiiiiiii     = 0;
        $this->aiiiiiiiii    = 0;
        $this->aiiiiiiiiii   = 0;
        $this->aiiiiiiiiiii  = 0;
        $this->aig           = count($_GET);
        $this->aip           = count($_POST);
        $this->air           = count($_REQUEST);
        $this->gvg           = '1';
        $this->gvp           = '1';
        $this->gvr           = '1';
        $this->gvs           = '0';
        $this->frd           = '2';
        $this->rdl           = '1';
        $this->rdf           = '1';
        $this->mod1          = '';
        $this->mod2          = '';
        $this->mod3          = '';
        $this->mod4          = '';
        $this->mod4a         = '';
        $this->mod4b         = '';
        $this->mod5          = '';
        $this->tme           = $aa;
        $GLOBALS['www']      = 'created';
        $this->destroy();
    }
    private function destroy() {/*DESTROYS VARIABLES THAT DO NOT EXIST ON A CERTAIN PAGE*/
        for($ai=0;$ai<$this->aa;$ai++) {
        	if(isset($_SESSION[$this->vrs[$ai]['vr']]) && $_SESSION[$this->vrs[$ai]['vr']] == '..') {
        		unset($_SESSION[$this->vrs[$ai]['vr']]);
        		$this->ai++;
        	}
            if($this->vrs[$ai]['pg'] > '0' && isset($_SESSION[$this->vrs[$ai]['vr']])) {
                if($this->vrs[$ai]['pg'] != $_SESSION['vu']) {
                	if($this->vrs[$ai]['sl'] != NULL) {
                		if($this->vrs[$ai]['sl'] != $_SESSION['seclvl']) {
		                    unset($_SESSION[$this->vrs[$ai]['vr']]);if(substr(get_class($this),7,1) != 'i') { return; }
		                    $this->ai++;
                		}
                		if($this->vrs[$ai]['pd'] != NULL) {
                			if($this->vrs[$ai]['pd'] != $_SESSION['pd']) {
                				unset($_SESSION[$this->vrs[$ai]['vr']]);if(substr(get_class($this),7,1) != 'i') { return; }
                				$this->ai++;
                			}
                		}
                		if($this->vrs[$ai]['pg'] != $_SESSION['vu']) {
                			unset($_SESSION[$this->vrs[$ai]['vr']]);if(substr(get_class($this),7,1) != 'i') { return; }
                			$this->ai++;
                		}
                	} else {
                		unset($_SESSION[$this->vrs[$ai]['vr']]);if(substr(get_class($this),7,1) != 'i') { return; }
                		$this->ai++;
                	}
                } else {
                	if($this->vrs[$ai]['sl'] != NULL) {
                		if($this->vrs[$ai]['sl'] != $_SESSION['seclvl']) {
                			unset($_SESSION[$this->vrs[$ai]['vr']]);if(substr(get_class($this),7,1) != 'i') { return; }
                			$this->ai++;
                		}
                	}
                }
            }
        }
        $this->create();
    }
    private function create() {/*CREATES VARIABLES THAT EXIST ON A CERTAIN PAGE*/
    	for($ai=0;$ai<$this->aa;$ai++) {
    		if($this->vrs[$ai]['pg'] == '0' && !isset($_SESSION[$this->vrs[$ai]['vr']])) {
    			$_SESSION[$this->vrs[$ai]['vr']] = $this->vrs[$ai]['vl'];if(substr(get_class($this),5,1) != 't') { return; }
    			$this->aii++;
    		}
    	}
    	$GLOBALS['vue'] = explode(':',$_SESSION['vu']);
    	for($ai=0;$ai<$this->aa;$ai++) {
    		if($this->vrs[$ai]['pg'] == $_SESSION['vu'] && !isset($_SESSION[$this->vrs[$ai]['vr']])) {
    			if($this->vrs[$ai]['sl'] != NULL) {
    				if($this->vrs[$ai]['pd'] != NULL) {
    					if(isset($_SESSION['pd']) && $this->vrs[$ai]['pd'] == $_SESSION['pd']) {
    						if($this->vrs[$ai]['sl'] == $_SESSION['seclvl']) {
    							$_SESSION[$this->vrs[$ai]['vr']] = $this->vrs[$ai]['vl'];if(substr(get_class($this),1,1) != 'u') { return; }
    							$this->aii++;
    						}
    					}
    				} else {
						if($this->vrs[$ai]['sl'] == $_SESSION['seclvl']) {
							$_SESSION[$this->vrs[$ai]['vr']] = $this->vrs[$ai]['vl'];if(substr(get_class($this),1,1) != 'u') { return; }
							$this->aii++;	
						}
    				}
    			} else {
    				$_SESSION[$this->vrs[$ai]['vr']] = $this->vrs[$ai]['vl'];if(substr(get_class($this),1,1) != 'u') { return; }
    				$this->aii++;
    			}
    		}
    	}
    	$this->update();
    }
    private function update() {/*UPDATES VARIABLES THAT EXIST ON A CERTAIN PAGE*/
        if($this->ai > 0 || $this->aii > 0 || $_SESSION['qry_last'] != $_SERVER['QUERY_STRING']) {
        	if($this->ai != 0) {
        		$this->ai = 0;
        	}
        	if($this->aii != 0) {
        		$this->aii = 0;
        	}
            if(isset($_SESSION['qry_last'])) {
                $_SESSION['qry_last'] = $_SERVER['QUERY_STRING'];
            }
            if($this->rdl == '1') {
                header('Location: '.$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);
                exit;
            }
        }
        for($ai=0;$ai<$this->aa;$ai++) {
            if(($this->vrs[$ai]['pg'] == '0' && isset($_SESSION[$this->vrs[$ai]['vr']])) || ($this->vrs[$ai]['pg'] > '0' && $this->vrs[$ai]['pg'] == $_SESSION['vu'])) {
                if($this->vrs[$ai]['rt'] == 'g') {
                    if(substr(get_class($this),0,1) != 'L') { return; }
                    if($this->gvg == '1') {
                        if(!empty($_GET[$this->vrs[$ai]['vr']])) {
                            if(preg_match($this->rgx($this->vrs[$ai]['rx']),$_GET[$this->vrs[$ai]['vr']])) {
                                if($_GET[$this->vrs[$ai]['vr']] != $_SESSION[$this->vrs[$ai]['vr']]) {
                                    $this->aiii++;
                                    $this->aiiiiiiiiiii++;
                                    $this->qvo .= ($this->vrs[$ai]['vr'].'='.$_GET[$this->vrs[$ai]['vr']].'&');
                                    $_SESSION[$this->vrs[$ai]['vr']] = $_GET[$this->vrs[$ai]['vr']];
                                } else {
                                    $this->qvo .= ($this->vrs[$ai]['vr'].'='.$_SESSION[$this->vrs[$ai]['vr']].'&');
                                }
                            } else {
                                $this->aiii++;
                                $this->qvo .= ($this->vrs[$ai]['vr'].'='.$_SESSION[$this->vrs[$ai]['vr']].'&');
                                $_SESSION[$this->vrs[$ai]['vr']] = $_SESSION[$this->vrs[$ai]['vr']];
                            }
                        }
                    } else {
                        if(!empty($_GET[$this->vrs[$ai]['vr']]) && $_SESSION[$this->vrs[$ai]['vr']] != $_GET[$this->vrs[$ai]['vr']]) {
                            $_SESSION[$this->vrs[$ai]['vr']] = $_GET[$this->vrs[$ai]['vr']];
                            $this->qvo .= ($this->vrs[$ai]['vr'].'='.$_GET[$this->vrs[$ai]['vr']].'&');
                            $this->aiii++;
                        } elseif(!empty($_GET[$this->vrs[$ai]['vr']])) {
                            $_SESSION[$this->vrs[$ai]['vr']] = $_GET[$this->vrs[$ai]['vr']];
                            $this->qvo .= ($this->vrs[$ai]['vr'].'='.$_SESSION[$this->vrs[$ai]['vr']].'&');
                        }
                    }
                } elseif($this->vrs[$ai]['rt'] == 'p') {
                    if(substr(get_class($this),2,1) != 'n') { return; }
                    if($this->gvp == '1') {
                        if(!empty($_POST[$this->vrs[$ai]['vr']])) {
                            if(preg_match($this->rgx($this->vrs[$ai]['rx']),$_POST[$this->vrs[$ai]['vr']])) {
                                if($_POST[$this->vrs[$ai]['vr']] != $_SESSION[$this->vrs[$ai]['vr']]) {
                                    $this->aiii++;
                                    $this->aiiiiiiiiiii++;
                                    $this->qvo .= ($this->vrs[$ai]['vr'].'='.$_POST[$this->vrs[$ai]['vr']].'&');
                                    $_SESSION[$this->vrs[$ai]['vr']] = $_POST[$this->vrs[$ai]['vr']];
                                } else {
                                    $this->qvo .= ($this->vrs[$ai]['vr'].'='.$_SESSION[$this->vrs[$ai]['vr']].'&');
                                }
                            } else {
                                $this->aiii++;
                                $this->qvo .= ($this->vrs[$ai]['vr'].'='.$_SESSION[$this->vrs[$ai]['vr']].'&');
                                $_SESSION[$this->vrs[$ai]['vr']] = $_SESSION[$this->vrs[$ai]['vr']];
                            }
                        }
                    } else {
                        if(!empty($_POST[$this->vrs[$ai]['vr']]) && $_SESSION[$this->vrs[$ai]['vr']] != $_POST[$this->vrs[$ai]['vr']]) {
                            $_SESSION[$this->vrs[$ai]['vr']] = $_POST[$this->vrs[$ai]['vr']];
                            $this->qvo .= ($this->vrs[$ai]['vr'].'='.$_POST[$this->vrs[$ai]['vr']].'&');
                            $this->aiii++;
                        } elseif(!empty($_POST[$this->vrs[$ai]['vr']])) {
                            $_SESSION[$this->vrs[$ai]['vr']] = $_POST[$this->vrs[$ai]['vr']];
                            $this->qvo .= ($this->vrs[$ai]['vr'].'='.$_SESSION[$this->vrs[$ai]['vr']].'&');
                        }
                    }
                } elseif($this->vrs[$ai]['rt'] == 'r') {
                    if(substr(get_class($this),3,1) != 'n') { return; }
                    if($this->gvr == '1') {
                        if(!empty($_REQUEST[$this->vrs[$ai]['vr']])) {
                            if(preg_match($this->rgx($this->vrs[$ai]['rx']),$_REQUEST[$this->vrs[$ai]['vr']])) {
                                if($_REQUEST[$this->vrs[$ai]['vr']] != $_SESSION[$this->vrs[$ai]['vr']]) {
                                    $this->aiii++;
                                    $this->aiiiiiiiiiii++;
                                    $this->qvo .= ($this->vrs[$ai]['vr'].'='.$_REQUEST[$this->vrs[$ai]['vr']].'&');
                                    $_SESSION[$this->vrs[$ai]['vr']] = $_REQUEST[$this->vrs[$ai]['vr']];
                                } else {
                                    $this->qvo .= ($this->vrs[$ai]['vr'].'='.$_SESSION[$this->vrs[$ai]['vr']].'&');
                                }
                            } else {
                                $this->aiii++;
                                $this->qvo .= ($this->vrs[$ai]['vr'].'='.$_SESSION[$this->vrs[$ai]['vr']].'&');
                                $_SESSION[$this->vrs[$ai]['vr']] = $_SESSION[$this->vrs[$ai]['vr']];
                            }
                        }
                    } else {
                        if(!empty($_REQUEST[$this->vrs[$ai]['vr']]) && $_SESSION[$this->vrs[$ai]['vr']] != $_REQUEST[$this->vrs[$ai]['vr']]) {
                            $_SESSION[$this->vrs[$ai]['vr']] = $_REQUEST[$this->vrs[$ai]['vr']];
                            $this->qvo .= ($this->vrs[$ai]['vr'].'='.$_REQUEST[$this->vrs[$ai]['vr']].'&');
                            $this->aiii++;
                        } elseif(!empty($_REQUEST[$this->vrs[$ai]['vr']])) {
                            $_SESSION[$this->vrs[$ai]['vr']] = $_REQUEST[$this->vrs[$ai]['vr']];
                            $this->qvo .= ($this->vrs[$ai]['vr'].'='.$_SESSION[$this->vrs[$ai]['vr']].'&');
                        }
                    }
                } elseif($this->vrs[$ai]['rt'] == 's') {
                    if($this->gvs == '1') {

                    } else {

                    }
                }
            }
        }
        foreach($this->qv as $qvar=>$qval) {
            $ax = explode('=',$qval);
            $ai = 0;
            foreach($this->vrs as $qqvar) {
                if($ax['0'] == $qqvar['vr']) {
                    if(preg_match($this->rgx($qqvar['rx']),$ax['1'])) {
                        if(!empty($_SESSION[$qqvar['vr']]) && $ax['1'] != $_SESSION[$qqvar['vr']]) {
                            $ai++;
                            $this->aiiii++;
                            $this->qva .= ($ax['0'].'='.$ax['1'].'&');
                        } else {
                            $ai++;
                            $this->aiiii++;
                            $this->qva .= ($ax['0'].'='.$ax['1'].'&');
                        }
                    } else {
                        $ai++;
                        $this->aiiii++;
                        if(isset($_SESSION[$qqvar['vr']])) {
                            $this->qva .= ($ax['0'].'='.$_SESSION[$qqvar['vr']].'&');
                        } else {
                            if($this->rdf == '1') {
                                if(preg_match($this->rgx('0'),$ax['1'])) {
                                    $this->qva .= ($ax['0'].'='.$ax['1'].'&');
                                }
                            } else {
                                $this->qva .= ($ax['0'].'='.$ax['1'].'&');
                            }
                        }
                    }
                }
            }
            if($ai == '0') {
                $this->aiiii++;
                if($this->rdf == '1') {
                    if(!empty($ax['1']) && preg_match($this->rgx('0'),$ax['1'])) {
                        $this->qva .= ($ax['0'].'='.$ax['1'].'&');
                    }
                } else {
                    if(!empty($ax['1'])) {
                        $this->qva .= ($ax['0'].'='.$ax['1'].'&');
                    }
                }
            }
        }
        if(isset($_SESSION['qvo_lall']) && $_SERVER['QUERY_STRING'] != $_SESSION['qvo_lall'] && $this->rdf == '1') {
            $_SESSION['qvo_lall'] = substr($this->qva,0,-1);
            $this->aiiiiiiiiiii++;
        }
        $this->mldr();
    }
    private function mldr() {/*MODULE LOADER*/
    	$this->vue();
        $this->mod5();
        $this->loc();
    }
    private function vue() {/*CURRENT VIEW (ie. $_SESSION['vur'] = $_SERVER['HTTP_REFERER'];$_SESSION['vuc'] = $_GET['vu'])*/
    	if(isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] != NULL) {
    		$htr = $_SERVER['HTTP_REFERER'];
    	} else {
    		$htr = 'fastsaas.php?vu=0:0&rq=123';
    	}
    	$url1 = explode('vu=',$htr);
    	$url2 = explode('vu=',$_SERVER['QUERY_STRING']);
    	if(!empty($url1['1'])) {
    		$urli1 = $url1['1']; 
    	}
    	if(isset($urli1)) {
	    	if(strpos($urli1,'&')) {
	    		$x = explode('&',$urli1);
	    		$urli1 = $x['0'];
	    	}
    	}
    	if(!empty($url2['1'])) {
    		$urli2 = $url2['1'];
    	}
    	if(isset($urli2)) {
	    	if(strpos($urli2,'&')) {
	    		$x = explode('&',$urli2);
	    		$urli2 = $x['1'];
	    	}
    	}
    	if(isset($urli1)) { 
    		$_SESSION['vur'] = $urli1;
    	} else{
    		$_SESSION['vur'] = '';
    	}
    	if(isset($urli2)) {
    		$_SESSION['vuc'] = $urli2;
    	} else {
    		$_SESSION['vuc'] = '';
    	}
    }
    private function rgx($aa) {/*REG EXPRESSION PATTERNS*/
        switch($aa) {
            case '1':
                $exp = '/^[0-9]{0,4}([:]{0,1})([0-9]{0,4})([:]{0,1})([0-9]{0,4})([:]{0,1})([0-9]{0,4})([:]{0,1})([0-9]{0,4})$/';
                return $exp;
            break;
            case '2':
                $exp = '/^[1]{0,1}$/';
                return $exp;
            break;
            case '3':
                $exp = '/^[a-zA-Z]{0,25}$/';
                return $exp;
            break;
            case '4':
                $exp = '/^[0-9]{0,4}$/';
                return $exp;
            break;
            case '5':
            	$exp = '/^[0-9]{0,255}$/';
            	return $exp;
            break;
            case '6':
            	$exp = '/^[0-9A-Za-z-_ ]{0,255}$/';
            	return $exp;
            break;
            case '101':
                $exp = '/^[0-9]{0,25}$/';
                return $exp;
            break;
            case '102':
                $exp = '/^[a-zA-Z]{0,25}$/';
                return $exp;
            break;
            case '103':
                $exp = '/^(([a-zA-Z0-9][-.\w]*[a-zA-Z_0-9])@([a-zA-Z0-9][-\w]*[a-zA-Z0-9]\.)+[a-zA-Z]{0,99})$/';
                return $exp;
            break;
            case '104':
                $exp = '/^[a-zA-Z]{2,25}+[ ]+[a-zA-Z]{0,25}$/';
                return $exp;
            break;
            case '105':
                $exp = '/^[a-zA-Z]{0,25}$/';
                return $exp;
            break;
            case '106':
                $exp = '/^[a-zA-Z0-9!@#$%^&*()_+= ]{0,50}$/';
                return $exp;
            break;
            case '107':
                $exp = '/^[a-zA-Z0-9- ]{0,25}$/';
                return $exp;
            break;
            case '108':
                $exp = '/^[a-zA-Z0-9!@#$^&*()_+=.!,? ]{0,50}$/';
                return $exp;
            break;
            case '109':
                $exp = '/^[a-zA-Z0-9!@#$^&*()_+=.!,? ]{0,250}$/';
                return $exp;
            break;
            case '110':
                $exp = '/^[0-9+()-xX ]{0,25}$/';
                return $exp;
            break;
            case '111':
                $exp = '/^www+[.]+[a-zA-Z0-9]{2,99}+[.]+[a-zA-Z.]{0,19}$/';
                return $exp;
            break;
            case '112':
                $exp = '/^[0-9.]{0,4}([:]{0,1})([0-9]{0,4})([:]{0,1})([0-9]{0,4})$/';
                return $exp;
            break;
            case '113':
            	$exp = '/^[a-zA-Z0-9-_@.]{0,255}$/';
            	return $exp;
            break;
            case '114':
            	$exp = '/^[0-9]{0,15}$/';
            	return $exp;
            break;
            case '115':
            	$exp = '/^[0-9]{1,255}([:]{1,1})([a-zA-Z0-9!@#$^&*()_+=.!,? ]{0,255})$/';
            	return $exp;
            break;
            case '116':
            	$exp = '/^[a-zA-Z0-9-_. ]{0,125}$/';
            	return $exp;
            break;
            case '117':
            	$exp = '/^[0-9-]{0,25}$/';
            	return $exp;
            break;
            case '118':
            	$exp = '/^[a-zA-Z0-9-_.\[\]\(\)]{0,255}$/';
            	return $exp;
            break;
            case '119':
            	$exp = '/^[0-9]{0,3}$/';
            	return $exp;
            break;
            case '120':
            	$exp = '/^[0-9,.]{0,13}$/';
            	return $exp;
            break;
            case '201':
            	$exp = '/^[a-zA-Z0-9.=&]{0,65}$/';
            	return $exp;
            break;
            case '202':
            	$exp = '/^([A-Za-z0-9 \-,;\"\(\)\&]+(?:\'|&#0*39;\"\(\)\&)*)*[A-Za-z0-9 \-!,.?\"\(\)\&@]{0,255}+$/';
            	return $exp;
            break;
            case '203':
            	$exp = '/^([A-Za-z0-9 \-,;\"\(\)\&\n\r\s\<\/\>\:@]+(?:\'|&#0*39;\"\(\)\&\n\r\s\<\/\>\:)*)*[A-Za-z0-9 \-!,.?\"\(\)\&\n\r\s\<\/\>\:]{0,9999}+$/';
            	return $exp;
            break;
            case '999':
            	$exp = '/^[0-9]{0,2}$/';
            	return $exp;
            break;
            default:
                $exp = '/^[a-zA-Z0-9.=]{0,25}$/';
                return $exp;
            break;
        }
    }
    private function crx($aa,$bb,$cc) {/*CRYPT (ie. $data = 'abcdefghijklmnopqrstuvwxyz'; $ccrypt = $this->crx('1',$data,'password'); $dcrypt = $this->crx('2',$ccrypt,'password'); echo('<br><br>CRYPTED:'.$ccrypt.'<br><br>DECRYPTED:'.$dcrypt.'<br><br>');)*/
    	//a) crypt type 1)encrypt, 2)decrypt b)data c)cryptkey
    	if($aa == '1') {
    		$dat = $bb;
    		$ivx = substr($cc,0,1).substr($cc,strlen($cc)-1,1);
    		for($ivxi=0;$ivxi<4;$ivxi++) {
    			$ivx .= $ivx;
    		}
    		$ivs = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256,MCRYPT_MODE_ECB);
    		$ivv = mcrypt_create_iv($ivs,MCRYPT_RAND);
    		$dat = mcrypt_encrypt(MCRYPT_RIJNDAEL_256,$ivx,$dat,MCRYPT_MODE_ECB,$ivv);
    		return 	$dat;
    	}
    	if($aa == '2') {
    		$dat = $bb;
    		$ivx = substr($cc,0,1).substr($cc,strlen($cc)-1,1);
    		for($ivxi=0;$ivxi<4;$ivxi++) {
    			$ivx .= $ivx;
    		}
    		$ivs = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256,MCRYPT_MODE_ECB);
    		$ivv = mcrypt_create_iv($ivs,MCRYPT_RAND);
    		$dat = mcrypt_decrypt(MCRYPT_RIJNDAEL_256,$ivx,$dat,MCRYPT_MODE_ECB,$ivv);
    		return $dat;
    	}
    }
    private function upx($aa,$bb,$cc,$dd) {/*MAIL*/
    	//a) email to b) subject c) comment d) email from
		$to      = $aa;
		$subject = $bb;
		$message = $cc;
		$headers = 'From: '.$dd.'' . "\r\n" .
    			   'Reply-To: '.$dd.'' . "\r\n" .
    			   'X-Mailer: PHP/' . phpversion();
		mail($to, $subject, $message, $headers);
    }
    private function dbi($aa,$bb) {/*DATABASE INTERFACE*/
    	//a) db type 1)mysql, 2)postgresql, 3)Oracle  b) SQL
    	switch($aa) {
    		case 1:
    			$db   = array();
    			$db_a = 'localhost';
    			$db_b = 'user';
    			$db_c = 'password';
    			$db_d = 'database';
    			$db_e = array();
    			$db = mysql_connect($db_a,$db_b,$db_c);
    			mysql_select_db($db_d,$db);
    			$db_e = mysql_query($bb,$db);
    			mysql_close($db);
    			return $db_e;
    			unset($db,$db_a,$db_b,$db_c,$db_d,$db_e);
    			break;
    	}
    }
    private function dbn($aa,$bb) {/*DATABASE NAVIGATION (ie. mysql_num_rows($result) while($row = mysql_fetch_array($result)) { $amisqk = $row['0'] } $this->dbn($_SESSION['db'],$amisqk))*/
    	//a) NAVCOMMAND [1-11] b) NUM_ROWS | USE "LIMIT $_SESSION['dbb'],$_SESSION['dbr']" IN YOUR SQL STATEMENTS FOR DB NAV
    	if(!empty($_SERVER['HTTP_REFERER'])) {
    		if($_SESSION['dx'] == '') {
    			$aa = $_SERVER['HTTP_REFERER'];
    			$bb = explode($_SERVER['SERVER_NAME'],$aa);
    			$_SESSION['dx'] = $bb['1'];
    			$_SESSION['dy'] = $_SERVER['REQUEST_URI'];
    			$_SESSION['db']  = '0';
    			$_SESSION['dbb'] = '0';
    			$_SESSION['dbf'] = '20';
    			$_SESSION['dbr'] = '20';
    		}
    		if($_SESSION['dy'] != $_SERVER['REQUEST_URI']) {
    			$aa = $_SERVER['HTTP_REFERER'];
    			$bb = explode($_SERVER['SERVER_NAME'],$aa);
    			$_SESSION['dx'] = $bb['1'];
    			$_SESSION['dy'] = $_SERVER['REQUEST_URI'];
    			$_SESSION['db']  = '0';
    			$_SESSION['dbb'] = '0';
    			$_SESSION['dbf'] = '20';
    			$_SESSION['dbr'] = '20';
    		}
    	}
    	switch($aa) {
    		case '1':
    			if($_SESSION['dbb'] > '0') {
    				$_SESSION['dbb'] = $_SESSION['dbb']-$_SESSION['dbr'];
    				$_SESSION['dbf'] = $_SESSION['dbf']-$_SESSION['dbr'];
    			}
    		break;
    		case '2':
    			if($_SESSION['dbf'] < $bb) {
    				$_SESSION['dbb'] = $_SESSION['dbb']+$_SESSION['dbr'];
    				$_SESSION['dbf'] = $_SESSION['dbf']+$_SESSION['dbr'];
    			}
    		break;
    		case '3':
    			$_SESSION['dbf'] = '20';
    			$_SESSION['dbr'] = '20';
    		break;
    		case '4':
    			$_SESSION['dbf'] = '40';
    			$_SESSION['dbr'] = '40';
    		break;
    		case '5':
    			$_SESSION['dbf'] = '60';
    			$_SESSION['dbr'] = '60';
    		break;
    		case '6':
    			$_SESSION['dbf'] = '80';
    			$_SESSION['dbr'] = '80';
    		break;
    		case '7':
    			$_SESSION['dbf'] = '100';
    			$_SESSION['dbr'] = '100';
    		break;
    		case '8':
    			if($_SESSION['dbb']-$_SESSION['dbr']*5 > '0') {
    				$_SESSION['dbb'] = $_SESSION['dbb']-$_SESSION['dbr']*5;
    				$_SESSION['dbf'] = $_SESSION['dbf']-$_SESSION['dbr']*5;
    			}
    		break;
    		case '9':
    			if($_SESSION['dbb']-$_SESSION['dbr']*10 > '0') {
    				$_SESSION['dbb'] = $_SESSION['dbb']-$_SESSION['dbr']*10;
    				$_SESSION['dbf'] = $_SESSION['dbf']-$_SESSION['dbr']*10;
    			}
    		break;
    		case '10':
    			if($_SESSION['dbb']+$_SESSION['dbr']*5 < $bb) {
    				$_SESSION['dbb'] = $_SESSION['dbb']+$_SESSION['dbr']*5;
    				$_SESSION['dbf'] = $_SESSION['dbf']+$_SESSION['dbr']*5;
    			}
    		break;
    		case '11':
    			if($_SESSION['dbb']+$_SESSION['dbr']*10 < $bb) {
    				$_SESSION['dbb'] = $_SESSION['dbb']+$_SESSION['dbr']*10;
    				$_SESSION['dbf'] = $_SESSION['dbf']+$_SESSION['dbr']*10;
    			}
    		break;
    	}
    	echo('<table border="0" cellpadding="3" cellspacing="0" style="width:100%;margin-top:10px;margin-bottom:10px;">');
    	echo('<tr><td valign="middle" align="center">');
    	echo('<form name="db" id="db" action="'.$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'].'" method="post"><input type="hidden" name="db" value="1"><input type="image" src="./www-img/navLeftArrow.png" style="border:0px;"></form>');
    	echo('</td><td valign="middle" align="center">');
    	echo('<form name="db" id="db" action="'.$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'].'" method="post"><input type="hidden" name="db" value="8"><input type="image" src="./www-img/navLeftX5.png" style="border:0px;"></form>');
    	echo('</td><td valign="middle" align="center">');
    	echo('<form name="db" id="db" action="'.$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'].'" method="post"><input type="hidden" name="db" value="9"><input type="image" src="./www-img/navLeftX10.png" style="border:0px;"></form>');
    	echo('</td><td valign="middle" align="center">');
    	switch($_SESSION['dbr']) {
    		case '20':
    			echo('<form name="db" id="db" action="'.$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'].'" method="post"><input type="hidden" name="db" value="4"><input type="image" src="./www-img/nav20.png" style="border:0px;"></form>');
    		break;
    		case '40':
    			echo('<form name="db" id="db" action="'.$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'].'" method="post"><input type="hidden" name="db" value="5"><input type="image" src="./www-img/nav40.png" style="border:0px;"></form>');
    		break;
    		case '60':
    			echo('<form name="db" id="db" action="'.$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'].'" method="post"><input type="hidden" name="db" value="6"><input type="image" src="./www-img/nav60.png" style="border:0px;"></form>');
    		break;
    		case '80':
    			echo('<form name="db" id="db" action="'.$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'].'" method="post"><input type="hidden" name="db" value="7"><input type="image" src="./www-img/nav80.png" style="border:0px;"></form>');
    		break;
    		case '100':
    			echo('<form name="db" id="db" action="'.$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'].'" method="post"><input type="hidden" name="db" value="3"><input type="image" src="./www-img/nav100.png" style="border:0px;"></form>');
    		break;
    		default:
    			echo('<form name="db" id="db" action="'.$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'].'" method="post"><input type="hidden" name="db" value="4"><input type="image" src="./www-img/nav20.png" style="border:0px;"></form>');
    		break;
    	}
    	echo('</td><td valign="middle" align="center">');
    	echo('<form name="db" id="db" action="'.$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'].'" method="post"><input type="hidden" name="db" value="11"><input type="image" src="./www-img/navRightX10.png" style="border:0px;"></form>');
    	echo('</td><td valign="middle" align="center">');
    	echo('<form name="db" id="db" action="'.$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'].'" method="post"><input type="hidden" name="db" value="10"><input type="image" src="./www-img/navRightX5.png" style="border:0px;"></form>');
    	echo('</td><td valign="middle" align="center">');
    	echo('<form name="db" id="db" action="'.$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'].'" method="post"><input type="hidden" name="db" value="2"><input type="image" src="./www-img/navRightArrow.png" style="border:0px;"></form>');
    	echo('</td></tr>');
    	echo('</table>');
    }
    private function dbq($aa,$bb) {/*DATABASE QUESTION $this->dbq('Would you like to make a deposit?'); RETURNS YES OR NO FORM WITH RADIO BUTTONS*/
    	//a)Form Type b)Question
    	if(isset($_POST['dbq'])) {
    		if(isset($_SESSION['dbq'])) {
    			switch($_POST['dbq']) {
    				case '1':
    					$_SESSION['dbq'] = '1';
    				break;
    				case '2':
    					$_SESSION['dbq'] = '2';
    				break;
    				default:
    					$_SESSION['dbq'] = '0';
    				break;
    			}
    			header('Location: '.$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);
    			exit;
    		}
    	}
    	if(isset($_POST['recycle_dbq'])) {
    		switch($_POST['recycle_dbq']) {
    			case '1':
    				$_SESSION['dbq'] = '0';
    			break;
    		}
    	}
    	switch($aa) {
    		case '1':
    			echo('<form name="dbq_f" id="dbq_f" action="'.$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'].'" method="post">');
    			echo('<table border="0" cellpadding="0" cellspacing="0" width="100%">');
    			echo('<tr><td style="vertical-align: top; text-align: left; width: 75%;">');
    			echo($bb);
    			echo('</td><td style="vertical-align: middle; text-align: right; width:25%">');
    			switch($_SESSION['dbq']) {
    				case '1':
    					echo('<table border="0" cellpadding="0" cellspacing="0" width="100%">');
    					echo('<tr>');
    					echo('<td style="vertical-align: middle; text-align: center;">&#160;Yes&#160;&#160;&#160;</td>');
    					echo('<td style="vertical-align: middle; text-align: center;"><input type="radio" name="dbq" id="dbq" value="1" style="border:0px;" checked></td>');
    					echo('</tr><tr>');
    					echo('<td style="vertical-align: middle; text-align: center;">&#160;No&#160;&#160;&#160;</td>');
    					echo('<td style="vertical-align: middle; text-align: center;"><input type="radio" name="dbq" id="dbq" value="2" style="border:0px;"></td>');
    					echo('</tr>');
    					echo('</table>');
    				break;
    				case '2':
    					echo('<table border="0" cellpadding="0" cellspacing="0" width="100%">');
    					echo('<tr>');
    					echo('<td style="vertical-align: middle; text-align: center;">&#160;Yes&#160;&#160;&#160;</td>');
    					echo('<td style="vertical-align: middle; text-align: center;"><input type="radio" name="dbq" id="dbq" value="1" style="border:0px;"></td>');
    					echo('</tr><tr>');
    					echo('<td style="vertical-align: middle; text-align: center;">No&#160;&#160;&#160;</td>');
    					echo('<td style="vertical-align: middle; text-align: center;"><input type="radio" name="dbq" id="dbq" value="2" style="border:0px;" checked></td>');
    					echo('</tr>');
    					echo('</table>');
    				break;
    				default:
    					echo('<table border="0" cellpadding="0" cellspacing="0" width="100%">');
    					echo('<tr>');
    					echo('<td style="vertical-align: middle; text-align: center;">&#160;Yes&#160;&#160;&#160;</td>');
    					echo('<td style="vertical-align: middle; text-align: center;"><input type="radio" name="dbq" id="dbq" value="1" style="border:0px;"></td>');
    					echo('</tr><tr>');
    					echo('<td style="vertical-align: middle; text-align: center;">&#160;No</span>&#160;&#160;&#160;</td>');
    					echo('<td style="vertical-align: middle; text-align: center;"><input type="radio" name="dbq" id="dbq" value="2" style="border:0px;"></td>');
    					echo('</tr>');	
    					echo('</table>');
    				break;
    			}
    			echo('</td></tr>');
    			echo('</table>');
    			echo('</form>');
    		break;
    		case '2':
    			echo('<table border="0" cellpadding="0" cellspacing="0" width="100%">');
    			echo('<form name="dbq" id="dbq" action="'.$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'].'" method="post">');
    			echo('<tr><td valign="top" align="left" style="width:75%;">');
    			echo('&#160;*&#160;'."$bb".'');
    			echo('</td><td valign="top" align="right" style="width:25%">');
    			switch($_SESSION['dbq']) {
    				case '1':
    					echo('&#160;Yes&#160;&#160;&#160;');
    					echo('<input type="radio" name="dbq" id="dbq" value="1" onDblCLick="javascript:switch(this.checked){case true:this.checked=false;break;case false:this.checked=true;break;};" style="border:0px;" checked><br>');
    					echo('&#160;No&#160;&#160;&#160;');
    					echo('<input type="radio" name="dbq" id="dbq" value="2" onDblCLick="javascript:switch(this.checked){case true:this.checked=false;break;case false:this.checked=true;break;};" style="border:0px;"><br>');
    					break;
    				case '2':
    					echo('&#160;Yes&#160;&#160;&#160;');
    					echo('<input type="radio" name="dbq" id="dbq" value="1" onDblCLick="javascript:switch(this.checked){case true:this.checked=false;break;case false:this.checked=true;break;};" style="border:0px;"><br>');
    					echo('No&#160;&#160;&#160;');
    					echo('<input type="radio" name="dbq" id="dbq" value="2" onDblCLick="javascript:switch(this.checked){case true:this.checked=false;break;case false:this.checked=true;break;};" style="border:0px;" checked><br>');
    					break;
    				default:
    					echo('&#160;Yes&#160;&#160;&#160;');
    					echo('<input type="radio" name="dbq" id="dbq" value="1" onDblCLick="javascript:switch(this.checked){case true:this.checked=false;break;case false:this.checked=true;break;};" style="border:0px;"><br>');
    					echo('&#160;No</span>&#160;&#160;&#160;');
    					echo('<input type="radio" name="dbq" id="dbq" value="2" onDblCLick="javascript:switch(this.checked){case true:this.checked=false;break;case false:this.checked=true;break;};" style="border:0px;"><br>');
    					break;
    			}
    			echo('</td></tr>');
    			echo('<tr><td colspan="2" align="right">&#160;*&#160;Required Fields</td></tr>');
    			echo('<tr><td colspan="2" align="right"><table border="0" cellpadding="0" cellspacing="0"><tr><td align="center" valign="top"><input type="submit" value="submit"></form></td><td align="center" valign="top"><form name="recycle_dbq" id="recycle_dbq" action="'.$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'].'" method="post"><input type="hidden" name="recycle_dbq" value="1"><input type="submit" value="clear"></form></td></tr></table></td></tr>');
    			echo('</form>');
    			echo('</tr></tr>');
    			echo('</table>');
    		break;
    	}

    }
    private function fsp($aa,$bb) {/*FIELD SPACE $this->fsp($row['name'],'30'); ADDS A SPACE EVERY 30 CHARS, PREVENTS LONG STRINGS RUINING VIEW LAYOUT ON MOBILE (IE. thisIsAReallyLongBusinessNameThatWouldMuckUpAPageViewBadly)*/
    	$ns  = $aa;
    	$nsx = explode(' ',$ns);
    	$nsy = count($nsx);
    	$nsz = '';
    	for($nsi=0;$nsi<$nsy;$nsi++) {
    		if(strlen($nsx[$nsi]) > $bb) {
    			$nsz .= wordwrap($nsx[$nsi], $bb, ' ', true);
    		} else {
    			$nsz .= $nsx[$nsi].' ';
    		}
    	}
    	return $nsz;
    }
    private function mod5() {/*MODULE 5: CREATES DYNAMIC FORMS AND DATA LOOPS*/
    	$arr1  = array();
    	$arr1u = array();
    	$arr2  = array();
    	$arr2u = array();
    	$arr2t = array();
    	$arr3  = array();
    	$ami   = 0;
    	$amii  = 0;
    	$amiii = 0;
    	$amix  = 0;
    	$amiy  = 0;
    	$amio  = '';
    	$dsi   = count($_SESSION['d_sys_out']);
    	foreach($_SESSION as $svar=>$sval) {
    		if(preg_match('/^(d+[0-9]{2,4}+[_]+[a-z-]{1,25}+[_]+[0-9]{1,3}+[_]+[0-9]{1,3}+[_]+[0-9]{1,3}+[_]+[0-9]{1,3}+[_]+[0-9]{1,3}+[_]+[0-9]{1,3}).*?(?:[a-z0-9_-])?$/',$svar)) {
    			$amx = explode('_',$svar);
    			if(substr($amx['1'],0,4) == 'data') {
    				if(preg_match($this->rgx($amx['4']),$_SESSION[$svar])) {
    					$_SESSION[$svar] = $sval;
    					foreach($_SESSION['d_sys_rgx'] as $avar=>$aval) {
    						if($avar == $svar) {
    							$_SESSION['d_sys_rgx'][$avar] = '1';
    						}
    					}
    				} else {
    					$_SESSION[$svar] = $sval;
    				}
    			}
    			if($amx['1'] == 'image') {
    				if(isset($_SESSION['ul']) && $_SESSION['ul'] != '') {
    					if(isset($_SESSION[$_SESSION['ul']]) && $_SESSION[$_SESSION['ul']] != '') {
	    					if(array_key_exists($_SESSION['ul'],$_SESSION)) {
	    						unlink($_SESSION[$_SESSION['ul']]);
	    						$rd0 = explode('vu=',$_SERVER['QUERY_STRING']);
	    						$rd1 = explode($_SESSION['ul'],$_SERVER['QUERY_STRING']);
	    						$rd2 = substr($rd1['0'],0,strlen($rd1['0'])-3);
	    						$rd3 = $rd2.$rd1['1'];
	    						$rd4 = explode('&',$rd0['1']);
	    						$_SESSION[$_SESSION['ul']] = '';
	    						$_SESSION['ul'] = '';
	    						switch($rd4['0']) {
	    							case '2:3:3':
	    								$amisql = $this->dbi('1','UPDATE directory SET img=\'\' WHERE BINARY acct=\''.$_SESSION['secact'].'\' AND BINARY uid=\''.$_SESSION['d11_dataa_1_1_5_999_1_1'].'\'');
	    								$_SESSION['d10_dataa_1_1_999_1_2_1'] = '0';
	    								$_SESSION['d_sys_data'] = '';
	    								header('Location:'.$_SERVER['PHP_SELF'].'?vu=2:3:3');
	    								exit;
	    							break;
	    						}
	    						header('Location: '.$_SERVER['PHP_SELF'].'?'.$rd3);
	    						exit;
	    					}
    					}
    				}
    				if(count($_FILES) > '0') {
    					$rand = rand();
    					$time = time();
    					if(array_key_exists($svar,$_FILES) && $_FILES[$svar]['name'] != '') {
    						if(!file_exists('./www-bin/img/'.$_SESSION['secact'].'')) {
    							mkdir('./www-bin/img/'.$_SESSION['secact'].'', 0755, true);
    						}
    						if($_FILES[$svar]['type'] == 'image/jpeg') {
    							if(move_uploaded_file($_FILES[$svar]['tmp_name'],'./www-bin/img/'.$_SESSION['secact'].'/'.$rand.'_'.$time.'_'.basename($_FILES[$svar]['name']))) {
    								$_SESSION[$svar] = './www-bin/img/'.$_SESSION['secact'].'/'.$rand.'_'.$time.'_'.basename($_FILES[$svar]['name']);
    								$ami++;
    							}
    						}
    					}
    				}
    			}
    			if($amx['3'] == '2' && preg_match($this->rgx($amx['4']),$_SESSION[$svar])) {
    				$_SESSION[$svar] = $sval;
    				foreach($_SESSION['d_sys_rgx'] as $avar=>$aval) {
    					if($avar == $svar) {
    						$_SESSION['d_sys_rgx'][$avar] = '1';
    					}
    				}
    			}
    			foreach($_POST as $pvar=>$pval) {
    				if($pvar == $svar) {
    					if(preg_match($this->rgx($amx['4']),$_POST[$svar])) {
    						$_SESSION[$svar] = $_POST[$svar];
    						$ami++;
    						foreach($_SESSION['d_sys_rgx'] as $avar=>$aval) {
    							if($avar == $svar) {
    								$_SESSION['d_sys_rgx'][$avar] = '1';
    							}
    						}
    					} else {
    						$_SESSION[$svar] = $_SESSION[$svar];
    					}
    				}
    			}
    			$arr1[] = $svar.'='.$sval;
    		}
    	}
    	if(isset($_SESSION['d_sys_data'])) {
    		if(count($_SESSION['d_sys_data']) != count($arr1)) {
    			$_SESSION['d_sys_data'] = $arr1;
    			$ami++;
    		}
    	}
    	if(isset($_SESSION['d_sys_rgx'])) {
    		if(count($_SESSION['d_sys_rgx']) != count($arr1)) {
	    		foreach($arr1 as $avar=>$aval) {
	    			$amx = explode('=',$aval);
	    			$_SESSION['d_sys_rgx'][$amx['0']] = '0';
	    			$ami++;
	    		}
    		}
    	}
    	if(isset($_SESSION['d_sys_rgx']) && $_SESSION['d_sys_rgx'] != NULL) {
    		foreach($_SESSION['d_sys_rgx'] as $d_sys_tst_var=>$d_sys_tst_val) {
    			if(!isset($_SESSION[$d_sys_tst_var])) {
    				unset($_SESSION['d_sys_data']);
    				unset($_SESSION['d_sys_rgx']);
    				header('Location: '.$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);
    				exit;
    			}
    		}
    	}
    	if(count($arr1) > '0') {
    		foreach($arr1 as $avar=>$aval) {
    			$am1 = explode('=',$aval);
    			$am2 = explode('_',$am1['0']);
    			$arr2[] = $am2['0'];
    		}
    	}
    	if(count($arr2) > '0') {
    		$arr1u = array_unique($arr2);
    		$arr2u = array_count_values($arr2);
    		$arr2t = array_count_values($arr2);
    	}
    	if(count($arr2u) > '0') {
    		foreach($arr2u as $a2uvar=>$a2uval) {
	    		foreach($arr1 as $a1var=>$a1val) {
	    			$am1 = explode('=',$a1val);
	    			$am2 = explode('_',$am1['0']);
	    			if($am2['0'] == $a2uvar && $am2['7'] == '2') {
	    				$a2uval--;
	    				$arr2u[$a2uvar] = $a2uval;
	    			}
	    		}
    		}
    	}
    	foreach($arr1u as $a1uvar=>$a1uval) {
    		foreach($arr2u as $a2uvar=>$a2uval) {
    			if($a1uval == $a2uvar) {
    				$arr3[] = array('obj'=>$a1uval,'max'=>$a2uval,'tot'=>$arr2t[$a2uvar],'rgx'=>'0','exe'=>'0');
    			}
    		}
    	}
    	if(isset($_POST['d_obj']) && preg_match('/^d+[0-9]{2,4}+$/',$_POST['d_obj'])) {
    		foreach($_SESSION['d_sys_data'] as $res0var=>$res0val) {
    			$rc1 = explode('=',$res0val);
    			$rc2 = explode('_',$rc1['0']);
    			if($rc2['0'] == $_POST['d_obj']) {
    				$_SESSION[$rc1['0']] = $rc1['1'];
    				unset($_SESSION['d_sys_rgx']);
    				$ami++;
    			}
    		}
    	}
    	if(isset($_SESSION['d_sys_status']) && $_SESSION['d_sys_status'] == '') {
    		if(isset($_SESSION['d_sys_code']) && $_SESSION['d_sys_code'] != '') {
    			$_SESSION['d_sys_status'] = '';
    			$_SESSION['d_sys_code']   = '';
    		}
    	}
    	if($ami > '0') {
    		if($this->rdl == '1') {
    			header('Location: '.$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);
    			exit;
    		}
    	}
    	if(isset($_SESSION['d_sys_rgx']) && $_SESSION['d_sys_rgx'] != NULL) {
	    	foreach($_SESSION['d_sys_rgx'] as $avar=>$aval) {
	    		$amx = explode('_',$avar);
	    		if($amx['7'] == '1' && $aval == '1') {
	    			$a3i = count($arr3);
	    			for($a3ii=0;$a3ii<$a3i;$a3ii++) {
	    				if($arr3[$a3ii]['obj'] == $amx['0']) {
	    					$arr3[$a3ii]['rgx']++;
	    				}
	    				if($arr3[$a3ii]['max'] == $arr3[$a3ii]['rgx']) {
	    					$arr3[$a3ii]['exe'] = 1;
	    				}
	    			}
	    		}
	    	}
    	}
    	if(count($arr1u) > '0') {
    		foreach($arr1u as $arr1uvar=>$arr1uval) {
    			$am3i = count($arr3);
    			for($am3ii=0;$am3ii<$am3i;$am3ii++) {
    				if($arr3[$am3ii]['obj'] == $arr1uval) {
	    				if($arr3[$am3ii]['exe'] == '1') {
	    					$amii = '1';
	    					$amio = $arr3[$am3ii]['obj'];
	    					$amix = $arr3[$am3ii]['max'];
	    					$amiy = $arr3[$am3ii]['tot'];
	    				} else {
	    					$amii = '0';
	    					$amio = $arr3[$am3ii]['obj'];
	    					$amix = $arr3[$am3ii]['max'];
	    					$amiy = $arr3[$am3ii]['tot'];
	    				}
    				}
    			}
    			if($amii == '1') {
    				/////////////////////////////////////////////////////////////////////////////
    				//DYNAMIC OBJECTS,DYNAMIC OBJECTS,DYNAMIC OBJECTS,DYNAMIC OBJECTS,DYNAMIC OBJ
    				/////////////////////////////////////////////////////////////////////////////
    				//////////////////////////////////         //////////////////////////////////
    				//////////////////////////////////         //////////////////////////////////
    				//////////////////////////////////         //////////////////////////////////
    				//////////////////////////////////         //////////////////////////////////
    				//////////////////////////////////         //////////////////////////////////
    				//////////////////////////////////         //////////////////////////////////
    				//////////////////////////////////         //////////////////////////////////
    				//////////////////////////////////         //////////////////////////////////
    				//////////////////////////////////         //////////////////////////////////
    				//////////////////////////////////         //////////////////////////////////
    				//////////////////////////////////         //////////////////////////////////
    				//////////////////////////////////         //////////////////////////////////
    				//////////////////////////////////         //////////////////////////////////
    				//////////////////////////////////         //////////////////////////////////
    				//////////////////////////////////         //////////////////////////////////
    				//////////////////////////////////         //////////////////////////////////
    				//////////////////////////////////         //////////////////////////////////
    				//////////////////////////////////         //////////////////////////////////
    				//////////////////////////////////         //////////////////////////////////
    				//////////////////////////////////         //////////////////////////////////
    				//////////////////////////////                 //////////////////////////////
    				///////////////////////////////               ///////////////////////////////
    				////////////////////////////////             ////////////////////////////////
    				/////////////////////////////////           /////////////////////////////////
    				//////////////////////////////////         //////////////////////////////////
    				///////////////////////////////////       ///////////////////////////////////
    				////////////////////////////////////     ////////////////////////////////////
    				/////////////////////////////////////   /////////////////////////////////////
    				////////////////////////////////////// //////////////////////////////////////
    				/////////////////////////////////////////////////////////////////////////////
    				
    				foreach($arr3 as $arr3var => $arr3val) {
    					if($arr3val['obj'] == $amio) {
	    					switch($arr3val['obj']) {
	    						case 'd01':
	    							/*
	    							if($_SESSION['seclvl'] == '0') {
		    							$amisql = $this->dbi('1','SELECT * FROM account WHERE BINARY userid = \''.$_SESSION['d01_usrid_1_1_113_2_1_1'].'\' AND BINARY passwd = \''.$_SESSION['d01_usrpd_2_1_106_3_1_1'].'\'');
		    							if(mysql_num_rows($amisql) > 0) {
		    								while($row = mysql_fetch_array($amisql)) {
		    									$_SESSION['secact'] = $row['acct'];
		    									$_SESSION['seclvl'] = $row['seclvl'];
		    									$_SESSION['secmsg'] = $row['secmsg'];
		    									$_SESSION['seceml'] = $row['email'];
		    									$_SESSION['secusr'] = $row['userid'];
		    								}
		    								$this->dbi('1','UPDATE account SET secipl = \''.$_SERVER['REMOTE_ADDR'].'\' WHERE acct = \''.$_SESSION['secact'].'\' LIMIT 1');
		    								echo('<span id="success">Logging you in...</span>');
		    							} else {
		    								$_SESSION['d_sys_rgx']['d01_usrid_1_1_113_2_1_1'] = '0';
		    								$_SESSION['d_sys_rgx']['d01_usrpd_2_1_106_3_1_1'] = '0';
		    								echo('<span id="status">Your User ID or Password is incorrect, please login again...</span>');
		    							}
	    							} elseif($_SESSION['seclvl'] == '1') {
	    								echo('<span id="success">Logged in...</span>');
	    							}
	    							*/
	    							if($_SESSION['d01_email_1_1_202_2_1_1'] == NULL) {
	    								echo('<span id="status">You must provide an email address.</span>');
	    							} elseif(!preg_match($this->rgx('103'),$_SESSION['d01_email_1_1_202_2_1_1'])) {
	    								echo('<span id="status">Your email address must be in the correct format.</span>');
	    							} else {
	    								$amisqj = $this->dbi('1','SELECT COUNT(*) FROM email WHERE email=\''.$_SESSION['d01_email_1_1_202_2_1_1'].'\'');
	    								while($row = mysql_fetch_array($amisqj)) {
	    									$amisqk = $row['0'];
	    								}
	    								if($amisqk ==  0) {
	    									$amisql = $this->dbi('1','INSERT INTO email (email,offers,signups,affid) values (\''.$_SESSION['d01_email_1_1_202_2_1_1'].'\',0,0,0)');
	    								}
	    								echo('<span id="status">Congratulations, You\'re signed up!</span>');
	    							}
	    							$_SESSION['d_sys_rgx']['d01_email_1_1_202_2_1_1'] = '0';
	    						break;
	    						case 'd02':
	    							/*
	    							if($_SESSION['seclvl'] == '0') {
		    							$amisql = $this->dbi('1','SELECT COUNT(*) FROM account WHERE BINARY email=\''.$_SESSION['d02_email_1_1_103_2_1_1'].'\' OR BINARY userid=\''.$_SESSION['d02_usrid_2_1_113_2_1_1'].'\'');
		    							if(is_resource($amisql)) {
		    								while($row = mysql_fetch_array($amisql)) {
		    									if($row['0'] == '0') {
		    										$_SESSION['d_sys_status'] = '1';
		    										$amisql = $this->dbi('1','INSERT INTO account (seclvl,secmsg,seckey,secipl,email,userid,passwd,cashier) values (\'1\',\'1\',\''.openssl_random_pseudo_bytes(15).'\',\''.$_SERVER['REMOTE_ADDR'].'\',\''.$_SESSION['d02_email_1_1_103_2_1_1'].'\',\''.$_SESSION['d02_usrid_2_1_113_2_1_1'].'\',\''.$_SESSION['d02_usrpd_3_1_106_3_1_1'].'\',\'25.00\')');
		    										$amisql = $this->dbi('1','SELECT * FROM account WHERE BINARY userid=\''.$_SESSION['d02_usrid_2_1_113_2_1_1'].'\' AND BINARY passwd=\''.$_SESSION['d02_usrpd_3_1_106_3_1_1'].'\'');
		    										while($row = mysql_fetch_array($amisql)) {
		    											$_SESSION['secact'] = $row['acct'];
		    											$_SESSION['seclvl'] = $row['seclvl'];
		    											$_SESSION['secmsg'] = $row['secmsg'];
		    											$_SESSION['seceml'] = $row['email'];
		    											$_SESSION['secusr'] = $row['userid'];
		    										}
		    										echo('<span id="success">Logging you in...</span>');
		    									} else {
		    										$_SESSION['d_sys_rgx']['d02_email_1_1_103_2_1_1'] = '0';
		    										$_SESSION['d_sys_rgx']['d02_usrid_2_1_113_2_1_1'] = '0';
		    										echo('<span id="status">The Email or User ID you have chosen is in use, please try again...</span>');
		    									}
		    								}
		    							}
	    							} elseif($_SESSION['seclvl'] == '1') {
	    								echo('<span id="success">Logged in...</span>');
	    							}
	    							*/
	    							$d02 = 0;
	    							if($_SESSION['d02_bname_1_1_109_2_1_1'] == NULL) {
	    								echo('<span id="status">Business name can\'t be left empty...</span><br>');
	    							} elseif($_SESSION['d02_bname_1_1_109_2_1_1'] != NULL) {
	    								if(!preg_match($this->rgx('109'),$_SESSION['d02_bname_1_1_109_2_1_1'])) {
	    									echo('<span id="status">Business name must be in the correct format...</span><br>');
	    								} else {
	    									$d02++;
	    								}
	    							}
	    							if($_SESSION['d02_addrs_2_1_116_2_1_1'] == NULL) {
	    								echo('<span id="status">Business address can\'t be left empty...</span><br>');
	    							} elseif($_SESSION['d02_addrs_2_1_116_2_1_1'] != NULL) {
	    								if(!preg_match($this->rgx('116'),$_SESSION['d02_addrs_2_1_116_2_1_1'])) {
	    									echo('<span id="status">Business address must be in the correct format...</span><br>');
	    								} else {
	    									$d02++;
	    								}
	    							}
	    							if($_SESSION['d02_cityy_3_1_116_2_1_1'] == NULL) {
	    								echo('<span id="status">Business city can\'t be left empty...</span><br>');
	    							} elseif($_SESSION['d02_cityy_3_1_116_2_1_1'] != NULL) {
	    								if(!preg_match($this->rgx('116'),$_SESSION['d02_cityy_3_1_116_2_1_1'])) {
	    									echo('<span id="status">Business City must be in the correct format...</span><br>');
	    								} else {
	    									$d02++;
	    								}
	    							}
	    							if($_SESSION['d02_state_4_1_116_2_1_1'] == NULL) {
	    								echo('<span id="status">Business state can\'t be left empty...</span><br>');
	    							} elseif($_SESSION['d02_state_4_1_116_2_1_1'] != NULL) {
	    								if(!preg_match($this->rgx('116'),$_SESSION['d02_state_4_1_116_2_1_1'])) {
	    									echo('<span id="status">Business state must be in the correct format...</span><br>');
	    								} else {
	    									$d02++;
	    								}
	    							}
	    							if($_SESSION['d02_zipce_5_1_117_2_1_1'] == NULL) {
	    								echo('<span id="status">Business zip code can\'t be left empty...</span><br>');
	    							} elseif($_SESSION['d02_zipce_5_1_117_2_1_1'] != NULL) {
	    								if(!preg_match($this->rgx('117'),$_SESSION['d02_zipce_5_1_117_2_1_1'])) {
	    									echo('<span id="status">Business zip code must be in the correct format...</span><br>');
	    								} else {
	    									$d02++;
	    								}
	    							}
	    							if($_SESSION['d02_phone_6_1_110_2_1_1'] == NULL) {
	    								echo('<span id="status">Business phone can\'t be left empty...</span><br>');
	    							} elseif($_SESSION['d02_phone_6_1_110_2_1_1'] != NULL) {
	    								if(!preg_match($this->rgx('110'),$_SESSION['d02_phone_6_1_110_2_1_1'])) {
	    									echo('<span id="status">Business phone must be in the correct format...</span><br>');
	    								} else {
	    									$d02++;
	    								}
	    							}
	    							if($_SESSION['d02_email_7_1_113_2_1_1'] == NULL) {
	    								echo('<span id="status">Business email can\'t be left empty...</span><br>');
	    							} elseif($_SESSION['d02_email_7_1_113_2_1_1'] != NULL) {
	    								if(!preg_match($this->rgx('113'),$_SESSION['d02_email_7_1_113_2_1_1'])) {
	    									echo('<span id="status">Business email must be in the correct format...</span><br>');
	    								} else {
	    									$d02++;
	    								}
	    							}
	    							if($_SESSION['d02_conta_8_1_109_2_1_1'] == NULL) {
	    								echo('<span id="status">Person to contact can\'t be left empty...</span><br>');
	    							} elseif($_SESSION['d02_conta_8_1_109_2_1_1'] != NULL) {
	    								if(!preg_match($this->rgx('109'),$_SESSION['d02_conta_8_1_109_2_1_1'])) {
	    									echo('<span id="status">Person to contact must be in the correct format...</span><br>');
	    								} else {
	    									$d02++;
	    								}
	    							}
	    							if($_SESSION['d02_rname_9_1_109_2_1_1'] == NULL) {
	    								echo('<span id="status">Your Name can\'t be left empty...</span><br>');
	    							} elseif($_SESSION['d02_rname_9_1_109_2_1_1'] != NULL) {
	    								if(!preg_match($this->rgx('109'),$_SESSION['d02_rname_9_1_109_2_1_1'])) {
	    									echo('<span id="status">Your Name must be in the correct format...</span><br>');
	    								} else {
	    									$d02++;
	    								}
	    							}
	    							if($_SESSION['d02_raddr_10_1_116_2_1_1'] == NULL) {
	    								echo('<span id="status">Your address can\'t be left empty...</span><br>');
	    							} elseif($_SESSION['d02_raddr_10_1_116_2_1_1'] != NULL) {
	    								if(!preg_match($this->rgx('116'),$_SESSION['d02_raddr_10_1_116_2_1_1'])) {
	    									echo('<span id="status">Your address must be in the correct format...</span><br>');
	    								} else {
	    									$d02++;
	    								}
	    							}
	    							if($_SESSION['d02_rcity_11_1_116_2_1_1'] == NULL) {
	    								echo('<span id="status">Your city can\'t be left empty...</span><br>');
	    							} elseif($_SESSION['d02_rcity_11_1_116_2_1_1'] != NULL) {
	    								if(!preg_match($this->rgx('116'),$_SESSION['d02_rcity_11_1_116_2_1_1'])) {
	    									echo('<span id="status">Your city must be in the correct format...</span><br>');
	    								} else {
	    									$d02++;
	    								}
	    							}
	    							if($_SESSION['d02_rstat_12_1_116_2_1_1'] == NULL) {
	    								echo('<span id="status">Your state can\'t be left empty...</span><br>');
	    							} elseif($_SESSION['d02_rstat_12_1_116_2_1_1'] != NULL) {
	    								if(!preg_match($this->rgx('116'),$_SESSION['d02_rstat_12_1_116_2_1_1'])) {
	    									echo('<span id="status">Your state must be in the correct format...</span><br>');
	    								} else {
	    									$d02++;
	    								}
	    							}
	    							if($_SESSION['d02_rzipc_13_1_117_2_1_1'] == NULL) {
	    								echo('<span id="status">Your zip code can\'t be left empty...</span><br>');
	    							} elseif($_SESSION['d02_rzipc_13_1_117_2_1_1'] != NULL) {
	    								if(!preg_match($this->rgx('117'),$_SESSION['d02_rzipc_13_1_117_2_1_1'])) {
	    									echo('<span id="status">Your zip code must be in the correct format...</span><br>');
	    								} else {
	    									$d02++;
	    								}
	    							}
	    							if($_SESSION['d02_rphne_14_1_110_2_1_1'] == NULL) {
	    								echo('<span id="status">Your phone can\'t be left empty...</span><br>');
	    							} elseif($_SESSION['d02_rphne_14_1_110_2_1_1'] != NULL) {
	    								if(!preg_match($this->rgx('110'),$_SESSION['d02_rphne_14_1_110_2_1_1'])) {
	    									echo('<span id="status">Your phone must be in the correct format...</span><br>');
	    								} else {
	    									$d02++;
	    								}
	    							}
	    							if($_SESSION['d02_rmail_15_1_113_2_1_1'] == NULL) {
	    								echo('<span id="status">Your email can\'t be left empty...</span><br>');
	    							} elseif($_SESSION['d02_rmail_15_1_113_2_1_1'] != NULL) {
	    								if(!preg_match($this->rgx('113'),$_SESSION['d02_rmail_15_1_113_2_1_1'])) {
	    									echo('<span id="status">Your email must be in the correct format...</span><br>');
	    								} else {
	    									$d02++;
	    								}
	    							}
									if($d02 == 15) {
										$this->upx('vipstudios@gmx.com','data_resource','write_code:13','no-reply@vipstudios.com');
										$this->dbi('1','INSERT INTO makeMoney (bname,baddr,bcity,bstate,bzip,bphone,bemail,bcontact,yname,yaddr,ycity,ystate,yzip,yphone,yemail) values (\''.$_SESSION['d02_bname_1_1_109_2_1_1'].'\',\''.$_SESSION['d02_addrs_2_1_116_2_1_1'].'\',\''.$_SESSION['d02_cityy_3_1_116_2_1_1'].'\',\''.$_SESSION['d02_state_4_1_116_2_1_1'].'\',\''.$_SESSION['d02_zipce_5_1_117_2_1_1'].'\',\''.$_SESSION['d02_phone_6_1_110_2_1_1'].'\',\''.$_SESSION['d02_email_7_1_113_2_1_1'].'\',\''.$_SESSION['d02_conta_8_1_109_2_1_1'].'\',\''.$_SESSION['d02_rname_9_1_109_2_1_1'].'\',\''.$_SESSION['d02_raddr_10_1_116_2_1_1'].'\',\''.$_SESSION['d02_rcity_11_1_116_2_1_1'].'\',\''.$_SESSION['d02_rstat_12_1_116_2_1_1'].'\',\''.$_SESSION['d02_rzipc_13_1_117_2_1_1'].'\',\''.$_SESSION['d02_rphne_14_1_110_2_1_1'].'\',\''.$_SESSION['d02_rmail_15_1_113_2_1_1'].'\')');
										unset($_SESSION['d02_bname_1_1_109_2_1_1'],$_SESSION['d02_addrs_2_1_116_2_1_1'],$_SESSION['d02_cityy_3_1_116_2_1_1'],$_SESSION['d02_state_4_1_116_2_1_1'],$_SESSION['d02_zipce_5_1_117_2_1_1'],$_SESSION['d02_phone_6_1_110_2_1_1'],$_SESSION['d02_email_7_1_113_2_1_1'],$_SESSION['d02_conta_8_1_109_2_1_1'],$_SESSION['d02_rname_9_1_109_2_1_1'],$_SESSION['d02_raddr_10_1_116_2_1_1'],$_SESSION['d02_rcity_11_1_116_2_1_1'],$_SESSION['d02_rstat_12_1_116_2_1_1'],$_SESSION['d02_rzipc_13_1_117_2_1_1'],$_SESSION['d02_rphne_14_1_110_2_1_1'],$_SESSION['d02_rmail_15_1_113_2_1_1']);
										echo('<span id="status">Your tip has been recieved; We\'ll get back with you soon, Thanks!</span><br>');
									}
									$_SESSION['d_sys_rgx']['d02_bname_1_1_109_2_1_1'] = 0;
									$_SESSION['d_sys_rgx']['d02_addrs_2_1_116_2_1_1'] = 0;
									$_SESSION['d_sys_rgx']['d02_cityy_3_1_116_2_1_1'] = 0;
									$_SESSION['d_sys_rgx']['d02_state_4_1_116_2_1_1'] = 0;
									$_SESSION['d_sys_rgx']['d02_zipce_5_1_117_2_1_1'] = 0;
									$_SESSION['d_sys_rgx']['d02_phone_6_1_110_2_1_1'] = 0;
									$_SESSION['d_sys_rgx']['d02_email_7_1_113_2_1_1'] = 0;
									$_SESSION['d_sys_rgx']['d02_conta_8_1_109_2_1_1'] = 0;
									$_SESSION['d_sys_rgx']['d02_rname_9_1_109_2_1_1'] = 0;
									$_SESSION['d_sys_rgx']['d02_raddr_10_1_116_2_1_1'] = 0;
									$_SESSION['d_sys_rgx']['d02_rcity_11_1_116_2_1_1'] = 0;
									$_SESSION['d_sys_rgx']['d02_rstat_12_1_116_2_1_1'] = 0;
									$_SESSION['d_sys_rgx']['d02_rzipc_13_1_117_2_1_1'] = 0;
									$_SESSION['d_sys_rgx']['d02_rphne_14_1_110_2_1_1'] = 0;
									$_SESSION['d_sys_rgx']['d02_rmail_15_1_113_2_1_1'] = 0;			
	    						break;
	    						case 'd03':
	    							switch($_SESSION['d03_data_1_1_999_1_2_1']) {
	    								case '1':
	    									if($_SESSION['seclvl'] == '0') {
	    										echo('<span id="status">You must be logged in to view this page...</span>');
	    									} elseif($_SESSION['seclvl'] == '1') {
	    										echo('<span id="success">Welcome '.$_SESSION['secusr'].',</span>');
	    									}
	    								break;
	    							}
	    						break;
	    						case 'd04':
	    							$d04 = 0;
	    							if($_SESSION['d04_nname_1_1_109_2_1_1'] == NULL) {
	    								echo('<span id="status">Your First Name can\'t be left empty...</span><br>');
	    							} elseif($_SESSION['d04_nname_1_1_109_2_1_1'] != NULL) {
	    								if(!preg_match($this->rgx('109'),$_SESSION['d04_nname_1_1_109_2_1_1'])) {
	    									echo('<span id="status">Your Name must be in the correct format...</span><br>');
	    								} else {
	    									$d04++;
	    								}
	    							}
	    							if($_SESSION['d04_email_2_1_202_2_1_1'] == NULL) {
	    								echo('<span id="status">Your Email can\'t be left empty...</span><br>');
	    							} elseif($_SESSION['d04_email_2_1_202_2_1_1'] != NULL) {
	    								if(!preg_match($this->rgx('103'),$_SESSION['d04_email_2_1_202_2_1_1'])) {
	    									echo('<span id="status">Your Email must be in the correct format...</span><br>');
	    								} else {
	    									$d04++;
	    								}
	    							}
	    							if($_SESSION['d04_descr_3_1_203_6_1_1'] == NULL) {
	    								echo('<span id="status">Your Question can\'t be left empty...</span><br>');
	    							} elseif($_SESSION['d04_descr_3_1_203_6_1_1'] != NULL) {
	    								if(!preg_match($this->rgx('203'),$_SESSION['d04_descr_3_1_203_6_1_1'])) {
	    									echo('<span id="status">Your Question must be in the correct format...</span><br>');
	    								} else {
	    									$d04++;
	    								}
	    							}
	    							if($d04 == 3) {
	    								echo('<span id="status">Thank you for your email...</span>');
	    								$this->upx('vipstudios@gmx.com',$_SESSION['d04_bname_1_1_109_2_1_1'],$_SESSION['d04_descr_3_1_203_6_1_1'],$_SESSION['d04_email_2_1_202_2_1_1']);
	    								unset($_SESSION['d04_nname_1_1_109_2_1_1'],$_SESSION['d04_email_2_1_202_2_1_1'],$_SESSION['d04_descr_3_1_203_6_1_1']);
	    							}
	    							$_SESSION['d_sys_rgx']['d04_nname_1_1_109_2_1_1'] = 0;
	    							$_SESSION['d_sys_rgx']['d04_email_2_1_202_2_1_1'] = 0;
	    							$_SESSION['d_sys_rgx']['d04_descr_3_1_203_6_1_1'] = 0;
	    						break;
	    						case 'd05':
	    							
	    						break;
	    						case 'd06':
	    							$ai = '<img src="./www-img/vipNotSiri.png" style="padding: 0px 2px 0px 0px;float: left;">@notSiri Says::&#160;';
	    							switch($_SESSION['d06_data_1_1_999_1_2_1']) {
	    								case '1':
	    									$this->dbq('1',$ai.'<span id="status">"Would you like to create a WebApp?"</span>');
	    									if($_SESSION['dbq'] == '1') {
	    										$_SESSION['dbq'] = '0';
	    										$_SESSION['d06_data_1_1_999_1_2_1'] = '2';
	    									}
	    									if($_SESSION['dbq'] == '2') {
	    										$_SESSION['dbq'] = '0';
	    										$_SESSION['d06_data_1_1_999_1_2_1'] = '3';
	    									}
	    								break;
	    								case '2':
	    									$this->dbq('1',$ai.'"<span id="status">"Great, are you ready to begin?"</span>');
	    									if($_SESSION['dbq'] == '1') {
	    										$_SESSION['dbq'] = '0';
	    										$_SESSION['d06_data_1_1_999_1_2_1'] = '4';
	    									}
	    									if($_SESSION['dbq'] == '2') {
	    										$_SESSION['dbq'] = '0';
	    										$_SESSION['d06_data_1_1_999_1_2_1'] = '1';
	    									}
	    								break;
	    								case '3':
	    									$this->dbq('1',$ai.'<span id="status">"How about another time?"</span>');
	    									if($_SESSION['dbq'] == '1') {
	    										$_SESSION['dbq'] = '0';
	    										$_SESSION['d06_data_1_1_999_1_2_1'] = '1';
	    									}
	    									if($_SESSION['dbq'] == '2') {
	    										$_SESSION['dbq'] = '0';
	    										$_SESSION['d06_data_1_1_999_1_2_1'] = '4';
	    									}
	    								break;
	    								case '4':
	    									$this->dbq('1',$ai.'<span id="status">"Is this an app you\'ve seen before?"</span>');
	    									if($_SESSION['dbq'] == '1') {
	    										$_SESSION['dbq'] = '0';
	    										$_SESSION['d06_data_1_1_999_1_2_1'] = '5';
	    									} elseif($_SESSION['dbq'] == '2') {
	    										$_SESSION['dbq'] = '0';
	    										$_SESSION['d06_data_1_1_999_1_2_1'] = '6';
	    									}
	    								break;
	    								case '5':
	    									$this->dbq('1',$ai.'<span id="status">"Can you provide a link?"</span>');
	    									if($_SESSION['dbq'] == '1') {
	    										$_SESSION['dbq'] = '0';
	    										$_SESSION['d06_data_1_1_999_1_2_1'] = '7';
	    									} elseif($_SESSION['dbq'] == '2') {
	    										$_SESSION['dbq'] = '0';
	    										$_SESSION['d06_data_1_1_999_1_2_1'] = '8';
	    									}
	    								break;
	    								case '6':
	    									$this->dbq('1',$ai.'<span id="status">"Can you describe it?"</span>');
	    									if($_SESSION['dbq'] == '1') {
	    										$_SESSION['dbq'] = '0';
	    										$_SESSION['d06_data_1_1_999_1_2_1'] = '9';
	    									} elseif($_SESSION['dbq'] == '2') {
	    										$_SESSION['dbq'] = '0';
	    										$_SESSION['d06_data_1_1_999_1_2_1'] = '10';
	    									}
	    								break;
	    								case '7':
	    									$this->dbq('1',$ai.'<span id="status">"Great! contact <a href="mailto://vipstudios@gmx.com" class="phone">vipstudios@gmx.com</a> or refer someone to get FREE cash!"</span>');
	    									if($_SESSION['dbq'] == '1') {
	    										$_SESSION['dbq'] = '0';
	    										$_SESSION['d06_data_1_1_999_1_2_1'] = '1';
	    									} elseif($_SESSION['dbq'] == '2') {
	    										$_SESSION['dbq'] = '0';
	    										$_SESSION['d06_data_1_1_999_1_2_1'] = '1';
	    									}
	    								break;
	    								case '8':				
	    									$this->dbq('1',$ai.'<span id="status">"Great! contact <a href="mailto://vipstudios@gmx.com" class="phone">vipstudios@gmx.com</a> or refer someone to get FREE cash!"</span>');
	    									if($_SESSION['dbq'] == '1') {
	    										$_SESSION['dbq'] = '0';
	    										$_SESSION['d06_data_1_1_999_1_2_1'] = '1';
	    									} elseif($_SESSION['dbq'] == '2') {
	    										$_SESSION['dbq'] = '0';
	    										$_SESSION['d06_data_1_1_999_1_2_1'] = '1';
	    									}
	    								break;
	    								case '9':
	    									$this->dbq('1',$ai.'<span id="status">"Great! contact <a href="mailto://vipstudios@gmx.com" class="phone">vipstudios@gmx.com</a> or refer someone to get FREE cash!"</span>');
	    								    if($_SESSION['dbq'] == '1') {
	    										$_SESSION['dbq'] = '0';
	    										$_SESSION['d06_data_1_1_999_1_2_1'] = '1';
	    									} elseif($_SESSION['dbq'] == '2') {
	    										$_SESSION['dbq'] = '0';
	    										$_SESSION['d06_data_1_1_999_1_2_1'] = '1';
	    									}
	    								break;
	    								case '10':
	    									$this->dbq('1',$ai.'<span id="status">"Great! contact <a href="mailto://vipstudios@gmx.com" class="phone">vipstudios@gmx.com</a> or refer someone to get FREE cash!"</span>');
	    								    if($_SESSION['dbq'] == '1') {
	    										$_SESSION['dbq'] = '0';
	    										$_SESSION['d06_data_1_1_999_1_2_1'] = '1';
	    									} elseif($_SESSION['dbq'] == '2') {
	    										$_SESSION['dbq'] = '0';
	    										$_SESSION['d06_data_1_1_999_1_2_1'] = '1';
	    									}
	    								break;
	    							}
	    						break;
	    						case 'd9999'://LOGOUT;{>
	    							switch($_SESSION['d9999_data_1_1_999_1_2_1']) {
	    								case '1':
	    									$_SESSION['d9999_data_1_1_999_1_2_1'] = '2';
	    									header('Location: '.$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);
	    									exit;
	    								break;
	    								case '2':
	    									@session_destroy();
	    									echo('<span id="success">You have been logged out...</span>');
	    								break;
	    							}
	    						break;
	    					}
    					}
    				}
    				/////////////////////////////////////////////////////////////////////////////
    				////////////////////////////////////// //////////////////////////////////////
    				/////////////////////////////////////   /////////////////////////////////////
    				////////////////////////////////////     ////////////////////////////////////
    				///////////////////////////////////       ///////////////////////////////////
    				//////////////////////////////////         //////////////////////////////////
    				/////////////////////////////////           /////////////////////////////////
    				////////////////////////////////             ////////////////////////////////
    				///////////////////////////////               ///////////////////////////////
    				//////////////////////////////                 //////////////////////////////
    				//////////////////////////////////         //////////////////////////////////
    				//////////////////////////////////         //////////////////////////////////
    				//////////////////////////////////         //////////////////////////////////
    				//////////////////////////////////         //////////////////////////////////
    				//////////////////////////////////         //////////////////////////////////
    				//////////////////////////////////         //////////////////////////////////
    				//////////////////////////////////         //////////////////////////////////
    				//////////////////////////////////         //////////////////////////////////
    				//////////////////////////////////         //////////////////////////////////
    				//////////////////////////////////         //////////////////////////////////
    				//////////////////////////////////         //////////////////////////////////
    				//////////////////////////////////         //////////////////////////////////
    				//////////////////////////////////         //////////////////////////////////
    				//////////////////////////////////         //////////////////////////////////
    				//////////////////////////////////         //////////////////////////////////
    				//////////////////////////////////         //////////////////////////////////
    				//////////////////////////////////         //////////////////////////////////
    				//////////////////////////////////         //////////////////////////////////
    				//////////////////////////////////         //////////////////////////////////
    				//////////////////////////////////         //////////////////////////////////
    				/////////////////////////////////////////////////////////////////////////////
    				//DYNAMIC OBJECTS,DYNAMIC OBJECTS,DYNAMIC OBJECTS,DYNAMIC OBJECTS,DYNAMIC OBJ
    				/////////////////////////////////////////////////////////////////////////////
    			} else {
    				foreach($arr1 as $arr1var=>$arr1val) {
    					$am3 = explode('=',$arr1val);
    					$am4 = explode('_',$am3['0']);
    					if($arr1uval == $am4['0']) {
	    					if($am4['2'] == '1' && $am4['6'] == '1') {
	    						echo('<form name="'."$arr1uval".'" id="'."$arr1uval".'" action="'.$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'].'" method="post" enctype="multipart/form-data">');
	    						echo('<input type="hidden" name="'."$arr1uval".'" value="'."$arr1uval".'">');
	    						echo('<table border="0" cellpadding="0" cellspacing="0" width="100%">');
	    					}
	    					if($am4['5'] == '999' && $am4['6'] == '1') {
	    						echo('<input type="hidden" name="'.$am3['0'].'" value="'.$am3['1'].'">');
	    					}
	    					if($arr1uval == $am4['0']) {
	    						if($am4['1'] == 'merch') {
	    							
	    							$amc = '#FFFFFF';
	    							$amd = '#000000';
	    							if(isset($_SESSION['dr'])) {
	    								if((isset($_SESSION['m_dir_data']) && $_SESSION['m_dir_data'] == NULL) || (isset($_SESSION['s_dir_data']) && $_SESSION['s_dir_data']) == NULL) {
	    								    if(file_exists('./data_classifieds.php')) {
    											include('./data_classifieds.php');
    											array_multisort($m_cat_data);
    											array_multisort($s_cat_data);
    											if(isset($_SESSION['m_cat_data']) && $_SESSION['m_cat_data'] == NULL) {
    												$_SESSION['m_cat_data'] = $m_cat_data;
    											}
    											if(isset($_SESSION['s_cat_data']) && $_SESSION['s_cat_data'] == NULL) {
    												$_SESSION['s_cat_data'] = $s_cat_data;
    											}
    										}
	    								}
	    								echo('<tr><td colspan="2">');
	    								$ca = array();
	    								$ca['0'] = '';
	    								$ca['1'] = '';
	    								$ca['2'] = '';
	    								$cx = explode(':',$_SESSION[$am3['0']]);
	    								if(isset($cx['0']) && $cx['0'] != '') {
	    									$ca['0'] = $cx['0'];
	    								}
	    								if(isset($cx['1']) && $cx['1'] != '') {
	    									$ca['1'] = $cx['1'];
	    								}
	    								if(isset($cx['2']) && $cx['2'] != '') {
	    									$ca['2'] = $cx['2'];
	    								}
	    								if($_SESSION['co'] == '' || $_SESSION['co'] == '..') {
	    									
	    								}
	    								$a = count($_SESSION['m_cat_data']);
	    								$e = count($_SESSION['s_cat_data']);
	    								$c = 0;
	    								$d = 0;
	    								echo('<table border="0" cellpadding="2" cellspacing="0" width="100%">');
	    								if($am4['7'] == '1') {
	    									echo('<tr><td align="left" valign="top">&#160;*&#160;Categories:&#160;&#160;&#160;</td><td align="right" valign="top">');
	    								} elseif($am4['7'] == '2') {
	    									echo('<tr><td align="left" valign="top">&#160;Categories:&#160;&#160;&#160;</td><td align="right" valign="top">');
	    								}
	    								echo('<select name="'.$am3['0'].'" id="'.$am3['0'].'" onChange="javascript:this.form.submit();" style="width:160px;height:25px;">');
	    								for($b=0;$b<$a;$b++) {
	    									if($ca['0'] == $_SESSION['m_cat_data'][$b]['m_cat_uid']) {
	    										echo('<option value="'.$_SESSION['m_cat_data'][$b]['m_cat_uid'].'" selected>'.$_SESSION['m_cat_data'][$b]['m_cat'].'</option>');
	    										for($f=0;$f<$e;$f++) {
	    											if($ca['0'] == $_SESSION['s_cat_data'][$f]['m_cat_uid']) {
	    												if($ca['1'] != NULL && $ca['1'] == $_SESSION['s_cat_data'][$f]['s_cat_uid']) {
	    													echo('<option value="'.$_SESSION['s_cat_data'][$f]['m_cat_uid'].':'.$_SESSION['s_cat_data'][$f]['s_cat_uid'].'" selected>&#160;&#8226;'.$_SESSION['s_cat_data'][$f]['s_cat'].'</option>');
	    												} else {
	    													echo('<option value="'.$_SESSION['s_cat_data'][$f]['m_cat_uid'].':'.$_SESSION['s_cat_data'][$f]['s_cat_uid'].'">&#160;&#8226;'.$_SESSION['s_cat_data'][$f]['s_cat'].'</option>');
	    												}
	    											}
	    										}
	    										echo('<option value=".." style="color:#FF0000;">[x] reset</option>');
	    										$c++;
	    									} else {
	    										if(($ca['0'] == NULL || $ca['0'] == '..') && $d == 0) {
	    											echo('<option value="#" selected>Select a Category:</option>');
	    											$d++;
	    										}
	    										echo('<option value="'.$_SESSION['m_cat_data'][$b]['m_cat_uid'].'">'.$_SESSION['m_cat_data'][$b]['m_cat'].'</option>');
	    										$c++;
	    									}
	    								}
	    								echo('</select><br></td></tr>');
	    								echo('</table>');
	    								echo('</td></tr>');
	    								unset($a,$b,$c,$d,$e,$f);
	    							}
	    							
	    						} elseif($am4['1'] == 'direc') {
	    							
	    							if(isset($_SESSION['dr'])) {
	    								if((isset($_SESSION['m_dir_data']) && $_SESSION['m_dir_data'] == NULL) || (isset($_SESSION['s_dir_data']) && $_SESSION['s_dir_data']) == NULL) {
	    									if(file_exists('./data_directory.php')) {
	    										include('./data_directory.php');
	    										array_multisort($m_dir_data);
	    										array_multisort($s_dir_data);
	    										if(isset($_SESSION['m_dir_data']) && $_SESSION['m_dir_data'] == NULL) {
	    											$_SESSION['m_dir_data'] = $m_dir_data;
	    										}
	    										if(isset($_SESSION['s_dir_data']) && $_SESSION['s_dir_data'] == NULL) {
	    											$_SESSION['s_dir_data'] = $s_dir_data;
	    										}
	    									}
	    								}
	    								$ca = array();
	    								$ca['0'] = '';
	    								$ca['1'] = '';
	    								$ca['2'] = '';
	    								$cx = explode(':',$_SESSION[$am3['0']]);
	    								if(isset($cx['0']) && $cx['0'] != '') {
	    									$ca['0'] = $cx['0'];
	    								}
	    								if(isset($cx['1']) && $cx['1'] != '') {
	    									$ca['1'] = $cx['1'];
	    								}
	    								if(isset($cx['2']) && $cx['2'] != '') {
	    									$ca['2'] = $cx['2'];
	    								}
	    								if($_SESSION['co'] == '' || $_SESSION['co'] == '..') {
	    									
	    								}
	    								$a = count($_SESSION['m_dir_data']);
	    								$e = count($_SESSION['s_dir_data']);
	    								$c = 0;
	    								$d = 0;
	    								echo('<table border="0" cellpadding="2" cellspacing="0" width="100%">');
	    								if($am4['7'] == '1') {
	    									echo('<tr><td align="left" valign="top">&#160;*&#160;Categories:&#160;&#160;&#160;</td><td align="right" valign="top">');
	    								} elseif($am4['7'] == '2') {
	    									echo('<tr><td align="left" valign="top">Categories:&#160;&#160;&#160;</td><td align="right" valign="top">');
	    								}
	    								$this->mod5 .= '<select name="'.$am3['0'].'" id="'.$am3['0'].'" onChange="javascript:this.form.submit();" style="width:160px;height:25px;">';
	    								for($b=0;$b<$a;$b++) {
	    									if($ca['0'] == $_SESSION['m_dir_data'][$b]['m_dir_uid']) {
	    										echo('<option value="'.$_SESSION['m_dir_data'][$b]['m_dir_uid'].'" selected>'.$_SESSION['m_dir_data'][$b]['m_dir'].'</option>');
	    										for($f=0;$f<$e;$f++) {
	    											if($ca['0'] == $_SESSION['s_dir_data'][$f]['m_dir_uid']) {
	    												if($ca['1'] != NULL && $ca['1'] == $_SESSION['s_dir_data'][$f]['s_dir_uid']) {
	    													echo('<option value="'.$_SESSION['s_dir_data'][$f]['m_dir_uid'].':'.$_SESSION['s_dir_data'][$f]['s_dir_uid'].'" selected>&#160;&#8226;'.$_SESSION['s_dir_data'][$f]['s_dir'].'</option>');
	    												} else {
	    													echo('<option value="'.$_SESSION['s_dir_data'][$f]['m_dir_uid'].':'.$_SESSION['s_dir_data'][$f]['s_dir_uid'].'">&#160;&#8226;'.$_SESSION['s_dir_data'][$f]['s_dir'].'</option>');
	    												}
	    											}
	    										}
	    										echo('<option value=".." style="color:#FF0000;">[x] reset</option>');
	    										$c++;
	    									} else {
	    										if(($ca['0'] == NULL || $ca['0'] == '..') && $d == 0) {
	    											echo('<option value="#" selected>Select a Category:</option>');
	    											$d++;
	    										}
	    										echo('<option value="'.$_SESSION['m_dir_data'][$b]['m_dir_uid'].'">'.$_SESSION['m_dir_data'][$b]['m_dir'].'</option>');
	    										$c++;
	    									}
	    								}
	    								echo('</select><br></td></tr>');
	    								echo('</table>');
	    								unset($a,$b,$c,$d,$e,$f);
	    							}
	    							
	    						} elseif($am4['1'] == 'costc') {
	    							
	    							if((isset($_SESSION['co_data']) && $_SESSION['co_data'] == NULL) || (isset($_SESSION['st_data']) && $_SESSION['st_data'] == NULL) || (isset($_SESSION['ci_data']) && $_SESSION['ci_data'] == NULL)) {
	    								if(file_exists('./data_costci.php')) {
	    									include('./data_costci.php');
	    									array_multisort($co_data);
	    									array_multisort($st_data);
	    									array_multisort($ci_data);
	    									if(isset($_SESSION['co_data']) && $_SESSION['co_data'] == NULL) {
	    										$_SESSION['co_data'] = $co_data;
	    									}
	    									if(isset($_SESSION['st_data']) && $_SESSION['st_data'] == NULL) {
	    										$_SESSION['st_data'] = $st_data;
	    									}
	    									if(isset($_SESSION['ci_data']) && $_SESSION['ci_data'] == NULL) {
	    										$_SESSION['ci_data'] = $ci_data;
	    									}
	    								}
	    							}
	    							$co = array();
	    							$co['0'] = '';
	    							$co['1'] = '';
	    							$co['2'] = '';
	    							$co['3'] = '';
	    							$co['4'] = '';
	    							$cz = '';
	    							if(isset($_SESSION[$am4['0'].'_'.'costc'.'_'.$am4['2'].'_'.$am4['3'].'_'.$am4['4'].'_'.$am4['5'].'_'.$am4['6'].'_'.$am4['7']])) {
	    								$cz .= $_SESSION[$am4['0'].'_'.'costc'.'_'.$am4['2'].'_'.$am4['3'].'_'.$am4['4'].'_'.$am4['5'].'_'.$am4['6'].'_'.$am4['7']];
	    							}
	    							if(isset($_SESSION[$am4['0'].'_'.'costs'.'_'.($am4['2']+1).'_'.$am4['3'].'_'.$am4['4'].'_'.$am4['5'].'_'.$am4['6'].'_'.$am4['7']])) {
	    								$cz .= ':'.$_SESSION[$am4['0'].'_'.'costs'.'_'.($am4['2']+1).'_'.$am4['3'].'_'.$am4['4'].'_'.$am4['5'].'_'.$am4['6'].'_'.$am4['7']];
	    							}
	    							if(isset($_SESSION[$am4['0'].'_'.'costi'.'_'.($am4['2']+2).'_'.$am4['3'].'_'.$am4['4'].'_'.$am4['5'].'_'.$am4['6'].'_'.$am4['7']])) {
	    								$cz .= ':'.$_SESSION[$am4['0'].'_'.'costi'.'_'.($am4['2']+2).'_'.$am4['3'].'_'.$am4['4'].'_'.$am4['5'].'_'.$am4['6'].'_'.$am4['7']];
	    							}
	    							$cx = explode(':',$cz);
	    							if(isset($cx['0']) && $cx['0'] != '') {
	    								$co['0'] = $cx['0'];
	    							}
	    							if(isset($cx['1']) && $cx['1'] != '') {
	    								$co['1'] = $cx['1'];
	    							}
	    							if(isset($cx['2']) && $cx['2'] != '') {
	    								$co['2'] = $cx['2'];
	    							}
	    							if($co['0'] == '' || $co['0'] != '') {
	    								if($_SESSION['co_data'] != NULL) {
	    									$a = count($_SESSION['co_data']);
	    									$c = 0;
	    									$d = 0;
	    									echo('<table cellpadding="2" cellspacing="0" width="100%">');
	    									if($am4['7'] == '1') {
	    										echo('<tr><td align="left" valign="top">&#160;*&#160;Country:&#160;&#160;&#160;</td><td align="right" valign="top">');
	    									} elseif($am4['7'] == '2') {
	    										echo('<tr><td align="left" valign="top">&#160;Country:&#160;&#160;&#160;</td><td align="right" valign="top">');
	    									}
	    									echo('<select name="'.$am3['0'].'" id="'.$am3['0'].'" onChange="javascript:this.form.submit();" style="width:160px;height:25px;">');
	    									for($b=0;$b<$a;$b++) {
	    										if($co['0'] == $_SESSION['co_data'][$b]['co_uid']) {
	    											$this->mod5 .= '<option value="'.$_SESSION['co_data'][$b]['co_uid'].'" selected>'.$_SESSION['co_data'][$b]['co_full_name'].'</option>';
	    											$co['3'] .= $_SESSION['co_data'][$b]['co_uid'];
	    											$co['4'] .= $_SESSION['co_data'][$b]['co_full_name'];
	    											$c++;
	    										} else {
	    											if(($co['0'] == NULL || $co['0'] == '..') && $d == 0) {
	    												echo('<option value="#" selected>Select a Country:</option>');
	    												$d++;
	    											}
	    											echo('<option value="'.$_SESSION['co_data'][$b]['co_uid'].'">'.$_SESSION['co_data'][$b]['co_full_name'].'</option>');
	    											$c++;
	    										}
	    									}
	    									echo('</select><br></td></tr>');
	    									echo('</table>');
	    									echo('</td></tr>');
	    									unset($a,$b,$c,$d);
	    								}
	    							}
	    							
	    						} elseif($am4['1'] == 'costs') {
	    							
	    							$co = array();
	    							$co['0'] = '';
	    							$co['1'] = '';
	    							$co['2'] = '';
	    							$co['3'] = '';
	    							$co['4'] = '';
	    							$cz = '';
	    							if(isset($_SESSION[$am4['0'].'_'.'costc'.'_'.($am4['2']-1).'_'.$am4['3'].'_'.$am4['4'].'_'.$am4['5'].'_'.$am4['6'].'_'.$am4['7']])) {
	    								$cz .= $_SESSION[$am4['0'].'_'.'costc'.'_'.($am4['2']-1).'_'.$am4['3'].'_'.$am4['4'].'_'.$am4['5'].'_'.$am4['6'].'_'.$am4['7']];
	    							}
	    							if(isset($_SESSION[$am4['0'].'_'.'costs'.'_'.$am4['2'].'_'.$am4['3'].'_'.$am4['4'].'_'.$am4['5'].'_'.$am4['6'].'_'.$am4['7']])) {
	    								$cz .= ':'.$_SESSION[$am4['0'].'_'.'costs'.'_'.$am4['2'].'_'.$am4['3'].'_'.$am4['4'].'_'.$am4['5'].'_'.$am4['6'].'_'.$am4['7']];
	    							}
	    							if(isset($_SESSION[$am4['0'].'_'.'costi'.'_'.($am4['2']+1).'_'.$am4['3'].'_'.$am4['4'].'_'.$am4['5'].'_'.$am4['6'].'_'.$am4['7']])) {
	    								$cz .= ':'.$_SESSION[$am4['0'].'_'.'costi'.'_'.($am4['2']+1).'_'.$am4['3'].'_'.$am4['4'].'_'.$am4['5'].'_'.$am4['6'].'_'.$am4['7']];
	    							}
	    							$cx = explode(':',$cz);
	    							if(isset($cx['0']) && $cx['0'] != '') {
	    								$co['0'] = $cx['0'];
	    							}
	    							if(isset($cx['1']) && $cx['1'] != '') {
	    								$co['1'] = $cx['1'];
	    							}
	    							if(isset($cx['2']) && $cx['2'] != '') {
	    								$co['2'] = $cx['2'];
	    							}
	    							if($co['0'] != '') {
	    								if($_SESSION['st_data'] != NULL && $co['0'] != '..') {
	    									$a = count($_SESSION['st_data']);
	    									$c = 0;
	    									$d = 0;
	    									echo('<table border="0" cellpadding="2" cellspacing="0" width="100%">');
	    									if($am4['7'] == '1') {
	    										echo('<tr><td align="left" valign="top">&#160;*&#160;State:&#160;&#160;&#160;</td><td align="right" valign="top">');
	    									} elseif($am4['7'] == '2') {
	    										echo('<tr><td align="left" valign="top">&#160;State:&#160;&#160;&#160;</td><td align="right" valign="top">');
	    									}
	    									echo('<select name="'.$am3['0'].'" id="'.$am3['0'].'" onChange="javascript:this.form.submit();" style="width:160px;height:25px;">');
	    									for($b=0;$b<$a;$b++) {
	    										if($_SESSION['st_data'][$b]['co_uid'] == $co['0']) {
	    											if($co['1'] == $_SESSION['st_data'][$b]['st_uid']) {
	    												echo('<option value="'.$_SESSION['st_data'][$b]['st_uid'].'" selected>'.$_SESSION['st_data'][$b]['st'].'</option>');
	    												$co['3'] .= ':'.$_SESSION['st_data'][$b]['st_uid'];
	    												$co['4'] .= '->'.$_SESSION['st_data'][$b]['st'];
	    												$c++;
	    											} else {
	    												if($co['1'] == NULL && $d == 0) {
	    													echo('<option value="#" selected>Select a State:</option>');
	    													$d++;
	    												}
	    												echo('<option value="'.$_SESSION['st_data'][$b]['st_uid'].'">'.$_SESSION['st_data'][$b]['st'].'</option>');
	    												$c++;
	    											}
	    										}
	    									}
	    									if($c == '0') {
	    										$co['1'] = '9999';
	    										echo('<option value="#" selected>Finished</option>');
	    									}
	    									echo('</select><br></td></tr>');
	    									echo('</table>');
	    									unset($a,$b,$c,$d);
	    								}
	    							}
	    							
	    						} elseif($am4['1'] == 'costi') {
	    							
	    							$co = array();
	    							$co['0'] = '';
	    							$co['1'] = '';
	    							$co['2'] = '';
	    							$co['3'] = '';
	    							$co['4'] = '';
	    							$cz = '';
	    							if(isset($_SESSION[$am4['0'].'_'.'costc'.'_'.($am4['2']-2).'_'.$am4['3'].'_'.$am4['4'].'_'.$am4['5'].'_'.$am4['6'].'_'.$am4['7']])) {
	    								$cz .= $_SESSION[$am4['0'].'_'.'costc'.'_'.($am4['2']-2).'_'.$am4['3'].'_'.$am4['4'].'_'.$am4['5'].'_'.$am4['6'].'_'.$am4['7']];
	    							}
	    							if(isset($_SESSION[$am4['0'].'_'.'costs'.'_'.($am4['2']-1).'_'.$am4['3'].'_'.$am4['4'].'_'.$am4['5'].'_'.$am4['6'].'_'.$am4['7']])) {
	    								$cz .= ':'.$_SESSION[$am4['0'].'_'.'costs'.'_'.($am4['2']-1).'_'.$am4['3'].'_'.$am4['4'].'_'.$am4['5'].'_'.$am4['6'].'_'.$am4['7']];
	    							}
	    							if(isset($_SESSION[$am4['0'].'_'.'costi'.'_'.$am4['2'].'_'.$am4['3'].'_'.$am4['4'].'_'.$am4['5'].'_'.$am4['6'].'_'.$am4['7']])) {
	    								$cz .= ':'.$_SESSION[$am4['0'].'_'.'costi'.'_'.$am4['2'].'_'.$am4['3'].'_'.$am4['4'].'_'.$am4['5'].'_'.$am4['6'].'_'.$am4['7']];
	    							}
	    							$cx = explode(':',$cz);
	    							if(isset($cx['0']) && $cx['0'] != '') {
	    								$co['0'] = $cx['0'];
	    							}
	    							if(isset($cx['1']) && $cx['1'] != '') {
	    								$co['1'] = $cx['1'];
	    							}
	    							if(isset($cx['2']) && $cx['2'] != '') {
	    								$co['2'] = $cx['2'];
	    							}
	    							if($co['0'] != '') {
	    								if($_SESSION['ci_data'] != NULL && $co['0'] != '..') {
	    									$a = count($_SESSION['ci_data']);
	    									$c = 0;
	    									$d = 0;
	    									echo('<table border="0" cellpadding="2" cellspacing="0" width="100%">');
	    									if($am4['7'] == '1') {
	    										echo('<tr><td align="left" valign="top">&#160;*&#160;City:&#160;&#160;&#160;</td><td align="right" valign="top">');
	    									} elseif($am4['7'] == '2') {
	    										echo('<tr><td align="left" valign="top">&#160;City:&#160;&#160;&#160;</td><td align="right" valign="top">');
	    									}
	    									echo('<select name="'.$am3['0'].'" id="'.$am3['0'].'" onChange="javascript:this.form.submit();" style="width:160px;height:25px;">');
	    									for($b=0;$b<$a;$b++) {
	    										if($_SESSION['ci_data'][$b]['co_uid'] == $co['0'] && $_SESSION['ci_data'][$b]['st_uid'] == $co['1']) {
	    											if($_SESSION['ci_data'][$b]['ci_uid'] == $co['2']) {
	    												echo('<option value="'.$_SESSION['ci_data'][$b]['ci_uid'].'" selected>'.$_SESSION['ci_data'][$b]['ci'].'</option>');
	    												$co['3'] .= ':'.$_SESSION['ci_data'][$b]['ci_uid'];
	    												$co['4'] .= '->'.$_SESSION['ci_data'][$b]['ci'];
	    												$c++;
	    											} else {
	    												if($co['2'] == NULL && $d == 0) {
	    													echo('<option value="#" selected>Select a City:</option>');
	    													$d++;
	    												}
	    												echo('<option value="'.$_SESSION['ci_data'][$b]['ci_uid'].'">'.$_SESSION['ci_data'][$b]['ci'].'</option>');
	    												$c++;
	    											}
	    										}
	    									}
	    									if($c == '0') {
	    										$co['2'] = '9999';
	    										$this->mod5 .= '<option value="#" selected>Finished</option>';
	    									}
	    									echo('</select><br></td></tr>');
	    									echo('</table>');
	    									unset($a,$b,$c,$d);
	    								}
	    							}
									
		    					} elseif($am4['1'] == 'zipco') {
		    						
		    						if($co['0'] != '' && $co['1'] != '' && $co['2'] != '') {
		    							if($_SESSION['ci_data'] != NULL && $co['0'] != '..') {
		    								$a = count($_SESSION['ci_data']);
		    								$c = 0;
		    								$d = 0;
		    								echo('<table border="0" cellpadding="0" cellspacing="0" width="100%">');
		    								if($am4['7'] == '1') {
		    									echo('<tr><td align="left" valign="top">&#160;*&#160;Zip Code:&#160;&#160;&#160;</td><td align="right" valign="top">');
		    								} elseif($am4['7'] == '2') {
		    									echo('<tr><td align="left" valign="top">&#160;Zip Code:&#160;&#160;&#160;</td><td align="right" valign="top">');
		    								}
		    								echo('<select name="'.$am3['0'].'" id="'.$am3['0'].'" onChange="javascript:this.form.submit();" style="width:160px;height:25px;">');
		    								for($b=0;$b<$a;$b++) {
		    									if($_SESSION['ci_data'][$b]['co_uid'] == $co['0'] && $_SESSION['ci_data'][$b]['st_uid'] == $co['1']) {
		    										if($_SESSION['ci_data'][$b]['ci_uid'] == $co['2'] && $_SESSION['ci_data'][$b]['zip'] != NULL) {
		    											$e = $_SESSION['ci_data'][$b]['zip'];
		    											$f = explode(':',$e);
		    											$g = count($f);
		    											for($h=0;$h<$g;$h++) {
		    												$i = explode('-',$f[$h]);
		    												for($j=$i['0'];$j<=$i['1'];$j++) {
		    													if($_SESSION[$am3['0']] == $j) {
		    														echo('<option value="'."$j".'" selected>'."$j".'</option>');
		    													} else {
		    														echo('<option value="'."$j".'">'."$j".'</option>');
		    													}
		    												}
		    											}
		    											$c++;
		    										}
		    									}
		    								}
		    								if($c == '0') {
		    									$co['2'] = '9999';
		    									echo('<option value="#" selected>Finished</option>');
		    								}
		    								echo('</select><br></td></tr>');
		    								echo('</table>');
		    								unset($a,$b,$c,$d,$e,$f,$g,$h,$i);
		    							}
		    						}
		    						
		    					} elseif($am4['1'] == 'rank') {
		    						
		    						echo('<table border="0" cellpadding="0" cellspacing="0" width="100%">');
		    						if($_SESSION[$am3['0']] == '') {
		    							echo('<tr>');
		    							echo('<td colspan="9">&#160;*&#160;Rank is required, please select:</td>');
		    							echo('</tr>');
		    						}
		    						echo('<tr>');
		    						echo('<td colspan="9">');
		    						echo('<table border="0" cellpadding="0" cellspacing="0" width="100%">');
		    						echo('<tr>');
		    						echo('<td style="width:50%;vertical-align:middle;text-align:right;">< worse - - - -&#160;</td>');
		    						echo('<td style="width:50%;vertical-align:middle;text-align:left;"> - - - - better ></td>');
		    						echo('</tr>');
		    						echo('</table>');
		    						echo('</td>');
		    						echo('</tr>');
		    						echo('<tr>');
		    						echo('<td style="vertical-align:middle;text-align:center;">1</td>');
		    						echo('<td style="vertical-align:middle;text-align:center;">2</td>');
		    						echo('<td style="vertical-align:middle;text-align:center;">3</td>');
		    						echo('<td style="vertical-align:middle;text-align:center;">4</td>');
		    						echo('<td style="vertical-align:middle;text-align:center;">5</td>');
		    						echo('<td style="vertical-align:middle;text-align:center;">6</td>');
		    						echo('<td style="vertical-align:middle;text-align:center;">7</td>');
		    						echo('<td style="vertical-align:middle;text-align:center;">8</td>');
		    						echo('<td style="vertical-align:middle;text-align:center;">9</td>');
		    						echo('</tr>');
		    						echo('<tr>');
		    						if($_SESSION[$am3['0']] == '1') {
		    							echo('<td style="vertical-align:middle;text-align:center;"><input type="radio" name="'.$am3['0'].'" id="'.$am3['0'].'" value="1" checked></td>');
		    						} else {
		    							echo('<td style="vertical-align:middle;text-align:center;"><input type="radio" name="'.$am3['0'].'" id="'.$am3['0'].'" value="1"></td>');
		    						}
		    						if($_SESSION[$am3['0']] == '2') {
		    							echo('<td style="vertical-align:middle;text-align:center;"><input type="radio" name="'.$am3['0'].'" id="'.$am3['0'].'" value="2" checked></td>');
		    						} else {
		    							echo('<td style="vertical-align:middle;text-align:center;"><input type="radio" name="'.$am3['0'].'" id="'.$am3['0'].'" value="2"></td>');
		    						}
		    						if($_SESSION[$am3['0']] == '3') {
		    							echo('<td style="vertical-align:middle;text-align:center;"><input type="radio" name="'.$am3['0'].'" id="'.$am3['0'].'" value="3" checked></td>');
		    						} else {
		    							echo('<td style="vertical-align:middle;text-align:center;"><input type="radio" name="'.$am3['0'].'" id="'.$am3['0'].'" value="3"></td>');
		    						}
		    						if($_SESSION[$am3['0']] == '4') {
		    							echo('<td style="vertical-align:middle;text-align:center;"><input type="radio" name="'.$am3['0'].'" id="'.$am3['0'].'" value="4" checked></td>');
		    						} else {
		    							echo('<td style="vertical-align:middle;text-align:center;"><input type="radio" name="'.$am3['0'].'" id="'.$am3['0'].'" value="4"></td>');
		    						}
		    						if($_SESSION[$am3['0']] == '5') {
		    							echo('<td style="vertical-align:middle;text-align:center;"><input type="radio" name="'.$am3['0'].'" id="'.$am3['0'].'" value="5" checked></td>');
		    						} else {
		    							echo('<td style="vertical-align:middle;text-align:center;"><input type="radio" name="'.$am3['0'].'" id="'.$am3['0'].'" value="5"></td>');
		    						}
		    						if($_SESSION[$am3['0']] == '6') {
		    							echo('<td style="vertical-align:middle;text-align:center;"><input type="radio" name="'.$am3['0'].'" id="'.$am3['0'].'" value="6" checked></td>');
		    						} else {
		    							echo('<td style="vertical-align:middle;text-align:center;"><input type="radio" name="'.$am3['0'].'" id="'.$am3['0'].'" value="6"></td>');
		    						}
		    						if($_SESSION[$am3['0']] == '7') {
		    							echo('<td style="vertical-align:middle;text-align:center;"><input type="radio" name="'.$am3['0'].'" id="'.$am3['0'].'" value="7" checked></td>');
		    						} else {
		    							echo('<td style="vertical-align:middle;text-align:center;"><input type="radio" name="'.$am3['0'].'" id="'.$am3['0'].'" value="7"></td>');
		    						}
		    						if($_SESSION[$am3['0']] == '8') {
		    							echo('<td style="vertical-align:middle;text-align:center;"><input type="radio" name="'.$am3['0'].'" id="'.$am3['0'].'" value="8" checked></td>');
		    						} else {
		    							echo('<td style="vertical-align:middle;text-align:center;"><input type="radio" name="'.$am3['0'].'" id="'.$am3['0'].'" value="8"></td>');
		    						}
		    						if($_SESSION[$am3['0']] == '9') {
		    							echo('<td style="vertical-align:middle;text-align:center;"><input type="radio" name="'.$am3['0'].'" id="'.$am3['0'].'" value="9" checked></td>');
		    						} else {
		    							echo('<td style="vertical-align:middle;text-align:center;"><input type="radio" name="'.$am3['0'].'" id="'.$am3['0'].'" value="9"></td>');
		    						}
		    						echo('</tr>');
		    						echo('</table>');
		    						
		    					} elseif($am4['1'] == 'profle') {
		    						
		    						echo('<table cellpadding="2" cellspacing="0" width="100%">');
		    						if($_SESSION['dxf'] != NULL && $_SESSION['dxf']['name'] != '') {
		    							echo('<tr><td colspan="2">&#177;&#174;ank&#451;&#160;'.$_SESSION['dxf']['name'].'</td></tr>');
		    						}
		    						if($am4['7'] == '1') {
		    							echo('<tr><td align="left" valign="top">&#160;*&#160;Profile:&#160;&#160;&#160;</td><td align="right" valign="top">');
		    						} elseif($am4['7'] == '2') {
		    							echo('<tr><td align="left" valign="top">&#160;Profile:&#160;&#160;&#160;</td><td align="right" valign="top">');
		    						}
		    						if($am4['3'] == '1') {
		    							echo('<select name="'.$am3['0'].'" id="'.$am3['0'].'" onChange="javascript:this.form.submit();" style="width:160px;height:25px;">');
		    						} elseif($am4['3'] == '2') {
		    							echo('<select name="'.$am3['0'].'" id="'.$am3['0'].'" onChange="javascript:this.form.submit();" style="width:160px;height:25px;" disabled>');
		    						}
		    						$amisql = $this->dbi('1','SELECT * FROM directory WHERE BINARY acct=\''.$_SESSION['secact'].'\' LIMIT '.$_SESSION['dbb'].','.$_SESSION['dbr'].'');
		    						if($_SESSION[$am3['0']] == '') {
		    							echo('<option value="#" selected>Choose a profile:</option>');
		    						} else {
		    							echo('<option value="#">Choose a profile:</option>');
		    						}
    								if(mysql_num_rows($amisql) > '0') {
    									while($row = mysql_fetch_array($amisql)) {
    										if($_SESSION[$am3['0']] == $row['uid'].':'.$row['name']) {
    											echo('<option value="'.$row['uid'].':'.$row['name'].'" selected>'.$row['name'].'</option>');
    										} else {
    											echo('<option value="'.$row['uid'].':'.$row['name'].'">'.$row['name'].'</option>');
    										}
    									}
    								}
		    						echo('</select><br></td></tr>');
		    						echo('</table>');
		    						
		    					} elseif($am4['1'] == 'timer') {
		    						
		    						$type = '2';
		    						if(isset($_SESSION[$am4['0'].'_'.'r-listing-type'.'_1_1_107_4_1_1_free--premium'])) {
		    							switch($_SESSION[$am4['0'].'_'.'r-listing-type'.'_1_1_107_4_1_1_free--premium']) {
		    								case 'free':
		    									if($_SESSION[$am3['0']] != '7') {
		    										$_SESSION[$am3['0']] = '7';
		    									}
		    									$type = '1';
		    								break;
		    								case 'premium':
		    									$type = '2';
		    								break;
		    							}
		    						}
		    						if(isset($_SESSION[$am4['0'].'_'.'r-listing-type'.'_1_2_107_4_1_1_free--premium'])) {
		    							switch($_SESSION[$am4['0'].'_'.'r-listing-type'.'_1_2_107_4_1_1_free--premium']) {
		    								case 'free':
		    									if($_SESSION[$am3['0']] != '7') {
		    										$_SESSION[$am3['0']] = '7';
		    									}
		    									$type = '1';
		    								break;
		    								case 'premium':
		    									$type = '2';
		    								break;
		    							}
		    						}
		    						echo('<tr><td colspan="2">');
		    						echo('<table cellpadding="2" cellspacing="0" width="100%">');
		    						if($_SESSION['dxf'] != NULL && $_SESSION['dxf']['name'] != '') {
		    							echo('<tr><td colspan="2">&#177;&#174;ank&#451;&#160;'.$_SESSION['dxf']['name'].'</td></tr>');
		    						}
		    						if($am4['7'] == '1') {
		    							echo('<tr><td align="left" valign="top"><span class="'."$amcd".'"><span style="color:'."$amcc".';font-family:Arial;font-size:14px;">*</span><span style="color:'."$amcc".';">Timer:</span></span>&#160;&#160;&#160;</td><td align="right" valign="top">');
		    						} elseif($am4['7'] == '2') {
		    							echo('<tr><td align="left" valign="top"><span class="'."$amcd".'"><span style="color:'."$amcc".';">Timer:</span></span>&#160;&#160;&#160;</td><td align="right" valign="top">');
		    						}
		    						if($am4['3'] == '1') {
		    							echo('<select name="'.$am3['0'].'" id="'.$am3['0'].'" onChange="javascript:this.form.submit();" style="width:160px;height:25px;">');
		    						} elseif($am4['3'] == '2') {
		    							echo('<select name="'.$am3['0'].'" id="'.$am3['0'].'" onChange="javascript:this.form.submit();" style="width:160px;height:25px;" disabled>');
		    						}
		    						for($i=1;$i<22;$i++) {
		    							if($_SESSION[$am3['0']] == $i) {
		    								echo('<option value="'.$i.'" selected>'.$i.' day</option>');
		    							} else {
		    								if($type == '1' && $i != '7') {
		    									echo('<option value="'.$i.'" disabled>'.$i.' day</option>');
		    								} else {
		    									echo('<option value="'.$i.'">'.$i.' day</option>');
		    								}
		    							}
		    						}
		    						echo('</select><br></td></tr>');
		    						echo('</table>');
		    						echo('</td></tr>');
		    						
		    					} else {
		    					
		    						if(count($am4) == '7' || count($am4) == '8'|| count($am4) == '9') {
		    							if($am4['6'] == '1') {
				    						echo('<tr><td align="left" valign="top">');
				    						switch($am4['1']) {
				    							case 'slrid':
				    								if($am4['7'] == '1') {
				    									echo('&#160;*&#160;Merchant:&#160;&#160;&#160;');
				    								} elseif($am4['7'] == '2') {
				    									echo('&#160;Merchant:&#160;&#160;&#160;');
				    								}
				    								break;
				    							case 'searc':
				    								if($am4['7'] == '1') {
				    									echo('&#160;*&#160;Search:&#160;&#160;&#160;');
				    								} elseif($am4['7'] == '2') {
				    									echo('&#160;Search:&#160;&#160;&#160;');
				    								}
				    							break;
				    							case 'pricr':
				    								if($am4['7'] == '1') {
				    									echo('&#160;*&#160;Reserve:&#160;&#160;&#160;');
				    								} elseif($am4['7'] == '2') {
				    									echo('&#160;Reserve:&#160;&#160;&#160;');
				    								}
				    							break;
				    							case 'prics':
				    								if($am4['7'] == '1') {
				    									echo('&#160;*&##160;Start Price:&#160;&#160;&#160;');
				    								} elseif($am4['7'] == '2') {
				    									echo('&#160;Start Price:&#160;&#160;&#160;');
				    								}
				    							break;
				    							case 'price':
				    								if($am4['7'] == '1') {
				    									echo('&#160;*&#160;Price:&#160;&#160;&#160;');
				    								} elseif($am4['7'] == '2') {
				    									echo('&#160;Price:&#160;&#160;&#160;');
				    								}
				    							break;
				    							case 'fname':
				    								if($am4['7'] == '1') {
				    									echo('&#160;*&#160;First Name:&#160;&#160;&#160;');
				    								} elseif($am4['7'] == '2') {
				    									echo('&#160;First Name:&#160;&#160;&#160;');
				    								}
				    							break;
				    							case 'mname':
				    								if($am4['7'] == '1') {
				    									echo('&#160;*&#160;Middle Name:&#160;&#160;&#160;');
				    								} elseif($am4['7'] == '2') {
				    									echo('&#160;Middle Name:&#160;&#160;&#160;');
				    								}
				    							break;
				    							case 'lname':
				    								if($am4['7'] == '1') {
				    									echo('&#160;*&#160;Last Name:&#160;&#160;&#160;');
				    								} elseif($am4['7'] == '2') {
				    									echo('&#160;Last Name:&#160;&#160;&#160;');
				    								}
				    							break;
				    							case 'wname':
				    								if($am4['7'] == '1') {
				    									echo('&#160;*&#160;Full Name:&#160;&#160;&#160;');
				    								} elseif($am4['7'] == '2') {
				    									echo('&#160;Full Name:&#160;&#160;&#160;');
				    								}
				    							break;
				    							case 'bname':
				    								if($am4['7'] == '1') {
				    									echo('&#160;*&#160;Business Name:&#160;&#160;&#160;');
				    								} elseif($am4['7'] == '2') {
				    									echo('&#160;Business Name:&#160;&#160;&#160;');
				    								}
				    							break;
				    							case 'rname':
				    								if($am4['7'] == '1') {
				    									echo('&#160;*&#160;Your Name:&#160;&#160;&#160;');
				    								} elseif($am4['7'] == '2') {
				    									echo('&#160;Your Name:&#160;&#160;&#160;');
				    								}
				    							break;
				    							case 'nname':
				    								if($am4['7'] == '1') {
				    									echo('&#160;*&#160;Name:&#160;&#160;&#160;');
				    								} elseif($am4['7'] == '2') {
				    									echo('&#160;Name:&#160;&#160;&#160;');
				    								}
				    								break;
				    							case 'pname':
				    								if($am4['7'] == '1') {
				    									echo('&#160;*&#160;Email or ID to send payment to:&#160;&#160;&#160;');
				    								} elseif($am4['7'] == '2') {
				    									echo('&#160;Name:&#160;&#160;&#160;');
				    								}
				    							break;
				    							case 'ptrid':
				    								if($am4['7'] == '1') {
				    									echo('&#160;*&#160;Transaction ID:&#160;&#160;&#160;');
				    								} elseif($am4['7'] == '2') {
				    									echo('&#160;Transaction ID:&#160;&#160;&#160;');
				    								}
				    							break;
				    							case 'email':
				    								if($am4['7'] == '1') {
				    									echo('&#160;*&#160;Email:&#160;&#160;&#160;');
				    								} elseif($am4['7'] == '2') {
				    									echo('&#160;Email:&#160;&#160;&#160;');
				    								}
				    							break;
				    							case 'rmail':
				    								if($am4['7'] == '1') {
				    									echo('&#160;*&#160;Your Email:&#160;&#160;&#160;');
				    								} elseif($am4['7'] == '2') {
				    									echo('&#160;Your Email:&#160;&#160;&#160;');
				    								}
				    							break;
				    							case 'addrs':
				    								if($am4['7'] == '1') {
				    									echo('&#160;*&#160;Address:&#160;&#160;&#160;');
				    								} elseif($am4['7'] == '2') {
				    									echo('&#160;Address:&#160;&#160;&#160;');
				    								}
				    							break;
				    							case 'addra':
				    								if($am4['7'] == '1') {
				    									echo('&#160;*&#160;Address 1:&#160;&#160;&#160;');
				    								} elseif($am4['7'] == '2') {
				    									echo('&#160;Address 1:&#160;&#160;&#160;');
				    								}
				    							break;
				    							case 'addrb':
				    								if($am4['7'] == '1') {
				    									echo('&#160;*&#160;Address 2:&#160;&#160;&#160;');
				    								} elseif($am4['7'] == '2') {
				    									echo('&#160;Address 2:&#160;&#160;&#160;');
				    								}
				    							break;
				    							case 'raddr':
				    								if($am4['7'] == '1') {
				    									echo('&#160;*&#160;Your Address:&#160;&#160;&#160;');
				    								} elseif($am4['7'] == '2') {
				    									echo('&#160;Your Address:&#160;&#160;&#160;');
				    								}
				    							break;
				    							case 'cityy':
				    								if($am4['7'] == '1') {
				    									echo('&#160;*&#160;City:&#160;&#160;&#160;');
				    								} elseif($am4['7'] == '2') {
				    									echo('&#160;City:&#160;&#160;&#160;');
				    								}
				    							break;
				    							case 'rcity':
				    								if($am4['7'] == '1') {
				    									echo('&#160;*&#160;Your City:&#160;&#160;&#160;');
				    								} elseif($am4['7'] == '2') {
				    									echo('&#160;Your City:&#160;&#160;&#160;');
				    								}
				    							break;
				    							case 'state':
				    								if($am4['7'] == '1') {
				    									echo('&#160;*&#160;State:&#160;&#160;&#160;');
				    								} elseif($am4['7'] == '2') {
				    									echo('&#160;State:&#160;&#160;&#160;');
				    								}
				    							break;
				    							case 'rstat':
				    								if($am4['7'] == '1') {
				    									echo('&#160;*&#160;Your State:&#160;&#160;&#160;');
				    								} elseif($am4['7'] == '2') {
				    									echo('&#160;Your State:&#160;&#160;&#160;');
				    								}
				    							break;
				    							case 'zipce':
				    								if($am4['7'] == '1') {
				    									echo('&#160;*&#160;Zip Code:&#160;&#160;&#160;');
				    								} elseif($am4['7'] == '2') {
				    									echo('&#160;Zip Code:&#160;&#160;&#160;');
				    								}
				    							break;
				    							case 'rzipc':
				    								if($am4['7'] == '1') {
				    									echo('&#160;*&#160;Your Zip Code:&#160;&#160;&#160;');
				    								} elseif($am4['7'] == '2') {
				    									echo('&#160;Your Zip Code:&#160;&#160;&#160;');
				    								}
				    							break;
				    							case 'propn':
				    								if($am4['7'] == '1') {
				    									echo('&#160;*&#160;Proposal Number:&#160;&#160;&#160;');
				    								} elseif($am4['7'] == '2') {
				    									echo('&#160;Proposal Number:&#160;&#160;&#160;');
				    								}
				    							break;
				    							case 'subjf':
				    								if($am4['7'] == '1') {
				    									echo('&#160;*&#160;Subject / Question:&#160;&#160;&#160;');
				    								} elseif($am4['7'] == '2') {
				    									echo('&#160;Subject / Question:&#160;&#160;&#160;');
				    								}
				    							break;
				    							case 'conta':
				    								if($am4['7'] == '1') {
				    									echo('&#160;*&#160;Contact:&#160;&#160;&#160;');
				    								} elseif($am4['7'] == '2') {
				    									echo('&#160;Contact:&#160;&#160;&#160;');
				    								}
				    							break;
				    							case 'usrid':
				    								if($am4['7'] == '1') {
				    									echo('&#160;*&#160;User ID:&#160;&#160;&#160;');
				    								} elseif($am4['7'] == '2') {
				    									echo('&#160;User ID:&#160;&#160;&#160;');
				    								}
				    							break;
				    							case 'usrpd':
				    								if($am4['7'] == '1') {
				    									echo('&#160;*&#160;Password:&#160;&#160;&#160;');
				    								} elseif($am4['7'] == '2') {
				    									echo('&#160;Password:&#160;&#160;&#160;');
				    								}
				    							break;
				    							case 'radio':
				    								if($am4['7'] == '1') {
				    									echo('&#160;*&#160;Radio:&#160;&#160;&#160;');
				    								} elseif($am4['7'] == '2') {
				    									echo('&#160;Radio:&#160;&#160;&#160;');
				    								}
				    							break;
				    							case 'tarea':
				    								if($am4['7'] == '1') {
				    									echo('&#160;*&#160;Message:&#160;&#160;&#160;');
				    								} elseif($am4['7'] == '2') {
				    									echo('&#160;Message:&#160;&#160;&#160;');
				    								}
				    							break;
				    							case 'darea':
				    								if($am4['7'] == '1') {
				    									echo('&#160;*&#160;Description:&#160;&#160;&#160;');
				    								} elseif($am4['7'] == '2') {
				    									echo('&#160;Description:&#160;&#160;&#160;');
				    								}
				    							break;
				    							case 'title':
				    								if($am4['7'] == '1') {
				    									echo('&#160;*&#160;Title:&#160;&#160;&#160;');
				    								} elseif($am4['7'] == '2') {
				    									echo('&#160;Title:&#160;&#160;&#160;');
				    								}
				    								break;
				    							case 'descr':
				    								if($am4['7'] == '1') {
				    									echo('&#160;*&#160;Description:&#160;&#160;&#160;');
				    								} elseif($am4['7'] == '2') {
				    									echo('&#160;Description:&#160;&#160;&#160;');
				    								}
				    							break;
				    							case 'phone':
				    								if($am4['7'] == '1') {
				    									echo('&#160;*&#160;Phone:&#160;&#160;&#160;');
				    								} elseif($am4['7'] == '2') {
				    									echo('&#160;Phone:&#160;&#160;&#160;');
				    								}
				    							break;
				    							case 'rphne':
				    								if($am4['7'] == '1') {
				    									echo('&#160;*&#160;Your Phone:&#160;&#160;&#160;');
				    								} elseif($am4['7'] == '2') {
				    									echo('&#160;Your Phone:&#160;&#160;&#160;');
				    								}
				    							break;
				    							case 'ddfax':
				    								if($am4['7'] == '1') {
				    									echo('&#160;*&#160;Fax:&#160;&#160;&#160;');
				    								} elseif($am4['7'] == '2') {
				    									echo('&#160;Fax:&#160;&#160;&#160;');
				    								}
				    							break;
				    							case 'image':
				    								if($am4['7'] == '1') {
				    									echo('&#160;*&#160;Image:&#160;&#160;&#160;');
				    								} elseif($am4['7'] == '2') {
				    									echo('&#160;Image:&#160;&#160;&#160;');
				    								}
				    							break;
				    							case 'curla':
				    								if($am4['7'] == '1') {
				    									echo('&#160;*&#160;Current site http://&#160;&#160;&#160;');
				    								} elseif($am4['7'] == '2') {
				    									echo('&#160;Current site http://&#160;&#160;&#160;');
				    								}
				    							break;
				    							case 'curlb':
				    								if($am4['7'] == '1') {
				    									echo('&#160;*&#160;Example http://&#160;&#160;&#160;');
				    								} elseif($am4['7'] == '2') {
				    									echo('&#160;Example http://&#160;&#160;&#160;');
				    								}
				    							break;
				    							case 'curlc':
				    								if($am4['7'] == '1') {
				    									echo('&#160;*&#160;Web://&#160;&#160;&#160;');
				    								} elseif($am4['7'] == '2') {
				    									echo('&#160;Web://&#160;&#160;&#160;');
				    								}
				    							break;
				    							case 'curld':
				    								if($am4['7'] == '1') {
				    									echo('&#160;*&#160;Tracking URL:&#160;&#160;&#160;');
				    								} elseif($am4['7'] == '2') {
				    									echo('&#160;Tracking URL:&#160;&#160;&#160;');
				    								}
				    								break;
				    							default:
				    								
				    								if(preg_match('/^[r]{1}+[-]{1}/',substr($am4['1'],0,2))) {
				    									if($am4['7'] == '1') {
				    										echo('&#160;*&#160;'.ucwords(str_replace('-',' ',substr($am4['1'],2))).'&#160;&#160;&#160;');
				    									} elseif($am4['7'] == '2') {
				    										echo('&#160;'.ucwords(str_replace('-',' ',substr($am4['1'],2))).'&#160;&#160;&#160;');
				    									}
				    								}
				    								if(preg_match('/^[c]{1}+[-]{1}/',substr($am4['1'],0,2))) {
				    									if($am4['7'] == '1') {
				    										echo('&#160;*&#160;'.ucwords(str_replace('-',' ',substr($am4['1'],2))).'&#160;&#160;&#160;');
				    									} elseif($am4['7'] == '2') {
				    										echo('&#160;'.ucwords(str_replace('-',' ',substr($am4['1'],2))).'&#160;&#160;&#160;');
				    									}
				    								}
				    								
				    							break;
				    						}
				    						echo('</td><td align="right" valign="top">');
				    						switch($am4['5']) {
				    							case '1':
			
				    							break;
				    							case '2':
				    								if($am4['3'] == '1') {
				    									echo('<input type="text" name="'.$am3['0'].'" id="'.$am3['0'].'" value="'.$_SESSION[$am3['0']].'" style="width:160px;height:20px;">');
				    								} elseif($am4['3'] == '2') {
				    									echo('<input type="text" name="'.$am3['0'].'" id="'.$am3['0'].'" value="'.$_SESSION[$am3['0']].'" style="width:160px;height:20px;" disabled>');
				    								}
				    							break;
				    							case '3':
				    								if($am4['3'] == '1') {
				    									echo('<input type="password" name="'.$am3['0'].'" id="'.$am3['0'].'" value="'.$_SESSION[$am3['0']].'" style="width:160px;height:20px;">');
				    								} elseif($am4['3'] == '2') {
				    									echo('<input type="password" name="'.$am3['0'].'" id="'.$am3['0'].'" value="'.$_SESSION[$am3['0']].'" style="width:160px;height:20px;" disabled>');
				    								}
				    							break;
				    							case '4':
				    								if($am4['3'] == '1') {
				    									if(isset($_POST[$am3['0']])) {
				    										if(isset($am4['8']) && $am4['8'] != NULL) {
				    											$am6 = explode('--',$am4['8']);
				    											foreach($am6 as $subvar=>$subval) {
				    												echo('<span class="'."$amcd".'"><span style="color:'."$amcc".';">'.ucwords(str_replace('-',' ',$subval)).'</span></span>');
				    												if($subval == $_POST[$am3['0']]) {
				    													echo('<input type="radio" name="'.$am3['0'].'" id="'.$am3['0'].'" value="'.$subval.'" onDblCLick="javascript:switch(this.checked){case true:this.checked=false;break;case false:this.checked=true;break;};" style="border:0px;" checked><br>');
				    												} else {
				    													echo('<input type="radio" name="'.$am3['0'].'" id="'.$am3['0'].'" value="'.$subval.'" onDblCLick="javascript:switch(this.checked){case true:this.checked=false;break;case false:this.checked=true;break;};" style="border:0px;"><br>');
				    												}
				    											}
				    										} else {
				    											echo('<span class="'."$amcd".'"><span style="color:'."$amcc".';">'.ucwords(str_replace('-',' ',$am3['1'])).'</span></span>');
				    											if($am3['1'] == $_POST[$am3['0']]) {
				    												echo('<input type="radio" name="'.$am3['0'].'" id="'.$am3['0'].'" value="'.$_SESSION[$am3['0']].'" onDblCLick="javascript:switch(this.checked){case true:this.checked=false;break;case false:this.checked=true;break;};" style="border:0px;" checked>');
				    											} else {
				    												echo('<input type="radio" name="'.$am3['0'].'" id="'.$am3['0'].'" value="'.$_SESSION[$am3['0']].'" onDblCLick="javascript:switch(this.checked){case true:this.checked=false;break;case false:this.checked=true;break;};" style="border:0px;">');
				    											}
				    										}
				    									} else {
				    										if(isset($am4['8']) && $am4['8'] != NULL) {
				    											$am6 = explode('--',$am4['8']);
				    											foreach($am6 as $subvar=>$subval) {
				    												echo('<span class="'."$amcd".'"><span style="color:'."$amcc".';">'.ucwords(str_replace('-',' ',$subval)).'</span></span>');
				    												if($subval == $am3['1']) {
				    													echo('<input type="radio" name="'.$am3['0'].'" id="'.$am3['0'].'" value="'.$subval.'" onDblCLick="javascript:switch(this.checked){case true:this.checked=false;break;case false:this.checked=true;break;};" style="border:0px;" checked><br>');
				    												} else {
				    													echo('<input type="radio" name="'.$am3['0'].'" id="'.$am3['0'].'" value="'.$subval.'" onDblCLick="javascript:switch(this.checked){case true:this.checked=false;break;case false:this.checked=true;break;};" style="border:0px;"><br>');
				    												}
				    											}
				    										} else {
				    											echo('<span class="'."$amcd".'"><span style="color:'."$amcc".';">'.ucwords(str_replace('-',' ',$am3['1'])).'</span></span>');
				    											if($am3['1'] == $am3['1']) {
				    												echo('<input type="radio" name="'.$am3['0'].'" id="'.$am3['0'].'" value="'.$_SESSION[$am3['0']].'" onDblCLick="javascript:switch(this.checked){case true:this.checked=false;break;case false:this.checked=true;break;};" style="border:0px;" checked>');
				    											} else {
				    												echo('<input type="radio" name="'.$am3['0'].'" id="'.$am3['0'].'" value="'.$_SESSION[$am3['0']].'" onDblCLick="javascript:switch(this.checked){case true:this.checked=false;break;case false:this.checked=true;break;};" style="border:0px;">');
				    											}
				    										}
				    									}
				    								} elseif($am4['3'] == '2') {
				    									if(isset($am4['8']) && $am4['8'] != NULL) {
				    										$am6 = explode('--',$am4['8']);
				    										foreach($am6 as $subvar=>$subval) {
				    											echo('<span class="'."$amcd".'"><span style="color:'."$amcc".';">'.ucwords(str_replace('-',' ',$subval)).'</span></span>');
				    											if($subval == $am3['1']) {
				    												echo('<input type="radio" name="'.$am3['0'].'" id="'.$am3['0'].'" value="'.$subval.'" onDblCLick="javascript:switch(this.checked){case true:this.checked=false;break;case false:this.checked=true;break;};" style="border:0px;" checked disabled><br>');
				    											} else {
				    												echo('<input type="radio" name="'.$am3['0'].'" id="'.$am3['0'].'" value="'.$subval.'" onDblCLick="javascript:switch(this.checked){case true:this.checked=false;break;case false:this.checked=true;break;};" style="border:0px;" disabled><br>');
				    											}
				    										}
				    									} else {
				    										echo('<span class="'."$amcd".'"><span style="color:'."$amcc".';">'.ucwords(str_replace('-',' ',$am3['1'])).'</span></span>');
				    										if($am3['1'] == $am3['1']) {
				    											echo('<input type="radio" name="'.$am3['0'].'" id="'.$am3['0'].'" value="'.$_SESSION[$am3['0']].'" onDblCLick="javascript:switch(this.checked){case true:this.checked=false;break;case false:this.checked=true;break;};" style="border:0px;" checked disabled>');
				    										} else {
				    											echo('<input type="radio" name="'.$am3['0'].'" id="'.$am3['0'].'" value="'.$_SESSION[$am3['0']].'" onDblCLick="javascript:switch(this.checked){case true:this.checked=false;break;case false:this.checked=true;break;};" style="border:0px;" disabled>');
				    										}
				    									}
				    								}
				    							break;
				    							case '5':
				    								if($am4['3'] == '1') {
				    									if(isset($_POST[$am3['0']])) {
				    										if(isset($am4['8']) && $am4['8'] != NULL) {
				    											$am6 = explode('--',$am4['8']);
				    											foreach($am6 as $subvar=>$subval) {
				    												if($am4['7'] == '1') {
				    													if($_SESSION[$am3['0']] == $subval) {
				    														echo('<span style="color:'."$amc".';">'.ucwords(str_replace('-',' ',$subval)).'</span>&#160;&#160;&#160;');
				    														echo('<input type="checkbox" name="'.$am3['0'].'" id="'.$am3['0'].'" value="'.$subval.'" onDblCLick="javascript:switch(this.checked){case true:this.checked=false;break;case false:this.checked=true;break;};" style="border:0px;" checked><br>');
				    													} else {
				    														echo('<span style="color:'."$amc".';">'.ucwords(str_replace('-',' ',$subval)).'</span>&#160;&#160;&#160;');
				    														echo('<input type="checkbox" name="'.$am3['0'].'" id="'.$am3['0'].'" value="'.$subval.'" onDblCLick="javascript:switch(this.checked){case true:this.checked=false;break;case false:this.checked=true;break;};" style="border:0px;"><br>');
				    													}
				    												} elseif($am4['7'] == '2') {
				    													if($_SESSION[$am3['0']] == $subval) {
				    														echo('<span style="color:'."$amc".';">'.ucwords(str_replace('-',' ',$subval)).'</span>&#160;&#160;&#160;');
				    														echo('<input type="checkbox" name="'.$am3['0'].'" id="'.$am3['0'].'" value="'.$subval.'" onDblCLick="javascript:switch(this.checked){case true:this.checked=false;break;case false:this.checked=true;break;};" style="border:0px;" checked><br>');
				    													} else {
				    														echo('<span style="color:'."$amc".';">'.ucwords(str_replace('-',' ',$subval)).'</span>&#160;&#160;&#160;');
				    														echo('<input type="checkbox" name="'.$am3['0'].'" id="'.$am3['0'].'" value="'.$subval.'" onDblCLick="javascript:switch(this.checked){case true:this.checked=false;break;case false:this.checked=true;break;};" style="border:0px;"><br>');
				    													}
				    												}
				    											}
				    										} else {
				    											if($am4['7'] == '1') {
				    												echo('<input type="checkbox" name="'.$am3['0'].'" id="'.$am3['0'].'" value="'.$_SESSION[$am3['0']].'" onDblCLick="javascript:switch(this.checked){case true:this.checked=false;break;case false:this.checked=true;break;};" style="border:0px;" checked><br>');
				    											} elseif($am4['7'] == '2') {
				    												echo('<input type="checkbox" name="'.$am3['0'].'" id="'.$am3['0'].'" value="'.$_SESSION[$am3['0']].'" onDblCLick="javascript:switch(this.checked){case true:this.checked=false;break;case false:this.checked=true;break;};" style="border:0px;" checked><br>');
				    											}
				    										}
				    									} else {
				    										if(isset($am4['8']) && $am4['8'] != NULL) {
				    											$am6 = explode('--',$am4['8']);
				    											foreach($am6 as $subvar=>$subval) {
				    												if($am4['7'] == '1') {
				    													if($_SESSION[$am3['0']] == $subval) {
				    														echo('<span style="color:'."$amc".';">'.ucwords(str_replace('-',' ',$subval)).'</span>&#160;&#160;&#160;');
				    														echo('<input type="checkbox" name="'.$am3['0'].'" id="'.$am3['0'].'" value="'.$subval.'" onDblCLick="javascript:switch(this.checked){case true:this.checked=false;break;case false:this.checked=true;break;};" style="border:0px;" checked><br>');
				    													} else {
				    														echo('<span style="color:'."$amc".';">'.ucwords(str_replace('-',' ',$subval)).'</span>&#160;&#160;&#160;');
				    														echo('<input type="checkbox" name="'.$am3['0'].'" id="'.$am3['0'].'" value="'.$subval.'" onDblCLick="javascript:switch(this.checked){case true:this.checked=false;break;case false:this.checked=true;break;};" style="border:0px;"><br>');
				    													}
				    												} elseif($am4['7'] == '2') {
				    													if($_SESSION[$am3['0']] == $subval) {
				    														echo('<span style="color:'."$amc".';">'.ucwords(str_replace('-',' ',$subval)).'</span>&#160;&#160;&#160;');
				    														echo('<input type="checkbox" name="'.$am3['0'].'" id="'.$am3['0'].'" value="'.$subval.'" onDblCLick="javascript:switch(this.checked){case true:this.checked=false;break;case false:this.checked=true;break;};" style="border:0px;" checked><br>');
				    													} else {
				    														echo('<span style="color:'."$amc".';">'.ucwords(str_replace('-',' ',$subval)).'</span>&#160;&#160;&#160;');
				    														echo('<input type="checkbox" name="'.$am3['0'].'" id="'.$am3['0'].'" value="'.$subval.'" onDblCLick="javascript:switch(this.checked){case true:this.checked=false;break;case false:this.checked=true;break;};" style="border:0px;"><br>');
				    													}
				    												}
				    											}
				    										} else {
				    											if($am4['7'] == '1') {
				    												echo('<input type="checkbox" name="'.$am3['0'].'" id="'.$am3['0'].'" value="'.$_SESSION[$am3['0']].'" onDblCLick="javascript:switch(this.checked){case true:this.checked=false;break;case false:this.checked=true;break;};" style="border:0px;" checked><br>');
				    											} elseif($am4['7'] == '2') {
				    												echo('<input type="checkbox" name="'.$am3['0'].'" id="'.$am3['0'].'" value="'.$_SESSION[$am3['0']].'" onDblCLick="javascript:switch(this.checked){case true:this.checked=false;break;case false:this.checked=true;break;};" style="border:0px;"><br>');
				    											}
				    										}
				    									}
				    								} elseif($am4['3'] == '2') {
				    									if($am3['1'] == $am3['1']) {
				    										echo('<input type="checkbox" name="'.$am3['0'].'" id="'.$am3['0'].'" value="'.$_SESSION[$am3['0']].'" onDblCLick="javascript:switch(this.checked){case true:this.checked=false;break;case false:this.checked=true;break;};" style="border:0px;" checked disabled><br>');
				    									} else {
				    										echo('<input type="checkbox" name="'.$am3['0'].'" id="'.$am3['0'].'" value="'.$_SESSION[$am3['0']].'" onDblCLick="javascript:switch(this.checked){case true:this.checked=false;break;case false:this.checked=true;break;};" style="border:0px;" disabled><br>');
				    									}
				    								}
				    							break;
				    							case '6':
				    								if($am4['3'] == '1') {
				    									echo('<textarea name="'.$am3['0'].'" id="'.$am3['0'].'" style="width:160px;height:40px;resize:none;">'.$_SESSION[$am3['0']].'</textarea>');
				    								} elseif($am4['3'] == '2') {
				    									echo('<textarea name="'.$am3['0'].'" id="'.$am3['0'].'" style="width:160px;height:40px;resize:none;" disabled>'.$_SESSION[$am3['0']].'</textarea>');
				    								}
				    							break;
				    							case '7':
				    								if($_SESSION[$am3['0']] == '') {
					    								if($am4['3'] == '1') {
					    									echo('<input type="file" name="'.$am3['0'].'" id="'.$am3['0'].'" value="'.$_SESSION[$am3['0']].'" style="width:160px;height:20px;">');
					    								} elseif($am4['3'] == '2') {
					    									echo('<input type="file" name="'.$am3['0'].'" id="'.$am3['0'].'" value="'.$_SESSION[$am3['0']].'" style="width:160px;height:20px;" disabled>');
					    								}
				    								} else {
				    									if(file_exists($_SESSION[$am3['0']])) {
				    										$xurl = $_SESSION[$am3['0']];
				    									} elseif(file_exists($_SESSION[$am3['0']])) {
				    										$xurl = $_SESSION[$am3['0']];
				    									}else {
				    										$xurl = '';
				    									}
				    									switch($_SESSION['pf']) {
				    										case '1':
				    											echo('<table border="0" cellpadding="0" cellspacing="0" style="padding:0px 0px 0px 0px;margin:5px 0px 5px 0px;"><tr><td valign="middle" align="center"><div class="zthumb_d"><a href="'.$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'].'&ul='.$am3['0'].'" class="link0">[x] delete</a></div><img src="'.$xurl.'" width="160" height="160"></td></tr></table>');
				    										break;
				    										case '2':
				    											echo('<table border="0" cellpadding="0" cellspacing="0" style="padding:0px 0px 0px 0px;margin:5px 0px 5px 0px;"><tr><td valign="middle" align="center"><div class="zthumb_d"><a href="'.$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'].'&ul='.$am3['0'].'" class="link0">[x] delete</a></div><img src="'.$xurl.'" width="160" height="160"></td></tr></table>');
				    										break;
				    										case '3':
				    											echo('<table border="0" cellpadding="0" cellspacing="0" style="padding:0px 0px 0px 0px;margin:5px 0px 5px 0px;"><tr><td valign="middle" align="center"><div class="zthumb_d"><a href="'.$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'].'&ul='.$am3['0'].'" class="link1">[x] delete</a></div><img src="'.$xurl.'" width="160" height="160"></td></tr></table>');
				    										break;
				    									}
				    								}
				    							break;
				    						}
				    						echo('</td></tr>');
		    							}
			    					}
			    				}
	    					}
	    					if($amiy == $am4['2'] && $am4['6'] == '1') {
	    						echo('<tr><td colspan="2" align="right">* Required Fields</td></tr>');
	    						//echo('<tr><td colspan="2" align="right"><table border="0" cellpadding="0" cellspacing="0"><tr><td align="center" valign="top"><input type="submit" value="submit"></form></td><td align="center" valign="top"><form name="recycle_'.$arr1uval.'" id="recycle_'.$arr1uval.'" action="'.$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'].'" method="post"><input type="hidden" name="d_obj" value="'.$arr1uval.'"><input type="submit" value="clear"></form></td></tr></table></td></tr>');
	    						echo('<tr><td colspan="2" align="right"><table border="0" cellpadding="0" cellspacing="0"><tr><td align="center" valign="top"><input type="submit" value="submit"></form></td><td align="center" valign="top"></td></tr></table></td></tr>');
	    						echo('</table>');
	    						echo('<br>');
	    					}
    					}
    				}
    			}
    		}
    		if(substr(get_class($this),4,1) != 'a') { return; }
    	}
    }
    private function loc() {
        $this->qvo = substr($this->qvo,0,-1);
        $this->qva = substr($this->qva,0,-1);
        if(isset($_SESSION['qvo_last'])) {
            $_SESSION['qvo_last'] = $this->qvo;
        }
        if(substr(get_class($this),4,1) != 'a') { return; }
        if(isset($_SESSION['logout']) && $_SESSION['logout'] == '1') {
            @session_destroy();
            header('Location:'.$_SERVER['PHP_SELF']);
            exit;
        } elseif($this->aiiiiiiiiiii > 0) {
        	$this->aiiiiiiiiiii = 0;
            if($this->rdl == '1') {
                if($this->frd == '1') {
                    header('Location:'.$_SERVER['PHP_SELF'].'?'.$this->qva);
                } elseif($this->frd == '2') {
                    header('Location:'.$_SERVER['PHP_SELF'].'?'.$this->qvo);
                } else {
                    header('Location:'.$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);
                }
            }
        }
        $xxx = (microtime()-$this->tme);
        echo('<!--GENERATED IN: '.$xxx.'-->');
        return $this;
    }
}
$tme = microtime();
$fastsaas = new Lunnatti($tme);
echo('<!--'.strtoupper($www).' BY FaStSAAS-->');
?>
