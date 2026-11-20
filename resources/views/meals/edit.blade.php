@extends('layouts.admin')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm p-4">
            <h4 class="text-warning mb-3">Edit Meal</h4>
            <form method="POST" action="{{ route('meals.update', $meal->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label class="form-label">Meal Name</label>
                    <input type="text" name="name" value="{{ $meal->name }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Category</label>
                    <select name="category_id" class="form-select" required>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $meal->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Price ($)</label>
                    <input type="number" step="0.01" name="price" value="{{ $meal->price }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Meal Image</label>
                    <input type="file" name="image" class="form-control">
                    @if($meal->image)
                        <div class="mt-2">
                            <img src="{{ asset($meal->image) }}" width="60" height="60" class="rounded">
                        </div>
                    @endif
                </div>

                <button type="submit" class="btn btn-warning w-100 fw-bold">Update Meal</button>
                <a href="{{ route('meals.index') }}" class="btn btn-secondary w-100 mt-2">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection