
#!/bin/bash

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


# BlueSpiceDistributionConnector
BlueSpiceDistributionConnector=(
	"https://github.com/hallowelt/mediawiki-extensions-BlueSpiceDistributionConnector/archive/master.zip"
	"mediawiki-extensions-BlueSpiceDistributionConnector-master"
	"BlueSpiceDistributionConnector"
)
# CategoryTree
CategoryTree=(
	"https://github.com/wikimedia/mediawiki-extensions-CategoryTree/archive/REL1_27.zip"
	"mediawiki-extensions-CategoryTree-REL1_27"
	"CategoryTree"
)
# DynamicPageList
DynamicPageList=(
	"https://github.com/wikimedia/mediawiki-extensions-DynamicPageList/archive/REL1_27.zip"
	"mediawiki-extensions-DynamicPageList-REL1_27"
	"DynamicPageList"
)
# Echo
Echo=(
	"https://github.com/wikimedia/mediawiki-extensions-Echo/archive/REL1_27.zip"
	"mediawiki-extensions-Echo-REL1_27"
	"Echo"
)
# EchoConnector
BlueSpiceEchoConnector=(
	"https://github.com/hallowelt/mediawiki-extensions-BlueSpiceEchoConnector/archive/master.zip"
	"mediawiki-extensions-BlueSpiceEchoConnector-master"
	"BlueSpiceEchoConnector"
)
# EmbedVideo
EmbedVideo=(
	"https://github.com/HydraWiki/mediawiki-embedvideo/archive/v2.4.1.zip"
	"mediawiki-embedvideo-2.4.1"
	"EmbedVideo"
)
# HitCounters
HitCounters=(
	"https://github.com/wikimedia/mediawiki-extensions-HitCounters/archive/REL1_27.zip"
	"mediawiki-extensions-HitCounters-REL1_27"
	"HitCounters"
)
# ImageMapEdit
ImageMapEdit=(
	"https://github.com/hallowelt/mediawiki-extensions-ImageMapEdit/archive/master.zip"
	"mediawiki-extensions-ImageMapEdit-master"
	"ImageMapEdit"
)
# LdapAuthentication
LdapAuthentication=(
	"https://github.com/hallowelt/mediawiki-extensions-LdapAuthentication/archive/REL1_27.zip"
	"mediawiki-extensions-LdapAuthentication-REL1_27"
	"LdapAuthentication"
)
# LdapAuthenticationConnector
BlueSpiceLdapAuthenticationConnector=(
	"https://github.com/hallowelt/mediawiki-extensions-BlueSpiceLdapAuthenticationConnector/archive/master.zip"
	"mediawiki-extensions-BlueSpiceLdapAuthenticationConnector-master"
	"BlueSpiceLdapAuthenticationConnector"
)
# Lockdown
Lockdown=(
	"https://github.com/wikimedia/mediawiki-extensions-Lockdown/archive/REL1_27.zip"
	"mediawiki-extensions-Lockdown-REL1_27"
	"Lockdown"
)
# MobileFrontend
MobileFrontend=(
	"https://github.com/wikimedia/mediawiki-extensions-MobileFrontend/archive/REL1_27.zip"
	"mediawiki-extensions-MobileFrontend-REL1_27"
	"MobileFrontend"
)
# NSFileRepo
NSFileRepo=(
	"https://github.com/wikimedia/mediawiki-extensions-NSFileRepo/archive/REL1_27.zip"
	"mediawiki-extensions-NSFileRepo-REL1_27"
	"NSFileRepo"
)
# Quiz
Quiz=(
	"https://github.com/wikimedia/mediawiki-extensions-Quiz/archive/REL1_27.zip"
	"mediawiki-extensions-Quiz-REL1_27"
	"Quiz"
)
# RSS
RSS=(
	"https://github.com/wikimedia/mediawiki-extensions-RSS/archive/REL1_27.zip"
	"mediawiki-extensions-RSS-REL1_27"
	"RSS"
)
# TitleKey
TitleKey=(
	"https://github.com/wikimedia/mediawiki-extensions-TitleKey/archive/REL1_27.zip"
	"mediawiki-extensions-TitleKey-REL1_27"
	"TitleKey"
)
# UserMerge
UserMerge=(
	"https://github.com/wikimedia/mediawiki-extensions-UserMerge/archive/REL1_27.zip"
	"mediawiki-extensions-UserMerge-REL1_27"
	"UserMerge"
)
# UserMergeConnector
BlueSpiceUserMergeConnector=(
	"https://github.com/hallowelt/mediawiki-extensions-BlueSpiceUserMergeConnector/archive/master.zip"
	"mediawiki-extensions-BlueSpiceUserMergeConnector-master"
	"BlueSpiceUserMergeConnector"
)

# EditNotify
EditNotify=(
	"https://github.com/wikimedia/mediawiki-extensions-EditNotify/archive/master.zip"
	"mediawiki-extensions-EditNotify-master"
	"EditNotify"
)

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
	BlueSpiceUserMergeConnector[@],
	EditNotify[@]
)

TEMP_FILE="/tmp/BlueSpiceDistribution.zip"

# Loop
COUNT=${#Extensions[@]}
for ((i=0; i<$COUNT; i++))
do
	NAME=${!Extensions[i]:1:1}
	VALUE=${!Extensions[i]:2:1}
	echo "NAME ${NAME}"
	echo "VALUE ${VALUE}"

	rm ${!Extensions[i]:1:1}.zip
	wget ${!Extensions[i]:0:1} -O ${!Extensions[i]:1:1}.zip

	rm -Rf ${!Extensions[i]:1:1}
	unzip ${!Extensions[i]:1:1}.zip
	rm ${!Extensions[i]:1:1}.zip

	rm -Rf ${!Extensions[i]:2:1}
	mv ${!Extensions[i]:1:1} ${!Extensions[i]:2:1}

done

for ((i=0; i<$COUNT; i++))
do
	find . -maxdepth 1 -type d -name ${!Extensions[i]:2:1} -exec zip -r $TEMP_FILE {} \;
	find . -maxdepth 1 -type d -name ${!Extensions[i]:2:1} -exec rm -Rf {} \;
done

#create localsettings configs
cat <<EOT >> LocalSettings.BlueSpiceDistribution.php.template
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
require_once( "\$IP/extensions/BlueSpiceEchoConnector/EchoConnector.setup.php" );
require_once( "\$IP/extensions/TitleKey/TitleKey.php" );
require_once( "\$IP/extensions/NSFileRepo/NSFileRepo.php" );
require_once( "\$IP/extensions/EmbedVideo/EmbedVideo.php" );
require_once( "\$IP/extensions/UserMerge/UserMerge.php" );
require_once( "\$IP/extensions/EditNotify/EditNotify.php" );
\$wgUserMergeProtectedGroups = array(); //+there is a hack in
//SpecialUserMerge:validateOldUser
\$wgUserMergeUnmergeable = array();

require_once( "\$IP/extensions/MobileFrontend/MobileFrontend.php" );
\$wgMFAutodetectMobileView = true;
\$wgMFEnableDesktopResources = true;
\$wgExtensionDirectory = "\$IP/extensions";

require_once( "\$IP/extensions/BlueSpiceDistributionConnector/BSDistConnector.setup.php" );
require_once( "\$IP/extensions/BlueSpiceUserMergeConnector/UserMergeConnector.setup.php" );

//By default this is disabled. See https://gerrit.wikimedia.org/r/#/c/193359/1
//If this is needed depends on the actual LDAP setup
//\$wgHooks['SetUsernameAttributeFromLDAP'][] = 'BlueSpiceDistributionHooks::onSetUsernameAttribute';
EOT

zip $TEMP_FILE LocalSettings.BlueSpiceDistribution.php.template
rm LocalSettings.BlueSpiceDistribution.php.template

echo "Package have been created: $TEMP_FILE";