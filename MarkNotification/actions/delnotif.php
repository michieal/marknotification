<?php
require_once(__MARKNOTIFICATION__ . "libraries/marknotif.php");

	 $guid = filter_var($_GET['guid'], FILTER_VALIDATE_INT);

	 if (empty($guid)){
		  ossn_trigger_message(ossn_print('mark:notification:delete:error'));
		  redirect(REF);
		  return;
	 }

	 if (marknotif_delete($guid)){
		  ossn_trigger_message(ossn_print('mark:notification:delete:success'), 'success');
	 } else {
		  ossn_trigger_message(ossn_print('mark:notification:delete:error'));
	 }
redirect(REF);

?>
