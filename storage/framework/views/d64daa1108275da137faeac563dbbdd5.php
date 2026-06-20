
<?php $__env->startSection('title', 'Add Transaction'); ?>

<?php $__env->startSection('content'); ?>
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card p-4">
                <h4 class="mb-4">Add Transaction</h4>

                <?php if($categories->isEmpty()): ?>
                    <div class="alert alert-warning">
                        You don't have any categories yet.
                        <a href="<?php echo e(route('categories.index')); ?>">Create one first</a>.
                    </div>
                <?php else: ?>
                    <form method="POST" action="<?php echo e(route('transactions.store')); ?>">
                        <?php echo csrf_field(); ?>

                        <div class="mb-3">
                            <label class="form-label">Type</label>
                            <select name="type" id="type" class="form-select" required>
                                <option value="income" <?php echo e(old('type') === 'income' ? 'selected' : ''); ?>>Income</option>
                                <option value="expense" <?php echo e(old('type') === 'expense' ? 'selected' : ''); ?>>Expense</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Category</label>
                            <select name="category_id" class="form-select" required>
                                <option value="" disabled selected>Select a category</option>
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($category->id); ?>"
                                        data-type="<?php echo e($category->type); ?>"
                                        <?php echo e(old('category_id') == $category->id ? 'selected' : ''); ?>>
                                        <?php echo e($category->name); ?> (<?php echo e(ucfirst($category->type)); ?>)
                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Amount (€)</label>
                            <input type="number" step="0.01" min="0.01" name="amount" class="form-control"
                                   value="<?php echo e(old('amount')); ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Date</label>
                            <input type="date" name="date" class="form-control"
                                   value="<?php echo e(old('date', date('Y-m-d'))); ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Description (optional)</label>
                            <textarea name="description" class="form-control" rows="2"><?php echo e(old('description')); ?></textarea>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="<?php echo e(route('transactions.index')); ?>" class="btn btn-outline-secondary">Cancel</a>
                            <button type="submit" class="btn btn-success">Save Transaction</button>
                        </div>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\proje\finance-app\resources\views/transactions/create.blade.php ENDPATH**/ ?>