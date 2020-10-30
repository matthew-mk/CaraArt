<head>
    <meta charset="UTF-8">
    <title>Cara Art: Art Listings</title>
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
    <h2>Cara's Paintings</h2>
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
    echo "<table>\n";
    echo "<tr>\n";
    echo "<th>name</th>\n";
    echo "<th>size (mm)</th>\n";
    echo "<th>price (£)</th>\n";
    echo "</tr>\n";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>\n";
        echo "<td>" . $row['name'] . "</td>\n";
        echo "<td>" . $row['width (mm)'] . "x" . $row['height (mm)'] . "</td>\n";
        echo "<td>" . $row['price (£)'] . "</td>\n";
        echo "<td>" . "<form action='artlistingdetails.php' method='get'><input type='hidden' name='paintingID' value='" . $row['id'] . "'><input type='submit' name='orderButton' value='More'></form>" . "</td>\n";
        echo "</tr>\n";
    }
    echo "</table>\n";
}
?>

<form action="artlisting.php" method="post">
    <input type="hidden" name="minRowNumValue" value="<?php echo $minRowNum?>">
    <input type="hidden" name="maxRowNumValue" value="<?php echo $maxRowNum?>">
    <input type="submit" name="previousButton" value="Previous">
</form>

<form action="artlisting.php" method="post">
    <input type="hidden" name="minRowNumValue" value="<?php echo $minRowNum?>">
    <input type="hidden" name="maxRowNumValue" value="<?php echo $maxRowNum?>">
    <input type="submit" name="nextButton" value="Next">
</form>

