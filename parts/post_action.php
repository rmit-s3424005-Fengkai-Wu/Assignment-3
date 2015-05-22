<?php
		require_once 'parts/class/cart.php';
		session_start();
		/*$keep_time = 3600*1;
		setcookie(session_name(),session_id(), time()+$keep_time);
		ini_set('session.gc_maxlifetime',$keep_time);/**/
		if (!isset($_SESSION['cart'])){
			$_SESSION['cart'] = new Cart();
		}
		if(isset($_POST['film'])
			&& isset($_POST['day'])
			&& isset($_POST['time'])
			&& isset($_POST['SA'])
			&& isset($_POST['SP'])
			&& isset($_POST['SC'])
			&& isset($_POST['FA'])
			&& isset($_POST['FC'])
			&& isset($_POST['B1'])
			&& isset($_POST['B2'])
			&& isset($_POST['B3'])
			&& ($_POST['film'] == 'AF'||$_POST['film'] == 'CH'||$_POST['film'] == 'RC'||$_POST['film'] == 'AC')
			&& ($_POST['day'] == 'Monday'||$_POST['day'] == 'Tuesday'||$_POST['day'] == 'Wednesday'||$_POST['day'] == 'Thursday'||$_POST['day'] == 'Friday'||$_POST['day'] == 'Saturday'||$_POST['day'] == 'Sunday'))
		{
			$_SESSION['cart']->add_ticket($_POST['film'],$_POST['day'],$_POST['time'],'SA',$_POST['SA']);
			$_SESSION['cart']->add_ticket($_POST['film'],$_POST['day'],$_POST['time'],'SP',$_POST['SP']);
			$_SESSION['cart']->add_ticket($_POST['film'],$_POST['day'],$_POST['time'],'SC',$_POST['SC']);
			$_SESSION['cart']->add_ticket($_POST['film'],$_POST['day'],$_POST['time'],'FA',$_POST['FA']);
			$_SESSION['cart']->add_ticket($_POST['film'],$_POST['day'],$_POST['time'],'FC',$_POST['FC']);
			$_SESSION['cart']->add_ticket($_POST['film'],$_POST['day'],$_POST['time'],'B1',$_POST['B1']);
			$_SESSION['cart']->add_ticket($_POST['film'],$_POST['day'],$_POST['time'],'B2',$_POST['B2']);
			$_SESSION['cart']->add_ticket($_POST['film'],$_POST['day'],$_POST['time'],'B3',$_POST['B3']);
		}
		if(isset($_POST['delete']))
		{
			$_SESSION['cart']->delete_ticket(intval($_POST['delete']));
		}
		if(isset($_POST['empty_cart']))
		{
			$_SESSION['cart']->delete_all_tickets();
		}
		if(isset($_POST['checkout'])
			&& !$_SESSION['cart']->is_empty())
		{
			if ($_SESSION["name"]!=null
				&& $_SESSION["email"]!=null
				&& $_SESSION["phone"]!=null)
			{
				to_webpage('print_ticket.php');
			}else{
				to_webpage('checkout.php');
			}
		}
		if(isset($_POST['edit_pravite_info'])
			&& !$_SESSION['cart']->is_empty())
		{
			to_webpage('checkout.php');
		}
		
?>