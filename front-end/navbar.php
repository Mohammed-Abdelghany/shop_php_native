<?php
session_start();

if(!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = 'english';
}

if (isset($_GET['lang']) && in_array($_GET['lang'], ['english', 'arabic'])) {
    $_SESSION['lang'] = $_GET['lang'];
}
$lang = "lang/" . $_SESSION['lang'] . ".php";
$translations = include($lang);

?>

<section id="header">
    <a href="index.html">
        <img src="img/logo.png" alt="homeLogo">
    </a>

    <div>
        <ul id="navbar">
            <li class="link">
                <a class="active" href="index.php"></a>
            </li>
            <li class="link">
                <a href="shop.php"><?= $translations['shop']  ?></a>
            </li>
            <li class="link">
                <a href="blog.php"><?= $translations['blog']  ?></a>
            </li>
            <li class="link">
                <a href="about.php"><?= $translations['about']  ?></a>
            </li>
            <li class="link">
                <a href="contact.php"><?= $translations['contact']  ?></a>
            </li>
            <li class="link">
                <a href="signup.php"><?= $translations['signup']  ?></a>
            </li>
            <li class="link">
                <a href="lang/lang.php?lang=english"><?= $translations['language_en']  ?></a>
            </li>
            <li class="link">
                <a href="lang/lang.php?lang=arabic"><?= $translations['language_ar']  ?></a>
            </li>

            <?php
            if (isset($_SESSION['userLoggedIn']) && $_SESSION['userLoggedIn'] == true) {
                echo '<li class="link">
                        <a href="logout.php">' . $translations['logout'] . '</a>
            </li>';
            } else {
                echo '<li class="link">
                <a href="login.php">' . $translations['login'] . '</a>
            </li>';
            }
            ?>

            <li class="link">
                <a id="lg-cart" href="cart.html">
                    <i class="fas fa-shopping-cart"></i>
                </a>
            </li>
            <a href="#" id="close"><i class="fas fa-times"></i></a>
        </ul>
    </div>

    <div id="mobile">
        <a href="cart.html">
            <i class="fas fa-shopping-cart"></i>
        </a>
        <a href="#" id="bar"> <i class="fas fa-outdent"></i> </a>
    </div>
</section>