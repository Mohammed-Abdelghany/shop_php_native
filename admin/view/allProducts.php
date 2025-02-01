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
if(isset($_POST["deleteProduct"])){
    if(isset($_GET["id"]) && $_GET["id"] != ''){
        $id = $_GET["id"];
        $sql = "DELETE FROM products WHERE id=$id";
        if (mysqli_query($conn, $sql)) {
          unlink("../upload/{$_POST['imgName']}");
            echo "product deleted successfully";
        } else {
            echo "Error deleting product: ". mysqli_error($conn);
        }
    } else {
        echo "product not found";
    }
    
}

$sql = "SELECT `products`.*, `category`.`name` as catName 
FROM `products` JOIN `category` 
ON `cat_id` = `category`.`id`
ORDER BY  `products`.`id`;";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
      $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
    //   echo "<pre>";
    //   print_r($data);
    //id	title	desc	price	quantity	image	category_id	created_at	
    // echo "<pre>";
    // print_r($data);
    // die();  
?>

            <table class="table table-dark">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Describtion</th>
                        <th scope="col">price</th>
                        <th scope="col">quantity</th>
                        <th scope="col">image</th>
                        <th scope="col">category</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
      
      foreach( $data as $product ): ?>
                    <tr>
                        <th scope="row"><?= $product['id'] ?></th>
                        <td><?= $product['name'] ?></td>
                        <td><?= $product['description'] ?></td>
                        <td><?= $product['price'] ?></td>
                        <td><?= $product['quantity'] ?></td>
                        <td><img src="../upload/<?= $product['img'] ?>"></td>
                        <td><?= $product['name'] ?></td>
                        <td><?= $product['created_at'] ?></td>
                        <td>
                            <a href="updateProduct.php?id=<?= $product['id'] ?>"><button type="button"
                                    class="btn btn-outline-success btn-sm">Edit</button></a>
                            <form action="allProducts.php?id=<?= $product['id']?>" method="post"
                                style="display: inline;">
                                <input type="hidden" name="imgName" class="form-control p_input"
                                    value="<?=$product['img']?>">
                                <button type="submit" class="btn btn-outline-danger btn-sm"
                                    name="deleteProduct">Delete</button>
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