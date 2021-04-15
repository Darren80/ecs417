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

    //Write the post to the database
    $title = $_POST['blog_title'];
    $text = $_POST['blog_text'];
    $date = date("Y-m-d H:m:s");
    $authors = $_POST['authors'];


    $sql = "INSERT INTO `blog` (`blog_title`, `blog_text`, `date_published`, `authors`) VALUES ('$title', '$text', '$date', '$authors')";
    $result = $conn->query($sql);

    if ($result) {
        header('Location: addEntry.php?success=true');
    } else {
        print($conn->error);
    }
?>