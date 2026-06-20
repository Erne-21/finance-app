@extends('layouts.app')
@section('title', 'Categories')

@section('content')
    <div class="row">
        <div class="col-md-5">
            <div class="card p-4 mb-4">
                <h5 class="mb-3">Add Category</h5>
                <form method="POST" action="{{ route('categories.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" placeholder="e.g. Food, Salary, Fuel"
                               value="{{ old('name') }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Type</label>
                        <select name="type" class="form-select" required>
                            <option value="income" {{ old('type') === 'income' ? 'selected' : '' }}>Income</option>
                            <option value="expense" {{ old('type') === 'expense' ? 'selected' : '' }}>Expense</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success w-100">Add Category</button>
                </form>
            </div>
        </div>

        <div class="col-md-7">
            <div class="card p-4">
                <h5 class="mb-3">Your Categories</h5>

                @if ($categories->isEmpty())
                    <p class="text-muted">No categories yet. Add one on the left.</p>
                @else
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Type</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr>
                                    <td>{{ $category->name }}</td>
                                    <td>
                                        <span class="badge {{ $category->type === 'income' ? 'badge-income' : 'badge-expense' }}">
                                            {{ ucfirst($category->type) }}
                                        </span>
                                    </td>
                                    <td class="text-end">
                                        <button type="button" class="btn btn-sm btn-outline-warning"
                                                data-bs-toggle="modal" data-bs-target="#editModal{{ $category->id }}">
                                            Edit
                                        </button>
                                        <form action="{{ route('categories.destroy', $category) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger"
                                                    onclick="return confirm('Delete this category? Related transactions will also be deleted.')">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>

                                <!-- Edit Modal -->
                                <div class="modal fade" id="editModal{{ $category->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form method="POST" action="{{ route('categories.update', $category) }}">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Category</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="form-label">Name</label>
                                                        <input type="text" name="name" class="form-control"
                                                               value="{{ $category->name }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Type</label>
                                                        <select name="type" class="form-select" required>
                                                            <option value="income" {{ $category->type === 'income' ? 'selected' : '' }}>Income</option>
                                                            <option value="expense" {{ $category->type === 'expense' ? 'selected' : '' }}>Expense</option>
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
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
@endsection