@extends('layouts.admin')

@section('content')
<div class="row">

    <div class="col-md-4 mb-4">
        <div class="card shadow-sm p-3 bg-black">
            <h4 class="text-success mb-3">Add Meal</h4>
            <form method="POST" action="{{ route('meals.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3 ">
                    <label class="form-label text-white">Meal Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label text-white">Category</label>
                    <select name="category_id" class="form-select" required>
                        <option value="" text-white>Select Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label text-white">Price ($)</label>
                    <input type="number" step="0.01" name="price" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label text-white">Meal Image</label>
                    <input type="file" name="image" class="form-control">
                </div>
                <button type="submit" class="btn btn-success w-100 text-white">Save Meal</button>
            </form>
        </div>
    </div>

   
    <div class="col-md-8">
        <div class="card shadow-sm p-3">
            <h4 class="text-primary mb-3">Meals List</h4>
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($meals as $meal)
                    <tr>
                        <td>{{ $meal->id }}</td>
                        <td>{{ $meal->name }}</td>
                        <td><span class="badge bg-info text-dark">{{ $meal->category->name }}</span></td>
                        <td>${{ number_format($meal->price, 2) }}</td>
                        <td>
                            @if($meal->image)
                                <img src="{{ asset($meal->image) }}" width="50" height="50" class="rounded" style="object-fit: cover;">
                            @else
                                <span class="text-muted small">No Image</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex gap-1">
                           
                                <a href="{{ route('meals.edit', $meal->id) }}" class="btn btn-sm btn-warning">Edit</a>

                                <form action="{{ route('meals.destroy', $meal) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this meal?')">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection