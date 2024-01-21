<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "fastfood_management_system";

$connection = new mysqli($servername, $username, $password, $database);

// 检查连接是否成功
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

$name = "";
$email = "";
$address = "";
$dateOfBirth = "";
$mob = "";
$successMessage = "";
$errorMessage = "";

// 处理 GET 请求
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // 检查是否传递了员工ID
    if (!isset($_GET["id"])) {
        header("location:/fastfood/index.php");
        exit;
    }

    $id = $_GET["id"];
    $sql = "SELECT * FROM Staff WHERE staffID='$id'";
    $result = $connection->query($sql);
    
    // 检查查询是否成功
    if ($result) {
        $row = $result->fetch_assoc();

        if (!$row) {
            header("location:/fastfood/index.php");
            exit;
        }

        // 读取员工信息
        $name = $row["name"];
        $email = $row["email"];
        $address = $row["address"];
        $dateOfBirth = $row["dateOfBirth"];
        $mob = $row["mob"];
    } else {
        $errorMessage = "Invalid query: " . $connection->error;
    }
} 
// 处理 POST 请求
elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id =$_POST["ID"];
    $name =$_POST["name"];
    $email =$_POST["email"];
    $address = $_POST["address"];
    $dateOfBirth = $_POST["dateOfBirth"];
    $mob =$_POST["mob"];


    // 检查是否有空字段
    if (empty($id) || empty($name) || empty($email) || empty($address) || empty($dateOfBirth) || empty($mob)) {
        $errorMessage = 'All fields are required';
    } else {
        // 构建更新员工信息的SQL语句
        $sql = "UPDATE Staff SET name='$name', email='$email', address='$address', dateOfBirth='$dateOfBirth', mob='$mob' WHERE staffID=$id";
        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query: " . $connection->error;
        } else {
            $successMessage = "Updated";
            header("location:/fastfood/index.php");
            exit;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
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
        <h1 style="text-align: center;"> Update Information </h1>

        <form method="post">
            <input type="hidden" name="ID" value="<?php echo $id; ?>">
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
             
          

            <div class="error-message" id="passwordError"><?php echo $errorMessage; ?></div>

            <button type="submit">Update</button>
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
