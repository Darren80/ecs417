<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="reset.css">
    <link rel="stylesheet" href="navigation_bar.css">

    <link rel="stylesheet" href="blog_style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,700;1,400;1,700&family=Pacifico&display=swap"
        rel="stylesheet">
</head>

<body>

    <header>
        <nav>

            <img id="logo" src="img/my_logo.png" alt="Logo" title="Logo">

            <ul>
                <li><a href="index.html">Who am I</a></li>
                <li><a href="index.html#contact_me">Let's Talk</a></li>
                <li><a href="skills_experience.html#flex_experience">Skills and Experience</a></li>
                <li><a href="skills_experience.html#education">Qualifications and Education</a></li>
                <li><a href="">Portfolio</a></li>
                <li><a href="blog.html">Blog</a></li>

            </ul>
        </nav>
    </header>

    <div id="container">
        <div id="main">

            <h1 class="title">Entries</h1>

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

                $sql = "SELECT * FROM `blog`";
                $result = $conn->query($sql);

                //MULTIDIMENSIONAL ARRAY SORTING
                function sortByDate($rows)
                {
                    usort($rows, function($a, $b) {
                        return $a['date_published'] <=> $b['date_published'];
                    });
                    return $rows;
                }

                if ($result->num_rows > 0) {

                    $rows = [];

                    while ($row = $result->fetch_assoc()) {
                        $rows[] = $row;
                    }

                    $rows = sortByDate($rows); //SORT POSTS BY SOMETHING (LIKE DATE)

                    foreach ($rows as &$row) {
                        $title = $row["blog_title"]; $text = $row["blog_text"];  $date_published = $row["date_published"];

                        //PRINTS THE BLOG POSTS TO HTML
                        print("<article>");
                        print("<p class=\"date_published\">Date published: $date_published</p>");
                        print("<h2 class=\"blog_title\">$title</h2>");
                        print("<p class=\"blog_text\">$text</p>");
                        print("</article>");
                        print("<br>");
                    }
                        
                }

                $conn->close();
            ?>

        </div>
        <aside id="sidebar" class="vertical_bar">
            
            <form id="login_form" method="POST" action="blog/login.php">
                <fieldset>
                    <legend>Login</legend>
                    
                    <div>
                        <label for="username">Username:</label>
                        <input type="text" id="username" name="username" autocomplete="username" placeholder="username"
                            required>
                    </div>
                    <div>
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" placeholder="password" autocomplete="current-password" required>
                    </div>
                    <div>
                        <label for="remember_me">Remember this device:</label>
                        <input type="checkbox" id="remember_me" name="remember_me">
                    </div>

                    <button type="submit">Login</button>
                </fieldset>
            </form>

            <?php
                        session_start();

                        if (isset($_SESSION['user_status'])) { 
                            $name = $_SESSION['name'];
                            print("<p id=\"login_message\">Welcome back, $name</p>");
                            //print_r($_SESSION);
                        }
                    ?>

            <fieldset id="account_options">
                <legend>Account actions: </legend>
                <a href="blog/addEntry.php"><button formaction="">Add Post</button></a>
                <a href="blog/logout.php"><button>Logout</button></a>
            </fieldset>

            <?php
                if (isset($_SESSION['user_status'])) { ?>
                    <script type="text/javascript">document.getElementById('login_form').remove();</script>
            <?php    } else { ?>
                    <script type="text/javascript">document.getElementById('account_options').remove();</script>
            <?php    }

            ?>
        </aside>
    </div>



    <!-- <form id="blog_form" method="GET" action="#">
        <fieldset>
            <legend>Add Blog Post</legend>

            <input type="text" id="title" name="blog_title" placeholder="Title" required>
            <textarea id="blog_post" name="blog_post" rows="6" cols="30" placeholder="entry"></textarea>

            
            <button type="submit">Post entry</button>
        </fieldset>
    </form> -->
</body>