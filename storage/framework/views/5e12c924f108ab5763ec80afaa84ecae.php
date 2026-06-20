
<?php $__env->startSection('title', 'Categories'); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-5">
            <div class="card p-4 mb-4">
                <h5 class="mb-3">Add Category</h5>
                <form method="POST" action="<?php echo e(route('categories.store')); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" placeholder="e.g. Food, Salary, Fuel"
                               value="<?php echo e(old('name')); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Type</label>
                        <select name="type" class="form-select" required>
                            <option value="income" <?php echo e(old('type') === 'income' ? 'selected' : ''); ?>>Income</option>
                            <option value="expense" <?php echo e(old('type') === 'expense' ? 'selected' : ''); ?>>Expense</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success w-100">Add Category</button>
                </form>
            </div>
        </div>

        <div class="col-md-7">
            <div class="card p-4">
                <h5 class="mb-3">Your Categories</h5>

                <?php if($categories->isEmpty()): ?>
                    <p class="text-muted">No categories yet. Add one on the left.</p>
                <?php else: ?>
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Type</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($category->name); ?></td>
                                    <td>
                                        <span class="badge <?php echo e($category->type === 'income' ? 'badge-income' : 'badge-expense'); ?>">
                                            <?php echo e(ucfirst($category->type)); ?>

                                        </span>
                                    </td>
                                    <td class="text-end">
                                        <button type="button" class="btn btn-sm btn-outline-warning"
                                                data-bs-toggle="modal" data-bs-target="#editModal<?php echo e($category->id); ?>">
                                            Edit
                                        </button>
                                        <form action="<?php echo e(route('categories.destroy', $category)); ?>" method="POST" class="d-inline">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="btn btn-sm btn-outline-danger"
                                                    onclick="return confirm('Delete this category? Related transactions will also be deleted.')">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>

                                <!-- Edit Modal -->
                                <div class="modal fade" id="editModal<?php echo e($category->id); ?>" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form method="POST" action="<?php echo e(route('categories.update', $category)); ?>">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('PUT'); ?>
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Category</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="form-label">Name</label>
                                                        <input type="text" name="name" class="form-control"
                                                               value="<?php echo e($category->name); ?>" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Type</label>
                                                        <select name="type" class="form-select" required>
                                                            <option value="income" <?php echo e($category->type === 'income' ? 'selected' : ''); ?>>Income</option>
                                                            <option value="expense" <?php echo e($category->type === 'expense' ? 'selected' : ''); ?>>Expense</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-warning">Save Changes</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\proje\finance-app\resources\views/categories/index.blade.php ENDPATH**/ ?>