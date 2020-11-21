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

//code to display 12 rows per page
$rowsPerPage = 12;
$minRowNum = isset($_POST['minRowNumValue']) ? $_POST['minRowNumValue'] : 1;
$maxRowNum = isset($_POST['maxRowNumValue']) ? $_POST['maxRowNumValue'] : 12;

$sqlAllRows = "SELECT * FROM `artwork`";
$resultAllRows = $conn->query($sqlAllRows);
$numRowsInTable = mysqli_num_rows($resultAllRows);

if (isset($_POST['previousButton'])) {
    if ($minRowNum - $rowsPerPage >= 1) {
        $minRowNum -= $rowsPerPage;
        $maxRowNum -= $rowsPerPage;
    }
}

if (isset($_POST['nextButton'])) {
    if ($minRowNum + $rowsPerPage <= $numRowsInTable) {
        $minRowNum += $rowsPerPage;
        $maxRowNum += $rowsPerPage;
    }
}

$sql = "SELECT * FROM `artwork` WHERE id >= $minRowNum AND id <= $maxRowNum";
$result = $conn->query($sql);

//display basic info for the selected rows
if ($result->num_rows > 0) {
    echo "<div id='artlistings-images'>";
    while ($row = $result->fetch_assoc()) {
        echo "<div class = artlistings-image>";
        echo '<p><img src="data:image/jpeg;base64,' . base64_encode($row['image']) .'"/>' . $row['name'] . "</p>\n";
        echo "<form action='artlistingdetails.php' method='get'><input type='hidden' name='paintingID' value='" . $row['id'] . "'><input id='more-button' type='submit' name='orderButton' value='+'></form>\n";
        echo "</div>\n";
    }
    echo "</div>\n";
}
?>
<div class="sidebyside-buttons">
<form action="artlisting.php" method="post">
    <input type="hidden" name="minRowNumValue" value="<?php echo $minRowNum?>">
    <input type="hidden" name="maxRowNumValue" value="<?php echo $maxRowNum?>">
    <input type="submit" name="previousButton" value="<--">
</form>

<form class="sidebyside-right-btn" action="artlisting.php" method="post">
    <input type="hidden" name="minRowNumValue" value="<?php echo $minRowNum?>">
    <input type="hidden" name="maxRowNumValue" value="<?php echo $maxRowNum?>">
    <input type="submit" name="nextButton" value="-->">
</form>
</div>
</div>
