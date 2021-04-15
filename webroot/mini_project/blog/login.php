<?php
    $dbhost = getenv("MYSQL_SERVICE_HOST");
    $dbport = getenv("MYSQL_SERVICE_PORT");
    $dbuser = "root";
    $dbpwd = "";
    $dbname = "app_data";
    // $dbuser = getenv("DATABASE_USER");
    // $dbpwd = getenv("DATABASE_PASSWORD");
    // $dbname = getenv("DATABASE_NAME");

    //Connect to db
    $conn = new mysqli($dbhost, $dbuser, $dbpwd, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
        //echo "Database connection successful.";
    }

    //Process form data
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM `users` WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if($result -> num_rows > 0) {
        //login success
        session_start();
        $_SESSION['name'] = $username;
        $_SESSION['user_status'] = "loggedin";
        $_SESSION['background-colour'] = "purple";

        header("Location: addEntry.php");
    } else {
        //login failure
        echo $conn->error;
    }

    if (isset($_SESSION["username"])) { ?>
        <a>Add Post</a>
<?php    } else { ?>
        <a>Login</a>
        <a>Sign up</a>
<?php    } ?>
    
