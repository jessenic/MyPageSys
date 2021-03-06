<?php
//This script handles pretty much everything what outputs to the page. Templates etc.
class MPSTemplate {
    protected $file;
    protected $values = array();

    public function __construct($file) {
        $this -> file = $file;
    }

    public function set($key, $value) {
        $this -> values[$key] = $value;
    }

    public function output() {
        if (!file_exists($this -> file)) {
            return "Error loading template file ($this->file).<br />";
        }
        $output = file_get_contents($this -> file);

        foreach ($this->values as $key => $value) {
            $tagToReplace = "[@$key]";
            $output = str_replace($tagToReplace, $value, $output);
        }

        return $output;
    }

}
?>