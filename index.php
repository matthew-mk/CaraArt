<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cara Art</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1 id="nav-title">Cara Art</h1>
        <nav>
            <ul>
                <li><a id="selected-nav" href="index.php">Home</a></li>
                <li><a href="artlisting.php">Art Listings</a></li>
                <li><a href="booking.php">Bookings</a></li>
                <li><a href="admin.php">Admin</a></li>
            </ul>
        </nav>
    </header>

    <div id="main-section-home">
        <div id="home-about-cara">
            <?php
            //connect to database
            require_once "password.php";
            $servername = "devweb2020.cis.strath.ac.uk";
            $username = "yhb18134";
            $password = get_password();
            $dbname = "yhb18134";
            $conn = new mysqli($servername, $username, $password, $dbname);

            //select information from specific row in database
            $sql = "SELECT * FROM `cara` WHERE id = 1";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                echo '<img id="home-cara-image" src="data:image/jpeg;base64,' . base64_encode($row['image']) .'"/>';
            }
            ?>
            <h1 id="home-page-title">About Cara</h1>
            <p>
                Cara is a painter, wildlife photographer and sculptor from Glasgow. She is the founder of Cara Art, an art
                gallery containing a wide range of her outstanding creations. Cara's love for nature and wildlife is her inspiration
                and is beautifully expressed in her artwork, which can be viewed on the <a href="artlisting.php">art listings page</a>.
            </p>
        </div>
    </div>
</body>
</html>