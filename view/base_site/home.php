<h1>Products</h1>
<h3>There are <?php echo $this->number?> Products</h3>
<form action="" method="post">
    <button name="showProducts" value="showProducts" type="submit">Show Products</button>
</form>

<section>
    <?php
        if($this->products != null && $this->chack != null){
            foreach ($this->products as $key => $value) {
                // $print_stuf()($value);
                // $this->print_stuf_controller($value);
                ?>
                <div class="height d-flex justify-content-center align-items-center">
                    <form action="" method="post">
                    
                    <div class="card p-3">
                        <div class="d-flex justify-content-between align-items-center ">
                            <div class="mt-2">
                                <h4 class="text-uppercase">Name :- <?php echo $value->name?></h4>
                                <div class="mt-5">
                                    <h5 class="text-uppercase mb-0">quantity :- <?php echo $value->quantity?></h5>
                                    <h1 class="main-heading mt-0">price :- <?php echo $value->price?></h1>
                                </div>
                            </div>
                            <div class="image">
                                <img src="<?php echo $value->image?>" width="200">
                            </div>
                        </div>
                        
                        <p>description :- <?php echo $value->description?></p>
                        
                        <button class="btn btn-danger" type="submit" value="<?php echo $value->id?>" name="add_to_cart">Add to cart</button>
                    </div>
                    
                </form>
                <form method="post" action="edit-Product">
                    <button class="btn btn-danger" type="submit" value="<?php echo $value->id?>" name="edit_product">Edit Product</button>                    
                </form>
                </div>
                <?php
            }
        }else {};
        
    ?>
</section>