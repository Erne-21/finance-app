@extends('layouts.app')
@section('content')
<div class="row mb-4">
    <div class="col-md-4"><div class="card text-white bg-success p-3">
        <h5>Total Income</h5><h3>€{{ number_format($totalIncome,2) }}</h3>
    </div></div>
    <div class="col-md-4"><div class="card text-white bg-danger p-3">
        <h5>Total Expenses</h5><h3>€{{ number_format($totalExpense,2) }}</h3>
    </div></div>
    <div class="col-md-4"><div class="card text-white bg-primary p-3">
        <h5>Balance</h5><h3>€{{ number_format($balance,2) }}</h3>
    </div></div>
</div>
<a href="{{ route('transactions.create') }}" class="btn btn-success mb-3">+ Add Transaction</a>
<table class="table table-striped">
    <thead><tr><th>Date</th><th>Type</th><th>Category</th><th>Amount</th><th>Actions</th></tr></thead>
    <tbody>
    @foreach($transactions as $t)
    <tr>
        <td>{{ $t->date->format('d M Y') }}</td>
        <td><span class="badge bg-{{ $t->type=='income'?'success':'danger' }}">{{ $t->type }}</span></td>
        <td>{{ $t->category->name }}</td>
        <td>€{{ number_format($t->amount,2) }}</td>
        <td>
            <a href="{{ route('transactions.edit',$t) }}" class="btn btn-sm btn-warning">Edit</a>
            <form method="POST" action="{{ route('transactions.destroy',$t) }}" class="d-inline">
                @csrf @method('DELETE')
                <button class="btn btn-sm btn-danger" onclick="return confirm('Delete?')">Del</button>
            </form>
        </td>
    </tr>
    @endforeach
    </tbody>
</table>
@endsection