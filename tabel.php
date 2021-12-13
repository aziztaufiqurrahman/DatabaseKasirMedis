<?php
include "models/employees.php";
$data = Employees::getAll($db);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table>
        <tr>
            <td>No.</td>
            <td>Username</td>
            <td>Nama</td>
        </tr>
        <?php
            foreach ($data as $key => $val)
            {
                $employee = $data[$key];
                echo "<tr>";
                echo "<td>".($key + 1)."</td>";
                echo "<td>".$employee['USERNAME']."</td>";
                echo "<td>".$employee['NAME']."</td>";
                echo "</tr>";
            }
            ?>
    </table>
</body>
</html>