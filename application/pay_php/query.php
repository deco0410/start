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
<form name="pay" method="post" action="querySend.php">

<input type="hidden" name="txn_dir" value="MF"/>
<!-- <input type="hidden" name="page_notify_url" value="<?php echo 'http://'.$_SERVER['HTTP_HOST']; ?>/infoResult.php"/> -->
<!-- <input type="hidden" name="back_notify_url" value="<?php echo 'http://'.$_SERVER['HTTP_HOST']; ?>/infoResult.php"/> -->


 <table width="70%" cellspacing="0" border="0" cellspacing="1" >
 <tr> 
		<td class="info_title" >模拟查询信息</td>
 </tr>
 
 <tr>
  <td width="100%"> 
		<table width="100%" border="0" cellspacing="1">
			
		 <tr>
		  <td width="200" class="bg_gray" align="right" >商户代码：&nbsp;&nbsp;</td>
		  <td class="bg_yellow2" align="left"> &nbsp;
			  <input type="text" name="mchnt_cd" size='30' maxlength='15' value='0001000F0040992'/>
		 </tr>
		  
		  <tr>
		  <td width="200" class="bg_gray" align="right" >订单号：&nbsp;&nbsp;</td>
		  <td class="bg_yellow2" align="left">&nbsp;&nbsp;<input type="text" name="order_id" size='30' maxlength='100' value='tttttttttttttt01'/></td>
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
