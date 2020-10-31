<head>
    <meta charset="UTF-8">
    <title>Cara Art: Form</title>
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
    <h1 class="page-title">Order Form</h1>
</body>

<?php

if (isset($_POST['submit'])) {
    //order submitted
    $name = strip_tags(isset($_POST['name']) ? $_POST['name'] : "");
    $phone = strip_tags(isset($_POST['phone']) ? $_POST['phone'] : "");
    $email = strip_tags(isset($_POST['email']) ? $_POST['email'] : "");
    $address = strip_tags(isset($_POST['address']) ? $_POST['address'] : "");
    $sqlPaintingID = $_POST['painting_id'];

    if ( ($name != "") && ($phone != "") && ($email != "") && ($address != "") && ($sqlPaintingID != "") && (filter_var($email, FILTER_VALIDATE_EMAIL)) ) {

        //connect to database
        require_once "password.php";
        $servername = "devweb2020.cis.strath.ac.uk";
        $username = "yhb18134";
        $password = get_password();
        $dbname = "yhb18134";
        $conn = new mysqli($servername, $username, $password, $dbname);

        //save order into table
        $sql = "INSERT INTO `artworkorders` (`id`, `name`, `phone`, `email`, `address`, `painting id`) VALUES "
            . "(NULL, '$name', '$phone', '$email', '$address', '$sqlPaintingID');";

        //inform user that the order was successful or unsuccessful
        if ($conn->query($sql)) {
            echo "<p class='form-para'>Your order was placed successfully.</p>";
        } else {
            echo "<p class='form-para'>An error occurred when trying to place your order. Please try again.</p>";
        }
    } else {
        echo "<p class='form-para'>Something in the form was filled in incorrectly, so your order was not placed. Please refresh the page and try again.</p>";
    }

} else {
    //Submit not clicked yet
    $paintingID = isset($_GET['paintingID']) ? $_GET['paintingID'] : "";
    $paintingName = isset($_GET['paintingName']) ? $_GET['paintingName'] : "";
    ?>
    <div id="order-form-text">
    <p>Please fill in the details below to complete your order of: </p>
    <p>ID: <?php echo "$paintingID"?></p>
    <p>Painting: <?php echo "$paintingName"?></p>
    </div>
    <form name="orderform" action="form.php" method="post" onsubmit="return checkOrderForm();">
        <div id="order-fields-to-fix"></div>
        <p><input type="text" name="name" placeholder="name" onchange="checkName()"></p>
        <p><input type="text" name="phone" placeholder="phone number" onchange="checkPhone()"></p>
        <p><input type="email" name="email" placeholder="email" onchange="checkEmail()"></p>
        <p><input type="text" name="address" placeholder="address" onchange="checkAddress()"></p>
        <p><input type="hidden" name="painting_id" value="<?php echo "$paintingID"?>"></p>
        <p><input class="big-button" type="submit" name="submit"></p>
    </form>
    <?php
}
?>
</div>

<script>
    function checkOrderForm() {
        var name = document.forms["orderform"]["name"];
        var phone = document.forms["orderform"]["phone"];
        var email = document.forms["orderform"]["email"];
        var address = document.forms["orderform"]["address"];
        var errs = "";

        name.style.background = "white";
        phone.style.background = "white";
        email.style.background = "white";
        address.style.background = "white";

        if (name.value == null || name.value == "") {
            errs += "  * Name must not be empty\n";
            name.style.background = "pink";
        }

        if (phone.value == null || phone.value == "") {
            errs += "  * Phone must not be empty\n";
            phone.style.background = "pink";
        }

        if (email.value == null || email.value == "") {
            errs += "  * Email must not be empty\n";
            email.style.background = "pink";
        }

        if (address.value == null || address.value == "") {
            errs += "  * Address must not be empty\n";
            address.style.background = "pink";
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
        var name = document.forms["orderform"]["name"];
        if (name.value == null || name.value == "") {
            name.style.background = "pink";
        } else {
            name.style.background = "white";
        }
    }

    function checkPhone() {
        var phone = document.forms["orderform"]["phone"];
        if (phone.value == null || phone.value == "" || (isNaN(phone.value) || phone.value.length < 10)) {
            phone.style.background = "pink";
        } else {
            phone.style.background = "white";
        }
    }

    function checkEmail() {
        var email = document.forms["orderform"]["email"];
        if (email.value == null || email.value == "") {
            email.style.background = "pink";
        } else {
            email.style.background = "white";
        }
    }

    function checkAddress() {
        var address = document.forms["orderform"]["address"];
        if (address.value == null || address.value == "") {
            address.style.background = "pink";
        } else {
            address.style.background = "white";
        }
    }
</script>