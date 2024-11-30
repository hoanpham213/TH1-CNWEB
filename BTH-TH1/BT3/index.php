<?php
include('database.php'); // Kết nối cơ sở dữ liệu
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách Người dùng</title>
    <!-- Thêm CSS để cải thiện giao diện -->
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
        }
        h1 {
            text-align: center;
            color: #333;
            margin-top: 20px;
        }
        table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        table th, table td {
            border: 1px solid #ddd;
            text-align: center;
            padding: 10px;
        }
        table th {
            background-color: #f2f2f2;
            color: #333;
        }
        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        table tr:hover {
            background-color: #f1f1f1;
        }
        .no-data {
            text-align: center;
            color: #888;
            margin: 20px;
        }
    </style>
</head>
<body>
    <h1>Danh sách Người dùng</h1>
    
    <?php
    // Lấy dữ liệu từ cơ sở dữ liệu
    $sql = "SELECT * FROM users";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Lastname</th>
                    <th>Firstname</th>
                    <th>City</th>
                    <th>Email</th>
                    <th>Course</th>
                </tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row['id'] . "</td>
                    <td>" . $row['username'] . "</td>
                    <td>" . $row['password'] . "</td>
                    <td>" . $row['lastname'] . "</td>
                    <td>" . $row['firstname'] . "</td>
                    <td>" . $row['city'] . "</td>
                    <td>" . $row['email'] . "</td>
                    <td>" . $row['course1'] . "</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "<div class='no-data'>Không có dữ liệu.</div>";
    }

    $conn->close();
    ?>
</body>
</html>
