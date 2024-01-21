<?php
// �������ݿ�����
$con = new mysqli("localhost", "root", "", "stocktrack");

// ��������Ƿ�ɹ�
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// ������ύ
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['ClayTrackUpdate-btn'])) {
    // ��ȡ������
    $clayIDs = $_POST['clayID'];  // �����һ�������� $clayIDs
    $adjustQuantities = $_POST['adjustQuantity'];
    $notes = $_POST['notes'];

    // ѭ������ÿ�� clay �� Adjust Quantity �� Notes
    for ($i = 0; $i < count($clayIDs); $i++) {
        // ��ȡ��Ӧ������
        $clayID = $clayIDs[$i];  // ���� $clayID
        $adjustQuantity = $adjustQuantities[$i];
        $note = $notes[$i];

        // �������ݿ��ж�Ӧ clay �� Adjust Quantity �� Notes
        $updateSql = "UPDATE ClayTrack SET quantity = quantity + $adjustQuantity, notes = '$note' WHERE clayID = $clayID";
        $updateResult = $con->query($updateSql);

        // ����Ƿ���³ɹ�������Ը���ʵ��������д���
        if (!$updateResult) {
            echo "Error updating record: " . $con->error;
        }
    }

    // �ض��� clay.php
    header("Location: clay.php");
    exit();
}

// ��ѯ���ݿ�
$sql = "SELECT clayID, clayName, quantity, date, notes, roleID FROM ClayTrack";
$result = $con->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clay Track</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .low-quantity {
            background-color: red;
        }

        .high-quantity {
            background-color: lightgreen;
        }

        .medium-quantity {
            background-color: lightsalmon;
        }
    </style>
</head>
<body>
    <br>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card mt-5">
                    <div class="card-header">
                        <h4>Clay Track</h4>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card-body">
                    <form action="claytrack.php" method="POST">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>
                                        <button type="submit" name="ClayTrackUpdate-btn" class="btn btn-primary">Update</button>
                                    </th>
                                    <th>Clay Name</th>
                                    <th>Current Quantity</th>
                                    <th>Adjust Quantity</th>
                                    <th>Date</th>
                                    <th>Notes</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // ����ѯ�Ƿ�ɹ�
                                if (!$result) {
                                    die("Query failed: " . $con->error);
                                }

                                // ������ݵ� HTML ���
                                while ($row = $result->fetch_assoc()) {
                                    $quantity = $row['quantity'];
                                    $rowClass = ($quantity < 5) ? 'low-quantity' : (($quantity > 20) ? 'high-quantity' : 'medium-quantity');
                                    ?>
                                    <tr class="<?= $rowClass; ?>">
                                        <td style="width:10px; text-align; center;">
                                            <input type="checkbox" name="clayTrackUpdate[]" value="<?= $row['clayID']; ?>">
                                        </td>
                                        <td><?= $row['clayName']; ?></td>
                                        <td><?= $quantity; ?></td>
                                        <td>
                                            <input type="number" name="adjustQuantity[]" value="0" min="-9999" max="9999">
                                        </td>
                                        <td><?= $row['date']; ?></td>
                                        <td><input type="text" name="notes[]" value="<?= $row['notes']; ?>"></td>
                                        <!-- ���ص��ֶΣ����ڱ�ʶclay��Ψһ��ʶ�� -->
                                        <input type="hidden" name="clayID[]" value="<?= $row['clayID']; ?>">
                                        <!-- ���ص��ֶΣ����ڱ�ʶRoleID -->
                                        <input type="hidden" name="roleID[]" value="<?= $row['roleID']; ?>">
                                    </tr>
                                    <?php
                                }

                                // �ر����ݿ�����
                                $con->close();
                                ?>
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript for email when low quantity -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var highQuantityRows = document.querySelectorAll('tr.high-quantity');
            highQuantityRows.forEach(function(row) {
                row.style.backgroundColor = 'lightgreen';
            });

            var mediumQuantityRows = document.querySelectorAll('tr.medium-quantity');
            mediumQuantityRows.forEach(function(row) {
                row.style.backgroundColor = 'lightsalmon';
            });

            // ������ӶԵͿ����ʼ����ѹ���
            var lowQuantityRows = document.querySelectorAll('tr.low-quantity');
            lowQuantityRows.forEach(function(row) {
                row.style.backgroundColor = 'red';

                // �ڴ˴���ӷ����ʼ����߼�������ͨ��Ajax�����˽ű������ʼ�
                // �������������ϵͳ���ý�����Ӧ������
                // ʾ�����루��Ҫ��������֧�֣���
                // var clayID = row.querySelector('[name="clayTrackUpdate[]"]').value;
                // var xhr = new XMLHttpRequest();
                // xhr.open('POST', 'send_email.php', true);
                // xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                // xhr.send('clayID=' + clayID);
            });
        });
    </script>
</body>
</html>

