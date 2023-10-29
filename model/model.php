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

    public function insert_product($table,$product){
        $to = "F:/Xampp/xammp/htdocs/php/MVCtest/assets/product_images/";
        $time = time();
        $uniq_id = uniqid();

        $combined_id = $time.$uniq_id;

        // $this->print_stuf_model("in product");
        // $this->print_stuf_model($product);

        $lastkay = array_slice($product,-1,1);//array_name , starting position ,ending position
        array_pop($product);
        array_pop($product);
        $imgName = $combined_id.$lastkay['image']["name"];
        $to .= $imgName;
        try {
            // move_uploaded_file($lastkay['image']["tmp_name"],$to);
        } catch (\Throwable $th) {
            printf($th);
        }
       
        $this->print_stuf_model($lastkay);

        
        $value = implode(",",array_values($product)) ;
        $value .=  ','.$imgName;
        $product = array_merge($product,$lastkay);
        $key = implode(",",array_keys($product));
         
         
         $this->print_stuf_model([$key,$value]);
        //  $value.=array_values($product[1]['tmp_name'])

        // $sqlex = "INSERT INTO $table ($key) VALUES ($value)";
        // $sql = $this->connection->query($sqlex);


    }

}

$model = new model();

?>