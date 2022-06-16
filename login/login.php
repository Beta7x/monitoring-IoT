<?php
session_start();

require 'connection.php';

if (isset($_POST["login"])) {
	$username = $_POST["username"];
	$password = $_POST["password"];

	$result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");

    // cheking username
    if (mysqli_num_rows($result) === 1) {
        // cheking password
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["password"])) {
            // create new login session
            $_SESSION["login"] = true;
            header("Location: ../index.php");
            exit();
        }
    } else {
        header("Location: index.html");
        $error = true;
    }
}

?>
