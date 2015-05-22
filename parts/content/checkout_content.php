
        <div class="content content_font">
<?php
$nameError = $emailError = $phoneError = "";
$name = $email = $phone = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   if (empty($_POST["name"])) {
     $nameError = "Name is required";
   } else {
     $name = user_input($_POST["name"]);
     // check if name only contains letters and white space
     if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
       $nameError = "Only letters and white space allowed"; 
     }else{
		 $_SESSION['name'] = $name;
	 }
   }
   
   if (empty($_POST["email"])) {
     $emailError = "Email is required";
   } else {
     $email = user_input($_POST["email"]);
     // check if e-mail address is well-formed
     if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
       $emailError = "Invalid email format"; 
     }else{
		 $_SESSION['email'] = $email;
	 }
   }
   
   if (empty($_POST["phone"])) {
	   $phoneError = "Phone number is required";
	} else {
	   $phone = user_input($_POST["phone"]);
	   if (!preg_match(("/^(\(04\)|04|\+614)[ ]?\d{4}[ ]?\d{4}$/"),$phone)) {
		   $phoneError = "Phone number is invalid. Please start first 2 digits with 04 or +614";
	   }else{
		 $_SESSION['phone'] = $phone;
	 }
	   
   }
   
   if ($_SESSION["name"]!=null
	   && $_SESSION["email"]!=null
	   && $_SESSION["phone"]!=null)
   {
		to_webpage('cart.php');
   }
}

function user_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
?>

<h2>Customer Detail</h2>
<p><span class="error">* required field.</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
   Name: <input type="text" name="name" value="<?php echo $name;?>">
   <span class="error">* <?php echo $nameError;?></span>
   <br><br>
   E-mail: <input type="text" name="email" value="<?php echo $email;?>">
   <span class="error">* <?php echo $emailError;?></span>
   <br><br>
   Phone Number: <input type="text" name="phone" value="<?php echo $phone;?>">
   <span class="error">* <?php echo $phoneError;?></span>
   <br><br>
   <input type="submit" name="submit" value="Submit"> 
</form>
        </div>