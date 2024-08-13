<?php
$conn = mysqli_connect('localhost', 'root', '', 'projectrojgar');

if ($conn === false) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    $fullname = $_POST["fname"];
    $phone = $_POST["num"];
    $email = $_POST["email"];
    $city = $_POST["cities"];
    $jobcategory = $_POST["job"];
    $expre = $_POST["ex"];
    $username = $_POST["username"];
    $pass = $_POST["password"];
    $conpass = $_POST["conpass"];
    $address = $_POST["address"];

    // Validate and sanitize inputs
    $fullname = mysqli_real_escape_string($conn, $fullname);
    $phone = mysqli_real_escape_string($conn, $phone);
    $email = mysqli_real_escape_string($conn, $email);
    $city = mysqli_real_escape_string($conn, $city);
    $jobcategory = mysqli_real_escape_string($conn, $jobcategory);
    $expre = mysqli_real_escape_string($conn, $expre);
    $username = mysqli_real_escape_string($conn, $username);
    $address = mysqli_real_escape_string($conn, $address);

    if ($pass === $conpass) {
        // Hash the password before storing it
        $hashedPass = password_hash($pass, PASSWORD_DEFAULT);

        // Prepare the SQL statement with placeholders
        $query = "INSERT INTO workerinfo (fullname, phone, email, city, jobcategory, expre, username, password, address) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        if ($stmt = $conn->prepare($query)) {
            // Bind parameters to the placeholders
            $stmt->bind_param("sssssssss", $fullname, $phone, $email, $city, $jobcategory, $expre, $username, $hashedPass, $address);

            // Execute the prepared statement
            if ($stmt->execute()) {
                // Redirect to another page instead of including HTML file directly
                header("Location: index.html");
                exit();
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
