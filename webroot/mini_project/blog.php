<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="reset.css">
    <link rel="stylesheet" href="navigation_bar.css">
    <link rel="stylesheet" href="blog_style.css">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,700;1,400;1,700&family=Pacifico&display=swap" rel="stylesheet">
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
                <li><a href="blog.php">Blog</a></li>

            </ul>
        </nav>
    </header>

    <?php
        session_start();
    ?>

    <div id="container">
        <div id="main">

            <h1 class="title">Entries</h1>
            <form>
                <?php
                    if (!empty($_GET['sort_select'])) {
                        $_SESSION['sort_select'] = $_GET['sort_select']; 
                    } else {
                        $_SESSION['sort_select'] = "newest";
                    }
                ?>
                <label for="sort_select">Sort by:</label>
                <select id="sort_select">
                    <optgroup label="Date">
                        <option <?php $_SESSION['sort_select'] == "newest" ? print("selected") : ""; ?>>Newest First</option>
                        <option <?php $_SESSION['sort_select'] == "oldest" ? print("selected") : ""; ?>>Oldest First</option>
                    </optgroup>
                </select>
            
                <?php
                    if (!empty($_GET['month'])) {
                        $_SESSION['filter_select'] = $_GET['month'];
                    } else {
                        $_SESSION['filter_select'] ="";
                    }

                ?>
                <label for="filter_select">Filter by:</label>
                <select id="filter_select">
                    <optgroup>
                        <option>None</option>
                    </optgroup>
                    <optgroup label="Month">
                        <option <?php $_SESSION['filter_select'] == "1" ? print("selected") : ""; ?>>January</option>
                        <option <?php $_SESSION['filter_select'] == "2" ? print("selected") : ""; ?>>February</option>
                        <option <?php $_SESSION['filter_select'] == "3" ? print("selected") : ""; ?>>March</option>
                        <option <?php $_SESSION['filter_select'] == "4" ? print("selected") : ""; ?>>April</option>
                        <option <?php $_SESSION['filter_select'] == "5" ? print("selected") : ""; ?>>May</option>
                        <option <?php $_SESSION['filter_select'] == "6" ? print("selected") : ""; ?>>June</option>
                        <option <?php $_SESSION['filter_select'] == "7" ? print("selected") : ""; ?>>July</option>
                        <option <?php $_SESSION['filter_select'] == "8" ? print("selected") : ""; ?>>August</option>
                        <option <?php $_SESSION['filter_select'] == "9" ? print("selected") : ""; ?>>September</option>
                        <option <?php $_SESSION['filter_select'] == "10" ? print("selected") : ""; ?>>October</option>
                        <option <?php $_SESSION['filter_select'] == "11" ? print("selected") : ""; ?>>November</option>
                        <option <?php $_SESSION['filter_select'] == "12" ? print("selected") : ""; ?>>December</option>
                    </optgroup>
                </select>
                <button type="submit" id="sort_filter_submit">Go</button>
            </form>

            <?php
            $dbhost = getenv("MYSQL_SERVICE_HOST");
            $dbport = getenv("MYSQL_SERVICE_PORT");
            //  $dbuser = "root";
            //  $dbpwd = "";
            //  $dbname = "app_data";
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

            $sql = "SELECT * FROM `BLOG`";
            $result = $conn->query($sql);

            //MULTIDIMENSIONAL ARRAY SORTING
            function sortByDate($rows, $order)
            {
                if ($order == "newest") {
                    usort($rows, function ($a, $b) {
                        return $b['date_published'] <=> $a['date_published'];
                    });
                } else if ($order == "oldest") {
                    usort($rows, function ($a, $b) {
                    return $a['date_published'] <=> $b['date_published'];
                    });
                }
                return $rows;
            }

            if (isset($_SESSION['filter_select']) && !empty($_SESSION['filter_select'])) {
                $month = $_SESSION['filter_select'];
                $sql = "SELECT * FROM `BLOG` WHERE MONTH(`date_published`) = $month";
            }           

            $result = $conn->query($sql);

            //IS THERE AT LEAST ONE FIELD IN THE `BLOG` TABLE?
            if ($result->num_rows > 0) {

                $rows = [];

                while ($row = $result->fetch_assoc()) {
                    $rows[] = $row;
                }

                $order = $_SESSION['sort_select'];
                $rows = sortByDate($rows, $order); //SORT POSTS BY SOMETHING (LIKE DATE)

                foreach ($rows as &$row) {
                    $title = $row["blog_title"];
                    $text = $row["blog_text"];
                    $date_published = $row["date_published"];

                    //PRINTS THE BLOG POSTS TO HTML
                    print("<article>");
                    print("<p class=\"date_published\">Date published: $date_published</p>");
                    print("<h2 class=\"blog_title\">$title</h2>");
                    print("<p class=\"blog_text\">$text</p>");
                    print("</article>");
                    print("<br>");
                }
            } else {
                print("<h1>There are no entries for this time-period.");
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
                        <input type="text" id="username" name="username" autocomplete="username" placeholder="username" required>
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
                <script type="text/javascript">
                    document.getElementById('login_form').remove();
                </script>
            <?php    } else { ?>
                <script type="text/javascript">
                    document.getElementById('account_options').remove();
                </script>
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
    <script type="text/javascript" src="blog.js"></script>
</body>