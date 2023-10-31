<?php
class model
{
    public $connection;
    public $products;
    public $to = "../assets/product_images/";
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
        //  $to = $this->to;
        // $time = time();
        // $uniq_id = uniqid();

        // $combined_id = $time.$uniq_id;

        $lastkay = array_slice($product,-1,1);//array_name , starting position ,ending position
        array_pop($product);
        array_pop($product);
        // $imgName = $combined_id.$lastkay['image']["name"];
        // $to .= $imgName;
        // try {
        //     move_uploaded_file($lastkay['image']["tmp_name"],$to);
        // } catch (\Throwable $th) {
        //     $this->print_stuf_model("somthing went wrong while uploading product Images");
        // }

        $this->upload_files($lastkay);
       
        $this->print_stuf_model($lastkay);

        
        $value = '"'.implode('","',array_values($product)) ;
        $value .=  '","'.$this->to.'"';

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

    public function getProducts($table,$id){
        ($id == " ")? $sqlex = "select * from $table" : $sqlex = "select * from $table WHERE id = $id"; 
        
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

    public function upload_files($imgdata){
         
         $time = time();
         $uniq_id = uniqid();
 
         $combined_id = $time.$uniq_id;

         $imgName = $combined_id.$imgdata['image']["name"];
         $this->to .= $imgName;
         
        //  $this->print_stuf_model($imgdata['image']["tmp_name"]);
        //  $this->print_stuf_model($to);
         try {
             move_uploaded_file($imgdata['image']["tmp_name"],$this->to );
         } catch (\Throwable $th) {
             $this->print_stuf_model("somthing went wrong while uploading product Images");
          }
    }
    public function getKeys($table){
        // $this->print_stuf_model(array_keys($this->products[0]));
        $keya = array();
        foreach ($this->products[0] as $key => $value) {
          $keya[]= $key;
        }
        return $keya;
        //  $this->print_stuf_model($keya); 
    }
    public function getValues($table,$imgdata,$keys){
        // $this->print_stuf_model(array_keys($this->products[0]));
        $valuea = array();
        foreach ($table as $key => $value) {
          $valuea[]= $value;
        }
        if($imgdata['image']['error'] != 0){
            // $this->print_stuf_model($imgdata); 
            // $this->print_stuf_model($this->products[0]->image); 
            $this->to = $this->products[0]->image;
            array_push($valuea,$this->to);
            return $valuea;
        }else{

            $this->upload_files($imgdata);
            array_push($valuea,$this->to);
            // $this->print_stuf_model($valuea); 
            //  $this->print_stuf_model(["KEYS"=>$keys]); 
            return $valuea;
        }
    }

    public function showProducts(){
        // $this->print_stuf_model($this->products);
        return $this->products;
    }
    public function clearDataBase($table){
      $sqlex = "TRUNCATE TABLE $table";
      $sql = $this->connection->query($sqlex);

      $dir = '../assets/product_images/'; // Directory to delete files from

      foreach(glob($dir.'*.{jpg,jpeg,png,gif}', GLOB_BRACE) as $file) {
          if(is_file($file)) {
                
              if(unlink($file)) {  
                //   echo "$file has been deleted";  
              } else {  
                //   echo "$file cannot be deleted";  
              }  
          }
      }

    }

   public function saveEditProduct($table,$data , $imgdata){
    // $this->print_stuf_model($table);
    // $this->print_stuf_model($this->products);
    $id = array_pop($data);
    $keys = $this->getKeys($table);
    $values = $this->getValues($data,$imgdata,$keys);

    array_unshift($values,$id);
    // $this->print_stuf_model([$keys,$values]);
    $com = array_combine($keys, $values);
    //  $this->print_stuf_model($com);

     $sql = 'update ' .$table .' set ';
    foreach ($com as $com_key => $value) {
    //    $sqlex .= $com_key .'='. '"$value"'.",";
       $sql .= $com_key .'=';
       $sql .= "'";
       $sql .= $value;
       $sql .= "'";
       $sql .= ",";

    }
    $sql= substr($sql, 0, -1);
    $sql .= ' WHERE id = '.$id;
    // $this->print_stuf_model($sql);
    $sqlex = $this->connection->query($sql);
    if($imgdata["image"]["error"] != 0){
        // $this->print_stuf_model("in error");
        // $this->print_stuf_model($this->products[0]->image);
        // $this->print_stuf_model($imgdata);
        if($sqlex !=1){
            $this->print_stuf_model($sql);
        }
        header('Location:home');
    }else{

        
        if($sqlex == 1){
            header('Location:home');
            // $this->print_stuf_model("success");
            $this->remove_spesifice_imgs();
        }else{
            $this->print_stuf_model($sql);
        }
    }

}

   public function remove_spesifice_imgs(){
        // $this->print_stuf_model("in remove_spesifice_imgs");
        //  $this->print_stuf_model($this->products);
        $img= $this->products[0]->image;
        if(is_file($img)) {
             unlink($img);
        }
}
}
$model = new model();

?>