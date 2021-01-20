
<?php require "app/functions.php"; ?>

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
    if (isset($_POST['submit'])) {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $pass = $_POST['pass'];
        $cpass = $_POST['cpass'];
        $uname = $_POST['uname'];
        $company = $_POST['company'];
        $email = $_POST['email'];
        $code = $_POST['code'];
        $tel = $_POST['number'];
        $sex = $_POST['gen'];
 

        $status ='disagree';
if (isset($_POST['status'])) {
    $status = $_POST['status'];
    
}
//Email Queiry
        $email_check = existValidation('email','register',$email);
//        emailCheck("register","email",$email);

//Username Queiry
        $user_check = existValidation('Username','register',$uname);
//File Upload
        $file = $_FILES['upload'];

//Phone Number Queiry

        $hash_pass = password_hash($pass, PASSWORD_DEFAULT);
        $areacode = str_pad($code, strlen($code) + 1, "+", STR_PAD_LEFT);
        $phone = $areacode . "-" . $tel;
        $phone_check = existValidation('Phone','register',$phone);


        // if (empty($fname) || empty($lname) || empty($pass) || empty($uname) || empty($company) || empty($email) || empty($code) || empty($tel) || empty($sex)) {
        //    $msg = validate('All fill requered!');
        // }



        if (strlen($fname) < 1) {
            $msg = validate('First Name Missing');
        } elseif (strlen($lname) < 1) {
            $msg = validate('Last Name mising!');
        } elseif (empty($uname)) { // && strlen($title) >60 
            $msg = validate('Username Missing!!');
        }
        elseif ($user_check > 0){
            $msg = validate('username Already exist!');
        }
        //for password
        elseif (empty($pass)) {
            $msg = validate('Password Missing!!');
        } elseif ($pass != $cpass) {
            $msg = validate('Password Not Match!');
        } elseif (empty($company)) {
            $msg = validate('Company Name Missing!');
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $msg = validate('Email Not valid!');
        }
        elseif ($email_check > 0){
            $msg = validate('Email Already exist!');
        }
        // OMG! for area code only >>>>Start<<<<<
        elseif (!preg_match('[\d]', $code) || strlen($code) > 4) {
            $msg = validate('Invalid area code. (less then 4 ) ex..+880!');
        }
        // OMG! for area code only >>>>End<<<<<

        elseif ((strspn($tel, "1234567890") != strlen($tel) < 15)) {
            // array_push($error,"should be number"); 
            $msg = validate('Mobile number no more then 14 !');
        }
        elseif ($phone_check > 0){
            $msg = validate('Phone Number Already exist!');
        }
        elseif ($status == 'disagree') {
            $msg = validate('You should agree first !!!');
        }
       
         else {
            if (!isset($msg)) {

               insertdata("insert into register values(NULL, '" . $fname . "', '" . $lname . "','" . $uname . "','" . $hash_pass . "', '" . $email . "', '" . $company . "','" . $phone . "', '" . $sex . "', NULL)");
                // File Upload
                    move_uploaded_file($file['tmp_name'],"files/".rand(1000,2000).'_'.$file['name']);
                $msg = validate('Registration Sucsessful','success');
                header('location:login_form.php');
                
            }
        }
    }

    ?>
</head>

<body>
    <div class="container">
        <div class="card text-white bg-success mb-3">
            <div class="card-header m-auto h3">Form Validation</div>
            <div class="card-body">
                
                <?php if (isset($msg)) { echo $msg;} ?>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                    <div class="input-group">
                        <span class="input-group-text">First Name</span>
                        <input type="text" name="fname" class="form-control" placeholder="David" value="<?php echo $fname ?? "" ?>">

                        <span class="input-group-text">last name</span>
                        <input type="text" name="lname" class="form-control" placeholder="Andrea" value="<?php echo $lname ?? "" ?>">
                    </div>
                    <div class="input-group mb-3 mt-3">
                        <span class="input-group-text">Username</span>
                        <input type="text" class="form-control" placeholder="Username.." name="uname" value="<?php echo $uname ?? "" ?>">
                    </div>
                    <div class="input-group mb-3 mt-3">
                        <span class="input-group-text">Password</span>
                        <input type="password" class="form-control" placeholder="Password.." name="pass">
                    </div>
                    <div class="input-group mb-3 mt-3">
                        <span class="input-group-text">Confirmation Password</span>
                        <input type="password" class="form-control" placeholder="Confirmation Password.." name="cpass">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Company</span>
                        <input type="text" class="form-control" name="company" placeholder="AtoZ Company LTD" value="<?php echo $company ?? "" ?>">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Email</span>
                        <input type="email" class="form-control" name="email" placeholder="example@example.com" value="<?php echo $email ?? "" ?>">
                    </div>
                    <div class="input-group">
                        <span class="input-group-text">Phone Number</span>
                        <input type="text" id="code" name="code" placeholder="880" class="form-control col-md-1" value="<?php echo $code ?? "" ?>">
                        <input type="number" name="number" placeholder="174587885" class="form-control" value="<?php echo $tel ?? "" ?>">
                    </div>


                    <div class="form-check mt-3">
                        <input class="form-check-input" id="male" type="radio" value="Male" name="gen">
                        <label class="form-check-label" for="male">
                            Male
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="female" value="Female" name="gen" checked>
                        <label class="form-check-label" for="female">
                            Female
                        </label>
                    </div>
                    <div class="form-group">
                        <input type="file" name="upload">
                    </div>
                    <div class="form-group">
                        <input name="status" value="Agree" type="checkbox" id="agree">
                        <label for="agree"> I agree all </label>
                    </div>
                    <input class="btn btn-primary mt-3" type="submit" value="Submit" name="submit">
                    <p class="text-white"><a class="text-white" href="index.php ">Login Here</a></p>
                </form>
            </div>
        </div>


        <!-- Optional JavaScript; choose one of the two! -->

        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="assest/js/bootstrap.bundle.min.js"></script>
</body>

</html>