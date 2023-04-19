<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $lastname = $_POST["lastname"];
    $firstname = $_POST["namefirst"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Perform validation and database operations
    // For example, you can check if the fields are not empty,
    // validate email format, and insert the data into a database.
    
    // Example validation
    if (empty($lastname) || empty($firstname) || empty($email) || empty($password)) {
        echo "All fields are required!";
    } else {
        // Insert data into the database or perform other operations
        // Here, you can use database libraries or functions to perform database operations
        // For example, you can use PDO or MySQLi to connect to a MySQL database

        // Inserting data into a MySQL database using PDO with prepared statements and bind parameters
        // Replace DB_HOST, DB_NAME, DB_USER, and DB_PASSWORD with your database credentials
        $conn = new PDO("mysql:host=DB_HOST;dbname=DB_NAME", "DB_USER", "DB_PASSWORD");
        $stmt = $conn->prepare("INSERT INTO sign_up (lastname, firstname, email, password) VALUES (?, ?, ?)");
        $stmt->bindParam(1, $username);
        $stmt->bindParam(2, $email);
        $stmt->bindParam(3, $password);

        if ($stmt->execute()) {
            echo "Sign up successful!";
        } else {
            echo "Error inserting data into the database.";
        }
    }
}
?>
