<?php
// ����Ƿ񴫵���Ա��ID
if (isset($_GET["id"])) {
    $id = $_GET["id"];

    // ���ݿ�������Ϣ
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "fastfood_management_system";

    // �������ݿ�����
    $connection = new mysqli($servername, $username, $password, $database);

    // ��������Ƿ�ɹ�
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    // ʹ��Ԥ�������
    $sql = "DELETE FROM staff WHERE staffID = ?";
    $stmt = $connection->prepare($sql);

    // �󶨲���
    $stmt->bind_param("i", $id);

    // ִ�в�ѯ
    $result = $stmt->execute();

    // ���ɾ���Ƿ�ɹ�
    if ($result === TRUE) {
        // �ر�Ԥ�������
        $stmt->close();

        // �ر����ݿ�����
        $connection->close();

        // �ض��� index.php
        header("location:/fastfood/index.php");
        exit;
    } else {
        // ��ӡ������Ϣ
        echo "Error deleting record: " . $stmt->error;
    }
} else {
    // ���δ�ṩԱ��ID����ʾ������Ϣ
    echo "Staff ID not provided";
}
?>
