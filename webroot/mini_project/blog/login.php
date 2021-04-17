<?php
    $dbhost = getenv("MYSQL_SERVICE_HOST");
    $dbport = getenv("MYSQL_SERVICE_PORT");
    // $dbuser = "root";
    // $dbpwd = "";
    // $dbname = "app_data";
    $dbuser = getenv("DATABASE_USER");
    $dbpwd = getenv("DATABASE_PASSWORD");
    $dbname = getenv("DATABASE_NAME");

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

    $sql = "SELECT * FROM `USERS` WHERE BINARY username='$username' AND BINARY password='$password'";
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
        
<?php    } else { ?>
            <h2>Sorry, your username or password was incorrect please try again.</h2>
<?php    } ?>
    
