@extends('layouts.app')
@section('title', 'Edit Transaction')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card p-4">
                <h4 class="mb-4">Edit Transaction</h4>

                @if ($categories->isEmpty())
                    <div class="alert alert-warning">
                        You don't have any categories yet.
                        <a href="{{ route('categories.index') }}">Create one first</a>.
                    </div>
                @else
                    <form method="POST" action="{{ route('transactions.update', $transaction) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">Type</label>
                            <select name="type" id="type" class="form-select" required>
                                <option value="income" {{ old('type', $transaction->type) === 'income' ? 'selected' : '' }}>Income</option>
                                <option value="expense" {{ old('type', $transaction->type) === 'expense' ? 'selected' : '' }}>Expense</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Category</label>
                            <select name="category_id" class="form-select" required>
                                <option value="" disabled>Select a category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        data-type="{{ $category->type }}"
                                        {{ old('category_id', $transaction->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }} ({{ ucfirst($category->type) }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Amount (€)</label>
                            <input type="number" step="0.01" min="0.01" name="amount" class="form-control"
                                   value="{{ old('amount', $transaction->amount) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Date</label>
                            <input type="date" name="date" class="form-control"
                                   value="{{ old('date', $transaction->date->format('Y-m-d')) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Description (optional)</label>
                            <textarea name="description" class="form-control" rows="2">{{ old('description', $transaction->description) }}</textarea>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('transactions.index') }}" class="btn btn-outline-secondary">Cancel</a>
                            <button type="submit" class="btn btn-success">Update Transaction</button>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection
