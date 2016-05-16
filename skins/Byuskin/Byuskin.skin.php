<?php
/**
*This skin, and CSS applied by Eric Eyre 06-11-2013
*ANY CHANGES MADE TO THIS FILE MUST ALSO BE REFLECTED IN THE CAM SITE!!!!!
*SETTINGS, FORMATTING, AND OTHER STYLISTIC ELEMENTS ARE MEANT TO BE IDENTICAL!!!!!
*
* BYU skin
 * Based off The Erudite skin for Wordpress.
 *
 * @file
 * @ingroup Skins
 */

$webbypath = dirname(__FILE__) . "/";
$webbypath = str_replace($_SERVER['DOCUMENT_ROOT'], '', $webbypath);

global $wgBASE_URL;
global $wgLOCAL_URL;

define('BASE_URL',  $wgBASE_URL);
define('LOCAL_URL',  $wgLOCAL_URL);

error_reporting(-1); //turn off error reporting to save the Asgard logs
// initialize
if( !defined( 'MEDIAWIKI' ) ){
	die( "This is a skins file for mediawiki and should not be viewed directly.\n" );
}
//require_once( dirname( dirname( __FILE__ ) ) . '/includes/cms_functions.inc');
//require_once( dirname( dirname( __FILE__ ) ) . '/includes/roles.inc');

require_once( dirname( dirname( dirname( __FILE__ ) ) ). '/includes/skins/SkinTemplate.php');

require_once( dirname( dirname( dirname( __FILE__ ) ) ). '/extensions/WikiEditor/WikiEditor.hooks.php');

// inherit main code from SkinTemplate, set the CSS and template filter

class SkinByuskin extends SkinTemplate {
	function initPage( OutputPage $out ) {
		parent::initPage( $out );
		$this->skinname  = 'byuskin';
		$this->stylename = 'Byuskin';
		$this->template  = 'ByuskinTemplate';
		$this->useHeadElement = false;
	}
	function setupSkinUserCss( OutputPage $out ) {
		global $wgHandheldStyle;
		parent::setupSkinUserCss( $out );
	}

	function getMTitle() {
		global $wgTitle;
		return $wgTitle;
	}
}

class ByuskinTemplate extends QuickTemplate {
	var $skin;
	function getCategories() {
		$catlinks=$this->getCategoryLinks();
		if(!empty($catlinks)) {
			return "<ul id='catlinks'>{$catlinks}</ul>";
		}
	}

	function getCategoryLinks() {
		global $wgOut, $wgUser, $wgTitle, $wgUseCategoryBrowser;
		global $wgContLang;

		if(count($wgOut->mCategoryLinks) == 0) return '';

		$skin = $wgUser->getSkin();

		# separator
		$sep = "";

		// use Unicode bidi embedding override characters,
		// to make sure links don't smash each other up in ugly ways
		$dir = $wgContLang->isRTL() ? 'rtl' : 'ltr';
		$embed = "<li dir='$dir'>";
		$pop = '</li>';
		$cats = $wgOut->mCategoryLinks['normal'];
		//$t = $embed . implode ( "{$pop} {$sep} {$embed}" , $wgOut->mCategoryLinks ) . $pop;

		$msg = wfMsgExt('pagecategories', array('parsemag', 'escape'), count($wgOut->mCategoryLinks));
		$s = $embed . $skin->makeLinkObj(Title::newFromText(wfMsgForContent('pagecategorieslink')), $msg) . $pop;
		while (list($key, $val) = each($cats)) {
			$s .= $embed . $val . $pop;
		}

		# optional 'dmoz-like' category browser - will be shown under the list
		# of categories an article belongs to
		if($wgUseCategoryBrowser) {
			$s .= '<br /><hr />';

			# get a big array of the parents tree
			$parenttree = $wgTitle->getParentCategoryTree();
			# Skin object passed by reference because it can not be
			# accessed under the method subfunction drawCategoryBrowser
			$tempout = explode("\n", Skin::drawCategoryBrowser($parenttree, $this));
			# clean out bogus first entry and sort them
			unset($tempout[0]);
			asort($tempout);
			# output one per line
			$s .= implode("<br />\n", $tempout);
		}
 		return $s;
	}

	/**
	 * Template filter callback for this skin.
	 * Takes an associative array of data set from a SkinTemplate-based
	 * class, and a wrapper for MediaWiki's localization database, and
	 * outputs a formatted page.
	 */
	public function execute() {
		global $wgRequest, $wgSitename;

		$this->skin = $this->data['skin'];
		$mTitle = $this->skin->getMTitle();

		// suppress warnings to prevent notices about missing indexes in $this->data
		wfSuppressWarnings();

		$matches = Array();
		$c = preg_match('/\<p\>(.+?)\<\/p\>/s', $this->data['bodytext'], $matches);
		$description = trim(preg_replace('/\"/', '\'', strip_tags($matches[0])));
if ($_COOKIE['dest']==0 || !isset($_COOKIE['dest'])){
$_COOKIE['dest']=$_GET["dest"];
setcookie('dest', $_GET["dest"], 0, "/");
}
		//$this->html( 'headelement' );
	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->


<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" class="no-js">

<? $FullURL = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
if ( $_COOKIE['AccountKiosk']=="AccountKiosk" || strpos ( $FullURL, 'accountkiosk' ) !== false || strpos ( $FullURL, 'dest=13' ) !==false || strpos ( $FullURL, 'dest=14' ) !==false || strpos ( $FullURL, 'dest=15' ) !==false || strpos ( $FullURL, 'dest=16' ) !==false || $_GET["dest"]==13 || $_GET["dest"]==14 || $_GET["dest"]==15 || $_GET["dest"]==16 ){
        $accountkiosk = TRUE; } else { $accountkiosk = FALSE; } ?>

<head profile="http://gmpg.org/xfn/11">
	<title><?php $this->html('title'); ?> &#8211; <?php echo($wgSitename); ?></title>
	<meta property="og:title" value="<?php $this->html('title'); ?>">
	<meta property="og:site_name" content="<?php echo($wgSitename); ?>"/>
	<meta property="og:type" content="article"/>
	<meta property="og:description" content="<?php echo($description); ?>"/>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />

	<?php if ($this->data['content_actions']['edit']) { ?>
		<link rel="alternate" type="application/x-wiki" title="Edit" href="<?php echo($this->data['content_actions']['edit']['href']); ?>" />
	<?php } ?>

	<link rel="shortcut icon" href="/favicon.ico" />
	<link rel="search" type="application/opensearchdescription+xml" href="<?php $this->text('scriptpath'); ?>/opensearch_desc.php" title="<?php echo($wgSitename); ?>" />
	<link rel="copyright" href="<?php $this->text('scriptpath'); ?>/index.php/Copyright_Notice" />
	<link rel="alternate" type="application/atom+xml" title="<?php echo($wgSitename); ?> Atom feed" href="<?php $this->text('scriptpath'); ?>/index.php?title=Special:RecentChanges&amp;feed=atom" />

	<!-- Insert plugin stylesheets here -->
	<link rel="stylesheet" href="<?php echo LOCAL_URL; ?>skins/Byuskin/template/css/plugins/slider.css" />
	<link rel="stylesheet" href="<?php echo LOCAL_URL; ?>skins/Byuskin/template/css/plugins/calendar.css" />
	<link rel="stylesheet" href="<?php echo LOCAL_URL; ?>skins/Byuskin/template/css/plugins/news.css" />
	<link rel="stylesheet" href="<?php echo LOCAL_URL; ?>skins/Byuskin/template/css/plugins/socialmedia.css" />
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
	<script>!window.jQuery && document.write(unescape('%3Cscript src="Byuskin/template/js/libs/jquery.min.js"%3E%3C/script%3E'))</script>


	<script src="<?php echo LOCAL_URL; ?>skins/Byuskin/template/js/libs/modernizr-2.0-basic.min.js"></script>

	<!-- Insert plugin stylesheets here -->
	<link rel="stylesheet" type="text/css" href="<?php echo LOCAL_URL; ?>skins/Byuskin/template/css/style.css" />
	<link rel="stylesheet" type="text/css" href="<?php $this->text('stylepath' ) ?>/common/shared.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="<?php $this->text('stylepath' ) ?>/common/commonPrint.css" media="print" />
	<link rel="stylesheet" type="text/css" href="<?php $this->text('stylepath' ) ?>/common/commonContent.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="<?php $this->text('stylepath' ) ?>/common/commonElements.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="<?php echo LOCAL_URL; ?>resources/jquery/jquery.makeCollapsible.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="<?php $this->text('stylepath' ) ?>/Byuskin/template/css/style.css" />

	<script type="text/javascript">
// <![CDATA[
		var erdt = {
			More: '<span></span> Keep Reading',
			Less: '<span></span> Put Away',
			Info: '&#x2193; Further Information',
			MenuShow: '<span></span> Show Menu',
			MenuHide: '<span></span> Hide Menu',
			DisableKeepReading: false,
			DisableHide: true
		};
		(function(H){H.className=H.className.replace(/\bno-js\b/,'js')})(document.documentElement)
// ]]>
	</script>
	<?php 
		// print Skin::makeGlobalVariablesScript( $this->data ); 
	?>
	<script type="<?php $this->text('jsmimetype') ?>" src="<?php $this->text('stylepath' ) ?>/common/wikibits.js?<?php echo $GLOBALS['wgStyleVersion'] ?>"><!-- wikibits js --></script>
   </head>
<body class="single single-post">

<header id="main-header">
		<div id="header-top" class="wrapper">
			<div id="logo">
				<? if ($accountkiosk) { ?>
				<a href="https://caedm.et.byu.edu/accountkiosk/" class="byu"><img src="<?php echo LOCAL_URL; ?>skins/Byuskin/images/menu/byulogo.png" style="width: 305px; padding-bottom: 2px;" alt="BYU Logo"/></a>
				<? } else { ?>
				<a href="http://www.byu.edu/" class="byu"><img src="<?php echo LOCAL_URL; ?>skins/Byuskin/images/menu/byulogo.png" style="width: 305px; padding-bottom: 2px;" alt="BYU Logo" usemap="#byulogo" /></a>
				<map name="byulogo">
					<area shape="rect" coords="0,0,115,45" href="http://www.byu.edu" />
                                        <area shape="rect" coords="115,0,305,45" href="https://caedm.et.byu.edu" />
                                        <area shape="rect" coords="0,45,305,180" href="http://www.et.byu.edu" />

					  </map>
				<? } ?>
			</div>
<? if (!$accountkiosk) { ?>
			<div id="search-container">
				<? if ( !isset( $_COOKIE['CMSUsername']) || $_COOKIE['CMSUsername']=="" || $_COOKIE['CMSPassword']=="" || !isset( $_COOKIE['CMSPassword'] )) {?>
				<a href="<?php echo BASE_URL; ?>index.php5?title=Special:UserLogin&returnto=Ira+A.+Fulton+College+of+Engineering+and+Technology&dest=00" class="button">CAEDM Login</a>
				
				<? } else { ?>
				<a href="<?php echo BASE_URL; ?>index.php5?title=Special:UserLogout&returnto=Ira+A.+Fulton+College+of+Engineering+and+Technology" class="button"> Logout </a>

					<script>
					var IDLE_TIMEOUT = 60*60*4; //seconds->4 hours
					var _idleSecondsCounter = 0;
					document.onclick = function() {
					    _idleSecondsCounter = 0;
					};
					document.onmousemove = function() {
					    _idleSecondsCounter = 0;
					};
					document.onkeypress = function() {
					    _idleSecondsCounter = 0;
					};
					window.setInterval(CheckIdleTime, 1000);

					function CheckIdleTime() {
					    _idleSecondsCounter++;
					    var oPanel = document.getElementById("SecondsUntilExpire");
					    if (oPanel)
						oPanel.innerHTML = (IDLE_TIMEOUT - _idleSecondsCounter) + "";
					    if (_idleSecondsCounter >= IDLE_TIMEOUT) {
						alert("Time expired!");
						document.location.href = "<?php echo BASE_URL; ?>index.php5?title=Special:UserLogout&returnto=Ira+A.+Fulton+College+of+Engineering+and+Technology";
					    }
					}
					</script>
				<? }
				 ?>
				<!-- ENTER YOUR SEARCH URL under action -->


				<form action="<?php $this->text('searchaction') ?>" id="searchform">
					<input type="text" name="search" id="search" placeholder="Search CAEDM" <?php if( isset( $this->data['search'] ) ) { ?>
                        			value="<?php $this->text('search') ?>"
                        			<?php } ?> />
					<input type="image" src="<?php echo LOCAL_URL; ?>skins/Byuskin/template/img/search-button.png" alt="Search" id="search-button" value="<?php $this->msg('searchbutton') ?>"/>
				</form>


			</div>
			<nav id="secondary-nav" class="no-js">
			<ul>
			<li class="nochild"><a href="https://my.byu.edu">MyBYU</a></li>
			<li class="nochild"><a href="https://learningsuite.byu.edu">Learning Suite</a></li>
			<li class="nochild"><a href="http://caedm.et.byu.edu<?php echo LOCAL_URL; ?>index.php5?title=Contact_Us">Contact Us</a></li>
			</ul>
			</div>
			</nav>

<? } ?>
			</div>





		<nav id="primary-nav" class="no-js">
			<ul>
				<?if ($accountkiosk ) {
                                if (strpos($FullURL, 'accountkiosk')!==false && (isset($_COOKIE["CMSUsername"]) && $_COOKIE["CMSUsername"]!=="")) { ?>
                                        <li><a href="<?php echo BASE_URL; ?>index.php5?title=Special:UserLogout">Logout</a></li>
                                <? } elseif (strpos($FullURL, 'accountkiosk')==false && (isset($_COOKIE["CMSUsername"]) && $_COOKIE["CMSUsername"]!=="")) { ?>
                                <li><a href="https://caedm.et.byu.edu/accountkiosk/">&#9668; Back</a></li>
                                <li><a href="<?php echo BASE_URL; ?>index.php5?title=Special:UserLogout">Logout</a></li>
                                <? } elseif (strpos($FullURL, 'accountkiosk')==false && (!isset($_COOKIE["CMSUsername"]) || $_COOKIE["CMSUsername"]=="")) { ?>
                                <li><a href="https://caedm.et.byu.edu/accountkiosk/">&#9668; Back</a></li>
                                <? } else { ?>
                                <li style="margin-top: 38px;" ></li>
                                <? } ?>
                        <? } else { ?>

				<li><a href="">Accounts</a>
					<div class="mega">
						<ul class="links">

						<?php foreach( $this->data['sidebar']['Accounts'] as $key => $val ) { ?>
							<li id="menu-item-<?php echo Sanitizer::escapeId( $val['id'] ) ?>" class="featured menu-item menu-item-type-post_type menu-item">
					       	<a href="<?php echo htmlspecialchars( $val['href'] ) ?>"><?php echo htmlspecialchars( $val['text'] ) ?></a>
																						</li>
						<?php } ?>
						
						</ul><ul class="links" style="position: absolute; top:180px;">	
						<li style="font-size:130%; margin-bottom:5px;"><u>Learn More</u></li>
						<?php foreach( $this->data['sidebar']['Accounts Learn More'] as $key => $val ) { ?>
							<li id="menu-item-<?php echo Sanitizer::escapeId( $val['id'] ) ?>" class="menu-item menu-item-type-post_type menu-item">
					       	<a href="<?php echo htmlspecialchars( $val['href'] ) ?>"><?php echo htmlspecialchars( $val['text'] ) ?></a>
																						</li>
						<?php } ?>
						</ul>
						<div class="highlight"><a href="<?php echo BASE_URL; ?>index.php5?title=CAEDM_account"><img src="<?php echo LOCAL_URL; ?>images/4/4b/Student_backpack.jpg" width="320" height="228"></a>
							<p>CAEDM may be new to you, but there are many ways that you can learn how to maximize your experience with CAEDM.</p>
						</div>

					</div>
				</li>
				<li><a href="">Remote Computing</a>
					<div class="mega">
						<ul class="links">
						
						<?php foreach( $this->data['sidebar']['Remote Computing'] as $key => $val ) { ?>
							<li id="menu-item-<?php echo Sanitizer::escapeId( $val['id'] ) ?>" class="featured menu-item menu-item-type-post_type menu-item">
					       	<a href="<?php echo htmlspecialchars( $val['href'] ) ?>"><?php echo htmlspecialchars( $val['text'] ) ?></a>
																						</li>
						<?php } ?>
						
						</ul><ul class="links" style="position: absolute; top:180px;">	
						<li style="font-size:130%;margin-bottom:5px;"><u>Learn More</u></li>
						<?php foreach( $this->data['sidebar']['Remote Computing Learn More'] as $key => $val ) { ?>
							<li id="menu-item-<?php echo Sanitizer::escapeId( $val['id'] ) ?>" class="menu-item menu-item-type-post_type menu-item">
					       	<a href="<?php echo htmlspecialchars( $val['href'] ) ?>"><?php echo htmlspecialchars( $val['text'] ) ?></a>
																						</li>
						<?php } ?>
						</ul>
						<div class="highlight"><a href="<?php echo BASE_URL; ?>index.php5?title=Remote_Computing"><img src="<?php echo LOCAL_URL; ?>images/4/4c/Devices.jpg" width="320" height="228"></a>
							<p>CAEDM offers a wide variety of resources that can all be used no matter where you happen to be.  From home, work, and even from your phone, your CAEDM needs can be fulfilled.</p>
						</div>

					</div>
				</li>
				<li> <a href="">Files</a>
					<div class="mega">
						<ul class="links">
						
						<?php foreach( $this->data['sidebar']['Files'] as $key => $val ) { ?>
							<li id="menu-item-<?php echo Sanitizer::escapeId( $val['id'] ) ?>" class="featured menu-item menu-item-type-post_type menu-item">
					       	<a href="<?php echo htmlspecialchars( $val['href'] ) ?>"><?php echo htmlspecialchars( $val['text'] ) ?></a>
																						</li>
						<?php } ?>

						</ul><ul class="links" style="position: absolute; top:180px;">	
						<li style="font-size:130%; margin-bottom:5px;"><u>Learn More</u></li>
						<?php foreach( $this->data['sidebar']['Files Learn More'] as $key => $val ) { ?>
							<li id="menu-item-<?php echo Sanitizer::escapeId( $val['id'] ) ?>" class="menu-item menu-item-type-post_type menu-item">
					       	<a href="<?php echo htmlspecialchars( $val['href'] ) ?>"><?php echo htmlspecialchars( $val['text'] ) ?></a>
																						</li>
						<?php } ?>
						</ul>
						<div class="highlight"><a href="<?php echo BASE_URL; ?>index.php5?title=J_Drive"><img src="<?php echo LOCAL_URL; ?>images/Accessing_files.png" width="320" height="228"></a>
                                                       <p>CAEDM provides file access anywhere on campus, and from home.</p>
                                                </div>
					</div>
				</li>
				<li> <a href="">Printing</a>
					<div class="mega">
						<ul class="links">
						
						<?php foreach( $this->data['sidebar']['Printing'] as $key => $val ) { ?>
							<li id="menu-item-<?php echo Sanitizer::escapeId( $val['id'] ) ?>" class="featured menu-item menu-item-type-post_type menu-item">
					       	<a href="<?php echo htmlspecialchars( $val['href'] ) ?>"><?php echo htmlspecialchars( $val['text'] ) ?></a>
																						</li>
						<?php } ?>
						
						</ul><ul class="links" style="position: absolute; top:180px;">	
						<li style="font-size:130%; margin-bottom:5px;"><u>Learn More</u></li>
						<?php foreach( $this->data['sidebar']['Printing Learn More'] as $key => $val ) { ?>
							<li id="menu-item-<?php echo Sanitizer::escapeId( $val['id'] ) ?>" class="menu-item menu-item-type-post_type menu-item">
					       	<a href="<?php echo htmlspecialchars( $val['href'] ) ?>"><?php echo htmlspecialchars( $val['text'] ) ?></a>
																						</li>
						<?php } ?>
						</ul>
						<div class="highlight"><a href="<?php echo BASE_URL; ?>index.php5?title=Printing"><img src="<?php echo LOCAL_URL; ?>images/c/c2/Printer_menu.jpg"></a>
							<p>CAEDM allows you to print from the labs, but also from an individual computer.</p>
						</div>
					</div>
				</li>
				<li> <a href="">Labs and Software</a>
					<div class="mega">
						<ul class="links">
						
						<?php foreach( $this->data['sidebar']['Labs'] as $key => $val ) { ?>
							<li id="menu-item-<?php echo Sanitizer::escapeId( $val['id'] ) ?>" class="featured menu-item menu-item-type-post_type menu-item">
					       	<a href="<?php echo htmlspecialchars( $val['href'] ) ?>"><?php echo htmlspecialchars( $val['text'] ) ?></a>
																						</li>
						<?php } ?>
						
						</ul><ul class="links" style="position: absolute; top:180px;">	
						<li style="font-size:130%; margin-bottom:5px;"><u>Learn More</u></li>
						<?php foreach( $this->data['sidebar']['Labs Learn More'] as $key => $val ) { ?>
							<li id="menu-item-<?php echo Sanitizer::escapeId( $val['id'] ) ?>" class="menu-item menu-item-type-post_type menu-item">
					       	<a href="<?php echo htmlspecialchars( $val['href'] ) ?>"><?php echo htmlspecialchars( $val['text'] ) ?></a>
																						</li>
						<?php } ?>
						</ul>
						<div class="highlight"><a href="<?php echo BASE_URL; ?>index.php5?title=CAEDM_Labs"><img src="<?php echo LOCAL_URL; ?>images/b/b6/Lab_and_software_menu.jpg"></a>
                                                       <p>CAEDM has 3 labs full of computers, but most resources may be accessed remotely.</p>
                                                </div>
					</div>
				</li>
				<li> <a href="">Groups</a>
					<div class="mega">
						<ul class="links">

						<?php foreach( $this->data['sidebar']['Groups'] as $key => $val ) { ?>
							<li id="menu-item-<?php echo Sanitizer::escapeId( $val['id'] ) ?>" class="featured menu-item menu-item-type-post_type menu-item">
					       	<a href="<?php echo htmlspecialchars( $val['href'] ) ?>"><?php echo htmlspecialchars( $val['text'] ) ?></a>
																						</li>
						<?php } ?>
						</ul><ul class="links" style="position: absolute; top:180px;">	
						<li style="font-size:130%; margin-bottom:5px;"><u>Learn More</u></li>
						<?php foreach( $this->data['sidebar']['Groups Learn More'] as $key => $val ) { ?>
							<li id="menu-item-<?php echo Sanitizer::escapeId( $val['id'] ) ?>" class="menu-item menu-item-type-post_type menu-item">
					       	<a href="<?php echo htmlspecialchars( $val['href'] ) ?>"><?php echo htmlspecialchars( $val['text'] ) ?></a>
																						</li>
						<?php } ?>
						</ul>
						<div class="highlight"><a href="<?php echo BASE_URL; ?>index.php5?title=CAEDM_groups"><img src="/wiki/images/9/93/Groups_menu.jpg" height="228" width="320"></a>
						     <p>CAEDM provides many group collaboration resources.</p>
						 </div>
					</div>
				</li>
                        <?php if (isset($_SESSION['wsUserID'])&&$_SESSION['wsUserID']!=0) { ?>
                        <li><a href="#" style="background:#4f77b8;">Wiki Toolbox</a>
                            <ul class="sub">
			    	<li>Edit This Page</li>
                                <li><a class="single" href="<?php echo($this->data['content_actions']['edit']['href']); ?>"> Edit</a></li>
                                <li><a class="single" href="<?php echo($this->data['content_actions']['move']['href']); ?>"> Move</a></li>
                                <li><a class="single" href="<?php echo($this->data['content_actions']['watch']['href']); ?>"> Watch</a></li>
                             	<li><a class="single" href="<?php echo($this->data['content_actions']['history']['href']); ?>"> History</a></li>
			        <li><a class="single" href="<?php echo($this->data['content_actions']['talk']['href']); ?>"> Discuss</a></li>
                                <li><a class="single" href="<?php echo($this->data['content_actions']['protect']['href']); ?>"> Protect</a></li>
                                <li><a class="single" href="<?php echo($this->data['content_actions']['delete']['href']); ?>"> Delete</a></li>
				<li><hr></li>
				<li>Toolbox</li>
				<li><a class="single" href="http://caedm.et.byu.edu/wiki/index.php5?title=MediaWiki:Sidebar&action=edit">Edit Menus</a></li>
				<li><a class="single" href="http://caedm.et.byu.edu/wiki/index.php5?title=Admin:Admin_documentation">Admin Documentation</a></li>
				<li><a class="single" href="<?php echo($this->data['nav_urls']['whatlinkshere']['href']); ?>"> What Links Here</a></li>
				<?php foreach( $this->data['sidebar']['Toolbox'] as $key => $val ) { ?>
                                <li id="menu-item-<?php echo Sanitizer::escapeId( $val['id'] ) ?>" class="menu-item menu-item-type-post_type menu-item">
				 <a href="<?php echo htmlspecialchars( $val['href'] ) ?>"> <?php echo htmlspecialchars( $val['text'] ) ?></a>                                                                                           </li>
			         <?php } ?>
				<li><hr></li>
				<li>My Account</li>
                                <?php foreach( array( 'mytalk', 'preferences', 'watchlist', 'mycontris', 'logout') as $special ) { ?>
                                               		 <?php if($this->data['personal_urls']) { ?>
                                        <li class="menu-item menu-item-type-post_type menu-item">
                                            <a href="<?php echo htmlspecialchars( $this->data['personal_urls'][$special]['href'] ) ?>"> <?php echo htmlspecialchars( $this->data['personal_urls'][$special]['text'] ) ?></a>
                                        </li>
                                       		         <?php } ?>
                                        		<?php }?>
							
  </ul>
  </li>
						<?	}

                      if (! isset($_SESSION['wsUserID'])||$_SESSION['wsUserID']!=0) { ?>

 <?php
                                $CMS=false;
                                $linkformat = '<li><a href="https://caedm.et.byu.edu/cms/%1$s/" target="cms_main">%2$s</a></li>' . "\n";
                                // $roles = roles_get_applist_for_current_user();
								$roles = array();
                                //debug($roles);die();

                                $role_names = array (
                                  'duser'=>'duser',
                                        'mad'=>'MAD',
                                        'roles'=>'Roles',
                                        'blacklist'=>'Blacklist',
                                        'quota'=>'Quota',
                                        'listadmin'=>'ListAdmin',
                                        'status'=>'Status',
                                        'uams'=>'UAMS',
                                        'inventory'=>'Inventory',
                                        'uturn'=>'UTurn',
                                        'winerrors'=>'WinErrors',
                                        'money'=>'Money',
                                        'securityscans'=>'SecurityScans',
                                        'docs'=>'Documentation',
                                        'logs'=>'Print/Charge logs',
                                        'printers'=>'Printer Management',
                                        'printqueue'=>'Print Queue',
                                        'nagios'=>'Nagios',
                                        'centreon'=>'SNC'
                                );

                        //debug($role_names);die();
$role_list="";
                        foreach($roles as $role=>$truth) {
                                if($truth) {

                                        if(isset($role_names[$role])) {
                                                if($role_list==""){
                                                $name = $role_names[$role];
                                           //     $role_list=sprintf($linkformat, $role, $name);
                                        }
                                                else {
                                                 $name = $role_names[$role];
                                             //   $role_list.='|'.sprintf($linkformat, $role, $name);
                                                }
                                        //debug("role: " . $role . "; name: " . $name);
                                        if($CMS==false){ ?>
                                                <li><a href="https://caedm.et.byu.edu/cms/cms/login.php" style="background:#4f77b8;">CMS</a>
                                             <!--    <div class="sub">
                                                <ul class="links">
                                <?php }

                                        $CMS=true;
                                       // printf($linkformat, $role, $name);
                                }
                        }
}
if ($CMS==true){
                        ?>
                        </ul>
                        </div> -->
                        </li>
<? }} ?>
                        </ul>


                      
                      <? } ?>
			</ul>
		</nav>
	</header>

	<div id="content" class="wrapper">

<!--    <div id="wrapper" class="hfeed">      -->




	<?php if( $this->data['newtalk'] ) { ?>
		<div id="newtalk"><?php $this->html('newtalk') ?></div>
	<?php } ?>
	<div id="container">
			<div id="content-container" class="post type-post hentry category-submissions">
				<?php if ($this->data['title']!="Ira A. Fulton College of Engineering and Technology") { ?>
				<h1 class="entry-title"><?php $this->html('title'); ?></h1>
				<?php if ($this->data['subtitle']) { ?>
					<span class="entry-sub-title"><?php $this->html('subtitle') ?></span><br/><br/>
				<?php }} ?>
				<div class="entry-content">

				<!-- INSERT WIKI STUFF HERE -->

				<?php
				$this->html('bodytext') ?>




			</div>
	</div><!-- #container -->

 	</div>     

</div>


<div id="footer-bottom">
	
		<div class="wrapper">
					  <div class="region region-footer-bottom">
					      <div id="block-block-1" class="block block-block first last odd">
					      <div class="content">


			<p class="rtecenter">
			<? if (!$accountkiosk) { ?>
			<div class="rtecenter" style="float: right; margin-right: -37px"><a align=right href="http://www.youtube.com/byucaedm"><img src="<?php echo LOCAL_URL; ?>skins/Byuskin/template/img/youtube.png"></a></div><?}?>
			<? if (!$accountkiosk) {?>
			<img src="<?php echo LOCAL_URL; ?>images/byulogofooter.png" style="width: 300px;" usemap="#BYU">
			<map name="BYU">
				<area shape="rect" coords="0,0,105,45" href="http://www.byu.edu" />
				<area shape="rect" coords="105,0,300,45" href="https://caedm.et.byu.edu" />
				<area shape="rect" coords="0,45,300,100" href="http://www.et.byu.edu" />

				</map>
		<br />	
			<div style="margin-top: 7.5px"><div><span style="color: rgb(128, 128, 128); line-height: 1.2em;"><a href="http://www.et.byu.edu/college-directory/CAEDM">Staff</a></span><span style="font-size:11px;">
			<span style="color: rgb(128, 128, 128); line-height: 1.2em;"><a href="http://caedm.et.byu.edu/wiki/index.php5?title=Contact_Us">Contact Us</a></span></div></div>

</p></div></div></div></div><? } else { ?><a href="https://caedm.et.byu.edu/accountkiosk/"><img src="<?php echo LOCAL_URL; ?>images/byulogofooter.png" style="width: 300px;"></a><? } ?>


							      		</div>
									   



</div><!-- #wrapper .hfeed -->
<script type="text/javascript">
jQuery(window).load(function() {
  jQuery.getJSON(wgScriptPath + '/api.php?action=query&format=json&list=recentchanges&rctype=new&rclimit=5&rcnamespace=0', function(data) {
  	var container = jQuery('#newestPages');
  	container.empty();

  	var results = data['query']['recentchanges'];
  	var resultlen = results.length;
  	for (i = 0; i < resultlen; i++) {
  		var result = results[i];
  		var timestamp = result['timestamp'];
  		var title = result["title"];
  		var encodedTitle = encodeURI(title);
  		var year = timestamp.substring(2,4);
  		var month = timestamp.substring(5,7);
  		var day = timestamp.substring(8,10);
		var path = wgArticlePath.replace('\$1', encodedTitle);

  		var formatdate = month + "." + day + "." + year;
  		//alert(result['title']);
  		container.append('<li>' + formatdate + ' - <a href="' + wgServer + path + '">' + title + '</a></li>');
  	}
  });
});
</script>
</script>

<script type='text/javascript' src='<?php $this->text('stylepath' ) ?>/Byuskin/template/js/script.js?<?php echo $GLOBALS['wgStyleVersion'] ?>'></script>
</body>
</html>
		<?php
	}
}
if (preg_match('/Admin\:/', $_SERVER['REQUEST_URI']) || preg_match('/Admin\:/', $_SERVER['QUERY_STRING'])|| preg_match('/Admin\:/', $_SERVER['HTTP_HOST'])) {
?>
<div style="position: fixed; z-index: 100000; background-color: rgb(245, 130, 32); color: white; font-size: 32px; padding: 16px;" id="adminfloater">Admin Page</div>
<?php }
