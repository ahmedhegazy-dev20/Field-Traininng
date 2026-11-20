<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gourmet Haven | Menu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

 
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4">
        <a class="navbar-brand" href="{{ route('home') }}">Gourmet Haven</a>
        <div class="ms-auto">
            <a href="{{ route('cart.index') }}" class="btn btn-outline-light position-relative me-3">
                🛒 Cart
            </a>
            @auth
                <a href="{{ route('dashboard') }}" class="btn btn-light">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="btn btn-outline-light me-2">Log in</a>
                <a href="{{ route('register') }}" class="btn btn-warning">Register</a>
            @endauth
        </div>
    </nav>

    <div class="container py-5">
        <div class="row">
        
            <div class="col-md-9">
                <div class="row mb-4">
                    <div class="col-12">
                        <h2 class="fw-bold mb-3">Our Menu</h2>
                        <!-- Category Filter Buttons -->
                        <div class="d-flex gap-2 my-3 flex-wrap">
                            <a href="{{ route('home') }}" class="btn btn-sm {{ request('category') ? 'btn-outline-warning text-dark' : 'btn-warning' }}">Show All</a>
                            @foreach($categories as $cat)
                                <a href="{{ route('home', ['category' => $cat->id]) }}" class="btn btn-sm {{ request('category') == $cat->id ? 'btn-warning' : 'btn-outline-warning text-dark' }}">
                                    {{ $cat->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="row">
                    @forelse($meals as $meal)
                        <div class="col-md-6 mb-4">
                            <div class="card h-100 shadow-sm border-0 d-flex flex-row align-items-center p-3">
                                @if($meal->image)
                                    <img src="{{ asset($meal->image) }}" alt="{{ $meal->name }}" class="rounded" style="width: 120px; height: 120px; object-fit: cover;">
                                @endif
                                <div class="card-body ps-3">
                                    <span class="badge bg-warning text-dark mb-1">{{ $meal->category->name }}</span>
                                    <h5 class="card-title fw-bold text-dark mb-1">{{ $meal->name }}</h5>
                                    <p class="text-muted small mb-2">Delicious meal prepared fresh.</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="fw-bold text-success">${{ number_format($meal->price, 2) }}</span>
                                        <form action="{{ route('cart.add', $meal->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm">Add to Cart</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center">
                            <p class="text-muted fs-5">No meals found in this category.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <div class="col-md-3 text-end d-none d-md-block">
                <h1 class="display-5 fw-bold text-secondary" style="writing-mode: vertical-rl; text-orientation: mixed; margin: auto;">Gourmet Haven</h1>
            </div>
        </div>
    </div>

</body>
</html>