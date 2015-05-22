<?php
	$voucher = "";
	$voucherError = "";
	if ($_SERVER["REQUEST_METHOD"] == "POST"
	&& isset($_POST['voucher'])) 
	{
		$voucher = $_POST["voucher"];
		$voucher = trim($voucher);
		if(!preg_match("/(\d{5})-(\d{5})-([a-zA-z]{2})/",$voucher))
		{
			$voucherError =  "*your voucher is invalid";
		}
		else
		{
			$chk1 = ((($voucher[0]*$voucher[1]+$voucher[2])*$voucher[3]+$voucher[4])%26);
			$chk2 = ((($voucher[6]*$voucher[7]+$voucher[8])*$voucher[9]+$voucher[10])%26);
			$voucher1 = $voucher[12];
			$voucher2 = $voucher[13];
			$letter = range("A","Z");
			$letter1 = $letter[$chk1];
			$letter2 = $letter[$chk2];
			if (($voucher1 == $letter1) && ($voucher2 == $letter2))
			{
				$voucherError = "valid";
				$_SESSION['cart']->add_voucher($_POST["voucher"]);
			}
			else
			{
				$voucherError = "*Your voucher is not matched";
			}
		}
	
	}
	
?>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
   Voucher: <input type="text" name="voucher" value="">
   <span class="error"><?php echo $voucherError;?></span>
  
   <input type="submit" value="Submit">
</form>