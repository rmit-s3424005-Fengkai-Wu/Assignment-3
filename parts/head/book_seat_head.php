
<?php
	if(!isset($_POST['Book_seats']))
	{
		to_webpage('cart.php');
	}
	$ticket_index = explode(",",$_POST['Book_seats']);
	for($i=0;$i<count($ticket_index);$i++)
	{
		$ticket_index[$i] = intval($ticket_index[$i]);
	}
	
	if(count($_SESSION['cart']->screenings)<=$ticket_index[0]
	||count($_SESSION['cart']->screenings[$ticket_index[0]]->tickets)<=$ticket_index[1])
	{
		to_webpage('cart.php');
	}
	$beanbag_avilable = false;
	$first_class_seat_avilable = false;
	$normal_seat_avilable = false;
	switch($_SESSION['cart']->screenings[$ticket_index[0]]->tickets[$ticket_index[1]]->type)
	{
		case 'SA':
		case 'SP':
		case 'SC':
			$normal_seat_avilable = true;
			break;
		case 'FA':
		case 'FC':
			$first_class_seat_avilable = true;
			break;
		case 'B1':
		case 'B2':
		case 'B3':
			$beanbag_avilable = true;
			break;
	}
?>