<?php
	if(isset($_POST['booked_seat']))
	{
		$ticket_index = explode(",",$_POST['booked_seat']);
		if(count($ticket_index)==3)
		{
			for($i=0;$i<2;$i++)
			{
				$ticket_index[$i] = intval($ticket_index[$i]);
			}
			if(count($_SESSION['cart']->screenings)>$ticket_index[0]
				&&count($_SESSION['cart']->screenings[$ticket_index[0]]->tickets)>$ticket_index[1])
			{
				array_push($_SESSION['cart']->screenings[$ticket_index[0]]->tickets[$ticket_index[1]]->seats, $ticket_index[2]);
			}
		}
	}
	
	if(isset($_POST['Empty_seats']))
	{
		$ticket_index = explode(",",$_POST['Empty_seats']);
		if(count($ticket_index)==2)
		{
			for($i=0;$i<2;$i++)
			{
				$ticket_index[$i] = intval($ticket_index[$i]);
			}
			if(count($_SESSION['cart']->screenings)>$ticket_index[0]
				&&count($_SESSION['cart']->screenings[$ticket_index[0]]->tickets)>$ticket_index[1])
			{
				$_SESSION['cart']->screenings[$ticket_index[0]]->tickets[$ticket_index[1]]->seats = array();
			}
		}
	}
	
?>

<script>
window.onload = function () {
	/*var content = document.getElementsByClassName("content")[0];
	var username = '<%=session("user")%>';
	content.innerHTML+='<%=session("user")%>';*/
	
}
</script>