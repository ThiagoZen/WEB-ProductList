<?php
    function clean($string) {
       $string = str_replace(' ', '-', $string);
    
       return preg_replace('/[^A-Za-z0-9\-]/', '', $string);
    }

    if(isset($_GET['checkBoxList'])){
    
        $mysqli = new mysqli("localhost","USERNAME","PASSWORD","id20639790_products");
        
        
        $name = $_GET['checkBoxList'];
        
        $clean_name = $name;
        foreach ($clean_name as $sku){ 
            $sql = "DELETE FROM lista WHERE `sku`="."\"$sku\"";
            mysqli_query($mysqli,$sql);
        } 
        
        $mysqli -> close();
        header("Location: index.php");
    
    }
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
	        background-color:#f0f0f0;
	        color: #131313;
	        border-style: solid;
	        border-width: 2px;
	    }
	    .product p{
	        text-align: center;
	    }
	</style>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body>
    <div class="container">
    
    <form action="index.php" method="get">
        
        <div class="d-flex align-items-center">
            <h1 class="p-2 justify-content-start">Product List</h1>
            <div class="ms-auto">
                <a href="add-product.php" class="btn btn-primary">ADD</a>
                <button class="btn btn-danger" id="delete-product-btn" type="submit" value="submit">MASS DELETE</button>
            </div>
        </div>
        
        <hr>
        
        <div class="container">
            <div class="row">

        	<?php
        	$mysqli = new mysqli("localhost","USERNAME","PASSWORD","id20639790_products");
        
            if ($mysqli -> connect_errno) {
                echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
                exit();
            }
        
            $sql = "SELECT * FROM lista";
            $result = $mysqli->query($sql);
            
            if ($result->num_rows > 0) {
        
              while($row = $result->fetch_assoc()) {
                echo "<div class='p-2 col-4'>";
                echo "<div class='product'>";
                echo "<input type='checkbox' name='checkBoxList[]' value='".$row["sku"]."' class='delete-checkbox'>";
                echo "<p class='textProduct p-1'><b>".$row["sku"]."</b></p>";
                echo "<p class='textProduct'>".$row["name"]."</p>";
                echo "<p class='textProduct text-success'>".$row["price"]." $"."</p>";
                
                if($row["identifier"] == "1"){//Dvd
                    echo "<p class='textProduct'>"."Size: ".$row["size"]." MB"."</p>";
                }
                else if($row["identifier"] == "2"){//book
                    echo "<p class='textProduct'>"."Weight: ".$row["weight"]." KG"."</p>";
                }
                else{//furniture
                    echo "<p class='textProduct'>"."Dimension: ".$row["height"]." X ".$row["width"]." X ".$row["length"]."</p>";
                }
                
                echo "</div>";
                echo "</div>";
                echo "</br>";
                  
              }
            } else {
              echo "0 results";
            }
            
            $mysqli -> close();
            
        	?>
        	</div>
        </div>
	</form>
	
	<hr class="mt-5">
	<p class="text-center">Scandiweb Junior Developer test assignment</p>
	
	</div>

</body>
</html>