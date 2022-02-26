<?php
/**
 * Open Source Social Network
 * @link      https://www.opensource-socialnetwork.org/
 * @package   Delete Notifications
 * @author    Michieal O'Sullivan
 * @copyright (C) Apophis Software
 * @license   GNU General Public License https://www.gnu.org/licenses/gpl-3.0.en.html
 */
require_once(__MARKNOTIFICATION__ . "libraries/marknotif.php");

$guid = filter_var($_GET['guid'], FILTER_VALIDATE_INT);

$delalllikes = filter_var($_GET['dal'], FILTER_VALIDATE_INT, array('default' => 0, 'min_range' => 0, 'max_range' => 1));
if ($delalllikes == 1) {
    if (marknotif_delete_allreactions()) {
        ossn_trigger_message(ossn_print('mark:notification:delete:likes:success'), 'success');
    } else {
        ossn_trigger_message(ossn_print('mark:notification:delete:likes:error'));
    }
    redirect(REF);
    exit;
}

if (empty($guid)) {
    ossn_trigger_message(ossn_print('mark:notification:delete:error'));
    redirect(REF);
    return;
}

if (marknotif_delete($guid)) {
    ossn_trigger_message(ossn_print('mark:notification:delete:success'), 'success');
} else {
    ossn_trigger_message(ossn_print('mark:notification:delete:error'));
}
redirect(REF);

?>
