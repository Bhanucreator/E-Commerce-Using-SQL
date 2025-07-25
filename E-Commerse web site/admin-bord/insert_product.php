<?php
    include('../includes/connect.php');
    if(isset($_POST['insert_product'])){
        $product_title=$_POST['product_title'];
        $discription=$_POST['Discription'];
        $product_keyword=$_POST['product_keyword'];
        $product_categories=$_POST['product_categories'];
        $product_brands=$_POST['product_brands'];
        $product_price=$_POST['product_price'];
        $product_status='true';

        //accessing image
        $product_image1=$_FILES['product_image1']['name'];
        $product_image2=$_FILES['product_image2']['name'];
        $product_image3=$_FILES['product_image3']['name'];
       
        //accessing image tmp name
        $tmp_image1=$_FILES['product_image1']['tmp_name'];
        $tmp_image2=$_FILES['product_image2']['tmp_name'];
        $tmp_image3=$_FILES['product_image3']['tmp_name'];

        //checking condition 
        if($product_title==''or $discription=='' or $product_keyword=='' or $product_categories==''or $product_brands==''or $product_price=='' or $product_image1=='' or $product_image2=='' or $product_image3==''){
            echo "<script>alert('Please fill all the available fields')</script>";
            exit();
        }else{
            move_uploaded_file($tmp_image1,"./product_images/$product_image1");
            move_uploaded_file($tmp_image2,"./product_images/$product_image2");
            move_uploaded_file($tmp_image3,"./product_images/$product_image3");

            //insert query
            $insert_products="insert into products (product_title,product_description,product_keywords,Category_id,Brand_id,product_image1,product_image2,product_image3,product_price,date,Status) values ('$product_title','$discription','$product_keyword','$product_categories','$product_brands','$product_image1','$product_image2','$product_image3','$product_price',NOW(),'$product_status')";
            $result_query=mysqli_query($con,$insert_products);
            if($result_query){
                echo "<script>alert('successfully inserted the products')</script>";
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <link rel="stylesheet" href="style1.css" class="css" >
</head>
<body class="bg-light">
    <div class="container mt-3">
        <h1 class="text-center">Insert Products</h1>
        <!--form-->
        <form action=""method="post" enctype="multipart/form-data">
            <!--title-->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_title" class="form-label">Product title</label>
                <input type="text" name="product_title" id="product_title" class="form-control" placeholder="Enter product title" autocomplete="off" required="required">
            </div>

            <!--Discription-->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="Discription" class="form-label">Product Discription</label>
                <input type="text" name="Discription" id="Discription" class="form-control" placeholder="Enter product Discription" autocomplete="off" required="required">
            </div>

            <!--Keywords-->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_keyword" class="form-label">Product Keywords</label>
                <input type="text" name="product_keyword" id="product_keyword" class="form-control" placeholder="Enter product Keywords" autocomplete="off" required="required">
            </div>

             <!--categories-->
             <div class="form-outline mb-4 w-50 m-auto">
                <select name="product_categories" id=""class="form-select">
                    <option value="">Select Category</option>
                    <?php
                        $select_query="Select * from categories";
                        $result_query=mysqli_query($con,$select_query);
                        while($row=mysqli_fetch_assoc($result_query)){
                            $category_title=$row['Category_title'];
                            $category_id=$row['Category_id'];
                            echo "<option value='$category_id'>$category_title</option>";
                        }
                    ?>
                </select>
            </div>

            <!--Brands-->
            <div class="form-outline mb-4 w-50 m-auto">
                <select name="product_brands" id=""class="form-select">
                    <option value="">Select Brands</option>
                    <?php
                        $select_query="Select * from brands";
                        $result_query=mysqli_query($con,$select_query);
                        while($row=mysqli_fetch_assoc($result_query)){
                            $brand_title=$row['Brand_title'];
                            $brand_id=$row['Brand_id'];
                            echo "<option value='$brand_id'>$brand_title</option>";
                        }
                    ?>
                </select>
            </div>

             <!--Image1-->
             <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_image1" class="form-label">Product Image1</label>
                <input type="file" name="product_image1" id="product_image1" class="form-control" required="required">
            </div>

            <!--Image2-->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_image2" class="form-label">Product Image2</label>
                <input type="file" name="product_image2" id="product_image2" class="form-control" required="required">
            </div>

             <!--Image3-->
             <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_image3" class="form-label">Product Image2</label>
                <input type="file" name="product_image3" id="product_image3" class="form-control" required="required">
            </div>

            <!--Price-->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_price" class="form-label">Product Price</label>
                <input type="text" name="product_price" id="product_price" class="form-control" placeholder="Enter product Price" autocomplete="off" required="required">
            </div>

            <!--Button-->
            <div class="form-outline mb-4 w-50 m-auto">
                <input type="Submit"name="insert_product"class="btn btn-info mb-3 px-3" value="Insert Products">
            </div>
        </form>
    </div>
</body>
</html>