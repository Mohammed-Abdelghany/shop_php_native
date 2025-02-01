<?php
include "Front-End/header.php";
include "Front-End/navbar.php";
include "dbConnection.php";
?>

<div class="card-body px-5 py-5" style="background-color:darkgray;">

    <?php
    if (isset($_POST['login'])) {
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);

        $sql_select = "SELECT * FROM users WHERE email='$email'";
        $result = mysqli_query($conn, $sql_select);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $hash_password = $row['password'];
            $role = $row['role'];
            if (password_verify($password, $hash_password) && $role == "user") {
                $_SESSION['userLoggedIn'] = true;
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['name'] = $row['name'];
                header("location:shop.php");
            } elseif (password_verify($password, $hash_password) && $role == "admin") {
                $_SESSION['userLoggedIn'] = true;
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['name'] = $row['name'];
                header("location:admin/view/layout.php");
            } else {
                echo "Invalid email or password";
            }
        } else {
            echo "email is not exist";
        }
    }

    ?>



    <h3 class="card-title text-left mb-3">Login</h3>
    <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
        <div class="form-group">
            <label>email *</label>
            <input type="text" name="email" class="form-control p_input">
        </div>
        <div class="form-group">
            <label>Password *</label>
            <input type="text" name="password" class="form-control p_input">
        </div>
        <div class="form-group d-flex align-items-center justify-content-between">
            <div class="form-check">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input"> Remember me </label>
            </div>
            <a href="forgetPassword.php" class="forgot-pass">Forgot password</a>
        </div>
        <div class="text-center">
            <button type="submit" name="login" class="btn btn-primary btn-block enter-btn">Login</button>
        </div>
        <div class="d-flex">
            <button class="btn btn-facebook me-2 col">
                <i class="mdi mdi-facebook"></i> Facebook </button>
            <button class="btn btn-google col">
                <i class="mdi mdi-google-plus"></i> Google plus </button>
        </div>
        <p class="sign-up">Don't have an Account?<a href="signup.php"> Sign Up</a></p>
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

<?php include "Front-End/footer.php" ?>