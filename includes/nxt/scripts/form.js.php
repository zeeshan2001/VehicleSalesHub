<?php
	include_once(dirname(realpath(__FILE__)) . '/../../common/lib/resources/KT_Resources.php');
	$d = 'NXT';

	KT_sendExpireHeader(60 * 60 * 24);
	header("Content-Type: application/JavaScript");
?>
//Javascript UniVAL Resources
if (typeof(NXT_Messages) == 'undefined') {
	NXT_Messages = {};
}
NXT_Messages['are_you_sure_move'] = '<?php echo KT_escapeJS(KT_getResource('ARE_YOU_SURE_MOVE', $d)); ?>';
NXT_Messages['Record_FH'] = '<?php echo KT_escapeJS(KT_getResource('Record_FH', $d)); ?>';