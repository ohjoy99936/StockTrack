<?php
// 创建数据库连接
$con = new mysqli("localhost", "root", "", "stocktrack");

// 检查连接是否成功
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// 查询数据库
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
                    <form action="clayTracks.php" method="POST">
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
                                // 检查查询是否成功
                                if (!$result) {
                                    die("Query failed: " . $con->error);
                                }

                                // 输出数据到 HTML 表格
                                while ($row = $result->fetch_assoc()) {
                                    $quantity = $row['quantity'];
                                    $rowClass = ($quantity < 5) ? 'low-quantity' : (($quantity > 20) ? 'high-quantity' : 'medium-quantity');
                                    ?>
                                    <tr class="<?= $rowClass; ?>">
                                        <td style="width:10px; text-align: center;">
                                            <input type="checkbox" name="clayTrackUpdate[]" value="<?= $row['clayID']; ?>">
                                        </td>
                                        <td><?= $row['clayName']; ?></td>
                                        <td><?= $quantity; ?></td>
                                        <td>
                                            <input type="number" name="adjustQuantity[]" value="0" min="-9999" max="9999">
                                        </td>
                                        <td><?= $row['date']; ?></td>
                                        
                                        <td><input type="text" name="notes[]" value="<?= $row['notes']; ?>"></td>
                                        <!-- 隐藏的字段，用于标识clay的唯一标识符 -->
                                        <input type="hidden" name="clayID[]" value="<?= $row['clayID']; ?>">
                                        <!-- 隐藏的字段，用于标识RoleID -->
                                        <input type="hidden" name="roleID[]" value="<?= $row['roleID']; ?>">
                                    </tr>
                                    <?php
                                }

                                // 关闭数据库连接
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
        });
    </script>
</body>
</html>
