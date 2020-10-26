<head>
    <meta charset="UTF-8">
    <title>Cara Art: Admin</title>
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
    <h2>Admin</h2>
</body>

<?php
if (isset($_POST['submit'])) {
    $passwordInput = strip_tags(isset($_POST['password']) ? $_POST['password'] : "");
    if ($passwordInput === "letMEin2020") {
        //Access granted, correct password was entered

        //Connect to database
        require_once "password.php";
        $servername = "devweb2020.cis.strath.ac.uk";
        $username = "yhb18134";
        $password = get_password();
        $dbname = "yhb18134";
        $conn = new mysqli($servername, $username, $password, $dbname);

        //Select all rows from the orders table
        $sql = "SELECT * FROM `artworkorders`";
        $result = $conn->query($sql);

        //Display all of the table rows as an HTML table
        if ($result->num_rows > 0) {
            echo "<table>\n";
            echo "<tr>\n";
            echo "<th>id</th>\n";
            echo "<th>name</th>\n";
            echo "<th>phone</th>\n";
            echo "<th>email</th>\n";
            echo "<th>address</th>\n";
            echo "<th>painting id</th>\n";
            echo "</tr>\n";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>\n";
                echo "<td>" . $row['id'] . "</td>\n";
                echo "<td>" . $row['name'] . "</td>\n";
                echo "<td>" . $row['phone'] . "</td>\n";
                echo "<td>" . $row['email'] . "</td>\n";
                echo "<td>" . $row['address'] . "</td>\n";
                echo "<td>" . $row['painting id'] . "</td>\n";
                echo "</tr>\n";
            }
            echo "</table>\n";
        } else {
            echo "There are currently no orders.";
        }
    } else {
        //Incorrect password entered
        ?>
        <p>To view this page, please enter the password below: </p>
        <form action="admin.php" method="post">
            <p><input type="password" name="password"></p>
            <p><input type="submit" name="submit"></p>
            <p>Incorrect password entered.</p>
        </form>
        <?php
    }
} else {
    //Submit not clicked yet
    ?>
    <p>To view this page, please enter the password below: </p>
    <form action="admin.php" method="post">
        <p><input type="password" name="password"></p>
        <p><input type="submit" name="submit"></p>
    </form>
    <?php
}
?>

