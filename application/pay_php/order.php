<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="styles/style.css" rel="stylesheet" type="text/css" />
<title>XXX商城</title>
<style type="text/css">
table{ 
	margin:0 auto; 
} 
</style>
</head>

<body>
<!--top -->

<br />
<form name="pay" method="post" action="orderSend.php">
<input type="hidden" name="order_id" value="test000002001"/>
<input type="hidden" name="order_valid_time" value="10m"/>
<input type="hidden" name="page_notify_url" value="<?php echo 'http://'.$_SERVER['HTTP_HOST']; ?>/orderResult.php"/>
<input type="hidden" name="back_notify_url" value="<?php echo 'http://'.$_SERVER['HTTP_HOST']; ?>/orderResult.php"/>
  <table width="70%" cellspacing="0" border="0" cellspacing="1" >
  <tr> 
		<td class="info_title" >模拟订单信息</td>
  </tr>
  
  <tr>
   <td width="100%"> 
		<table width="100%" border="0" cellspacing="1">
			
		 <tr>
		    <td width="200" class="bg_gray" align="right" >商户代码：&nbsp;&nbsp;</td>
		    <td class="bg_yellow2" align="left"> &nbsp;
			    <input type="text" name="mchnt_cd" size='30' maxlength='15' value="0001000F0040992"/>
		  </tr>
		  <!--<tr>
		    <td width="200" class="bg_gray" align="right" >商户订单号：&nbsp;&nbsp;</td>
		    <td class="bg_yellow2" align="left"> &nbsp;
			    <input type="text" name="order_id" size='30' maxlength='15' value=''/>
		  </tr>
		  <tr>
		    <td width="200" class="bg_gray" align="right" >商户流水号：&nbsp;&nbsp;</td>
		    <td class="bg_yellow2" align="left"> &nbsp;
			    <input type="text" name="mchnt_ssn" size='30' maxlength='15' value=''/>
		  </tr>
		  -->
		  <tr>
		    <td width="200" class="bg_gray" align="right" >交易金额：&nbsp;&nbsp;</td>
		    <td class="bg_yellow2" 	align="left">&nbsp;&nbsp;<input type="text" name="order_amt"  size='30' value='2000'/></td>
		  </tr>
		  <tr>
		    <td width="200" class="bg_gray" align="right" >支付币种：&nbsp;&nbsp;</td>
		    <td class="bg_yellow2" 	align="left">&nbsp;&nbsp;<input type="text" name="cur_type"  size='30' value='CNY'/></td>
		  </tr>
		  <tr>
		    <td width="200" class="bg_gray" align="right" >支付类型：&nbsp;&nbsp;</td>
		    <td class="bg_yellow2" 	align="left">&nbsp;&nbsp;
		     <select name="order_pay_type">
		     	  <option value="B2C" >B2C</option>  
						<option value="B2B" >B2B</option>
					</select>
				</td>
			</tr>	
		  <tr>
		    <td width="200" class="bg_gray" align="right" >银行代码：&nbsp;&nbsp;</td>
		    <td class="bg_yellow2" 	align="left">&nbsp;&nbsp;
		     <select name="iss_ins_cd">
		     	  <option value="0803080000" >招商银行</option>  
						<option value="0803010000" >交通银行	</option>
						<option value="0803100000" >上海浦东发展银行</option>
						<option value="0803090000" >兴业银行</option>
						<option value="0803160000" >浙商银行</option>  
						<option value="0801020000" >中国工商银行</option>  
						<option value="0803030000" >中国光大银行</option>  
						<option value="0801050000" >中国建设银行</option>  
						<option value="0803050000" >中国民生银行</option>  
						<option value="0801030000" >中国农业银行</option>  
						<option value="0801040000" >中国银行</option>  
						<option value="0803020000" >中信银行</option>  
						<option value="0803030000" >光大银行</option>
						<option value="08G0000001" >CFCA</option>  
						<option value="0000000000" selected="selected">其他银行</option>
					</select>
				</td>
			</tr>		

		  <tr>
		    <td width="200" class="bg_gray" align="right" >商品名称：&nbsp;&nbsp;</td>
		    <td class="bg_yellow2" 	align="left">&nbsp;&nbsp;<input type="text" name="goods_name"  size='60' maxlength='100' value='NIKE'/></td>
		  </tr>
		  <tr>
		    <td width="200" class="bg_gray" align="right" >商品展示网址：&nbsp;&nbsp;</td>
		    <td class="bg_yellow2" 	align="left">&nbsp;&nbsp;<input type="text" name="goods_display_url"  size='30' maxlength='100' value='<?php echo 'http://'.$_SERVER['HTTP_HOST']; ?>/index.php'/></td>
		  </tr>
		  <tr>
		    <td width="200" class="bg_gray" align="right" >备注：&nbsp;&nbsp;</td>
		    <td class="bg_yellow2" 	align="left">&nbsp;&nbsp;<input type="text" name="rem"  size='30' maxlength='100' value='备注'/></td>
		  </tr>
		  <tr>
		    <td width="200" class="bg_gray" align="right" >保留字段：&nbsp;&nbsp;</td>
		    <td class="bg_yellow2" 	align="left">&nbsp;&nbsp;<input type="text" name="rcvr"  size='100' maxlength='100' value='保留字段'/></td>
		  </tr>
		  <tr>
		    <td width="200" class="bg_gray" align="right" >版本号：&nbsp;&nbsp;</td>
		    <td class="bg_yellow2" 	align="left">&nbsp;&nbsp;<input type="text" name="ver"  size='30' maxlength='100' value='1.1'/></td>
		  </tr>
		  <tr>
		    <td width="200" class="bg_gray" align="right" >mchnt_key：&nbsp;&nbsp;</td>
		    <td class="bg_yellow2" 	align="left">&nbsp;&nbsp;<input type="text" name="mchnt_key"  size='30' maxlength='100' value="vau6p7ldawpezyaugc0kopdrrwm4gkpu"/></td>
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