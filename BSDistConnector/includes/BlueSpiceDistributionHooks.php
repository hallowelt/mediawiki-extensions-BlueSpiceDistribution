<?php

class BlueSpiceDistributionHooks {

	public static function onBeforePageDisplay( $out, $skin ) {
		global $wgScriptPath;
		if ( class_exists( "MobileContext" ) && MobileContext::singleton()->isMobileDevice() ) {
			$out->addHeadItem( 'bluespice.mobile', "<link rel='stylesheet' href='" . $wgScriptPath . "/extensions/BlueSpiceDistribution/BSDistConnector/resources/bluespice.mobile.css'>" );
		}
		$out->addModules( 'ext.bluespice.distribution' );
		$out->addModuleStyles( 'ext.bluespice.wikicategorytagcloud' );
		return true;
	}

	public static function onMinervaPreRender( MinervaTemplate $template ) {
		foreach ( $template->data['sidebar'] as $key => $val ) {
			if ( !is_array( $val ) ) {
				continue;
			}
			foreach ( $val as $key2 => $val2 ) {
				if ( strpos( $val2['text'], "|" ) ) {
					$aVal2 = explode( "|", $val2['text'] );
					$val2['text'] = $aVal2[0];
				}
				$template->data['discovery_urls'][$val2['id']] = $val2;
			}
		}
		$template->data['discovery_urls']['n-specialpages'] = array(
			'text' => wfMessage( "specialpages" )->plain(),
			'href' => SpecialPage::getSafeTitleFor( "Specialpages" )->getFullURL(),
			'id' => 'n-specialpages',
			'active' => false
		);
		return true;
	}

	public static function onResourceLoaderRegisterModules( ResourceLoader &$resourceLoader ) {
		global $wgResourceModules, $IP, $wgMFResourceBoilerplate;
		//MobileFrontend.php ln 189 sets it's ResourceLoader Paths without the possibility to overwrite
		//we don't want to hack our distribution extensions, so we're doing a modification here after it's been set
		foreach ( $wgResourceModules as $key => $val ) {
			$aKey = explode( ".", $key );
			if ( !isset( $aKey[1] ) ) continue;
			if ( $aKey[0] . "." . $aKey[1] != "skins.minerva" && $aKey[0] != "mobile" && $aKey[0] != "tablet" )
				continue;
			$wgResourceModules[$key]['localBasePath'] = $IP . "/extensions/BlueSpiceDistribution/MobileFrontend";
			$wgResourceModules[$key]['remoteExtPath'] = "BlueSpiceDistribution/MobileFrontend";
			$wgResourceModules[$key]['localTemplateBasePath'] = $IP . "/extensions/BlueSpiceDistribution/MobileFrontend/templates";
		}
		return true;
	}

	public static function onUserLoginForm( &$template ) {
		wfProfileIn( __METHOD__ );
		if ( $template instanceof UserLoginMobileTemplate ) {
			$template = new BSUserLoginMobileTemplate( $template );
		}
		wfProfileOut( __METHOD__ );
		return true;
	}

	/**
	 * This is an optional hook handler that needs to be enabled within BlueSpiceDistribution.php
	 * See https://www.mediawiki.org/wiki/Extension:LDAP_Authentication/Configuration_Options#Auto_authentication_options
	 * @param string $LDAPUsername
	 * @param array $info
	 * @return boolean
	 */
	public static function onSetUsernameAttribute( &$LDAPUsername, $info ) {
		$LDAPUsername = str_replace( '_', ' ', $info[0]['samaccountname'][0] );
		return true;
	}

	/**
	 * Inject tags into InsertMagic
	 * @param Object $oResponse reference
	 * $param String $type
	 * @return always true to keep hook running
	 */
	public function onBSInsertMagicAjaxGetDataCategoryTree( &$oResponse, $type ) {
		if ( $type != 'tags' ) return true;

		$oResponse->result[] = array(
			'id' => 'categorytree',
			'type' => 'tag',
			'name' => 'categorytree',
			'desc' => wfMessage( 'bs-distribution-tag-categorytree-desc' )->plain(),
			'code' => '<categorytree></categorytree>',
		);

		return true;
	}
}
