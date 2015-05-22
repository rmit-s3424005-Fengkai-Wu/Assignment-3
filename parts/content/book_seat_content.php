
<div class="content content_font" style="background-image:none;background-color:#BBBBBB">
<?php
require_once 'parts/class/book_seat.php';
(new Book_seat())->create_table($_POST['Book_seats'], $normal_seat_avilable,$first_class_seat_avilable,$beanbag_avilable);
		
?>
</div>