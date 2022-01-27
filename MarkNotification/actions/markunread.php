<?php
require_once(__MARKNOTIFICATION__ . "libraries/marknotif.php");

$guid = filter_var($_GET['guid'], FILTER_VALIDATE_INT);

	 if (empty($guid)){
		  ossn_trigger_message(ossn_print('mark:notification:unread:error'));
		  redirect(REF);
		  return;
	 }

	 if (marknotif_unread($guid)){
		  ossn_trigger_message(ossn_print('mark:notification:unread:success'), 'success');
	 } else {
		  ossn_trigger_message(ossn_print('mark:notification:unread:error'));
	 }
redirect(REF);
?>
