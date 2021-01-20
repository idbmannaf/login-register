<?php
if (isset($_POST['submit'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $files = $_FILES['upload'];
       move_uploaded_file($files['tmp_name'],"files/".$files['name']);

}
?>


<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <title>File Upload</title>
    <style>
        html, .background{
            background-color: #8080802b;
        }
      .file_form{
          width: 300px;
          background-color: #f7f7f7;

      }
        input#name, input#email{
        background-color: transparent;

      }
    </style>
</head>
<body>
<div class="background ">
<div class="container ">
<div class="file_form m-auto mt-5">
    <div class="card card-info mb-3">
        <h3 class="card-header m-auto">Upload Your File</h3>
    </div>
    <form action="" METHOD="post" ENCTYPE="multipart/form-data">
    <div class="form-group">
    <lable class="ms-2 h5" for="name">Name</lable>
        <input class="form-control" type="text" placeholder="type your name" id="name" name="name" required>
    </div>
        <div class="form-group">
            <lable class="h5 ms-2" for="email">Email</lable>
            <input class="form-control" type="email" placeholder="type your name" id="email" name="email" required>
        </div>
        <div class="form-group mt-3 ms-2">
            <input type="file" placeholder="Upload Your file" id="upload" name="upload" required>
        </div>
        <input class="mt-4 form-control btn btn-info" type="submit" name="submit" value="Submit">

    </form>
</div>


</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

</body>
</html>