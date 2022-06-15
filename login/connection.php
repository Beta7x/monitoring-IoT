<?php
$servername = "localhost";
$database = "monitoring";
$username = "root";
$password = "sudo./root";

// Create connection

$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// mysqli_close($conn);

function registration($data) {
    global $conn;
    
    $username = strtolower(stripslashes($data['username']));
    $password = mysqli_real_escape_string($conn, $data['password']);
    $password2 = mysqli_real_escape_string($conn, $data['password2']);

    // checking username if exists in database
    $result = mysqli_query($conn, "SELECT username FROM users WHERE username = '$username'");
    if (mysqli_fetch_assoc($result)) {
        echo "<script>
                alert('username sudah terdaftar!');
                </script>";
        return false;
    }

    // confirmations area
    if ($password !== $password2) {
        echo "<script>
                alert('Konfirmasi password tidak sesuai!');
                </script>";
        return false;
    }

    // password encryption
    $password = password_hash($password, PASSWORD_DEFAULT);

    // adding new user
    mysqli_query($conn, "INSERT INTO users(username, password) VALUES('$username', '$password')");
    
    return mysqli_affected_rows($conn); 
}

?>