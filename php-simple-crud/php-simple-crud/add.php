<?php

session_start();

//including the database connection file
include_once("connector.php");

if(isset($_POST['simpan'])) {
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

    } else {
        $sql = "INSERT INTO user (username, password, email, tgl_lahir)
				VALUES ('$username', '$password', '$email', '$tgl_lahir')";

        if ($conn->query($sql) === TRUE) {
            $_SESSION['message_type'] = 'success';
            $_SESSION['message'] = "Data berhasil disimpan";
        }
        else {
            $_SESSION['message_type'] = 'danger';
            $_SESSION['message']= "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

header('Location: index.php');
?>

