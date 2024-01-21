<?php
$email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

// �������ݿ�����
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

        // ��ȡ�û���roleID
        $roleID = $data['roleID'];

        // ���������Ϣ
        echo "Input Email: " . $email . "<br>";
        echo "Input Password: " . $password . "<br>";
        echo "Database Password: " . $data['password'] . "<br>";

        if (isset($data['password']) && $data['password'] === $password) {
            // ��¼�ɹ������ݽ�ɫ�ض�����Ӧ��ҳ��
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

    // �رղ�ѯ�������ݿ�����
    $stmt->close();
    $con->close();
}
?>
