<?php

session_start();

//including the database connection file
include_once("connector.php");

if(isset($_POST['update'])) {
    // $username = mysqli_real_escape_string($mysqli, $_POST['username']);
    // $password = mysqli_real_escape_string($mysqli, $_POST['password']);
    // $email = mysqli_real_escape_string($mysqli, $_POST['email']);
    // $tgl_lahir = mysqli_real_escape_string($mysqli, $_POST['tgl_lahir']);

    $id = $_POST['id'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$email = $_POST['email'];
	$tgl_lahir = $_POST['tgl_lahir'];

    // checking empty fields
    if(empty($username) || empty($password) || empty($email) || empty($tgl_lahir)) {

        $_SESSION['message_type'] = 'danger';

        if(empty($username)) {
            $_SESSION['message']="- Username tidak diisi";
        }

        if(empty($password)) {
            $_SESSION['message'].="<br> - Password tidak diisi";
        }

        if(empty($email)) {
            $_SESSION['message'].="<br> - Email tidak diisi";
        }

        if(empty($tgl_lahir)) {
            $_SESSION['message'].="<br> - Tanggal lahir tidak diisi";
        }

        header('Location: edit.php?id=$id');

    } else {
        $sql = "UPDATE user SET 
                username='$username', password='$password', email='$email',
                tgl_lahir='$tgl_lahir'
                WHERE id=$id";

        if ($conn->query($sql) === TRUE) {
            $_SESSION['message_type'] = 'success';
            $_SESSION['message'] = "Data berhasil diubah";
            header('Location: index.php');
        }
        else {
            $_SESSION['message_type'] = 'danger';
            $_SESSION['message']= "Error: " . $sql . "<br>" . $conn->error;
            header('Location: edit.php?id=$id');
        }
    }
}


?>

