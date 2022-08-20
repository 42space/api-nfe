<?php

class XmltoString {

    
    public $converted = "";

    public function __construct($path) {
       $this->converted = $this->converteXmltoString($path);
    }

    /*
     *Converted File Xml to String 
     */
    private function converteXmltoString($path) {
        return file_get_contents($path);
    }

    public function __toString() {
        return $this->converted;
    }
}