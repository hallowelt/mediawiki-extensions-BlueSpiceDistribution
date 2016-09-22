
#!/bin/bash

if [ -z "$1" ]
  then EXTENSIONS_DIR="extensions"
  else EXTENSIONS_DIR="$1"
fi

#GIT_URL="git@github.com:" #use this for git over ssh
GIT_URL="https://github.com/" #use this for anonymous git over https

# build bluespice distribution
# used extensions:
#
#	BlueSpiceDistributionConnector
#	CategoryTree
#	DynamicPageList
#	Echo
#	BlueSpiceEchoConnector
#	EmbedVideo
#	HitCounters
#	ImageMapEdit
#	LdapAuthentication
#	BlueSpiceLdapAuthenticationConnector
#	Lockdown
#	MobileFrontend
#	NSFileRepo
#	Quiz
#	RSS
#	TitleKey
#	UserMerge
#	BlueSpiceUserMergeConnector
#	EditNotify


# BlueSpiceDistributionConnector
BlueSpiceDistributionConnector=(
	"${GIT_URL}hallowelt/mediawiki-extensions-BlueSpiceDistributionConnector.git"
	"master"
	"BlueSpiceDistributionConnector"
)
# CategoryTree
CategoryTree=(
	"${GIT_URL}wikimedia/mediawiki-extensions-CategoryTree.git"
	"REL1_27"
	"CategoryTree"
)
# DynamicPageList
DynamicPageList=(
	"${GIT_URL}Alexia/DynamicPageList.git"
	"master"
	"DynamicPageList"
)
# Echo
Echo=(
	"${GIT_URL}wikimedia/mediawiki-extensions-Echo.git"
	"REL1_27"
	"Echo"
)
# EchoConnector
BlueSpiceEchoConnector=(
	"${GIT_URL}hallowelt/mediawiki-extensions-BlueSpiceEchoConnector.git"
	"master"
	"BlueSpiceEchoConnector"
)
# EmbedVideo
EmbedVideo=(
	"${GIT_URL}HydraWiki/mediawiki-embedvideo.git"
	"master"
	"EmbedVideo"
)
# HitCounters
HitCounters=(
	"${GIT_URL}wikimedia/mediawiki-extensions-HitCounters.git"
	"REL1_27"
	"HitCounters"
)
# ImageMapEdit
ImageMapEdit=(
	"${GIT_URL}hallowelt/mediawiki-extensions-ImageMapEdit.git"
	"master"
	"ImageMapEdit"
)
# LdapAuthentication
LdapAuthentication=(
	"${GIT_URL}hallowelt/mediawiki-extensions-LdapAuthentication.git"
	"REL1_27"
	"LdapAuthentication"
)
# LdapAuthenticationConnector
BlueSpiceLdapAuthenticationConnector=(
	"${GIT_URL}hallowelt/mediawiki-extensions-BlueSpiceLdapAuthenticationConnector.git"
	"master"
	"BlueSpiceLdapAuthenticationConnector"
)
# Lockdown
Lockdown=(
	"${GIT_URL}wikimedia/mediawiki-extensions-Lockdown.git"
	"REL1_27"
	"Lockdown"
)
# MobileFrontend
MobileFrontend=(
	"${GIT_URL}wikimedia/mediawiki-extensions-MobileFrontend.git"
	"REL1_27"
	"MobileFrontend"
)
# NSFileRepo
NSFileRepo=(
	"${GIT_URL}wikimedia/mediawiki-extensions-NSFileRepo.git"
	"REL1_27"
	"NSFileRepo"
)
# Quiz
Quiz=(
	"${GIT_URL}wikimedia/mediawiki-extensions-Quiz.git"
	"REL1_27"
	"Quiz"
)
# RSS
RSS=(
	"${GIT_URL}wikimedia/mediawiki-extensions-RSS.git"
	"REL1_27"
	"RSS"
)
# TitleKey
TitleKey=(
	"${GIT_URL}wikimedia/mediawiki-extensions-TitleKey.git"
	"REL1_27"
	"TitleKey"
)
# UserMerge
UserMerge=(
	"${GIT_URL}wikimedia/mediawiki-extensions-UserMerge.git"
	"REL1_27"
	"UserMerge"
)
# UserMergeConnector
BlueSpiceUserMergeConnector=(
	"${GIT_URL}hallowelt/mediawiki-extensions-BlueSpiceUserMergeConnector.git"
	"master"
	"BlueSpiceUserMergeConnector"
)
# EditNotify
EditNotify=(
	"${GIT_URL}wikimedia/mediawiki-extensions-EditNotify.git"
	"master"
	"EditNotify"
)

BlueSpiceEditNotifyConnector={
	"https://gerrit.wikimedia.org/r/mediawiki/extensions/BlueSpiceEditNotifyConnector",
	"master",
	"BlueSpiceEditNotifyConnector"
}

Extensions=(
	BlueSpiceDistributionConnector[@]
	CategoryTree[@]
	DynamicPageList[@]
	Echo[@]
	BlueSpiceEchoConnector[@]
	EmbedVideo[@]
	HitCounters[@]
	ImageMapEdit[@]
	LdapAuthentication[@]
	BlueSpiceLdapAuthenticationConnector[@]
	Lockdown[@]
	MobileFrontend[@]
	NSFileRepo[@]
	Quiz[@]
	RSS[@]
	TitleKey[@]
	UserMerge[@]
	BlueSpiceUserMergeConnector[@]
	EditNotify[@],
	BlueSpiceEditNotifyConnector[@]
)

mkdir -p $EXTENSIONS_DIR
cd $EXTENSIONS_DIR

# Loop
COUNT=${#Extensions[@]}
for ((i=0; i<$COUNT; i++)); do
    git clone -b ${!Extensions[i]:1:1} --depth 1 ${!Extensions[i]:0:1} ${!Extensions[i]:2:1}
done

#create localsettings configs
SETTINGS_FILE="../LocalSettings.BlueSpiceDistribution.php.template"
rm $SETTINGS_FILE
cat <<EOT >> $SETTINGS_FILE

<?php
//Copy LocalSettings.BlueSpiceDistribution.php.template to mediawiki main directory: /LocalSettings.BlueSpiceDistribution.php
//Include LocalSettings.BlueSpiceProDistribution.php in LocalSettings.php to activate all Modules

/*
cp LocalSettings.BlueSpiceDistribution.php.template ../LocalSettings.BlueSpiceDistribution.php
echo 'require_once "LocalSettings.BlueSpiceDistribution.php";' | tee --append ../LocalSettings.php
*/

require_once( "\$IP/extensions/CategoryTree/CategoryTree.php" );
require_once( "\$IP/extensions/DynamicPageList/DynamicPageList.php" );
require_once( "\$IP/extensions/ImageMapEdit/ImageMapEdit.php" );
require_once( "\$IP/extensions/Lockdown/Lockdown.php" );
require_once( "\$IP/extensions/Quiz/Quiz.php" );
require_once( "\$IP/extensions/RSS/RSS.php" );
require_once( "\$IP/extensions/Echo/Echo.php" );
require_once( "\$IP/extensions/TitleKey/TitleKey.php" );
require_once( "\$IP/extensions/NSFileRepo/NSFileRepo.php" );
require_once( "\$IP/extensions/EmbedVideo/EmbedVideo.php" );
require_once( "\$IP/extensions/UserMerge/UserMerge.php" );
require_once( "\$IP/extensions/EditNotify/EditNotify.php" );

\$wgUserMergeProtectedGroups = array();
\$wgUserMergeUnmergeable = array();

require_once( "\$IP/extensions/MobileFrontend/MobileFrontend.php" );
\$wgMFAutodetectMobileView = true;
\$wgMFEnableDesktopResources = true;

require_once( "\$IP/extensions/BlueSpiceEchoConnector/BlueSpiceEchoConnector.php" );
require_once( "\$IP/extensions/BlueSpiceDistributionConnector/BlueSpiceDistributionConnector.php" );
require_once( "\$IP/extensions/BlueSpiceUserMergeConnector/BlueSpiceUserMergeConnector.php" );
wfLoadExtensions( "BlueSpiceEditNotifyConnector" );


//By default this is disabled. See https://gerrit.wikimedia.org/r/#/c/193359/1
//If this is needed depends on the actual LDAP setup
//\$wgHooks['SetUsernameAttributeFromLDAP'][] = 'BlueSpiceDistributionHooks::onSetUsernameAttribute';
EOT

#echo 'require_once "LocalSettings.BlueSpiceDistribution.php";' | tee --append ../LocalSettings.php

echo "extensions initialized, don't forget to rename/include LocalSettings.BlueSpiceDistribution.php.template file and call update.php on first init";