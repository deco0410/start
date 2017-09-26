<?php 
include_once("./class/StringUtils.class.php");
$StringUtils = NEW StringUtils;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>提交到富友交易系统</title>
</head>
<script type="text/javascript">
function submitForm(){
document.getElementById("form").submit();
}
</script>
<?php

try{

$mchnt_cd = $StringUtils->nvl( $_REQUEST['mchnt_cd']);
$origin_order_date = $StringUtils->nvl( $_REQUEST['origin_order_date']);
$origin_order_id = $StringUtils->nvl( $_REQUEST['origin_order_id']);
$refund_amt = $StringUtils->nvl( $_REQUEST['refund_amt']);
$refund_cur_type = $StringUtils->nvl( $_REQUEST['refund_cur_type']);
$rem = $StringUtils->nvl( $_REQUEST['rem']);
$mchnt_key = $StringUtils->nvl( $_REQUEST['mchnt_key']);

$signDataStr = $mchnt_cd . "|" . $origin_order_date . "|" . $origin_order_id . "|" . $refund_amt . "|" . $refund_cur_type . "|" . $rem . "|" . $mchnt_key;
$str_md5 = md5($signDataStr);

?>
<body onload="javascript:submitForm();">
<form name="pay" method="post" action="https://pay.fuiou.com/newSmpRefundGate.do" id = "form">
<input type="hidden" value = '<?php echo $str_md5; ?>' name="md5"/>
<input type="hidden" value = '<?php echo $mchnt_cd; ?>' name="mchnt_cd"/>
<input type="hidden" value = '<?php echo $origin_order_date; ?>' name="origin_order_date"/>
<input type="hidden" value = '<?php echo $origin_order_id; ?>' name="origin_order_id"/>
<input type="hidden" value = '<?php echo $refund_amt; ?>' name="refund_amt"/>
<input type="hidden" value = '<?php echo $rem; ?>' name="rem"/>
<input type="hidden" value = '<?php echo $refund_cur_type; ?>' name="refund_cur_type"/>
</form>
</body>
<?php
}catch(Exception $e){
	$e->getMessage();
} ?>
<body>
</body>
</html>