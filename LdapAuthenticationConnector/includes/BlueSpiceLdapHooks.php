<?php

class BlueSpiceLdapHooks {

	public static function onLDAPModifyUITemplate( &$template ) {
		global $bsgLDAPRenameLocal, $bsgLDAPShowLocal, $wgLDAPDomainNames, $wgLDAPAutoAuthDomain;
		$localname = 'local';
		if (isset( $bsgLDAPRenameLocal ) && !empty( $bsgLDAPRenameLocal ) ) {
			$localname = $bsgLDAPRenameLocal;
		}
		$domains = $wgLDAPDomainNames;
		array_push( $domains, $localname );
		unset( $domains[array_search( $wgLDAPAutoAuthDomain, $domains )] );
		if (isset( $bsgLDAPShowLocal ) && $bsgLDAPShowLocal == false) {
			unset( $domains[array_search( $localname, $domains )]);
		}
		$template->set( 'domainnames', $domains );
		return true;
	}

	public static function onPersonalUrls( &$personal_urls ) {
		global $bsgLDAPAutoAuthChangeUser;
		if ( $bsgLDAPAutoAuthChangeUser === true ) {
			$personal_urls["changeuser"] = array(
				"text" => wfMessage( "bs-ldapc-changeuser-label" )->plain(),
				"title" => wfMessage( "tooltip-pt-changeuser" )->plain(),
				"href" => SpecialPage::getTitleFor( 'Userlogin' )->getLinkURL()
			);
		}
		return true;
	}

}
