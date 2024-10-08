<?php

//database
$servername = "localhost";
$username = "root";
$password = "hopenduta26"; 
$dbname = "taskappdb";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("INSERT INTO users (name, email) VALUES (?, ?)");
$stmt->bind_param("ss", $user_name, $email);

if ($stmt->execute()) {
    echo "New user inserted successfully!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();


$email = $_POST['email']; 
$user_name = $_POST['name'];

if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $to = $email;
    $subject = "Welcome to Task App!";
    $message = "Hello " . $user_name . ", welcome to our Task App!";
    $headers = "From: no-reply@taskapp.com";
    
    if (mail($to, $subject, $message, $headers)) {
        echo "Email successfully sent to $user_name!";
    } else {
        echo "Failed to send email.";
    }
} else {
    echo "Invalid email address.";
}

?>

<html>
<form action="mail.php" method="post">
    Name: <input type="text" name="name"><br>
    Email: <input type="text" name="email"><br>
    <input type="submit" value="Sign Up">
</form>
</html>