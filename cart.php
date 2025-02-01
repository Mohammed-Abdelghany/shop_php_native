<?php
include 'front-end/header.php';
include 'front-end/navbar.php';

?>

<?php

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if (isset($_POST['submit']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_id = $_POST['id'];
    $product_name = $_POST['name'];
    $product_price = $_POST['price'];
    $product_image = $_POST['img'];
    $product_description = $_POST['description'];
    $product_quantity = $_POST['quantity'];
    // if(isset($_SESSION['cart'][$product_id])){

    if (isset($_SESSION['cart']) && !in_array($product_id, array_keys($_SESSION['cart']))) {

        $_SESSION['cart'][$product_id] = [
            'id' => $product_id,
            'name' => $product_name,
            'price' => $product_price,
            'img' => $product_image,
            'description' => $product_description,
            'quantity' => $product_quantity,
            'total_price' => $product_price * $product_quantity
        ];
    }
}


if(isset($_POST['remove']) && $_SERVER['REQUEST_METHOD'] == 'POST'){
$product_id = $_POST['id'];
unset($_SESSION['cart'][$product_id]);
}

?>

<section id="page-header" class="about-header">
    <h2>#Cart</h2>
    <p>Let's see what you have.</p>
</section>

<section id="cart" class="section-p1">
    <table width="100%">
        <thead>
            <tr>
                <td>Image</td>
                <td>Name</td>
                <td>Desc</td>
                <td>Quantity</td>
                <td>Price</td>
                <td>Subtotal</td>
                <td>Remove</td>
            </tr>
        </thead>

        <tbody>
            <?php if (empty($_SESSION['cart'])): ?>
            <tr>
                <td colspan="7">Your cart is empty.</td>
            </tr>
            <?php endif; ?>
            <?php foreach ($_SESSION['cart'] as $key => $value) { ?>
            <tr>
                <td><img src="admin/upload/<?= $value['img']; ?>" alt=""></td>
                <td><?= $value['name']; ?></td>
                <td><?= $value['description']; ?></td>
                <td>
                    <?= $value['quantity']; ?>
                </td>
                <td><?= $value['price']; ?></td>
                <td><?= $value['total_price']; ?></td>
                <?php $_SESSION['total'] += $value['total_price'];   ?>
                <td>
                    <form method="POST" action="cart.php">
                        <input type="hidden" name="id" value="<?= $value['id'] ?>">
                        <button type="submit" name="remove" class="btn btn-danger">Remove</button>
                    </form>

                </td>
            </tr>
            <?php  } ?>

        </tbody>
    </table>

    <div id="cart-totals">
        <h3>Cart Totals</h3>
        <table>
            <tr>
                <td>Subtotal</td>
                <td><?= (isset($_SESSION['total']) ? $_SESSION['total'] : 0) ?></td>
            </tr>
            <tr>
                <td>Shipping</td>
                <td><?= (isset($_SESSION['total']) ? $_SESSION['shipping'] = $_SESSION['total'] + 10 : 0) ?></td>
            </tr>
            <tr>
                <td>Tax</td>
                <td>15</td>
            </tr>
            <tr>
                <td><strong>Total</strong></td>
                <td><strong><?= (isset($_SESSION['total']) ? $_SESSION['shipping'] + 15 : 0) ?></strong></td>
            </tr>
        </table>
        <button class="normal">Proceed to Checkout</button>
    </div>
</section>



<?php include "front-end/footer.php"; ?>