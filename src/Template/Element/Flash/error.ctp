<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<script type="text/javascript">	
$.growl({
	message:"<?= h($message) ?>"
},{
	type:'danger',
	allow_dismiss: true,
	'placement':{
		from:'bottom',
		align:'left'
	}
})	
</script>