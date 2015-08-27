<?php

class BlueSpiceLdapHooks {

	public static function activateLogoutButton () {
		global $wgLDAPAutoAuthLogout;
		if (isset ($wgLDAPAutoAuthLogout) && $wgLDAPAutoAuthLogout == true) {
			global $wgHooks;
			unset ($wgHooks['PersonalUrls'][array_search ('LdapAutoAuthentication::NoLogout', $wgHooks['PersonalUrls'])]);
		}
		return true;
	}

	public static function onLDAPModifyUITemplate ( &$template ) {
		global $wgLDAPRenameLocal, $wgLDAPShowLocal, $wgLDAPDomainNames, $wgLDAPAutoAuthDomain;
		$localname = 'local';
		if (isset ($wgLDAPRenameLocal) && !empty ($wgLDAPRenameLocal)) {
			$localname = $wgLDAPRenameLocal;
		}
		$domains = $wgLDAPDomainNames;
		unset ($domains[array_search ($wgLDAPAutoAuthDomain, $domains)]);
		if (isset ($wgLDAPShowLocal) && $wgLDAPShowLocal == true) {
			array_push ($domains, $localname);
		}
		$template->set( 'domainnames', $domains );
		return true;
	}

}
