/**
 * Apophis Software Component for OSSN v. 6.1.
 *
 * @package   Apophis Software MarkNotification
 * @author    Apophis Software
 * @copyright (C) Apophis Software
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.apophissoftware.com/
 */
// <script>
Ossn.register_callback('ossn', 'init', 'MarkNotification_js_init');
function MarkNotification_js_init(){

    $(document).ready(function(){
        $('body').delegate('.apop-notif-read', 'click', function(){
            var $guid = $(this).attr('data-guid');
        });
        $('body').delegate('.apop-notif-delete', 'click', function(){
            var $guid = $(this).attr('data-guid');
        });
    });
}

function mnInstant(type, guid) {
    let xhr = new XMLHttpRequest();

    if (type == 1) {
        let url = Ossn.site_url + "action/mark/delete?guid=" + guid.toString();
        url = Ossn.AddTokenToUrl(url);

        xhr.open('PUT', url, true);
        xhr.setRequestHeader("Content-Type", "application/json")
        xhr.send(null);

        Ossn.trigger_message('Notification has been deleted. You may have to refresh to see it removed.','success' );
        Ossn.NotificationsCheck();
    }

    if (type == 2) {
        let url = Ossn.site_url + "action/mark/read?guid=" + guid.toString();
        url = Ossn.AddTokenToUrl(url);

        xhr.open('PUT', url, true);
        xhr.setRequestHeader("Content-Type", "application/json")
        xhr.send(null);

        Ossn.trigger_message('Notification has been Marked Read. You may have to refresh to see it changed.','success' );
        Ossn.NotificationsCheck();
    }
}