<head>
    <meta charset="UTF-8">
    <title>Cara Art: Admin</title>
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
    <h1 class="page-title">Admin</h1>
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

        //Display all of the orders as an HTML table
        echo "<h3 class='admin-subtitle'>Orders</h3>";
        echo "<div class='form-container'>";
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
            echo "</div>";
        } else {
            echo "<p class='no-rows-text'>There are currently no orders.</p>";
        }

        //Select all rows from the appointments table
        $appointmentsSQL = "SELECT * FROM `artworkappointments`";
        $appointmentsResult = $conn->query($appointmentsSQL);

        //Display all of the appointments as an HTML table
        echo "<h3 class='admin-subtitle'>Appointments</h3>";
        echo "<div class='form-container'>";
        if ($appointmentsResult->num_rows > 0) {
            echo "<table>\n";
            echo "<tr>\n";
            echo "<th>id</th>\n";
            echo "<th>name</th>\n";
            echo "<th>address</th>\n";
            echo "<th>phone</th>\n";
            echo "<th>date</th>\n";
            echo "<th>time</th>\n";
            echo "</tr>\n";
            while ($row = $appointmentsResult->fetch_assoc()) {
                echo "<tr>\n";
                echo "<td>" . $row['id'] . "</td>\n";
                echo "<td>" . $row['name'] . "</td>\n";
                echo "<td>" . $row['address'] . "</td>\n";
                echo "<td>" . $row['phone'] . "</td>\n";
                echo "<td>" . $row['date'] . "</td>\n";
                echo "<td>" . $row['time'] . "</td>\n";
                echo "</tr>\n";
            }
            echo "</table>\n";
            echo "</div>\n";
        } else {
            echo "<p class='no-rows-text'>There are currently no appointments.</p>";
        }

    } else {
        //Incorrect password entered
        ?>
        <p class="view-page-text">To view this page, please enter the password below: </p>
        <form class="admin-form" action="admin.php" method="post">
            <p><input type="password" name="password"></p>
            <p id="admin-incorrect-password">Incorrect password.</p>
            <p><input class="big-button" type="submit" name="submit"></p>
        </form>
        <?php
    }
} else {
    //Submit not clicked yet
    ?>
    <p class="view-page-text">To view this page, please enter the password below: </p>
    <form class="admin-form" action="admin.php" method="post">
        <p><input type="password" name="password"></p>
        <p><input class="big-button" type="submit" name="submit"></p>
    </form>
    <?php
}
?>
</div>
