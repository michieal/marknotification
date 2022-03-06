<?php
/**
 * Open Source Social Network
 * @link      https://www.opensource-socialnetwork.org/
 * @package   MarkNotification
 * @author    Michieal O'Sullivan
 * @copyright (C) Apophis Software. (C) OpenTeknik LLC, for base code.
 * @license   GNU General Public License https://www.gnu.org/licenses/gpl-3.0.en.html; Base code: (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 */

$get = new  OssnNotifications;
$notifications = $get->searchNotifications(array(
    'owner_guid' => ossn_loggedin_user()->guid,
    'offset' => input('offset', '', 1),
    'order_by' => 'n.guid DESC',
));
$count = $get->searchNotifications(array(
    'owner_guid' => ossn_loggedin_user()->guid,
    'count' => true,
));
$list = '<div class="ossn-notifications-all ossn-notification-page">';
$notif_text = ossn_print('mark:notification:delete:likes');
$notif_title = ossn_print('mark:notification:delete:likes:title');
$link = htmlspecialchars(ossn_site_url("action/mark/delete?dal=1", true));
$data = "<a href='" . $link . "' class='apop-notif-delete-button' title='" . $notif_title . "' >" . $notif_text . "</a>";
$list .= '<div>' . $data . '<br/><br/></div>';

if ($notifications) {
    foreach ($notifications as $item) {
        $list .= $item->toTemplate();
    }
}
$list .= "</div>";
$pagination = ossn_view_pagination($count);
echo ossn_plugin_view('widget/view', array(
    'title' => ossn_print('notifications'),
    'contents' => $list . $pagination,
));
