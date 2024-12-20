<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Manage Issues</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Inter', sans-serif;
        }

        .table-title {
            background-color: #343a40;
            color: white;
            padding: 15px;
            border-radius: 5px 5px 0 0;
        }

        .table-wrapper {
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            background-color: #ffffff;
            overflow: hidden;
        }

        .table th, .table td {
            vertical-align: middle;
        }

        .btn {
            border-radius: 30px;
            transition: all 0.3s;
        }

        .btn:hover {
            transform: scale(1.05);
        }

        .pagination .page-link {
            border-radius: 50%;
        }

        .modal-content {
            border-radius: 15px;
        }
    </style>
</head>
<body>
    <div class="container my-4">
        <div class="table-wrapper">
            <div class="table-title d-flex justify-content-between align-items-center">
                <h3>Manage <b>Computer lab</b></h3>
                <a href="<?php echo e(route('issue.create')); ?>" class="btn btn-success">
                    <i class="fas fa-plus-circle me-2"></i>Thêm vấn đề mới
                </a>
            </div>
            <?php if(session('success')): ?>
                <div class="alert alert-success mt-2">
                    <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>
            <table class="table table-striped table-hover text-center mt-3">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Tên máy</th>
                        <th>Tên phiên bản</th>
                        <th>Người báo cáo</th>
                        <th>Thời gian báo cáo</th>
                        <th>Mức độ sự cố</th>
                        <th>Trạng thái</th>
                        <th>Hoạt động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $issues; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $issue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($issue->id); ?></td>
                            <td><?php echo e($issue->computer->computer_name); ?></td>
                            <td><?php echo e($issue->computer->model); ?></td>
                            <td><?php echo e($issue->reported_by); ?></td>
                            <td><?php echo e($issue->reported_date); ?></td>
                            <td>
                                <span class="badge bg-<?php echo e($issue->urgency === 'High' ? 'danger' : ($issue->urgency === 'Medium' ? 'warning' : 'success')); ?>">
                                    <?php echo e($issue->urgency); ?>

                                </span>
                            </td>
                            <td>
                                <span class="badge bg-<?php echo e($issue->status === 'Open' ? 'primary' : 'secondary'); ?>">
                                    <?php echo e($issue->status); ?>

                                </span>
                            </td>
                            <td>
                                <a href="<?php echo e(route('issue.edit', $issue->id)); ?>" class="btn btn-warning btn-sm me-2">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo e($issue->id); ?>">
                                    <i class="fas fa-trash-alt"></i>
                                </button>

                                <!-- Delete Confirmation Modal -->
                                <div class="modal fade" id="deleteModal<?php echo e($issue->id); ?>" tabindex="-1" aria-labelledby="deleteModalLabel<?php echo e($issue->id); ?>" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Xác nhận xóa</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Bạn có chắc chắn muốn xóa vấn đề này không <b>#<?php echo e($issue->id); ?></b>?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                                                <form action="<?php echo e(route('issue.destroy', $issue->id)); ?>" method="POST">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <button type="submit" class="btn btn-danger">Xóa</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                <?php echo e($issues->links('pagination::bootstrap-5')); ?>

            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\TH4\QUANLYPHONGTHUCHANHTINHOC\resources\views/issue/index.blade.php ENDPATH**/ ?>