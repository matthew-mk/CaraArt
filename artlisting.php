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
</body>

<?php

require_once "password.php";

$servername = "devweb2020.cis.strath.ac.uk";
$username = "yhb18134";
$password = get_password();
$dbname = "yhb18134";
$conn = new mysqli($servername, $username, $password, $dbname);

$sql = "SELECT * FROM `artwork`";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table>\n";
    echo "<tr>\n";
    echo "<th>id</th>\n";
    echo "<th>name</th>\n";
    echo "<th>date of completion</th>\n";
    echo "<th>width (mm)</th>\n";
    echo "<th>height (mm)</th>\n";
    echo "<th>price (£)</th>\n";
    echo "<th>description</th>\n";
    echo "</tr>\n";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>\n";
        echo "<td>" . $row['id'] . "</td>\n";
        echo "<td>" . $row['name'] . "</td>\n";
        echo "<td>" . $row['date of completion'] . "</td>\n";
        echo "<td>" . $row['width (mm)'] . "</td>\n";
        echo "<td>" . $row['height (mm)'] . "</td>\n";
        echo "<td>" . $row['price (£)'] . "</td>\n";
        echo "<td>" . $row['description'] . "</td>\n";
        echo "<td>" . "<form action='form.php' method='get'><input type='hidden' name='paintingID' value='" . $row['id'] . "'><input type='hidden' name='paintingName' value='" . $row['name'] . "'><input type='submit' name='orderButton' value='Order'></form>" . "</td>\n";
        echo "</tr>\n";
    }
    echo "</table>\n";
}

?>

