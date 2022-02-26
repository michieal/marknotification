<?php
/**
 * Open Source Social Network
 * @link      https://www.opensource-socialnetwork.org/
 * @package   MarkNotification
 * @author    Michieal O'Sullivan
 * @copyright (C) Apophis Software
 * @license   GNU General Public License https://www.gnu.org/licenses/gpl-3.0.en.html
 */

/**
 * Mark the singular Notification as read.
 *
 * @param integer $guid Notification guid
 *
 * @return boolean;
 */
function marknotif_read($guid) {
    if (empty($guid)) {
        return false;
    }
    $Notification = new OssnNotifications;
    $ownerGuid = ossn_loggedin_user()->getGUID();
    $Notification->statement("UPDATE ossn_notifications SET viewed='' WHERE(owner_guid='{$ownerGuid}' and guid='{$guid}');");
    if ($Notification->execute()) {
        return true;
    }
    //error_log("Notification failed to mark read.",0);
    return false;

}

/*
/**
 * Mark the singular Notification as unread.
 * [DO NOT USE] Included here because I wanted to make it, but it fails. If anyone gets it working, please let me know.
 * @param integer $guid Notification guid
 *
 * @return boolean;
 *//*
function marknotif_unread($guid) {
    if (empty($guid)) {
        return false;
    }
    // An explanation of the logic:
    // if the value is null, it's unread.
    // if the value is not null it's read.
    $nix = NULL;
    $Notification = new OssnNotifications;
    $ownerGuid = ossn_loggedin_user()->getGUID();
    $Notification->statement("UPDATE ossn_notifications SET viewed={$nix} WHERE(owner_guid='{$ownerGuid}' and guid='{$guid}');");
    if($Notification->execute()) {
        return true;
    }
    error_log("Notification failed to mark unread.",0);
    return false;
}
*/
/**
 * Delete the singular Notification.
 *
 * @param integer $guid Notification guid
 *
 * @return boolean;
 */
function marknotif_delete($guid) {
    $Notification = new OssnNotifications;
    if (empty($guid)) {
        return false;
    } else {
        $ownerGuid = ossn_loggedin_user()->getGUID();
        $Notification->statement("DELETE FROM ossn_notifications WHERE(
				owner_guid='{$ownerGuid}' and guid='{$guid}');");
        if ($Notification->execute()) {
            return true;
        }
    }
    //error_log("Notification Deletion Failed.",0);
    return false;
}

/**
 * Delete all reaction Notifications.
 *
 * @return boolean;
 */
function marknotif_delete_allreactions(): bool {
    $Notification = new OssnDatabase();
    $ownerGuid = ossn_loggedin_user()->getGUID();
    $check = false;
    $checknext = false;
    $Notification->statement("DELETE FROM ossn_notifications WHERE(
				owner_guid='{$ownerGuid}' and type = 'like:post:group:wall');
				");
    $check = $Notification->execute();

    $Notification->statement("DELETE FROM ossn_notifications WHERE(
				owner_guid='{$ownerGuid}' and type = 'like:entity:file:ossn:aphoto');
				");
    $checknext = $Notification->execute();
    if ($check == false) {
        $check = $checknext;
    }

    $Notification->statement("DELETE FROM ossn_notifications WHERE(
				owner_guid='{$ownerGuid}' and type = 'like:annotation');
				");
    $checknext = $Notification->execute();
    if ($check == false) {
        $check = $checknext;
    }

    $Notification->statement("DELETE FROM ossn_notifications WHERE(
				owner_guid='{$ownerGuid}' and type = 'like:entity:blog');
				");
    $checknext = $Notification->execute();
    if ($check == false) {
        $check = $checknext;
    }

    $Notification->statement("DELETE FROM ossn_notifications WHERE(
				owner_guid='{$ownerGuid}' and type = 'like:entity:file:profile:cover');
				");
    $checknext = $Notification->execute();
    if ($check == false) {
        $check = $checknext;
    }

    $Notification->statement("DELETE FROM ossn_notifications WHERE(
				owner_guid='{$ownerGuid}' and type = 'like:entity:file:profile:photo');");
    $checknext = $Notification->execute();
    if ($check == false) {
        $check = $checknext;
    }

    $Notification->statement("DELETE FROM ossn_notifications WHERE(
				owner_guid='{$ownerGuid}' and type = 'like:post');
				");
    $checknext = $Notification->execute();
    if ($check == false) {
        $check = $checknext;
    }

    $Notification->statement("DELETE FROM ossn_notifications WHERE(
				owner_guid='{$ownerGuid}' and type = 'like:entity');
				");
    $checknext = $Notification->execute();
    if ($check == false) {
        $check = $checknext;
    }

    $Notification->statement("DELETE FROM ossn_notifications WHERE(
				owner_guid='{$ownerGuid}' and type = 'like:entity:event:wall');
				");
    $checknext = $Notification->execute();
    if ($check == false) {
        $check = $checknext;
    }

    $Notification->statement("DELETE FROM ossn_notifications WHERE(
				owner_guid='{$ownerGuid}' and type = 'like:entity:poll_entity');
				");
    $checknext = $Notification->execute();
    if ($check == false) {
        $check = $checknext;
    }

    $Notification->statement("DELETE FROM ossn_notifications WHERE(
				owner_guid='{$ownerGuid}' and type = 'like:post:businesspage:wall');
				");
    $checknext = $Notification->execute();
    if ($check == false) {
        $check = $checknext;
    }

    $Notification->statement("DELETE FROM ossn_notifications WHERE(
				owner_guid='{$ownerGuid}' and type = 'like:annotation:comments:post');
				");
    $checknext = $Notification->execute();
    if ($check == false) {
        $check = $checknext;
    }

    //error_log("Notification Deletion Failed.",0);
    return $check;
}

