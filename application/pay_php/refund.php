<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>XXX商城</title>
<link href="styles/style.css" rel="stylesheet" type="text/css" />
<style type="text/css">
table{ 
	margin:0 auto; 
} 
</style>
</head>
<body>
<!--top -->


<br />
<form name="pay" method="post" action="refundSend.php">
  <table width="70%" cellspacing="0" border="0" cellspacing="1" >
  <tr> 
		<td class="info_title" >模拟退款信息</td>
  </tr>
  
  <tr>
   <td width="100%"> 
		<table width="100%" border="0" cellspacing="1">
		 <tr>
		    <td width="200" class="bg_gray" align="right" >商户代码：&nbsp;&nbsp;</td>
		    <td class="bg_yellow2" align="left"> &nbsp;
           <input type="text" name="mchnt_cd"  size='30' maxlength='15' value='0001000F0040992'/>
			  </td>
		  </tr>
			<tr>
		    <td width="200" class="bg_gray" align="right" >原交易日期：&nbsp;&nbsp;</td>
		    <td class="bg_yellow2" align="left">&nbsp;&nbsp;<input type="text" name="origin_order_date" size='30' maxlength='100' value='<?php echo date('Ymd');?>'/></td>
		  </tr>	    
		   <tr>
		    <td width="200" class="bg_gray" align="right" >原订单号：&nbsp;&nbsp;</td>
		    <td class="bg_yellow2" align="left">&nbsp;&nbsp;<input type="text" name="origin_order_id" size='30' maxlength='100' value='test000002001'/></td>
		  </tr>
		  <tr>
		    <td width="200" class="bg_gray" align="right" >退款金额：&nbsp;&nbsp;</td>
		    <td class="bg_yellow2" align="left">&nbsp;&nbsp;<input type="text" name="refund_amt" size='30' value='2000'/></td>
		  </tr>
		  <tr>
		    <td width="200" class="bg_gray" align="right" >退款币种：&nbsp;&nbsp;</td>
		    <td class="bg_yellow2" align="left">&nbsp;&nbsp;<input type="text" name="refund_cur_type" size='30' value='156'/></td>
		  </tr>
		  <tr>
		    <td width="200" class="bg_gray" align="right" >备注：&nbsp;&nbsp;</td>
		    <td class="bg_yellow2" align="left">&nbsp;&nbsp;<input type="text" name="rem" size='30' maxlength='100' value='错了'/></td>
		  </tr>
		  <tr>
		    <td width="200" class="bg_gray" align="right" >mchnt_key：&nbsp;&nbsp;</td>
		    <td class="bg_yellow2" align="left">&nbsp;&nbsp;<input type="text" name="mchnt_key" size='30' maxlength='100' value='vau6p7ldawpezyaugc0kopdrrwm4gkpu'/></td>
		  </tr>
		  <tr>
		    <td height="50">&nbsp;</td>
		    <td><input type="submit" name="Submit" value="确 定" />&nbsp;&nbsp;&nbsp;&nbsp;
		      <input type="reset" name="Submit2" value="重 置" /></td>
		  </tr>
		  </table>
   </td>
  </tr>
</table>
</form>



</body>
</html>
