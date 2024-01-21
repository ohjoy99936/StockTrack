<?php
// �����Ự
session_start();

// ������лỰ����
$_SESSION = array();

// ������ڻỰ cookie��ǿ��ɾ��
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// �������ٻỰ
session_destroy();

// �ض��򵽵�¼ҳ��������ʵ���ҳ��
header("Location: login.html");
exit();
?>
