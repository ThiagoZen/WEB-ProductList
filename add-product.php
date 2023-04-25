<?php

    $mysqli = new mysqli("localhost","USERNAME","PASSWORD","id20639790_products");
    
    function clean($string) {
       $string = str_replace(' ', '-', $string);
    
       return preg_replace('/[^A-Za-z0-9\-]/', '', $string);
    }
    
    function Error($string){
        echo "<h1>Error: $string</h1>";
        exit;
    }
    
    function successfullyAdded(){
        echo "<div class='alert alert-success' role='alert'>Value successfully added to database</div>";
    }
    
    class Product{
        public $prod_type;
        
        public $sku;
        public $name;
        public $price;
        
        public $size;
        
        public $weight;
        
        public $height;
        public $width;
        public $length;
        
        function set_prodType($prod_type){
            if($prod_type == "dvd" or $prod_type == "book" or $prod_type == "furniture"){
                $this->prod_type = $prod_type;
            }
            else{
                Error("Product type wrong");
            }
        }
        function get_prodType(){
            return $this->prod_type;
        }
        
        // SKU
        function set_sku($sku){
            $clean_sku = clean($sku);
            
            if(strlen($clean_sku) <= 15){
                $this->sku = $clean_sku;
            }
            else{
                Error("SKU too long");
            }
        }
        function get_sku(){
            return $this->sku;
        }
        // Name
        function set_name($name){
            $clean_name = clean($name);
            
            if(strlen($clean_name) <= 25){
                $this->name = $clean_name;
            }
            else{
                Error("Name too long");
            }
        }
        function get_name(){
            return $this->name;
        }
        // Price
        function set_price($price){
            $clean_price = preg_replace('/\D/', '', $price);
            
            if(strlen($clean_price) == 0){
                Error("Price not set");
            }
            else if(strlen($clean_price) <= 6){
                $this->price = $clean_price;
            }
            else{
                Error("Price too long");
            }
        }
        function get_price(){
            return $this->price;
        }
        // Size, DVD
        function set_size($size){
            $clean_size = preg_replace('/\D/', '', $size);
            
            if(strlen($clean_size) == 0){
                Error("Size not set");
            }
            else if(strlen($clean_size) <= 12){
                $this->size = $clean_size;
            }
            else{
                Error("Size too long");
            }
        }
        function get_size(){
            return $this->size;
        }
        // Weight, Book
        function set_weight($weight){
            $clean_weight = preg_replace('/\D/', '', $weight);
            
            if(strlen($clean_weight) == 0){
                Error("Weight not set");
            }
            else if(strlen($clean_weight) <= 3){
                $this->weight = $clean_weight;
            }
            else{
                Error("Weight too long");
            }
        }
        function get_weight(){
            return $this->weight;
        }
        
        // Dimensions, Furniture
        // height
        function set_height($height){
            $clean_height = preg_replace('/\D/', '', $height);
            
            if(strlen($clean_height) == 0){
                Error("Height not set");
            }
            else if(strlen($clean_height) <= 3){
                $this->height = $clean_height;
            }
            else{
                Error("Height too long");
            }
        }
        function get_height(){
            return $this->height;
        }
        // Width
        function set_width($width){
            $clean_width = preg_replace('/\D/', '', $width);
            
            if(strlen($clean_width) == 0){
                Error("Width not set");
            }
            else if(strlen($clean_width) <= 3){
                $this->width = $clean_width;
            }
            else{
                Error("Width too long");
            }
        }
        function get_width(){
            return $this->width;
        }
        // Length
        function set_length($length){
            $clean_length = preg_replace('/\D/', '', $length);
            
            if(strlen($clean_length) == 0){
                Error("Length not set");
            }
            else if(strlen($clean_length) <= 3){
                $this->length = $clean_length;
            }
            else{
                Error("Length too long");
            }
        }
        function get_length(){
            return $this->length;
        }
 
        // Product ID
        
        function set_productID($prod_type){
            $this->prod_type = $prod_type;
        }
        function get_productID(){
            return $this->prod_type;
        }
    } 
    
    if(isset($_POST['productType'])){
        $ADD_PRODUCT = new Product();
        $ADD_PRODUCT->set_prodType($_POST['productType']);
        
        if($_POST['sku'] != "" and $_POST['name'] != "" and $_POST['price'] != ""){
            $ADD_PRODUCT->set_sku($_POST['sku']);
            $ADD_PRODUCT->set_name($_POST['name']);
            $ADD_PRODUCT->set_price($_POST['price']);
            

            if($ADD_PRODUCT->get_prodType() == "dvd" and $_POST['size'] != ""){
                $ADD_PRODUCT->set_size($_POST['size']);
                $ADD_PRODUCT->set_productID("1");
                
                $sql = "INSERT INTO `lista`(`sku`, `name`, `price`, `size`,`identifier`) VALUES ('{$ADD_PRODUCT->get_sku()}','{$ADD_PRODUCT->get_name()}','{$ADD_PRODUCT->get_price()}','{$ADD_PRODUCT->get_size()}','{$ADD_PRODUCT->get_productID()}')";
                
                mysqli_query($mysqli,$sql);
                successfullyAdded();
            }
            else if($ADD_PRODUCT->get_prodType() == "book" and $_POST['weight'] != ""){
                $ADD_PRODUCT->set_weight($_POST['weight']);
                $ADD_PRODUCT->set_productID("2");
                
                $sql = "INSERT INTO `lista`(`sku`, `name`, `price`, `weight`,`identifier`) VALUES ('{$ADD_PRODUCT->get_sku()}','{$ADD_PRODUCT->get_name()}','{$ADD_PRODUCT->get_price()}','{$ADD_PRODUCT->get_weight()}','{$ADD_PRODUCT->get_productID()}')";

                mysqli_query($mysqli,$sql);
                successfullyAdded();
            }
            else if($ADD_PRODUCT->get_prodType() == "furniture" and $_POST['height'] != "" and $_POST['width'] != "" and $_POST['length'] != ""){
                $ADD_PRODUCT->set_height($_POST['height']);
                $ADD_PRODUCT->set_width($_POST['width']);
                $ADD_PRODUCT->set_length($_POST['length']);
                $ADD_PRODUCT->set_productID("3");
                
                $sql = "INSERT INTO `lista`(`sku`, `name`, `price`, `height`, `width`, `length`,`identifier`) VALUES ('{$ADD_PRODUCT->get_sku()}','{$ADD_PRODUCT->get_name()}','{$ADD_PRODUCT->get_price()}','{$ADD_PRODUCT->get_height()}','{$ADD_PRODUCT->get_width()}','{$ADD_PRODUCT->get_length()}','{$ADD_PRODUCT->get_productID()}')";
                
                mysqli_query($mysqli,$sql);
                successfullyAdded();
            }
        }
        else{
            Error("SKU,Name or Price not defined");
        }
        
        
    }
    $mysqli -> close();

?>
<!DOCTYPE html>
<html>
<head>
	<title>Junior Developer Test Task</title>
	<style>
    	body{
    	    padding:10px;
    	}
	    .product{
	        padding: 20px;
	        background-color:#131313;
	        color: white;
	    }
	    .textProduct{
	       text-align:center;
	    }
	    .Buttons{
	        
	    }
	</style>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body>
    <div class="container">
    
    <form action="add-product.php" method="post" id="product_form">
        <div class="form-group">
            <div class="d-flex align-items-center">
                <h1 class="p-2 justify-content-start">Product List</h1>
                <div class="ms-auto">
                    <button class="btn btn-primary" id="save-product-btn" type="submit" value="submit">Save</button>
                    <a href="index.php" class="btn btn-danger ">Cancel</a>
                </div>
            </div>
            
            <hr>
            
            <label>SKU </label><input type="text" id="sku" name="sku" class="form-control" placeholder="JVC200123" required>
            <label>Name </label><input type="text" id="name" name="name" class="form-control" placeholder="Acme DISC" required>
            <label>Price ($)</label><input type="number" id="price" name="price" class="form-control" placeholder="1" required>
            </br>
            <select onchange="change()" name="productType" id="productType"  class="form-control mb-5">
                <option value="dvd">DVD</option>
                <option value="book">Book</option>
                <option value="furniture">Furniture</option>
            </select>
            <div class="dvd" id="dvd">
                <label>Size (MB) </label><input type="number" id="size" name="size" class="form-control" placeholder="700">
            </div>
            
            <div class="book" id="book">
                <label>Weight (KG)</label><input type="number" id="weight" name="weight" class="form-control" placeholder="2">
            </div>
    
            <div class="furniture" id="furniture">
                <label>Height (CM)</label><input type="number" id="height" name="height" class="form-control" placeholder="24">
                <label>Width (CM)</label><input type="number" id="width" name="width" class="form-control" placeholder="45">
                <label>Length (CM)</label><input type="number" id="length" name="length" class="form-control" placeholder="15">
            </div>
        </div>
	</form>
	
	<script type="text/javascript">
        
        var dvd = document.getElementById("dvd");
        var book = document.getElementById("book");
        var furn = document.getElementById("furniture");
        book.style.display = "none";
        furn.style.display = "none";

        var dropDown = document.getElementById("productType");
        
        function change(){
            if(dropDown.value == "dvd"){
                dvd.style.display = "block";
                book.style.display = "none";
                furn.style.display = "none";
            }
            else if(dropDown.value == "book"){
                book.style.display = "block";
                dvd.style.display = "none";
                furn.style.display = "none";
            }
            else{
                furn.style.display = "block";
                dvd.style.display = "none";
                book.style.display = "none";
            }
        }

	</script>
	
	<hr class="mt-5">
	<p class="text-center">Scandiweb Junior Developer test assignment</p>
	</div>
</body>


</html>