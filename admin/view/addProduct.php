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

                <?php

        if (isset($_POST['addProduct'])) {

            $category = $_POST['category'];
            $title = $_POST['title'];
            $desc = $_POST['desc'];
            $price = $_POST['price'];
            $quantity = $_POST['quantity'];
            $filename = $_FILES["img"]["name"];
            $tempname = $_FILES["img"]["tmp_name"];   //--> from
            $folder = "../imgs/" . $filename;  // --> to
            $sql_catID="SELECT `id` FROM `category` WHERE `name` = '$category'";
             $result_catID = mysqli_query($conn, $sql_catID);

            $row_catID = mysqli_fetch_array($result_catID, MYSQLI_ASSOC);
            $catID = $row_catID['id'];
         
          $sql = "INSERT INTO `products`( `name`, `description`, `price`, `quantity`, `img`,`cat_id`) VALUES ('$title','$desc','$price','$quantity','$filename','$catID')";
          $insertData = mysqli_query($conn, $sql);
          if($insertData)
          {
            move_uploaded_file($tempname, $folder);
            echo "Product Added";
          }
          else
          {
            echo "Product Not Added";
          }


        }
        ?>
                <div class="card-body px-5 py-5">
                    <h3 class="card-title text-left mb-3">Add Product</h3>
                    <form method="POST" action="addProduct.php" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Category</label>
                            <input type="text" name="category" class="form-control p_input">
                        </div>
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control p_input">
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <input type="text" name="desc" class="form-control p_input">
                        </div>
                        <div class="form-group">
                            <label>Price</label>
                            <input type="number" name="price" class="form-control p_input">
                        </div>
                        <div class="form-group">
                            <label>Quantity</label>
                            <input type="number" name="quantity" class="form-control p_input">
                        </div>
                        <div class="form-group">
                            <label>Image</label>
                            <input type="file" name="img" class="form-control p_input">
                        </div>
                        <div class="text-center">
                            <button type="submit" name="addProduct"
                                class="btn btn-primary btn-block enter-btn">Add</button>
                        </div>

                    </form>
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