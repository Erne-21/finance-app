
<?php $__env->startSection('content'); ?>
<div class="row mb-4">
    <div class="col-md-4"><div class="card text-white bg-success p-3">
        <h5>Total Income</h5><h3>€<?php echo e(number_format($totalIncome,2)); ?></h3>
    </div></div>
    <div class="col-md-4"><div class="card text-white bg-danger p-3">
        <h5>Total Expenses</h5><h3>€<?php echo e(number_format($totalExpense,2)); ?></h3>
    </div></div>
    <div class="col-md-4"><div class="card text-white bg-primary p-3">
        <h5>Balance</h5><h3>€<?php echo e(number_format($balance,2)); ?></h3>
    </div></div>
</div>
<a href="<?php echo e(route('transactions.create')); ?>" class="btn btn-success mb-3">+ Add Transaction</a>
<table class="table table-striped">
    <thead><tr><th>Date</th><th>Type</th><th>Category</th><th>Amount</th><th>Actions</th></tr></thead>
    <tbody>
    <?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr>
        <td><?php echo e($t->date->format('d M Y')); ?></td>
        <td><span class="badge bg-<?php echo e($t->type=='income'?'success':'danger'); ?>"><?php echo e($t->type); ?></span></td>
        <td><?php echo e($t->category->name); ?></td>
        <td>€<?php echo e(number_format($t->amount,2)); ?></td>
        <td>
            <a href="<?php echo e(route('transactions.edit',$t)); ?>" class="btn btn-sm btn-warning">Edit</a>
            <form method="POST" action="<?php echo e(route('transactions.destroy',$t)); ?>" class="d-inline">
                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                <button class="btn btn-sm btn-danger" onclick="return confirm('Delete?')">Del</button>
            </form>
        </td>
    </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\proje\finance-app\resources\views/transactions/index.blade.php ENDPATH**/ ?>