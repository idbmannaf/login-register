
<?php require "app/autoload.php"; ?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="assest/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assest/css/style.css">

    <style>
        span.input-group-text {
            width: 121px;

        }

        .card.text-white.bg-success.mb-3 {
            margin: 0 auto;
            width: 522px;
        }
    </style>
    <title>Hello, world!</title>

    <?php
    if (isset($_POST['submit'])){
        $login = $_POST['uname'];
        $pass = $_POST['pass'];
        if (empty($login) || empty($pass)){
            $msg = validate('All fields are require!!');
        }
        else{
            global $data;
            $sql ="SELECT * FROM register WHERE Username='$login' OR Email='$login'";
           $login_data =  $data->query($sql);
            $login_nam=  $login_data->num_rows;
        $login_user = $login_data->fetch_assoc();
         if ($login_nam == 1){
             if (password_verify($pass, $login_user['Password'])){

            header('location:profile.php');

             }
             else{
                 $msg = validate('Worng Pasword!!');
             }
         }
         else{
             $msg = validate('Username/Email Incorrec!');
         }
        }
    }
    ?>

</head>

<body>
    <div class="container">
        <div class="card text-white bg-success mb-3">
            <div class="card-header m-auto h3">Login Form</div>
            <div class="card-body">
                <?php if (isset($msg)){echo $msg;}  ?>
                <form action="" method="post", enctype="multipart/form-data">
                <div class="form-group">
                    <label for="uname">Username / Email</label>
                    <input type="text" class="form-control" id="uname" name="uname" placeholder="Username">
                </div>
                <div class="form-group">
                    <label for="pass">Password</label>
                    <input type="password" class="form-control" name="pass" id="pass" placeholder="Password">
                </div>
                <div class="form-group">
                    <input type="submit" class="form-control btn btn-info mt-5" name="submit" value="Login">
                </div>
                <p class="text-white"><a class="text-white" href="registration.php ">Create a New Account</a></p>
                </form>
            </div>
        </div>


        <!-- Optional JavaScript; choose one of the two! -->

        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="assest/js/bootstrap.bundle.min.js"></script>
</body>

</html>