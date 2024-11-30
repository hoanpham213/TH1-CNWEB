<?php
include('database.php');

if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $sql = "DELETE FROM users WHERE id=$delete_id";
    if ($conn->query($sql) === TRUE) {
        echo "Xóa thành công.";
    } else {
        echo "Lỗi: " . $conn->error;
    }
}

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $lastname = $_POST['lastname'];
    $firstname = $_POST['firstname'];
    $city = $_POST['city'];
    $email = $_POST['email'];
    $course1 = $_POST['course1'];

    $sql = "INSERT INTO users (username, password, lastname, firstname, city, email, course1) 
            VALUES ('$username', '$password', '$lastname', '$firstname', '$city', '$email', '$course1')";
    if ($conn->query($sql) === TRUE) {
        echo "Thêm thành công.";
    } else {
        echo "Lỗi: " . $conn->error;
    }
}

$sql = "SELECT * FROM users";
$result = $conn->query($sql);

echo "<h1>Quản trị người dùng</h1>";
echo "<h3>Thêm người dùng mới</h3>";
?>

<form method="POST" action="admin.php">
    <label for="username">Username:</label><br>
    <input type="text" name="username" required><br><br>
    <label for="password">Password:</label><br>
    <input type="password" name="password" required><br><br>
    <label for="lastname">Lastname:</label><br>
    <input type="text" name="lastname" required><br><br>
    <label for="firstname">Firstname:</label><br>
    <input type="text" name="firstname" required><br><br>
    <label for="city">City:</label><br>
    <input type="text" name="city" required><br><br>
    <label for="email">Email:</label><br>
    <input type="email" name="email" required><br><br>
    <label for="course1">Course:</label><br>
    <input type="text" name="course1" required><br><br>
    <input type="submit" name="submit" value="Thêm người dùng">
</form>

<?php
if ($result->num_rows > 0) {
    echo "<h3>Danh sách người dùng</h3>";
    echo "<table border='1'>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Password</th>
                <th>Lastname</th>
                <th>Firstname</th>
                <th>City</th>
                <th>Email</th>
                <th>Course</th>
                <th>Thao tác</th>
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
                <td>
                    <a href='admin.php?delete_id=" . $row['id'] . "'>Xóa</a>
                </td>
            </tr>";
    }
    echo "</table>";
} else {
    echo "Không có dữ liệu.";
}

$conn->close();
?>