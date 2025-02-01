<?php
include "Front-End/header.php";
include "Front-End/navbar.php";
include "dbConnection.php";
?>


<div class="card-body px-5 py-5 " style="background-color:darkgray;">

    <?php
    //mysqli_fetch_row ----> return one row
    //mysqli_fetch_all  ---> return all rows    
    ////mysqli_fetch_array  ---> return one row (ASSOCIATIVE ARRAY)

    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $hash_password = password_hash($password, PASSWORD_BCRYPT);
        $phone = $_POST['phone'];
        $sql_select = "SELECT * FROM users WHERE email='$email'";
        $result_select = mysqli_query($conn, $sql_select);
        if (mysqli_num_rows($result_select) > 0) {

            echo "Email already exist";
        } else {
            $sql = "INSERT INTO users(name,email,password,phone) VALUES('$name','$email','$hash_password','$phone')";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                echo "Data inserted successfully";
            } else {
                echo "invalid User";
            }
        }
    }

    ?>

    <h3 class="card-title text-center mb-3">Register</h3>
    <form id="signupForm" method="post" class="col-4 mx-auto">
        <div class="form-group">
            <label>Username</label>
            <input type="text" name="name" class="form-control p_input" id="name" value="">
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control p_input" id="email">
        </div>
        <div class=" form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control p_input" id="password">

        </div>
        <div class="form-group">
            <label>Phone</label>
            <input type="text" name="phone" class="form-control p_input" id="phone">
        </div>

        <div class="form-group d-flex align-items-center justify-content-between">
            <div class="form-check">

                <div class="text-center mt-4">
                    <button type="submit" name="submit" class="btn btn-primary btn-block enter-btn">Signup</button>
                </div>
                <div class="d-flex">
                    <button class="btn btn-facebook col me-2">
                        <i class="mdi mdi-facebook"></i> Facebook </button>
                    <button class="btn btn-google col">
                        <i class="mdi mdi-google-plus"></i> Google plus </button>
                </div>
                <p class="sign-up text-center">Already have an Account?<a href="login.php"> Login</a></p>
                <p class="terms">By creating an account you are accepting our<a href="#"> Terms & Conditions</a></p>
    </form>
    <!-- <form id="signupForm">
        <input type="text" id="name" placeholder="Full Name" required>
        <input type="email" id="email" placeholder="Email" required>
        <input type="password" id="password" placeholder="Password" required>
        <input type="text" id="phone" placeholder="Phone Number" required>
        <button type="submit" id="submit">Signup</button> <!-- This button submits the form -->
    <!-- </form> -->
    <!-- <script>
    document.getElementById('signupForm').addEventListener('submit', function(event) {
        event.preventDefault();
        console.log('Form submitted'); // Debugging line

        const name = document.getElementById('name').value;
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;
        const phone = document.getElementById('phone').value;

        const data = {
            name: name,
            email: email,
            password: password,
            phone: phone
        };

        console.log('Data to send:', data); // Debugging line

        fetch('http://localhost/test/index.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(data => {
                alert(data.message || data.error);
            })
            .catch(error => {
                console.error('Error:', error);
            });
    });
    </script> -->
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


<!-- regex 

  $regex = /^01[0,1,2,5][0-9]{8}$/

  preg_match($regex,) 
  
  -->