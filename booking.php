<head>
    <meta charset="UTF-8">
    <title>Cara Art: Bookings</title>
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
    <h2>Book an Appointment</h2>
</body>

<?php

if (isset($_POST['submit'])) {
    //form submitted
    $name = strip_tags(isset($_POST['name']) ? $_POST['name'] : "");
    $address = strip_tags(isset($_POST['address']) ? $_POST['address'] : "");
    $phone = strip_tags(isset($_POST['phone']) ? $_POST['phone'] : "");
    $date = strip_tags(isset($_POST['date']) ? $_POST['date'] : "");
    $time = strip_tags(isset($_POST['time']) ? $_POST['time'] : "");

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
        echo "Your appointment was booked successfully.";
    } else {
        echo "An error occurred when trying to book your appointment. Please try again.";
    }

} else {
    //Submit not clicked yet
    ?>
    <p>Please fill in the details below to book an appointment at the art gallery.</p>
    <form action="booking.php" method="post">
        <p><input type="text" name="name" placeholder="name"></p>
        <p><input type="text" name="address" placeholder="address"></p>
        <p><input type="text" name="phone" placeholder="phone number"></p>
        <p><input type="date" name="date" placeholder="date"></p>
        <p><input type="time" name="time" placeholder="time"></p>
        <p><input type="submit" name="submit"></p>
    </form>
    <?php
}

?>
