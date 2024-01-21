 <?php
$name = "";
$email = "";
$address = "";
$dateOfBirth = "";
$mob = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $address = $_POST["address"];
    $dateOfBirth = $_POST["dateOfBirth"];
    $mob = $_POST["mob"];

    $con = new mysqli("localhost", "root", "", "fastfood_management_system");
    // check con
    if ($con->connect_error) {
        die("Failed to connect: " . $con->connect_error);
    }

    // Insert new staff into the database
    $insertQuery = "INSERT INTO staff (name, email, mob, roleID, address, dateOfBirth) VALUES ('$name', '$email', '$mob', NULL, '$address', '$dateOfBirth')";

    if ($con->query($insertQuery) === TRUE) {
        $successMessage = "Staff added correctly";
    } else {
        echo "Error: " . $insertQuery . "<br>" . $con->error;
    }

    $con->close();
}




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Staff Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .container {
            width: 50%;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        form {
            display: grid;
            gap: 15px;
        }

        label {
            display: block;
        }

        input {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }

        button {
            background-color: #007bff;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%; 
        }

        .card-footer {
            margin-top: 15px;
            text-align: right;
        }

        .error-message {
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 style="text-align: center;">New Staff Registration</h1>
        <form action="create.php" method="post">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required value="<?php echo $name; ?>">

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required value="<?php echo $email; ?>">

            <label for="address">Address:</label>
            <input type="text" id="address" name="address" required value="<?php echo $address; ?>">

            <label for="dateOfBirth">Date of Birth:</label>
            <input type="date" id="dateOfBirth" name="dateOfBirth" required value="<?php echo $dateOfBirth; ?>">

            <label for="mob">Mobile:</label>
            <input type="text" id="mob" name="mob" required value="<?php echo $mob; ?>">

            <div class="error-message" id="passwordError"></div>

            <button type="submit">Register</button>
        </form>
        
        <?php
        if (!empty($successMessage)) {
            echo "<p style='color: green;'>$successMessage</p>";
        }
        ?>
        
        <div class="card-footer">
            <small>&copy; Joy Tech</small>
        </div>
    </div>
</body>
</html>
