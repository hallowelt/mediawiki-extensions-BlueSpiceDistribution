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
		array_push ($domains, $localname);
		unset ($domains[array_search ($wgLDAPAutoAuthDomain, $domains)]);
		if (isset ($wgLDAPShowLocal) && $wgLDAPShowLocal == false) {
			unset ($domains[array_search ($localname, $domains)]);
		}
		$template->set( 'domainnames', $domains );
		return true;
	}

}
