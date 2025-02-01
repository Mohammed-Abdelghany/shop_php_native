<?php

include "../view/header.php";
include "../view/sidebar.php";
include "../view/navbar.php";
include "../../dbConnection.php";
?>

<?php
if(isset($_POST['addCategory']))
{
  $name = $_POST['name'];
  $sql = "INSERT INTO `category`(`name`) VALUES ('$name')";
  $insertData = mysqli_query($conn, $sql);
  if($insertData)
  {
    echo "Category Added";
  }
  else
  {
    echo "Error";
  }
} 

?>

<div class="card-body px-5 py-5">
    <h3 class="card-title text-left mb-3">Add Category</h3>
    <form method="POST" action="addCategory.php">
        <div class="form-group">
            <label>Title</label>
            <input type="text" name="name" class="form-control p_input text-light">
        </div>
        <div class="text-center">
            <button type="submit" name="addCategory" class="btn btn-primary btn-block enter-btn">Add</button>
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