<head>
    <!-- 引用 Firebase JavaScript SDK -->
    <script src="https://www.gstatic.com/firebasejs/10.0.2/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/10.0.2/firebase-auth.js"></script>
    <script src="https://www.gstatic.com/firebasejs/10.0.2/firebase-database.js"></script>

    <!-- Firebase 初始化代码 -->
    <script>
        // 初始化 Firebase 项目
        const firebaseConfig = {
            apiKey: "AIzaSyDuO9AkQqFfVS-U8rgwkdkiS1wthmGOkQU",
            authDomain: "stocktrack-327a4.firebaseapp.com",
            projectId: "stocktrack-327a4",
            storageBucket: "stocktrack-327a4.appspot.com",
            messagingSenderId: "707185415746",
            appId: "1:707185415746:web:21ad50fba1434302d5bfdb",
            measurementId: "G-0H43SEWVBF"
        };
        firebase.initializeApp(firebaseConfig);
    </script>
</head>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 获取POST请求的数据
    $email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    // 创建数据库连接
    $con = new mysqli("localhost", "root", "", "stocktrack");

    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    } else {
        $stmt = $con->prepare("SELECT * FROM staff WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt_result = $stmt->get_result();

        if ($stmt_result->num_rows > 0) {
            $data = $stmt_result->fetch_assoc();

            // 获取用户的roleID
            $roleID = $data['roleID'];

            // 输出调试信息
            echo "Input Email: " . $email . "<br>";
            echo "Input Password: " . $password . "<br>";
            echo "Database Password: " . $data['password'] . "<br>";

            if (isset($data['password']) && $data['password'] === $password) {
                // 登录成功，根据角色重定向到相应的页面
                if ($roleID == 3 || $roleID == 4) {
                    // technical officer or head teacher
                    header("Location: myinfor.php");
                    exit();
                } else {
                    // Other roles
                    header("Location: navbar.html");
                    exit();
                }
            } else {
                echo "<h2>Ooppps! Invalid email or password</h2>";
            }
        } else {
            echo "<h2>User not found</h2>";
        }

        // 关闭查询语句和数据库连接
        $stmt->close();
        $con->close();
    }
} else {
    echo "405 Not Allowed";
}
?>
