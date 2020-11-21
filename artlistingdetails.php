<head>
    <meta charset="UTF-8">
    <title>Cara Art: Art Listings</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1 id="nav-title">Cara Art</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a id="selected-nav" href="artlisting.php">Art Listings</a></li>
                <li><a href="booking.php">Bookings</a></li>
                <li><a href="admin.php">Admin</a></li>
            </ul>
        </nav>
    </header>
    <div class="main-section">
</body>

<?php

//connect to database
require_once "password.php";
$servername = "devweb2020.cis.strath.ac.uk";
$username = "yhb18134";
$password = get_password();
$dbname = "yhb18134";
$conn = new mysqli($servername, $username, $password, $dbname);

//select information from specific row in database
$paintingID = isset($_GET['paintingID']) ? $_GET['paintingID'] : 0;
$sql = "SELECT * FROM `artwork` WHERE id = $paintingID;";
$result = $conn->query($sql);

//display full details from specific row
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<h1 id='ald-title'>" . $row['name'] . "</h1>";
        echo '<img id="ald-pic" src="data:image/jpeg;base64,' . base64_encode($row['image']) . '" width="60%" height="50%"/>' . "\n";
        echo "<div id='ald-text'>";
        echo "<p id='ald-desc'>" . $row['description'] . "</p>\n";
        echo "<p>Price: £" . $row['price (£)'] . "</>\n";
        echo "<p>Size: " . $row['width (mm)'] . "x" . $row['height (mm)'] . "mm</>\n";
        echo "<p>Date of Completion: " . $row['date of completion'] . "</p>\n";
        echo "</div>";
        echo "<div class='sidebyside-buttons'>";
        echo "<form action='form.php' method='get'><input type='hidden' name='paintingID' value='" . $row['id'] . "'><input type='hidden' name='paintingName' value='" . $row['name'] . "'><input id='order-button' type='submit' name='orderButton' value='Order'></form>\n";
        echo "<button id='back-button'>Back</button>";
        echo "</div>";
    }
}
?>

<script>
    var backButton = document.getElementById('back-button');
    backButton.addEventListener("click", function() {
        document.location='artlisting.php';
    })
</script>
</div>