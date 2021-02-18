<?php
require("includes/functions.inc.php");

if(isset($_GET['id'])){

    //DELETE the contact with this id
    $id = $_GET['id'];

    $rows = db_select("SELECT * FROM contacts where id = $id");
    if($rows === false)
    {
        $error = db_error();
        dd($error);
    }
}

//Found the user which has to be deleted!
$image_name = $rows[0]['image_name'];
unlink("images/users/$image_name");

//Query TO DELETE the contact

$sql = "DELETE FROM contacts where id = $id";
/*
function db_query($query)
{
    $connection = db_connect();
    if($connection)
    {
        $result = mysqli_query($connection, $query);
        return $result;
    }
    return false;
}*/

$result = db_query($sql);
if($result){
    header("Location: index.php?q=success"); //Syntax must be Location: can't be location : or etc.....
}else{
    header("Location: index.php?q=error&op=delete");
}
