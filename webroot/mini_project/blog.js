document.querySelector("#sort_select").addEventListener("change", (e) => {
        let value = document.querySelector("sort_select").value;
        if (value == "Newest First") {
            location.href = "./blog.php?sort=newest";
        } else if (value == "Oldest First") {
            location.href = "./blog.php?sort=oldest";
        }
});