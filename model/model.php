<?php
class model
{
    public $connection;
    public function __construct(){
        // $this->print_stuf_model("in model");
        try {
            $this->connection = new mysqli("localhost", "root", "", "mvctest");
            // $this->print_stuf_model("connection successfull");
        } catch (\Throwable $th) {
            $this->print_stuf_model($th);
        }
    }
    public function print_stuf_model($stuf_name){
        echo "<pre>";
        print_r($stuf_name);
        echo "</pre>";
    }

    public function insert_product($product){

        $this->print_stuf_model("in product");
        $this->print_stuf_model($product);
    }

}

$model = new model();

?>