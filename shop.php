<?php include 'Front-End/header.php'; ?>
<?php include 'Front-End/navbar.php'; ?>
<?php include "dbConnection.php"; ?>

<section id="product1" class="section-p1">
    <h2>Featured Products</h2>
    <p>Summer Collection New Modern Design</p>
    <div class="pro-container">

        <?php

        $product_per_page = 3;
        $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
        $offset = ($current_page - 1) * $product_per_page;

        $sql = "SELECT * from Products LIMIT $offset,$product_per_page";
        $result = mysqli_query($conn, $sql);

        //Total Products
        $Total_Products = "SELECT count(*) as total from Products";
        $Total_result = mysqli_query($conn, $Total_Products);
        $total_number = mysqli_fetch_assoc($Total_result)['total'];
        $total_pages = ceil($total_number / $product_per_page);


        if (mysqli_num_rows($result) > 0) {
            $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
            foreach ($data as $row) {
        ?>

        <div class="pro">
            <img src="admin/upload/<?= $row['img'] ?>" alt="p1" />
            <div class="des">
                <h2><?= $row['name'] ?></h2>
                <h5><?= $row['price'] ?></h5>
                <div class="star">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <h4><?= $row['description'] ?></h4>
                Stock: <label for="quantity"><?= $row['quantity'] ?></label>


                <form method="POST" action="cart.php">
                    <input type="number" name="quantity" value="1" min="1" max="<?= $row['quantity'] ?>">
                    <input type="hidden" value="<?= $row['id'] ?>" name="id">
                    <input type="hidden" value="<?= $row['name'] ?>" name="name">
                    <input type="hidden" value="<?= $row['price'] ?>" name="price">
                    <input type="hidden" value="<?= $row['description'] ?>" name="description">
                    <input type="hidden" value="<?= $row['img'] ?>" name="img">
                    <input type="hidden" value="<?= $row['img'] ?>" name="img">
                    <button type="submit" name="submit" class="cart w-20"> <i class="fas fa-shopping-cart "></i>
                    </button>
                </form>

            </div>
        </div>

        <?php
            }
        }
        ?>

    </div>
</section>

<section id="pagination" class="section-p1">
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item <?= $current_page == 1 ? 'disabled' : '' ?>">
                <a class="page-link" href="?page=<?= $current_page - 1  ?>" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <?php for ($i = 1; $i <= $total_pages; $i++):  ?>
            <li class="page-item <?= $current_page == $i ? 'active' : '' ?> ">
                <a class="page-link" href="?page=<?= $i  ?>">
                    <?= $i  ?>

                </a>

            </li>
            <?php endfor ?>
            <li class="page-item <?= $current_page == $total_pages ? 'disabled' : '' ?>">
                <a class="page-link" href="?page=<?= $current_page + 1  ?>" aria-label="NEXT">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
        </ul>
    </nav>
</section>

<section id="newsletter" class="section-p1 section-m1">
    <div class="newstext">
        <h4>Sign Up For Newsletters</h4>
        <p>Get E-mail Updates about our latest shop and <span class="text-warning">Special Offers.</span></p>
    </div>
    <div class="form">
        <input type="text" placeholder="Enter Your E-mail...">
        <button class="normal">Sign Up</button>
    </div>
</section>

<?php include 'Front-End/footer.php'; ?>