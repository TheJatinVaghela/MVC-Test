<?php
class model
{
    public $connection;
    public $products;
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

        $lastkay = array_slice($product,-1,1);//array_name , starting position ,ending position
        array_pop($product);
        array_pop($product);
        $imgName = $combined_id.$lastkay['image']["name"];
        $to .= $imgName;
        try {
            move_uploaded_file($lastkay['image']["tmp_name"],$to);
        } catch (\Throwable $th) {
            $this->print_stuf_model("somthing went wrong while uploading product Images");
        }
       
        $this->print_stuf_model($lastkay);

        
        $value = '"'.implode('","',array_values($product)) ;
        $value .=  '","'.$to.$imgName.'"';
        $product = array_merge($product,$lastkay);
        $key =  implode(",",array_keys($product));
        
         
        //  $this->print_stuf_model([$key,$value]);
        //  $value.=array_values($product[1]['tmp_name'])

         $sqlex = "INSERT INTO $table ($key) VALUES ($value)";
         $this->print_stuf_model($sqlex);
         $sql = $this->connection->query($sqlex);

         if ($sql == 1) {
            header("Location:home");
            return;
        } else {
            $this->print_stuf_model("somthing went wrong while uploading product");
            return;
            # code...
         }
         

    }

    public function getProducts($table){
        $sqlex = "select * from $table"; 
        $sql = $this->connection->query($sqlex);
        if ($sql->num_rows > 0) {
            // $this->print_stuf_model($sql);
             while ($allProducts = $sql->fetch_object()) {
                # code...
                   $products[] = $allProducts;
             }
            $this->products = $products;
            return $sql->num_rows;
        }else{
            $this->products = null;
            return $sql->num_rows;
        }
    }

    public function showProducts(){
        // $this->print_stuf_model($this->products);
        return $this->products;
    }
    public function clearDataBase($table){
      $sqlex = "TRUNCATE TABLE $table";
      $sql = $this->connection->query($sqlex);
    }
}

$model = new model();

?>