
<?php
    require_once(__MARKNOTIFICATION__ . "libraries/marknotif.php");

	 $guid = filter_var($params['guid'], FILTER_VALIDATE_INT);

	 if (empty($guid)){
		  ossn_trigger_message(ossn_print('mark:notification:read:error'));
		  redirect(REF);
		  return;
	 }

	 if (marknotif_read($guid)){
		  ossn_trigger_message(ossn_print('mark:notification:read:success'), 'success');
	 } else {
		  ossn_trigger_message(ossn_print('mark:notification:read:error'));
	 }
redirect(REF);

?>
