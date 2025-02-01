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


    if (isset($_POST['updateCategory'])) {
        $title = $_POST['title'];
        if(empty($title)) {
            $error = 'title is required';
        }

        if(empty($error)) {
        $sql = "UPDATE `category` SET `name`='$title' WHERE `id`=$id";
        $result = mysqli_query($conn, $sql);
        if ($result) {
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

      
$sql = "SELECT * FROM category WHERE `id`=$id";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
  $data = mysqli_fetch_assoc($result);
?>
                    <form method="POST" action="updateCategory.php?id=<?= $id ?>">
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control p_input text-light"
                                value="<?= $data['name']?>">
                        </div>
                        <div class="text-center">
                            <button type="submit" name="updateCategory"
                                class="btn btn-primary btn-block enter-btn">Add</button>
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