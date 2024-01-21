<?php
// 检查是否传递了员工ID
if (isset($_GET["id"])) {
    $id = $_GET["id"];

    // 数据库连接信息
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "fastfood_management_system";

    // 创建数据库连接
    $connection = new mysqli($servername, $username, $password, $database);

    // 检查连接是否成功
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    // 使用预处理语句
    $sql = "DELETE FROM staff WHERE staffID = ?";
    $stmt = $connection->prepare($sql);

    // 绑定参数
    $stmt->bind_param("i", $id);

    // 执行查询
    $result = $stmt->execute();

    // 检查删除是否成功
    if ($result === TRUE) {
        // 关闭预处理语句
        $stmt->close();

        // 关闭数据库连接
        $connection->close();

        // 重定向到 index.php
        header("location:/fastfood/index.php");
        exit;
    } else {
        // 打印错误信息
        echo "Error deleting record: " . $stmt->error;
    }
} else {
    // 如果未提供员工ID，显示错误信息
    echo "Staff ID not provided";
}
?>
