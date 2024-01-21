<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "fastfood_management_system";

$staffID = "";

// Create connection
$connection = new mysqli($servername, $username, $password, $database);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

if (isset($_POST['AvailableUpdate-btn'])) {

    if (empty($_POST['availabilityUpdate'])) {
        header("location:/fastfood/index.php");
        exit;
    } else {
        $rosterAvailable_ID = $_POST['availabilityUpdate'];
        $staffID = $_POST['staffID'];

        for ($x = 0; $x < count($rosterAvailable_ID); $x++) {
            $rosterID = $rosterAvailable_ID[$x];
            
            // Fetch dateTimeFrom and dateTimeTo from the roster table
            $fetchRosterQuery = "SELECT dateTimeFrom, dateTimeTo FROM roster WHERE rosterID = '$rosterID'";
            $result = $connection->query($fetchRosterQuery);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $dateTimeFrom = $row['dateTimeFrom'];
                $dateTimeTo = $row['dateTimeTo'];
                
                // Insert the data into the availability table
                $insertQuery = "INSERT INTO availability (staffID, rosterID, dateTimeFrom, dateTimeTo) " .
                    "VALUES ('$staffID', '$rosterID', '$dateTimeFrom', '$dateTimeTo')";
                $result = $connection->query($insertQuery);
            }
        }
    }
}

header("location:/fastfood/index.php");
exit;
?>
