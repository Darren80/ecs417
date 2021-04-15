<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="../reset.css">
        <link rel="stylesheet" href="addEntry.css">
    </head>
    <body>
            <form id="add_post" method="POST" action="addPost.php">
                <fieldset>
                    <legend>Add a post to your blog</legend>
                    <input name="blog_title" id="blog_title" placeholder="Title..."/>

                    <textarea name="blog_text" id="blog_text" rows="12" cols="40" placeholder="Enter your article here"></textarea>

                    <label for="authors" id="authors_text">Author name:</label>
                    <input name="authors" id="authors" placeholder="Enter the name(s) of the author(s)"/>

                    <button type="submit" >Add Post</button>
                    <button formaction="" formmethod="" id="clear_form">Clear form</button>
                    
                </fieldset>
                <button><a href="../blog.php">Go back to blog</a></button>

                <?php
                    if (isset($_GET['success']) && $_GET['success'] == true) {
                        print('<p class="post_success">Your new blog has been posted successfully.</p>');
                    }
                ?>
            </form>
    </body>
    <script type="text/javascript" src="clearForm_addEntry.js"></script>
</html>