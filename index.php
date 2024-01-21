<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of staff</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
</head>
<body>

    <div class="container mt-5">

        <a class="btn btn-primary" href="create.php" role="button"> New staff </a>
        <br>

        <table class="table">
            <thead>
                <tr>
                    <th>staffID</th>
                    <th>name</th>
                    <th>address</th>
                    <th>dateOfBirth</th>
                    <th>email</th>
                    <th>mob</th>
                    <th>roleID</th>
                    <th>Password</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $database = "fastfood_management_system";
                $connection = new mysqli($servername, $username, $password, $database);

                $sql = "SELECT * FROM staff";
                $result = $connection->query($sql);

                if (!$result) {
                die("Invalid query: " . $connection->error);
                }

                while ($row = $result->fetch_assoc()) {
                echo "
                <tr>
                    <td>" . (isset($row['staffID']) ? $row['staffID'] : '') . "</td>
                    <td>" . (isset($row['name']) ? $row['name'] : '') . "</td>
                    <td>" . (isset($row['address']) ? $row['address'] : '') . "</td>
                    <td>" . (isset($row['dateOfBirth']) ? $row['dateOfBirth'] : '') . "</td>
                    <td>" . (isset($row['email']) ? $row['email'] : '') . "</td>
                    <td>" . (isset($row['mob']) ? $row['mob'] : '') . "</td>
                    <td>" . (isset($row['roleID']) ? $row['roleID'] : '') . "</td>
                    <td>" . (isset($row['Password']) ? $row['Password'] : '') . "</td>
                    <td>
                        <a class='btn btn-primary btn-sm' href='edit.php?id=$row[staffID]'>Edit</a>
                        <a class='btn btn-primary btn-sm' href='delete.php?id=$row[staffID]'>Delete</a>
                    </td>
                    <td>
                       <a class='btn btn-info btn-sm' href='availability.php?staffID=$row[staffID]'>Availability</a>

                    </td>
                </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>

