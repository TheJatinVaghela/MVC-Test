<?php 
require_once("../model/model.php");
class controller extends model
{
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
    } 
    public function files(){
        if($_SERVER["PATH_INFO"]){
            // $this->print_stuf_controller($_SERVER["PATH_INFO"]);
            switch ($_SERVER["PATH_INFO"]) {
                case '/home':
                    $this->header_footer("home.php");
                    break;
                case '/Add-Product':
                    
                    $this->header_footer("Add-Product.php");
                    break;
                    
                    case "/add":
                        if(isset($_REQUEST["submit"])){
                            //  $this->print_stuf_controller();
                             $this->insert_product($_REQUEST);                        
                        }else{
                            $this->print_stuf_controller("NOPNIOPNOP");
                        }
                        break;

                case '/edit-Product':
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
$controller->__construct();
?>