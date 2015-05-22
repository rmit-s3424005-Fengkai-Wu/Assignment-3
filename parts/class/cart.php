<?php
require_once 'function.php';
require_once 'parts/class/post_button.php';
class Ticket{
	public $type;
	public $quantity;
	public $price;
	public $subtotal_price;
	public $seats;
	
	public function count_subtotal_price()
	{
		$this->subtotal_price = $this->price * $this->quantity;
	}
	public function __construct($Type,$Quantity,$Price)
	{
		$this->type = $Type;
		$this->quantity = $Quantity;
		$this->price = $Price;
		$this->count_subtotal_price();
		$this->seats = array();
	}
	public function add_quantity($Quantity)
	{
		$this->quantity += $Quantity;
		$this->count_subtotal_price();
	}
	public function seats_to_string()
	{
		if(count($this->seats)==0)
		{
			return "Unselected";
		}
		
		$string = $this->seats[0];
		for($i=1;$i<count($this->seats);$i++)
		{
			$string = $string.', '.$this->seats[$i];
		}
		return $string;
	}
	
	public function create_ticket_table($Screenings_index, $Ticket_index)
	{
		echo '<tr class="ticket">';
		echo '<td>';
		echo movie_type_to_name($this->type);
		echo '<td>$';
		echo $this->price;
		echo '<td>';
		echo $this->quantity;
		echo '<td>';
		if(count($this->seats)==0)
		{
			echo 'not selected';
		}else{
			echo $this->seats_to_string();
		}
		echo '<td>';
		if(count($this->seats)>=$this->quantity)
		{
			(new Post_button("Empty_seats","Empty_seats",$Screenings_index.','.$Ticket_index))->create_button();
		}else{
			(new Post_button("Book_seats","Book_seats",$Screenings_index.','.$Ticket_index,'book_seat.php'))->create_button();
		}
		echo '<td>$';
		echo $this->subtotal_price;
	}
}//////////////////////////////////////////////////////////////////////////////////
class Screening{
	public $movie_ID;
	public $day;
	public $start_time;
	public $promotion_time;
	public $tickets;
	public $subtotal_price;
	
	public function count_subtotal_price()
	{
		$this->subtotal_price = 0;
		foreach ($this->tickets as $ticket){
			$this->subtotal_price += $ticket->subtotal_price;
		}
	}
	public function __construct($Movie_ID,$Day,$Start_time)
	{
		$this->movie_ID = $Movie_ID;
		$this->day = $Day;
		$this->start_time = $Start_time;
		$this->tickets = array();
		$this->subtotal_price = 0;
		
		if($this->day == "Monday" || $this->day == "Tuesday"
        || ($this->promotion_time == "1pm" && ($this->day == "Wednesday" || $this->day == "Thursday" || $this->day == "Friday")))
		{
			$this->promotion_time = true;
		}else{
			$this->promotion_time = false;
		}
	}
	public function add_ticket($Type,$Quantity)
	{
		foreach ($this->tickets as $ticket){
			if($ticket->type == $Type)
			{
				$ticket->add_quantity($Quantity);
				$this->count_subtotal_price();
				return;
			}
		}
		$price;
		if($this->promotion_time == true){
			switch ($Type)
			{
			case 'SA':
				$price = 12;
				break;
			case 'SP':
				$price = 10;
				break;
			case 'SC':
				$price = 8;
				break;
			default:
			case 'FA':
				$price = 25;
				break;
			case 'FC':
				$price = 20;
				break;
			case 'B1':
			case 'B2':
			case 'B3':
				$price = 20;
			}
		}else{
			switch ($Type)
			{
			case 'SA':
				$price = 18;
				break;
			case 'SP':
				$price = 15;
				break;
			case 'SC':
				$price = 12;
				break;
			default:
			case 'FA':
				$price = 30;
				break;
			case 'FC':
				$price = 25;
				break;
			case 'B1':
			case 'B2':
			case 'B3':
				$price = 30;
			}
		}
		array_push($this->tickets,new Ticket($Type,$Quantity,$price));
		$this->count_subtotal_price();
	}
	
	public function create_screening_table($Screenings_index)
	{
		echo '<tr>';
		echo '<td class="screening">';
		echo '<span class="title">';
		echo movie_ID_to_name($this->movie_ID);
		echo '</span>';
		echo "<br>";
		echo "Showing at ";
		echo $this->day;
		echo ", ";
		echo $this->start_time;
		echo "<br>";
		echo "<br>";
		
		echo '<table class="screening_table">';
		echo '<tr>';
		echo '<th>';
		echo 'Ticket Type';
		echo '<th>';
		echo 'Cost';
		echo '<th>';
		echo 'Qty';
		echo '<th>';
		echo 'Seats';
		echo '<th>';
		echo 'Operation';
		echo '<th>';
		echo 'Subtotal';
		for($i=0;$i<count($this->tickets);$i++)
		{
			$this->tickets[$i]->create_ticket_table($Screenings_index,$i);
		}
		echo '<tr>';
		echo '<td class="subtotal_price" colspan="5">Sub Total: ';
		echo '<td>$';
		echo $this->subtotal_price;
		echo '</table>';
		
		echo '<br>';
		$delete_button = new Post_button("Delete from Cart","delete",$Screenings_index);
		$delete_button->set_class_name("delete_button");
		$delete_button->create_button();
        /*echo '<form action="http://titan.csit.rmit.edu.au/~s3424005/wp/a3/cart.php" method="post" >';
		echo '	<input name = "delete" style="display:none" value="';
		echo 	$Index;
		echo '	">';
		echo '	<input class="delete_button" type="submit" value="Delete from Cart">';
        echo '</form>';/**/
	}
}///////////////////////////////////////////////////////////////////////////
class Cart{
	public $screenings;
	public $total_price;
	public $voucher;
	public $discounted_price;
	
	public function is_empty()
	{
		if($this->total_price == 0)
		{
			return true;
		}
		return false;
	}
	public function count_total_price()
	{
		$this->total_price = 0;
		foreach ($this->screenings as $screening){
			$this->total_price += $screening->subtotal_price;
		}
		if($this->voucher==null){
			$this->discounted_price = $this->total_price;
		}else{
			$this->discounted_price = 0.8 * $this->total_price;
		}
	}
	public function add_voucher($Voucher){
		$this->voucher = $Voucher;
		$this->count_total_price();
	}
	public function __construct()
	{
		$this->screenings = array();
		$this->voucher = null;
		$this->total_price = 0;
		$this->discounted_price = 0;
	}
	public function add_ticket($Movie_ID, $Day, $Start_time,    $Type, $Quantity)
	{
		if($Quantity == 0)
		{
			return;
		}		
		foreach ($this->screenings as $screening){
			if($screening->movie_ID == $Movie_ID
			&& $screening->day == $Day
			&& $screening->start_time == $Start_time)
			{
				$screening->add_ticket($Type,$Quantity);
				$this->count_total_price();
				return;
			}
		}
		$new_screening = new Screening($Movie_ID, $Day, $Start_time);
		$new_screening->add_ticket($Type,$Quantity);
		array_push($this->screenings,$new_screening);
		$this->count_total_price();
		return;
	}
	public function delete_ticket($Index)
	{
		array_splice($this->screenings,$Index,1);
		$this->count_total_price();
	}
	public function delete_all_tickets()
	{
		$this->screenings = array();
		$this->count_total_price();
	}
	public function create_cart_table()
	{
		echo '<table class="ticket_cart">';
		for($i=0;$i<count($this->screenings);$i++)
		{
			$this->screenings[$i]->create_screening_table($i);
		}
		/*foreach ($this->screenings as $screening){
			$screening->create_screening_table();
		}/**/
		echo '<tr>';
		echo '<th class="total_price"><br>';
		echo 'Total: $';
		echo $this->total_price;
		echo '<br><br>';
		echo '<span class="voucher">';
		require_once 'parts/voucher.php';
		echo '</span>';
		if($this->voucher != null)
		{
			echo '<br><br>';
			echo 'Meal and Movie Deal Voucher(';
			echo $this->voucher;
			echo '):20%';
		}
		echo '<br><br>';
		echo 'Grand Total: $';
		echo $this->discounted_price;		
		echo '<br><br>';
		(new Post_button("Empty Cart","empty_cart"))->create_button();
		echo '<br>';
		echo '<span class="cart_pravite_info">';
		echo $_SESSION['name'];
		echo '</span>';
		echo '<br>';
		echo '<span class="cart_pravite_info">';
		echo $_SESSION['email'];
		echo '</span>';
		echo '<br>';
		echo '<span class="cart_pravite_info">';
		echo $_SESSION['phone'];
		echo '</span>';
		(new Post_button("Edit pravite info","edit_pravite_info"))->create_button();
		echo '<br>';
		(new Post_button("Checkout","checkout"))->create_button();
		echo '</table>';
		//echo json_encode($_SESSION);
	}
}
?>





























