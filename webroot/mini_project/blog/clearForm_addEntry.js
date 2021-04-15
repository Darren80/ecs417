
document.querySelector("#clear_form").addEventListener('click', () => {
    let confirmed = window.confirm("Are you sure you want to clear your draft");
    if (confirmed) {
        document.querySelector("#blog_title").innerHTML = ""
        document.querySelector("#blog_text").innerHTML = ""
        document.querySelector("#authors").innerHTML = ""
        console.log("Clear form button clicked");
    }
});

document.getElementById("add_post").addEventListener("submit", (event) => {

    let blog_title = document.querySelector("#blog_title");
    let blog_text = document.querySelector("#blog_text");
    let authors_text = document.querySelector("#authors");

    let warningBox = document.createElement("div");
    warningBox.className = "warning";

    if (!blog_title.value || !blog_text.value || !authors_text.value) {
        event.preventDefault();

        setTimeout(() => {
            warningBox.parentNode.removeChild(warningBox);
        }, 2000);
    }

    if (!blog_title.value) {
        warningBox.innerHTML = "Please enter a title";
        blog_title.parentNode.insertBefore(warningBox, blog_title.nextSibling);

    } else if (!blog_text.value) {
        warningBox.innerHTML = "Please enter some article text";
        blog_text.parentNode.insertBefore(warningBox, blog_text.nextSibling);
    } else if (!authors_text.value) {
        warningBox.innerHTML = "Please enter author names";
        authors_text.parentNode.insertBefore(warningBox, authors_text.nextSibling);
    }
});