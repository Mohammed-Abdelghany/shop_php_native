<?php

include "../view/header.php";
include "../view/sidebar.php";
include "../view/navbar.php";
include "../../dbConnection.php";
?>


<div class="container-fluid page-body-wrapper full-page-wrapper">
    <div class="row w-100 m-0">
        <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
            <div class="card col-lg-4 mx-auto">

                <div class="card-body px-5 py-5">
                    <h3 class="card-title text-left mb-3">Add Category</h3>

                    <?php

if(isset($_GET["id"]) && $_GET["id"] != ""){
$id = $_GET["id"];


    if (isset($_POST['updateProduct'])) {
        $category = $_POST['category'];
        $title = $_POST['title'];
        $desc = $_POST['desc'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];
        $image = $_FILES['img']['name'];
        $image_temp=$_FILES['img']['tmp_name'];
        $cat_id=$_POST['category'];
    
        if(empty($title) || empty($desc) || empty($price) || empty($quantity) || empty($cat_id)){
            $error = 'All inputs are required';
        }
if(empty($image)){
    $image = $_POST['oldImg'];
}

        if(empty($error)) {
        $sql = "UPDATE `products` SET `name`='$title',`description`='$desc',`price`='$price',`quantity`='$quantity',`img`='$image',`cat_id`='$cat_id' WHERE `id`=$id";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            if($image != $_POST['oldImg']){
            unlink("../upload/{$_POST['oldImg']}");
            move_uploaded_file($image_temp,"../upload/$image");
            }   
            // header('location:allCategories.php'); 
          echo "Data updated successfully";
        // exit();
        } else {
          die(mysqli_error($conn));
        }
    } else {
        echo $error;
 
    }
      }  }else {
        header('location:allCategories.php'); 
      }

      
$sql = "SELECT * FROM products WHERE `id`=$id";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
  $product = mysqli_fetch_assoc($result);
?>
                    <form method="POST" action="updateProduct.php?id=<?= $id ?>" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Category</label>
                            <!-- <input type="text" name="category" class="form-control p_inp
                             ut"> -->

                            <select name="category">
                                <?php 
                             $sql = "SELECT id,name FROM category";
                             $result = mysqli_query($conn, $sql);
                             if (mysqli_num_rows($result) > 0) {
                                $data =mysqli_fetch_all($result, MYSQLI_ASSOC);
                                foreach ($data as $row) {
                                
                             ?>
                                <option value="<?= $row['id'] ?>"
                                    <?= ($product['cat_id'] ==  $row['id'])?'selected':null ?>>
                                    <?= $row['name'] ?>
                                </option>

                                <?php } } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control p_input" value=<?= $product['name']?>>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <input type="text" name="desc" class="form-control p_input"
                                value=<?= $product['description']?>>
                        </div>
                        <div class="form-group">
                            <label>Price</label>
                            <input type="number" name="price" class="form-control p_input"
                                value=<?= $product['price']?>>
                        </div>
                        <div class="form-group">
                            <label>Quantity</label>
                            <input type="number" name="quantity" class="form-control p_input"
                                value=<?= $product['quantity']?>>
                        </div>
                        <div class="form-group">
                            <label>Image</label>
                            <input type="file" name="img" class="form-control p_input">
                            <input type="hidden" name="oldImg" class="form-control p_input"
                                value="<?=$product['img']?>">
                            <img src="<?= "../upload/{$product['img']}"?>" alt="" width="100px">
                        </div>
                        <div class="text-center">
                            <button type="submit" name="updateProduct"
                                class="btn btn-primary btn-block enter-btn">Update</button>
                        </div>

                    </form>
                    <?php }else {
                     header('location:allCategories.php'); 
} ?>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
    </div>
    <!-- row ends -->
</div>

<!-- page-body-wrapper ends -->
</div>

<?php
include "../view/footer.php";
?>