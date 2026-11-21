<?php

session_start();
include 'db.php';

if (isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username == "" || $password == "") {

        $error = "Please fill in all fields.";

    } else if ($username == "admin" && $password == "admin123") {

        $_SESSION['username'] = $username;
        header("Location: index.php");
        exit();

    } else {

        $sql = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $sql->bind_param("s", $username);
        $sql->execute();

        $user = $sql->get_result()->fetch_assoc();

if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['email'];

            header("Location: index.php");
            exit();

        } else {

            $error = "Invalid username or password.";

        }
    }
}
?>

<h2>STUDENT GRADING SYSTEM</h2>

<h3>Login</h3>

<?php
if (isset($error)) {
    echo "<p style='color:red;'>$error</p>";
}
?>

<form method="post">

    <label>Email:</label>
    <input type="text" name="username" placeholder="Enter email">
    <br><br>

    <label>Password:</label>
    <input type="password" name="password" placeholder="Enter password">
    <br><br>

    <button type="submit" name="login">Login</button>

</form>