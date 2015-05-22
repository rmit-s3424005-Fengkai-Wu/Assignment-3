<?php
function file_name(){
	$url = $_SERVER['PHP_SELF'];
	$name = str_replace('.php','',substr($url ,strrpos($url ,'/')+1 ));
	return $name;
}

function to_webpage($url){ 
	echo '<script>window.location.href="';
	echo $url;
	echo '"</script>';
}
function movie_ID_to_name($Movie_ID)
{
    		switch($Movie_ID)
		{
			case 'AF':
				return 'Mardaani';
				break;
			case 'CH':
				return 'Planes: Fire and Rescue';
				break;
			case 'RC':
				return 'Once a Princess';
				break;
			case 'AC':
				return 'Guardians of the Galaxy';
				break;
		}
}
function movie_type_to_name($type)
{
	switch($type)
		{
			case 'SA':
				return 'Adult';
				break;
			case 'SP':
				return 'Concession';
				break;
			case 'SC':
				return 'Child';
				break;
			case 'FA':
				return 'First Class Adult';
				break;
			case 'FC':
				return 'First Class Child';
				break;
			case 'B1':
				return 'Beanbag - 1 Person';
				break;
			case 'B2':
				return 'Beanbag - 2 Person';
				break;
			case 'B3':
				return 'Beanbag - 3 Person';
				break;
		}
}
?>