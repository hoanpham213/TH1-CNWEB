<?php include 'flowers.php'; ?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách hoa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container mt-4">
        <h1 class="text-center mb-4">Danh Sách Các Loài Hoa</h1>
        <?php foreach ($flowers as $flower): ?>
            <div class="flower-item">
                <h3><?php echo $flower['id'], '.', $flower['name']; ?></h3>
                <img src="<?php echo $flower['image']; ?>" alt="<?php echo $flower['name']; ?>">
                <p><?php echo $flower['description']; ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
