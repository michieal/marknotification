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
    marknotif_LogData("Notification marked read.");
    $Notification->statement("UPDATE ossn_notifications SET viewed='' WHERE(guid='{$guid}');");
    if($Notification->execute()) {
        return true;
    }
    marknotif_LogData("Notification failed to mark read.");
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
    marknotif_LogData("Notification marked unread.");
    $Notification->statement("UPDATE ossn_notifications SET viewed={$nix} WHERE(guid='{$guid}');");
    if($Notification->execute()) {
        return true;
    }
    marknotif_LogData("Notification failed to mark unread.");
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
        $Notification->statement("DELETE FROM ossn_notifications WHERE(
				guid='{$guid}');");
        if ($Notification->execute()) {
            marknotif_LogData("Notification Deleted Successfully.");
            return true;
        }
    }
    marknotif_LogData("Notification Deletion Failed.");
    return false;
}

function marknotif_LogError(Exception $e) {
    // Log an error.
    $handle = fopen('errlog.Log', "a");
    if ($handle != 'FALSE') {
        // write the data
        $date = new DateTime("now");
        $LogTime = $date->format('m-d-Y H:i:s') . ' GMT';
        fwrite($handle, "Timestamp: $LogTime\r\n");
        fwrite($handle, "Exception Message: {$e->getMessage()} \r\n");
        fwrite($handle, "Exception File: {$e->getFile()} \r\n");
        fwrite($handle, "Exception Line: {$e->getLine()} \r\n");
        fwrite($handle, "Exception Code: {$e->getCode()} \r\n");
        fwrite($handle, "Exception Trace: {$e->getTraceAsString()} \r\n------------------------------------\r\n");
        fflush($handle);
        fclose($handle);
    }
}

function marknotif_LogData($message) {
    // Log an error.
    $handle = fopen('errlog.Log', "a");
    if ($handle != 'FALSE') {
        // write the data
        $date = new DateTime("now");
        $LogTime = $date->format('m-d-Y H:i:s') . ' GMT';
        fwrite($handle, "Timestamp: $LogTime\r\n");
        fwrite($handle, "Message: {$message} \r\n");
        fwrite($handle, "------------------------------------\r\n");
        fflush($handle);
        fclose($handle);
    }
}
