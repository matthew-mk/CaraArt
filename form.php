<head>
    <meta charset="UTF-8">
    <title>Cara Art: Form</title>
</head>
<body>
    <nav>
        <ul>
            <li><a href="index.html">HOME</a></li>
            <li><a href="artlisting.php">ART LISTINGS</a></li>
            <li><a href="booking.php">BOOKINGS</a></li>
            <li><a href="admin.php">ADMIN</a></li>
        </ul>
    </nav>
    <h1>Order Form</h1>
</body>

<?php

if (isset($_POST['submit'])) {
    //order submitted
    $name = strip_tags(isset($_POST['name']) ? $_POST['name'] : "");
    $phone = strip_tags(isset($_POST['phone']) ? $_POST['phone'] : "");
    $email = strip_tags(isset($_POST['email']) ? $_POST['email'] : "");
    $address = strip_tags(isset($_POST['address']) ? $_POST['address'] : "");
    $sqlPaintingID = $_POST['painting_id'];

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
        echo "Your order was placed successfully.";
    } else {
        echo "An error occurred when trying to place your order. Please try again.";
    }

} else {
    $paintingID = isset($_GET['paintingID']) ? $_GET['paintingID'] : "";
    $paintingName = isset($_GET['paintingName']) ? $_GET['paintingName'] : "";
    //Submit not clicked yet
    ?>
    <p>Please fill in the details below to complete your order of: </p>
    <p>ID: <?php echo "$paintingID"?></p>
    <p>Painting: <?php echo "$paintingName"?></p>

    <form action="form.php" method="post">
        <p><input type="text" name="name" placeholder="name"></p>
        <p><input type="text" name="phone" placeholder="phone number"></p>
        <p><input type="text" name="email" placeholder="email"></p>
        <p><input type="text" name="address" placeholder="address"></p>
        <p><input type="hidden" name="painting_id" value="<?php echo "$paintingID"?>"></p>
        <p><input type="submit" name="submit"></p>
    </form>
    <?php
}

?>
