<?php
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'accounts_db';
$conn = new mysqli($host, $username, $password);
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === TRUE) {
    echo "Tạo thành công cơ sở dữ liệu $dbname .<br>";
} else {
    echo "Lỗi: " . $conn->error;
}

$conn->select_db($dbname);

$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50),
    password VARCHAR(50),
    lastname VARCHAR(50),
    firstname VARCHAR(50),
    city VARCHAR(50),
    email VARCHAR(100),
    course1 VARCHAR(50)
)";

if ($conn->query($sql) === TRUE) {
    echo "Tạo thành công bảng 'users'.<br>";
} else {
    echo "Lỗi: " . $conn->error;
}

$filename = "KTPM3_Danh_sach_diem_danh.csv";
if (($handle = fopen($filename, "r")) !== FALSE) {
    fgetcsv($handle);
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $username = $data[0];
        $password = $data[1];
        $lastname = $data[2];
        $firstname = $data[3];
        $city = $data[4];
        $email = $data[5];
        $course1 = $data[6];

        $stmt = $conn->prepare("INSERT INTO users (username, password, lastname, firstname, city, email, course1) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $username, $password, $lastname, $firstname, $city, $email, $course1);
        $stmt->execute();
    }

    fclose($handle);
    echo "Chèn dữ liệu vào bảng 'users' thành công.<br>";
} else {
    echo "Không thể mở file CSV.<br>";
}

$conn->close();
?>