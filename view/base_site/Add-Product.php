
    
    
<form  method="post" enctype="multipart/form-data">
        
        <div class="form-group">
            <label for="exampleInputEmail1">Product Name</label>
            <input type="text" class="form-control" id="name" name="name" required   placeholder="Enter Product Name">
        </div>
        
        <div class="form-group">
            <label for="exampleInputEmail1">Product Price</label>
            <input type="text" class="form-control" id="price" name="price" required  placeholder="Enter Product Price">
        </div>
        
        <div class="form-group">
            <label for="exampleInputEmail1">Product Discription</label>
            <textarea name="description" class="form-control" id="description"required  cols="30" rows="3"></textarea>
        </div>
        
        <div class="form-group">
            <label for="exampleInputEmail1">Product Quantity</label>
            <input type="number" class="form-control" id="quantity" name="quantity" required  placeholder="Enter Product quantity">
        </div>
        
        <!-- IF ANY MORE OPTIONS ADD HERE -->
        <!-- Example if you want to add rating add it in here
             dont add any thing before submit button and after Images   -->
      <!--  <div class="form-group">
            <label for="exampleInputEmail1">Rating</label>
            <select name="rating" id="">
                <option value="1">⭐</option>
                <option value="2">⭐⭐</option>
                <option value="3">⭐⭐⭐</option>
                <option value="4">⭐⭐⭐⭐</option>
                <option value="5">⭐⭐⭐⭐⭐</option>
            </select>
        </div> 
        -->

        <div class="form-group">
            <label for="exampleInputEmail1">Product Image</label>
            <input type="file" class="form-control" accept="image/*" id="image" required name="image">
        </div>
        
        
        
        
        
            <button type="submit" name="submit" value="submit" class="btn btn-primary">Submit</button>
 
    </form>
