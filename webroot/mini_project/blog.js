    document.querySelector("#sort_filter_submit").addEventListener("click", (e) => {
        e.preventDefault();
        changed();
    });

    function changed() {
        let value = document.querySelector("#filter_select").value;
        let vars = "";
        switch (value) {
            case "January":
                vars += "month=1";
                break;
            case "February":
                vars += "month=2";
                break;
            case "March":
                vars += "month=3";
                break;
            case "April":
                vars += "month=4";
                break;
            case "May":
                vars += "month=5";
                break;
            case "June":
                vars += "month=6";
                break;
            case "July":
                vars += "month=7";
                break;
            case "August":
                vars += "month=8";
                break;
            case "September":
                vars += "month=9";
                break;
            case "October":
                vars += "month=10";
                break;
            case "November":
                vars += "month=11";
                break;
            case "December":
                vars += "month=12";
                break;
            default:
                break;
        }
        console.log(vars);
        value = document.querySelector("#sort_select").value;
        if (value == "Newest First") {

            vars += "&sort_select=newest";
            location.href = `./blog.php?${vars}`;

        } else if (value == "Oldest First") {

            vars += "&sort_select=oldest";
            location.href = `./blog.php?${vars}`;

        }
        //console.log(vars);

    };
