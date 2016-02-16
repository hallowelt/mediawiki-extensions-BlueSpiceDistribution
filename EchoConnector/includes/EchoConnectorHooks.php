<?php

class EchoConnectorHooks {
	public static function onBeforeNotificationsInit() {
		BSNotifications::registerNotificationHandler(
				'BSEchoNotificationHandler'
		);

		return true;
	}

	/**
	 * Processes "extra data":
	 * - 'affected-users': array of User objects, user ids, user names
	 * - 'affected-groups': array of strings
	 * @param EchoEvent $event
	 * @param array $users in form of [ <user_id> => <User object>, ...]
	 * @return boolean
	 */
	public static function onEchoGetDefaultNotifiedUsers( $event, &$users ) {
		$aAffectedUsers = $event->getExtra( 'affected-users' , array() );
		$aAffectedGroups = $event->getExtra( 'affected-users' , array() );

		//Step 1: resolve groups to user_ids
		$dbr = wfGetDB( DB_SLAVE );
		$res = $dbr->select( 'user_groups', 'ug_user', array( 'ug_group' => $aAffectedGroups ) );
		foreach( $res as $row ) {
			$aAffectedUsers[] = $row->ug_user; //Append id to list of users.
			//If a user is already on the list he/she will be filtered out below
		}

		//Step 2: normalize list of users
		foreach( $aAffectedUsers as $mUser ) {
			$oUser = $mUser;
			if( is_int( $mUser ) ) { //user_id
				if( isset( $users[ $mUser ] ) ) {
					continue;
				}
				$oUser = User::newFromId( $mUser );
			}

			if( is_string( $mUser ) ) { //user_name
				$oUser = User::newFromName( $mUser );
			}

			if( $oUser instanceof User && !$oUser->isAnon() ) {
				$users[ $oUser->getId() ] = $oUser;
			}
		}

		return true;
	}
}