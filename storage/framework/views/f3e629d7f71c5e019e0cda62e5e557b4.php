<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'Finance App'); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f4f6f9; }
        .navbar-brand { font-weight: 600; }
        .card { border: none; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.06); }
        .badge-income { background-color: #198754; }
        .badge-expense { background-color: #dc3545; }
    </style>
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark px-3">
    <a class="navbar-brand" href="<?php echo e(route('transactions.index')); ?>">Finance App</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navMenu">
        <ul class="navbar-nav me-auto">
            <li class="nav-item">
                <a class="nav-link <?php echo e(request()->routeIs('transactions.*') ? 'active fw-bold' : ''); ?>"
                   href="<?php echo e(route('transactions.index')); ?>">Transactions</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo e(request()->routeIs('categories.*') ? 'active fw-bold' : ''); ?>"
                   href="<?php echo e(route('categories.index')); ?>">Categories</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo e(request()->routeIs('reports.*') ? 'active fw-bold' : ''); ?>"
                   href="<?php echo e(route('reports.index')); ?>">Reports</a>
            </li>
        </ul>
        <div class="d-flex align-items-center">
            <?php if(auth()->guard()->check()): ?>
                <span class="text-white-50 me-3"><?php echo e(auth()->user()->name); ?></span>
                <form method="POST" action="<?php echo e(route('logout')); ?>">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="btn btn-sm btn-outline-light">Logout</button>
                </form>
            <?php endif; ?>
        </div>
    </div>
</nav>

<div class="container mt-4 mb-5">
    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if($errors->any()): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul class="mb-0">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php echo $__env->yieldContent('content'); ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\proje\finance-app\resources\views/layouts/app.blade.php ENDPATH**/ ?>