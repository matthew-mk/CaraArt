<head>
    <meta charset="UTF-8">
    <title>Cara Art: Bookings</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1 id="nav-title">Cara Art</h1>
        <nav>
            <ul>
                <li><a href="index.html">HOME</a></li>
                <li><a href="artlisting.php">ART LISTINGS</a></li>
                <li><a href="booking.php">BOOKINGS</a></li>
                <li><a href="admin.php">ADMIN</a></li>
            </ul>
        </nav>
    </header>
    <div class="main-section">
    <h1 class="page-title">Book an Appointment</h1>
</body>

<?php

if (isset($_POST['submit'])) {
    //form submitted
    $name = strip_tags(isset($_POST['name']) ? $_POST['name'] : "");
    $address = strip_tags(isset($_POST['address']) ? $_POST['address'] : "");
    $phone = strip_tags(isset($_POST['phone']) ? $_POST['phone'] : "");
    $date = strip_tags(isset($_POST['date']) ? $_POST['date'] : "");
    $time = strip_tags(isset($_POST['time']) ? $_POST['time'] : "");

    if (($name != "") && ($address != "") && ($phone != "") && ($date != "") && ($time != "") && is_numeric($phone)) {

        //connect to database
        require_once "password.php";
        $servername = "devweb2020.cis.strath.ac.uk";
        $username = "yhb18134";
        $password = get_password();
        $dbname = "yhb18134";
        $conn = new mysqli($servername, $username, $password, $dbname);

        //save order into table
        $sql = "INSERT INTO `artworkappointments` (`id`, `name`, `address`, `phone`, `date`, `time`) VALUES "
            . "(NULL, '$name', '$address', '$phone', '$date', '$time');";

        //inform user that the order was successful or unsuccessful
        if ($conn->query($sql)) {
            echo "<p class='form-para'>Your appointment was booked successfully.</p>";
        } else {
            echo "<p class='form-para'>An error occurred when trying to book your appointment. Please try again.</p>";
        }
    } else {
        echo "<p class='form-para'>An error occurred when trying to book your appointment. Please refresh the page and try again.</p>";
    }

} else {
    //Submit not clicked yet
    ?>
    <p class="fill-details-text">Please fill in the details below to book an appointment at the art gallery.</p>
    <form name="bookingform" action="booking.php" method="post" onsubmit="return checkBookingForm();">
        <div id="fields-to-fix"></div>
        <p><input type="text" name="name" placeholder="name" onchange="checkName()"></p>
        <p><input type="text" name="address" placeholder="address" onchange="checkAddress()"></p>
        <p><input type="text" name="phone" placeholder="phone number" onchange="checkPhone()"></p>
        <p><input type="date" name="date" placeholder="date" onchange="checkDate()"></p>
        <p><input type="time" name="time" placeholder="time" onchange="checkTime()"></p>
        <p><input class="big-button" type="submit" name="submit"></p>
    </form>
    <?php
}
?>
</div>

<script>
    function checkBookingForm() {
        var name = document.forms["bookingform"]["name"];
        var address = document.forms["bookingform"]["address"];
        var phone = document.forms["bookingform"]["phone"];
        var date = document.forms["bookingform"]["date"];
        var time = document.forms["bookingform"]["time"];
        var errs = "";

        name.style.background = "white";
        address.style.background = "white";
        phone.style.background = "white";
        date.style.background = "white";
        time.style.background = "white";

        if (name.value == null || name.value == "") {
            errs += "  * Name must not be empty\n";
            name.style.background = "pink";
        }

        if (address.value == null || address.value == "") {
            errs += "  * Address must not be empty\n";
            address.style.background = "pink";
        }

        if (phone.value == null || phone.value == "") {
            errs += "  * Phone must not be empty\n";
            phone.style.background = "pink";
        }

        if (date.value == null || date.value == "") {
            errs += "  * Date must not be empty\n";
            date.style.background = "pink";
        }

        if (time.value == null || time.value == "") {
            errs += "  * Time must not be empty\n";
            time.style.background = "pink";
        }

        if (isNaN(phone.value) || phone.value.length < 10) {
            errs += "  * Phone should be a valid phone number with no spaces. Example: 01786123456\n";
            phone.style.background = "pink";
        }

        if (errs != "") {
            alert("Please fix the following: \n" + errs);
        }

        return (errs=="");
    }

    function checkName() {
        var name = document.forms["bookingform"]["name"];
        if (name.value == null || name.value == "") {
            name.style.background = "pink";
        } else {
            name.style.background = "white";
        }
    }

    function checkAddress() {
        var address = document.forms["bookingform"]["address"];
        if (address.value == null || address.value == "") {
            address.style.background = "pink";
        } else {
            address.style.background = "white";
        }
    }

    function checkPhone() {
        var phone = document.forms["bookingform"]["phone"];
        if (phone.value == null || phone.value == "" || (isNaN(phone.value) || phone.value.length < 10)) {
            phone.style.background = "pink";
        } else {
            phone.style.background = "white";
        }
    }

    function checkDate() {
        var date = document.forms["bookingform"]["date"];
        if (date.value == null || date.value == "") {
            date.style.background = "pink";
        } else {
            date.style.background = "white";
        }
    }

    function checkTime() {
        var time = document.forms["bookingform"]["time"];
        if (time.value == null || time.value == "") {
            time.style.background = "pink";
        } else {
            time.style.background = "white";
        }
    }
</script>