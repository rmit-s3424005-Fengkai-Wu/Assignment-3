<?php
class Navigation_button{
    private $file_name;
    public function __construct($File_name) {
        $this->file_name = $File_name;
    }
	private function button_text() {
		return strcasecmp($this->file_name,'index')?ucfirst($this->file_name):'Home';
	}
    public function create_button() {
        if (strcasecmp($this->file_name,file_name())) {
            return '<a href="'.$this->file_name.'.php" >'.$this->button_text().'</a>';
        } else{
			return '<span class="current_tag">'.$this->button_text().'</span>';
		}
    }
}
?>