@extends('layouts.admin')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <h2 class="fw-bold mb-4">Admin Dashboard</h2>
    </div>
    
   
    <div class="col-md-6 mb-3">
        <div class="card bg-black border border-secondary text-light p-4 h-100 shadow-sm">
            <h3 class="text-primary fw-bold">Manage Categories</h3>
            <p class="text-white">Create and manage menu categories.</p>
            <div class="mt-auto">
                <a href="{{ route('categories.index') }}" class="btn btn-primary w-100 fw-bold">Go to Categories</a>
            </div>
        </div>
    </div>

    <div class="col-md-6 mb-3">
        <div class="card bg-black border border-secondary text-light p-4 h-100 shadow-sm">
            <h3 class="text-success fw-bold">Manage Meals</h3>
            <p class="text-white">Add, view, and organize meal items and prices.</p>
            <div class="mt-auto">
                <a href="{{ route('meals.index') }}" class="btn btn-success w-100 fw-bold">Go to Meals</a>
            </div>
        </div>
    </div>
</div>
@endsection