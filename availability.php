<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Availability</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
   
</head>
<body>
    <br>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card mt-5">
                    <div class="card-header">
                        <h4>Available Information</h4>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card-body">
                    <form action="availUpdate.php" method="POST">
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        <button type="submit" name="AvailableUpdate-btn" class="btn btn-primary">Update</button>
                                    </th>
                                    <th>StaffID</th>
                                    <th>Name</th>
                                    <th>RoleID</th>
                                    <th>RosterID</th>
                                    <th>Start</th>
                                    <th>End</th>
                                </tr>
                            </tbody>

                        </tbody>
                            <?php
                            $servername = "localhost";
                            $username = "root";
                            $password = "";
                            $database = "fastfood_management_system";

                            // Create connection
                            $connection = new mysqli($servername, $username, $password, $database);

                            // Check connection
                            if ($connection->connect_error) {
                                die("Connection failed: " . $connection->connect_error);
                            }

                            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                                // GET method: Show the data of the client

                                if (!isset($_GET["staffID"])) {
                                    header("location:/fastfood/index.php");
                                    exit;
                                }


                                $staffID = $_GET["staffID"];
                            }

                              // Use the $staffID from the session for the query
                              $sql = "SELECT staff.staffID, staff.name, staff.roleID, roster.rosterID, roster.dateTimeFrom, roster.dateTimeTo " .
                              "FROM staff JOIN Role ON staff.roleID = role.roleID " .
                              "JOIN rosterRole ON role.roleID = rosterRole.roleID " .
                              "JOIN roster ON rosterRole.rosterID = roster.rosterID " .
                              "WHERE staff.staffID = $staffID " .
                              "ORDER BY roster.dateTimeFrom ";
                              $result = $connection->query($sql);
  
                              if ($result->num_rows == 0) {
                                  echo ("Bye,nothing");
                                  header ("location:/fastfood/index.php");
                              }
  
                              foreach($result as $row) {
                              ?>
                                  <tr>
                                      <td style="width:10px; text-align; center;">
                                      <input type="checkbox" name="availabilityUpdate[]" value="<?=$row['rosterID']; ?>">
                                      <td><?=$row['staffID']; ?></td>
                                      <td><?=$row['name']; ?></td>
                                      <td><?=$row['roleID']; ?></td>
                                      <td><?=$row['rosterID']; ?></td>
                                      <td><?=$row['dateTimeFrom']; ?></td>
                                      <td><?=$row['dateTimeTo']; ?></td>
                                  </tr>
                              <?php
                              }
                              ?>
  
   
                              <input type="hidden" name="staffID" value="<?php echo $staffID; ?>">
                          </tbody>
                      
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
