<?php
require_once 'parts/class/post_button.php';
class Book_seat_button extends Post_button{
	public $ticket_index;
	public $available;
    public function __construct($Ticket_index,$Available,$Class_name=null,$Name=null) {
		$this->ticket_index = $Ticket_index;
		$this->available = $Available;
        parent::__construct($this->available?$Name:' ','booked_seat',$this->ticket_index.','.$Name,$Available?'cart.php':'');
		parent::set_class_name($Class_name.($Available?'':'_not_available'));
    }
	public function set_text($Name)
	{
		parent::set_value($this->ticket_index.','.$Name);
		parent::set_text($this->available?$Name:' ');
	}
	public function create_button($Name=null)
	{
		if($Name!=null)
		{
			$this->set_text($Name);
		}
		parent::create_button($this->available);
	}
};/////////////////////////////////////

class Book_seat{
	
	public function create_seat_row($seat_class_name,$row,$start,$end, $Ticket_index, $avilable)
	{
		echo '<tr>';
		for($i=$end;$i>=$start;$i--)
		{
			$seat = null;
			echo '<td>';
			if($i<10)
			{
				$seat = new Book_seat_button($Ticket_index, $avilable,$seat_class_name,$row."0".$i);
			}else{
				$seat = new Book_seat_button($Ticket_index, $avilable,$seat_class_name,$row.$i);
			}
			$seat->create_button();
		}
	}
	public function create_seat_table($seat_class_name, $rows, $start_column,$end_column, $Ticket_index, $avilable)
	{		
		echo '<table class="'.$seat_class_name.'_table">';////////////////////
		
		foreach ($rows as $row){
			$this->create_seat_row($seat_class_name,$row,$start_column,$end_column, $Ticket_index, $avilable);
		}
		
		echo '</table>';/**//**//**//**//**/
	}
	public function create_table($Ticket_index, $normal_seat_avilable, $first_class_seat_avilable, $beanbag_avilable)
	{
		echo '<table class="book_seat_table">';
		echo '<tr>';
		echo '<th colspan="3">';
		echo 'Screen';
		echo '<tr>';
		echo '<td colspan="3">';
		echo 'Front Row. Closest to screen.';
		
		echo '<tr>';
		echo '<td colspan="3">';
		echo '<table class="beanbag_table">';/////////////
		$beanbag = new Book_seat_button($Ticket_index,$beanbag_avilable,"beanbag");
		echo '<tr>';////
		echo '<td>';
		echo '<td>';
		echo '<td>';
		$beanbag->create_button("A02");
		echo '<td>';
		$beanbag->create_button("A01");
		echo '<td>';
		echo '<td>';
		echo '<tr>';////
		echo '<td colspan="2">';
		$beanbag->create_button("B03");
		echo '<td colspan="2">';
		$beanbag->create_button("B02");
		echo '<td colspan="2">';
		$beanbag->create_button("B01");
		echo '<tr>';////
		echo '<td>';
		$beanbag->create_button("C04");
		echo '<td>';
		$beanbag->create_button("C03");
		echo '<td>';
		echo '<td>';
		echo '<td>';
		$beanbag->create_button("C02");
		echo '<td>';
		$beanbag->create_button("C01");
		echo '<tr>';////
		echo '<td colspan="2">';
		$beanbag->create_button("D04");
		echo '<td colspan="2">';
		echo '<td colspan="2">';
		$beanbag->create_button("D01");
		echo '<tr>';////
		echo '<td>';
		echo '<td>';
		echo '<td>';
		$beanbag->create_button("D03");
		echo '<td>';
		$beanbag->create_button("D02");
		echo '<td>';
		echo '<td>';/**/
		echo '</table>';/**//**//**//**/
		
		echo '<tr>';
		echo '<td>';		
		$this->create_seat_table('left_normal_seat',array('E','F','G','H'),10,14, $Ticket_index, $normal_seat_avilable);		
		echo '<td>';
		$this->create_seat_table('first_class_seat',array('E','F','G'),6,9, $Ticket_index, $first_class_seat_avilable);	
		echo '<td>';		
		$this->create_seat_table('right_normal_seat',array('E','F','G','H'),1,5, $Ticket_index, $normal_seat_avilable);	
		
		echo '<tr>';
		echo '<td colspan="3">';
		echo 'Back Row. Furthest to screen.';
		echo '</table>';
	}

}
?>