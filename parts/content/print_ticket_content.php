
        <div class="content content_font" style="background-image:none;background-color:#BBBBBB">

<?php
			
		echo '<div class="ticket">';
		
		echo '<div class="left">';
		echo '<img class="logo film_info" src="img/logo.gif"  alt="Silverado\'s logo" />';
		echo '</div>';
		
		echo '<div class="right">';
		echo '<br>';
		echo '<br>';
		echo '<br>';
		echo '<span class="pravite_info">';
		echo $_SESSION['name'];
		echo '</span>';
		echo '<br>';
		echo '<span class="pravite_info">';
		echo $_SESSION['email'];
		echo '</span>';
		echo '<br>';
		echo '<span class="pravite_info">';
		echo $_SESSION['phone'];
		echo '</span>';
		echo '<br>';
		echo '<br>';
		echo '</div>';
		for($i=0;$i<count($_SESSION['cart']->screenings);$i++)
		{
		echo '<strong class="film_info">';
		echo movie_ID_to_name($_SESSION['cart']->screenings[$i]->movie_ID);
		echo '</strong>';
		echo '<br>';
		echo '<strong class="film_info">';
		echo ($_SESSION['cart']->screenings[$i]->day);
		echo ", ";
		echo ($_SESSION['cart']->screenings[$i]->start_time);
		echo '</strong>';
		echo '<br>';
		echo '<span>';
		for($u=0;$u<count($_SESSION['cart']->screenings[$i]->tickets);$u++)
			{
				echo ' '.($_SESSION['cart']->screenings[$i]->tickets[$u]->quantity);
				echo " x ";
				echo movie_type_to_name($_SESSION['cart']->screenings[$i]->tickets[$u]->type);
				echo " = ";
				echo ($_SESSION['cart']->screenings[$i]->tickets[$u]->subtotal_price);
				echo '<br>';
				
			}
		echo " Subtotal Price: $";
		echo ($_SESSION['cart']->screenings[$i]->subtotal_price);
		echo '</span>';
		echo '<br>';
		echo '<br>';
		}
		echo '<strong>';
		echo "Total price: $";
		echo ($_SESSION['cart']->discounted_price);
		echo '</strong>';
		echo '</div>';	
		
		
		////////////////////////////////////
		
		for($i=0;$i<count($_SESSION['cart']->screenings);$i++)
		{
			for($u=0;$u<count($_SESSION['cart']->screenings[$i]->tickets);$u++)
			{
				for($b=0;$b<($_SESSION['cart']->screenings[$i]->tickets[$u]->quantity);$b++)
				{
		echo '<div class="ticket">';
		echo '<span class="cinema_name_2">Silverado Cinema</span>';
		echo '<br>';
		echo "------------------------------------";
		echo '<br>';
		echo "Movie: ";
		echo '<strong>';
		echo movie_ID_to_name($_SESSION['cart']->screenings[$i]->movie_ID);
		echo '</strong>';
		echo '<br>';
		echo "Show time: ";
		echo '<strong>';
		echo ($_SESSION['cart']->screenings[$i]->day);
		echo ", ";
		echo ($_SESSION['cart']->screenings[$i]->start_time);
		echo '<br>';
		echo '<br>';
		echo '</strong>';
		echo "Type: ";
		echo '<strong>';
		echo movie_type_to_name($_SESSION['cart']->screenings[$i]->tickets[$u]->type);
		echo '</strong>';
		echo '<br>';
		echo  "Seat:";
		if(count($_SESSION['cart']->screenings[$i]->tickets[$u]->seats)>$b)
		{
			echo $_SESSION['cart']->screenings[$i]->tickets[$u]->seats[$b];
		}else{
			echo 'Unselected';
		}
		echo '<br>';
		echo '------------------------------------';
		echo '</div>';	
				}	
			}
		}
		
		$_SESSION['cart'] = new Cart();
		$_SESSION['name'] = null;
		$_SESSION['email'] = null;
		$_SESSION['phone'] = null;
		
?>
	
        </div>