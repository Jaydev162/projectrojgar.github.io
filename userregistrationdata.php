<?php
$conn = mysqli_connect('localhost', 'root', '', 'projectrojgar');

if ($conn === false) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    $fullname = $_POST["fname"];
    $phone = $_POST["num"];
    $email = $_POST["email"];
    $username = $_POST["username"];
    $pass = $_POST["password"];
    $conpass = $_POST["conpass"];
    $city = $_POST["cities"];
    $address = $_POST["address"];

    if ($pass === $conpass) {
        // Hash the password before storing it
        $hashedPass = password_hash($pass, PASSWORD_DEFAULT);

        // Prepare the SQL statement with placeholders
        $query = "INSERT INTO userinfo (fullname, phone, email, username, password, city, address) VALUES (?, ?, ?, ?, ?, ?, ?)";
        if ($stmt = $conn->prepare($query)) {
            // Bind parameters to the placeholders
            $stmt->bind_param("sisssss", $fullname, $phone, $email, $username, $hashedPass, $city, $address);

            // Execute the prepared statement
            if ($stmt->execute()) {
                echo "Registration successful!";
                include "index.html";
            } else {
                echo "Error: " . $stmt->error;
            }

            // Close the statement
            $stmt->close();
        } else {
            echo "Error preparing the statement: " . $conn->error;
        }
    } else {
        echo "Your passwords do not match. Please confirm the password.";
    }

    // Close the connection
    $conn->close();
}
?>
