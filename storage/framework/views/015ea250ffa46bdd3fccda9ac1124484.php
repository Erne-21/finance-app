<?php $__env->startSection('title', 'Reports'); ?>

<?php $__env->startSection('content'); ?>
    <h2 class="reports-title mb-4">Reports</h2>

    
    <div class="report-card mb-4">
        <h6 class="report-card-label">Filter by Period</h6>
        <form method="GET" action="<?php echo e(route('reports.index')); ?>" class="row g-3 align-items-end">
            <div class="col-md-5">
                <label class="report-field-label">From</label>
                <input type="date" name="date_from" class="form-control report-input" value="<?php echo e($dateFrom); ?>">
            </div>
            <div class="col-md-5">
                <label class="report-field-label">To</label>
                <input type="date" name="date_to" class="form-control report-input" value="<?php echo e($dateTo); ?>">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn report-btn-apply w-100">Apply Filter</button>
            </div>
        </form>
    </div>

    
    <div class="report-card mb-4">
        <h6 class="report-card-label">Section 1 — Transactions</h6>

        <?php if($transactions->isEmpty()): ?>
            <p class="report-muted mb-0">No transactions found for the selected period.</p>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table report-table mb-0">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Description</th>
                            <th>Category</th>
                            <th>Type</th>
                            <th class="text-end">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $transactions->sortByDesc('date'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="report-date"><?php echo e($t->date->format('d M Y')); ?></td>
                                <td><?php echo e($t->description ?: '—'); ?></td>
                                <td><?php echo e($t->category->name ?? '—'); ?></td>
                                <td>
                                    <span class="report-badge <?php echo e($t->type === 'income' ? 'report-badge-income' : 'report-badge-expense'); ?>">
                                        <?php echo e(ucfirst($t->type)); ?>

                                    </span>
                                </td>
                                <td class="text-end report-amount <?php echo e($t->type === 'income' ? 'report-amount-income' : 'report-amount-expense'); ?>">
                                    <?php echo e($t->type === 'income' ? '+' : '-'); ?>€<?php echo e(number_format($t->amount, 2)); ?>

                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>

    
    <div class="report-card mb-4">
        <h6 class="report-card-label">Section 2 — Totals by Category</h6>

        <?php if($byCategory->isEmpty()): ?>
            <p class="report-muted mb-0">No transactions found for the selected period.</p>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table report-table mb-0">
                    <thead>
                        <tr>
                            <th>Category</th>
                            <th>Type</th>
                            <th class="text-end">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $byCategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categoryName => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($categoryName); ?></td>
                                <td>
                                    <span class="report-badge <?php echo e($row['type'] === 'income' ? 'report-badge-income' : 'report-badge-expense'); ?>">
                                        <?php echo e(ucfirst($row['type'])); ?>

                                    </span>
                                </td>
                                <td class="text-end report-amount <?php echo e($row['type'] === 'income' ? 'report-amount-income' : 'report-amount-expense'); ?>">
                                    €<?php echo e(number_format($row['total'], 2)); ?>

                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>

    
    <div class="report-card">
        <h6 class="report-card-label">Section 3 — Statistical Analysis</h6>

        <div class="row g-4">
            <div class="col">
                <div class="report-stat-label">Min Transaction</div>
                <div class="report-stat-value">€<?php echo e(number_format($stats['min'], 2)); ?></div>
            </div>
            <div class="col">
                <div class="report-stat-label">Max Transaction</div>
                <div class="report-stat-value">€<?php echo e(number_format($stats['max'], 2)); ?></div>
            </div>
            <div class="col">
                <div class="report-stat-label">Average</div>
                <div class="report-stat-value">€<?php echo e(number_format($stats['avg'], 2)); ?></div>
            </div>
            <div class="col">
                <div class="report-stat-label">Total Income</div>
                <div class="report-stat-value report-amount-income">€<?php echo e(number_format($totalIncome, 2)); ?></div>
            </div>
            <div class="col">
                <div class="report-stat-label">Total Expenses</div>
                <div class="report-stat-value report-amount-expense">€<?php echo e(number_format($totalExpense, 2)); ?></div>
            </div>
        </div>

        <div class="row g-4 mt-2">
            <div class="col">
                <div class="report-stat-label"># Transactions</div>
                <div class="report-stat-value"><?php echo e($transactions->count()); ?></div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<style>
    .reports-title {
        color: #1f2937;
        font-weight: 700;
    }
    .report-card {
        background-color: #ffffff;
        border: 1px solid #e9ecef;
        border-radius: 12px;
        padding: 1.75rem;
        box-shadow: 0 2px 8px rgba(0,0,0,0.06);
    }
    .report-card-label {
        color: #6b7280;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.05em;
        font-weight: 700;
        margin-bottom: 1.25rem;
    }
    .report-field-label {
        color: #495057;
        font-size: 0.85rem;
        margin-bottom: 0.35rem;
        display: block;
    }
    .report-input {
        background-color: #fff;
        border: 1px solid #ced4da;
        color: #212529;
    }
    .report-input:focus {
        background-color: #fff;
        border-color: #4d7fff;
        color: #212529;
        box-shadow: 0 0 0 0.2rem rgba(77,127,255,0.15);
    }
    .report-btn-apply {
        background-color: #198754;
        border: none;
        color: #fff;
        font-weight: 600;
    }
    .report-btn-apply:hover {
        background-color: #157347;
        color: #fff;
    }
    .report-muted {
        color: #6b7280;
    }
    .report-table {
        color: #212529;
        margin-bottom: 0;
    }
    .report-table thead th {
        color: #6b7280;
        text-transform: uppercase;
        font-size: 0.72rem;
        letter-spacing: 0.04em;
        font-weight: 700;
        border-bottom: 1px solid #e9ecef;
        padding-bottom: 0.75rem;
    }
    .report-table tbody td {
        border-bottom: 1px solid #f1f3f5;
        padding-top: 0.85rem;
        padding-bottom: 0.85rem;
        vertical-align: middle;
    }
    .report-table tbody tr:last-child td {
        border-bottom: none;
    }
    .report-date {
        color: #6b7280;
    }
    .report-badge {
        display: inline-block;
        padding: 0.25rem 0.65rem;
        border-radius: 999px;
        font-size: 0.75rem;
        font-weight: 600;
    }
    .report-badge-income {
        background-color: rgba(25,135,84,0.12);
        color: #198754;
    }
    .report-badge-expense {
        background-color: rgba(220,53,69,0.12);
        color: #dc3545;
    }
    .report-amount {
        font-weight: 600;
        font-family: ui-monospace, "SF Mono", Menlo, Consolas, monospace;
    }
    .report-amount-income {
        color: #198754;
    }
    .report-amount-expense {
        color: #dc3545;
    }
    .report-stat-label {
        color: #6b7280;
        text-transform: uppercase;
        font-size: 0.7rem;
        letter-spacing: 0.04em;
        font-weight: 700;
        margin-bottom: 0.35rem;
    }
    .report-stat-value {
        color: #1f2937;
        font-size: 1.4rem;
        font-weight: 700;
        font-family: ui-monospace, "SF Mono", Menlo, Consolas, monospace;
    }
</style>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\proje\finance-app\resources\views/reports/index.blade.php ENDPATH**/ ?>