<?php
class Post_button{
    private $name;
    private $value;
    private $class_name;
    private $text;
    private $url;
	public function set_name($Name)
	{
        $this->name = $Name;
	}
	public function set_value($Value)
	{
        $this->value = $Value;
	}
	public function set_text($Text)
	{
        $this->text = $Text;
	}
	public function set_url($Url)
	{
        $this->url = $Url;
	}
    public function __construct($Text,$Name,$Value=true,$Url=null) {
        $this->name = $Name;
        $this->value = $Value;
        $this->class_name = null;
        $this->text = $Text;
        $this->url = $Url;
    }
	public function get_url()
	{
        return $this->url;
	}
	public function set_class_name($Class_name)
	{
        $this->class_name = $Class_name;
	}
    public function create_button($Available = true) {
		if(!$Available)
		{
			echo '	<input ';
			if($this->class_name != null)
			{
				echo 'class="';
				echo $this->class_name;
				echo '"';
			}
			echo 'type = "button" value="';
			echo $this->text;
			echo '">';
			return;
		}/////////////////////////////////		
		
        echo '<form action="';
		if($this->url == null)
		{
			echo htmlspecialchars($_SERVER["PHP_SELF"]);
		}else{
			echo $this->url;
		}
		echo '" method="post" >';
		echo '	<input name = "';
		echo $this->name;
		echo '" style="display:none" value="';
		echo $this->value;
		echo '	">';
		echo '	<input ';
		if($this->class_name != null)
		{
			echo 'class="';
			echo $this->class_name;
			echo '"';
		}
		echo ' type="submit" value="';
		echo $this->text;
		echo '">';
        echo '</form>';
    }
}
?>