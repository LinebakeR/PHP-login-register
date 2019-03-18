<?php

include_once "inc/header.php";

class Form{

    private $data;
    private $surround = 'p';

    public function __construct($data){
        $this->data = $data;

    }

    private function surround($html){
        return "<{$this->surround}>{$html}</{$this->surround}>";

    }


    private function getValue($index){

        return isset($this->data[$index]) ? $this->data[$index] : null;
    }

    public function input($name){

        return
            $this->surround(
                '<label for="' .$name. '">'.$name.'</label>'.
            '<input type="text" name="'. $name .'" value="' . $this->getValue($name) . '" class="form-control">'
        );

    }


    public function submit(){

        return $this->surround('<button type="submit" class="btn btn-primary">envoyer</button>');

    }

    public function label($label){

        return '<label for="' .$label. '">'.$label.'</label>';

    }


}