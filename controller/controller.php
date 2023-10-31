<?php 
require_once("../model/model.php");
class controller extends model
{   
    public $number = 1;
    public $chack = null;
    public $products;
    public function __construct(){
        parent::__construct();
        // $this->print_stuf_controller("in controller");
        $this->files();
    }

    public function print_stuf_controller($stuf_name){
        echo "<pre>";
        print_r($stuf_name);
        echo "</pre>";
    }

    public function header_footer($file){
        require_once("../view/base_site/header.php");
        require_once("../view/base_site/$file");
        require_once("../view/base_site/footer.php");
        return;
    } 
    public function files(){
        if($_SERVER["PATH_INFO"]){
            // $this->print_stuf_controller($_SERVER["PATH_INFO"]);
            if(isset($_REQUEST["clear_Products"])){
                // $this->print_stuf_controller($_REQUEST);
                $this->clearDataBase("product");
            }
            switch ($_SERVER["PATH_INFO"]) {
                case '/home':
                    $this->number = $this->getProducts("product"," ");
                    if(isset($_REQUEST["showProducts"])){
                        $this->products = $this->showProducts();
                        $this->chack = 1;
                    };
                    // $this->print_stuf_controller($this->products);
                    $this->header_footer("home.php");
                    break;
                case '/Add-Product':
                    if(isset($_REQUEST["submit"])){
                         //  $this->print_stuf_controller(array_merge($_REQUEST,$_FILES));
                           $this->insert_product("product",array_merge($_REQUEST,$_FILES));                        
                    }else{
                        // $this->print_stuf_controller("NOPNIOPNOP");
                    }
                    $this->header_footer("Add-Product.php");
                    break;
                
                case '/edit-Product':
                    if(isset($_REQUEST["edit_product"])){
                        // $this->print_stuf_controller($_REQUEST);
                        $this->number = $this->getProducts("product",$_REQUEST["edit_product"]);
                        if($this->number != 0){
                            $this->products = $this->showProducts();
                            $this->chack = 1;
                        };
                    };
                    if(isset($_REQUEST["save_edited_product"])){
                        // $this->print_stuf_controller($_REQUEST);
                         $this->getProducts("product",$_REQUEST["save_edited_product"]);
                         $this->remove_spesifice_imgs();
                         $this->saveEditProduct("product",$_REQUEST,$_FILES);
                    };
                    $this->header_footer("edit-Product.php");
                    break;
                case '/see-Product':
                    $this->header_footer("see-Product.php");
                    break;
                
                default:
                    $this->print_stuf_controller("404 not found");
                    break;
            }
        }else{
            // $this->print_stuf_controller("404 not found");
            header("Location:home");
        }
    }

   
};

$controller = new Controller();

?>