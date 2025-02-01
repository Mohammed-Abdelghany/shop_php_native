<?php

include "../view/header.php";
include "../view/sidebar.php";
include "../view/navbar.php";
include "../../dbConnection.php";
?>



<div class="container-fluid page-body-wrapper full-page-wrapper">
    <div class="row w-100 m-0">
        <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
            <?php
if(isset($_POST["deleteCategory"])){
    if(isset($_GET["id"]) && $_GET["id"] != ''){
        $id = $_GET["id"];
        $sql = "DELETE FROM category WHERE id=$id";
        if (mysqli_query($conn, $sql)) {
            echo "Category deleted successfully";
        } else {
            echo "Error deleting category: ". mysqli_error($conn);
        }
    } else {
        echo "category not found";
    }
    
}

$sql = "SELECT * FROM category";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
      $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
    //   echo "<pre>";
    //   print_r($data);
?>

            <table class="table table-dark">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach( $data as $cat ): ?>
                    <tr>
                        <th scope="row"><?= $cat['id'] ?></th>
                        <td><?= $cat['name'] ?></td>
                        <td><?= $cat['created_at'] ?></td>
                        <td>
                            <a href="updateCategory.php?id=<?= $cat['id'] ?>"><button type="button"
                                    class="btn btn-outline-success btn-sm">Edit</button></a>
                            <form action="allCategories.php?id=<?= $cat['id']?>" method="post" style="display: inline;">
                                <button type="submit" class="btn btn-outline-danger btn-sm"
                                    name="deleteCategory">Delete</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php } else {
    echo "categories not found";
} ?>
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