<?php

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
    error_log("Notification marked read.");
    $Notification->statement("UPDATE ossn_notifications SET viewed='' WHERE(owner_guid='{ossn_loggedin_user()->getGUID()}' and guid='{$guid}');");
    if($Notification->execute()) {
        return true;
    }
    error_log("Notification failed to mark read.");
    return false;

}

/**
 * Mark the singular Notification as unread.
 *
 * @param integer $guid Notification guid
 *
 * @return boolean;
 */
function marknotif_unread($guid) {
    if (empty($guid)) {
        return false;
    }
    // An explanation of the logic:
    // if the value is null, it's unread.
    // if the value is not null it's read.
    $nix = NULL;
    $Notification = new OssnNotifications;
    error_log("Notification marked unread.");
    $Notification->statement("UPDATE ossn_notifications SET viewed={$nix} WHERE(owner_guid='{ossn_loggedin_user()->getGUID()}' and guid='{$guid}');");
    if($Notification->execute()) {
        return true;
    }
    error_log("Notification failed to mark unread.");
    return false;
}

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
        ;
        $Notification->statement("DELETE FROM ossn_notifications WHERE(
				owner_guid='{ossn_loggedin_user()->getGUID()}' and guid='{$guid}');");
        if ($Notification->execute()) {
            error_log("Notification Deleted Successfully.");
            return true;
        }
    }
    error_log("Notification Deletion Failed.");
    return false;
}

