<?php
$sql = "INSERT INTO USERS (username, password, first_name, last_name, email_address) VALUES ('dan', 'bbc', 'tammy', 'nickles', '$email_address')";
    if ($conn->query($sql)) {
        echo "User registered.";
}
?>