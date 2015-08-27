<?php

$wgHooks['BeforePageDisplay'][] = 'BlueSpiceLdapHooks::activateLogoutButton';
$wgHooks['LDAPModifyUITemplate'][] = 'BlueSpiceLdapHooks::onLDAPModifyUITemplate';
