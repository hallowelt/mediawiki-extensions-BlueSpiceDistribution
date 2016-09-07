<?php

require_once( __DIR__."/CategoryTree/CategoryTree.php" );
require_once( __DIR__."/DynamicPageList/DynamicPageList.php" );
require_once( __DIR__."/ImageMapEdit/ImageMapEdit.php" );
require_once( __DIR__."/Lockdown/Lockdown.php" );
require_once( __DIR__."/Quiz/Quiz.php" );
require_once( __DIR__."/RSS/RSS.php" );
require_once( __DIR__."/Echo/Echo.php" );
require_once( __DIR__."/EchoConnector/EchoConnector.setup.php" );
require_once( __DIR__."/TitleKey/TitleKey.php" );
require_once( __DIR__."/NSFileRepo/NSFileRepo.php" );
require_once( __DIR__."/EmbedVideo/EmbedVideo.php" );
require_once( __DIR__."/HitCounters/HitCounters.php" );
if( !isset($wgExtensionDirectory) ) {
	$wgExtensionDirectory = "$IP/extensions";
}
$wgExtensionDirectory = "$IP/extensions/BlueSpiceDistribution";
require_once( __DIR__."/UserMerge/UserMerge.php" );
$wgUserMergeProtectedGroups = array(); //+there is a hack in
//SpecialUserMerge:validateOldUser
$wgUserMergeUnmergeable = array();

require_once( __DIR__ . "/MobileFrontend/MobileFrontend.php" );
$wgMFAutodetectMobileView = true;
$wgMFEnableDesktopResources = true;
$wgExtensionDirectory = "$IP/extensions";

require_once( __DIR__."/BSDistConnector/BSDistConnector.setup.php" );
require_once( __DIR__."/UserMergeConnector/UserMergeConnector.setup.php" );

//By default this is disabled. See https://gerrit.wikimedia.org/r/#/c/193359/1
//If this is needed depends on the actual LDAP setup
//$wgHooks['SetUsernameAttributeFromLDAP'][] = 'BlueSpiceDistributionHooks::onSetUsernameAttribute';
