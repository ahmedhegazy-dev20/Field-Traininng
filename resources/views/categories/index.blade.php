@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold">Menu Categories</h2>
    <a href="{{ route('dashboard') }}" class="btn btn-outline-light btn-sm">Back to Dashboard</a>
</div>

<div class="row">
    <div class="col-md-4 mb-4">
        <div class="card bg-black border border-secondary text-light p-3 shadow-sm">
            <h4 class="text-success mb-3 fw-bold">Add New Category</h4>
            <form method="POST" action="{{ route('categories.store') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Category Name</label>
                    <input type="text" name="name" class="form-control bg-dark text-light border-secondary" placeholder="e.g. Pizza, Burgers" required>
                </div>
                <button type="submit" class="btn btn-primary w-100 fw-bold">Save Category</button>
            </form>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card bg-black border border-secondary text-light p-3 shadow-sm">
            <h4 class="text-primary mb-3 fw-bold">Existing Categories</h4>
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <table class="table table-dark table-bordered table-hover align-middle">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Category Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>
                            <form action="{{ route('categories.destroy', $category) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger fw-bold" onclick="return confirm('Delete this category?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection