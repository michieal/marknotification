<?php
/**
 * Open Source Social Network
 * @link      https://www.opensource-socialnetwork.org/
 * @package   MarkNotification
 * @author    Michieal O'Sullivan
 * @copyright (C) Apophis Software. (C) OpenTeknik LLC, for base code.
 * @license   GNU General Public License https://www.gnu.org/licenses/gpl-3.0.en.html; Base code: (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 */
?>
<div class="messages-inner">
    <?php
    echo '<div class="ossn-notifications-all">';
    if (!empty($params['notifications'])) {
        foreach ($params['notifications'] as $not) {
            echo $not;
        }
    }
    echo '</div>';
    ?>
</div>
<div class="bottom-all">
    <?php
    $notif_text = ossn_print('mark:notification:delete:likes');
    $notif_title = ossn_print('mark:notification:delete:likes:title');
    $link = htmlspecialchars(ossn_site_url("action/mark/delete?dal=1", true));
    $bottomlink = "<a href='" . $link . "' class='apop-bottom-link' title='" . $notif_title . "' >" . $notif_text . "</a>";

    if (isset($params['seeall'])) {
        ?>
        <a href="<?php echo $params['seeall']; ?>"><?php echo ossn_print('see:all'); ?></a> <?php echo $bottomlink;?>
    <?php } ?>
</div>