<?php 

try{

$mchnt_cd = nvl($_REQUEST['mchnt_cd']);
$order_id = nvl($_REQUEST['order_id']);
$order_amt = nvl($_REQUEST['order_amt']);
$order_date = nvl($_REQUEST['order_date']);
$order_st = nvl($_REQUEST['order_st']);
$order_pay_code = nvl($_REQUEST['order_pay_code']);
$order_pay_error = nvl($_REQUEST['order_pay_error']);
$fy_ssn = nvl($_REQUEST['fy_ssn']);
$resv1 = nvl($_REQUEST['resv1']);
$md5 = nvl($_REQUEST['md5']);
$mchnt_key = "vau6p7ldawpezyaugc0kopdrrwm4gkpu";  //32位的商户密钥

$signDataStr = $mchnt_cd . "|" . $order_id . "|" . $order_date . "|" . $order_amt. "|" .$order_st. "|" .$order_pay_code. "|" . $order_pay_error. "|" . $resv1. "|" .  $fy_ssn. "|" . $mchnt_key;
$md52 = md5($signDataStr);

if(strtolower($md52) !== strtolower($md5))
   throw new Exception("返回数据非法");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>XXX商城</title>
<link href="styles/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<br/>
<br/>
<table width="70%" border="0" cellspacing="1" cellpadding="0">
  <tr>
    <td width="30%" height="35" align="right"  class="bg_gray">商户代码：&nbsp;&nbsp;</td>
    <td width="70%" class="bg_yellow2" align="left">&nbsp;&nbsp;<?php echo $mchnt_cd; ?></td>
  </tr>
  <tr>
    <td width="30%" height="35" align="right"  class="bg_gray">商户订单号：&nbsp;&nbsp;</td>
    <td width="70%" class="bg_yellow2" align="left">&nbsp;&nbsp;<?php echo $order_id; ?></td>
  </tr>
  <tr>
    <td width="30%" height="35" align="right"  class="bg_gray">交易金额：&nbsp;&nbsp;</td>
    <td width="70%" class="bg_yellow2" align="left">&nbsp;&nbsp;<?php echo $order_amt; ?></td>
  </tr>
  <tr>
    <td width="30%" height="35" align="right"  class="bg_gray">日期：&nbsp;&nbsp;</td>
    <td width="70%" class="bg_yellow2" align="left">&nbsp;&nbsp;<?php echo $order_date; ?></td>
  </tr>
  <tr>
    <td width="30%" height="35" align="right"  class="bg_gray">订单状态：&nbsp;&nbsp;</td>
    <td width="70%" class="bg_yellow2" align="left">&nbsp;&nbsp;<?php echo $order_st; ?></td>
  </tr>
  <tr>
    <td width="30%" height="35" align="right"  class="bg_gray">错误代码：&nbsp;&nbsp;</td>
    <td width="70%" class="bg_yellow2" align="left">&nbsp;&nbsp;<?php echo $order_pay_code; ?></td>
  </tr>
  <tr>
    <td width="30%" height="35" align="right"  class="bg_gray">错误中文描述：&nbsp;&nbsp;</td>
    <td width="70%" class="bg_yellow2" align="left">&nbsp;&nbsp;<?php echo $order_pay_error; ?></td>
  </tr>
  <tr>
    <td width="30%" height="35" align="right"  class="bg_gray">富友流水号：&nbsp;&nbsp;</td>
    <td width="70%" class="bg_yellow2" align="left">&nbsp;&nbsp;<?php echo $fy_ssn; ?></td>
  </tr>
 <tr>
    <td width="30%" height="35" align="right"  class="bg_gray">&nbsp;&nbsp;</td>
    <td width="70%" class="bg_yellow2" align="left">&nbsp;&nbsp;</td>
  </tr>
 <tr>
    <td width="30%" height="35" align="right"  class="bg_gray">&nbsp;&nbsp;</td>
    <td width="70%" class="bg_yellow2" align="left">
    	&nbsp;&nbsp;<a href="./order.php"><font color="red">返回重新测试支付</font></a>
    </td>
  </tr>
</table>
</body>
</html>
<?php
}catch(Exception $e){
	$e->getMessage();
} ?>
<body>
</body>
</html>