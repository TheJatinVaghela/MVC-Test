<section>
    <?php
        if($this->products != null && $this->chack != null){
            foreach ($this->products as $key => $value) {
                // $print_stuf()($value);
                // $this->print_stuf_controller($value);
                ?>
                <form action="" method="post" enctype="multipart/form-data">
                <div class="height d-flex justify-content-center align-items-center">
                    
                    <div class="card p-3">
                        <div class="d-flex justify-content-between align-items-center ">
                            <div class="mt-2">
                            Name :- <input class="text-uppercase" name="name" value="<?php echo $value->name?>" required></input>
                                <div class="mt-5">
                                    price :-    <input class="main-heading mt-0" name="price" type="number" value="<?php echo $value->price?>" required></input>
                                    description :- <input type="text" name="description" value="<?php echo $value->description?>"></input>
                                </div>
                            </div>
                            quantity :-  <input class="text-uppercase mb-0" name="quantity" type="number" value="<?php echo $value->quantity?>" required> </input>
                        </div>
                        
                        <div class="image">
                            <!-- <img src="" width="200"> -->
                            Image:- <input type="file" accept="image/*" id="image" name="image"/>
                        </div>
                        
                        <button class="btn btn-danger" type="submit" value="<?php echo $value->id?>" name="save_edited_product">save product</button>
                    </div>
                    
                </div>
                </form>
                <?php
            }
        }else {
            echo "<h1>NO PRODUCTS</h1>";
        };
        
    ?>
</section>