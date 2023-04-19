<?php
include('conn.php');

if(isset($_POST['submit'])) {
    $lname = $_POST['FirstName'];
    $fname = $_POST['LastName'];
    $email = $_POST['Email'];
    $password = sha1($_POST['Password']);

    // Check if email already exists in the database
    $stmt = $conn->prepare("SELECT * FROM sign_up WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $count = mysqli_num_rows($result);

    // If email already exists, display an error message
    if($count > 0) {
        echo "<script>alert('Email already exists in the database!');</script>";
    } else {
        // If email does not exist, insert data into the database
        $stmt = $conn->prepare("INSERT INTO sign_up ( lastname, firstname, email, Password)
                VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $lname, $fname, $email, $password);
        if($stmt->execute()) {
            header("location:signup.html");
            echo "<script>alert('Data saved successfully!');</script>";
        } else {
            echo "Error: " . $stmt->error;
        }
    }
}


if(isset($_POST['login'])){
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $password = sha1($password);

    $stmt = $conn->prepare("SELECT * FROM users WHERE Email=? and Password=?");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    $num = mysqli_num_rows($result);

    if($num>0){
        $_SESSION['email'] = $email;
        header("location:../Pages/index.html");
    }else{
        echo"<script>alert('something went wrong try again')</script>";
    }
}

?>