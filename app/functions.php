<?php require "database.php"; ?>
<?php

/** For Validation messages */
function validate($msg,$type = 'danger'){
    return '<div class="alert alert-'.$type.' alert-dismissible fade show" role="alert">
    <strong>'.$msg.'</strong> <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}
function insertdata($sql){
   global $data;
   $data->query($sql);

}

function existValidation($col,$table,$var){
    global $data;
    $sql = "SELECT $col FROM $table WHERE $col ='$var'";
    $edata =  $data-> query($sql);
    return   $edata->num_rows;
}

//function emailCheck($table,$colname,$value){
//    global $data;
//    $sql = "SELECT $colname FROM $table WHERE colname ='$value'";
//    $edata =  $data-> query($sql);
//    return  $user_check=  $edata->num_rows;
//
//}