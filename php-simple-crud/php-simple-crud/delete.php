<?php

session_start();

//including the database connection file
include_once("connector.php");

if(isset($_GET['id'])) {

    $id = $_GET['id']; 
    
    $sql = "DELETE FROM user WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['message_type'] = 'success';
        $_SESSION['message'] = "Data berhasil dihapus";
        header('Location: index.php');
    }
    else {
        $_SESSION['message_type'] = 'danger';
        $_SESSION['message']= "Error: " . $sql . "<br>" . $conn->error;
        header('Location: edit.php?id=$id');
    }
}

?>

