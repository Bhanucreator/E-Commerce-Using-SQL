<?php
  include('connect.php');
  if(isset($_POST['insert_cat'])){
    $category_title=$_POST['cat_title'];

    $select_query="select * from categories where Category_title='$category_title'";
    $result_select=mysqli_query($con,$select_query);
    $number=mysqli_num_rows($result_select);
    if($number>0){
        echo "<script>alert('This category is present inside the database')</script>";
    }else{
    $insert_query="insert into categories (Category_title) values('$category_title')";
    $result=mysqli_query($con,$insert_query);
    if($result){
        echo "<script>alert('category has been inserted successfully')</script>";
    }
   }
  }
?>

<h2 class="text-center">Insert Category</h2>
<form action="" method="post" class="mb-2">
<div class="input-group w-90 mb-2">
  <span class="input-group-text bg-info" id="basic-addon1"><i class="fa-solid fa-receipt"></i></span>
  <input type="text" class="form-control"name="cat_title" placeholder="Insert Categories" aria-label="Username" aria-describedby="basic-addon1">
</div>
<div class="input-group w-10 mb-2 m-auto">
  <input type="Submit" class="bg-info border=0 p-2 my-3"name="insert_cat" value="Insert Categories">
</div>
</form>