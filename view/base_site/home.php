<h1>Products</h1>
<h3>There are <?php echo $this->number?> Products</h3>
<form action="" method="post">
    <button name="showProducts" value="showProducts" type="submit">Show Products</button>
</form>

<section>
    <?php
        if($this->products != null){
            foreach ($this->products as $key => $value) {
                // $print_stuf()($value);
                $this->print_stuf_controller($value);
            }
        }else {};
        
    ?>
</section>