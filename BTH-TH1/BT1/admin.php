<?php include 'flowers.php'; ?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý danh sách hoa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1 class="text-center">Quản lý danh sách hoa</h1>
        <a href="add.php" class="btn btn-success mb-3">Thêm hoa mới</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Tên hoa</th>
                    <th>Mô tả</th>
                    <th>Hình ảnh</th>
                    <th>Sửa</th>
                    <th>Xóa</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($flowers as $flower): ?>
                    <tr>
                        <td><?php echo $flower['name']; ?></td>
                        <td><?php echo $flower['description']; ?></td>
                        <td><img src="<?php echo $flower['image']; ?>" width="100" alt="<?php echo $flower['name']; ?>"></td>
                        <td><a href="edit.php?id=<?php echo $flowert['id']; ?>"><i class="text-primary">✏️</i></a></td>
                        <td><a href="delete.php?id=<?php echo $flower['id']; ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa?');"><i class="text-danger">🗑️</i></a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
