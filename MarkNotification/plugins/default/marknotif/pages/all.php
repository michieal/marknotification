<?php
/**
 * Open Source Social Network
 * @link      https://www.opensource-socialnetwork.org/
 * @package   MarkNotification
 * @author    Michieal O'Sullivan
 * @copyright (C) Apophis Software
 * @license   GNU General Public License https://www.gnu.org/licenses/gpl-3.0.en.html
 */

$get = new OssnNotifications;
$notifications = $get->searchNotifications(array(
	 'owner_guid' => ossn_loggedin_user()->guid,
	 'offset' => input('offset', '', 1),
	 'order_by' => 'n.guid DESC',
));
$count = $get->searchNotifications(array(
	 'owner_guid' => ossn_loggedin_user()->guid,
	 'count' => true,
));
if($notifications){
	$list = '<div class="ossn-notifications-all ossn-notification-page">';
	foreach($notifications as $item){
			$list .= $item->toTemplate();
	}
	$list .= "</div>";
}
$pagination = ossn_view_pagination($count);
echo ossn_plugin_view('widget/view', array(
	 'title' => ossn_print('notifications'),
	 'contents' => $list . $pagination,
));
