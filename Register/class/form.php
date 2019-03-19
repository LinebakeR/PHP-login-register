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

    public function input($name, $type){

        return
            $this->surround(
                '<label for="' .$name. '">'.$name.'</label>'.
            '<input type="'. $type .'" name="'. $name .'" value="' . $this->getValue($name) . '" class="form-control">'
        );

    }

    public function checkbox($value){
        return '<div class="form-check"><input type="checkbox" class="form-check-input" id="exampleCheck1" name ="is_admin">
        <label class="form-check-label" for="is_admin">'.$value.'</label>
    </div>';

    }


    public function submit(){

        return $this->surround('<button type="submit" class="btn btn-primary">envoyer</button>');

    }

    public function label($label){

        return '<label for="' .$label. '">'.$label.'</label>';

    }


}