<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart | Gourmet Haven</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">


    <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4">
        <a class="navbar-brand" href="{{ route('home') }}">Gourmet Haven</a>
        <div class="ms-auto">
            <a href="{{ route('cart.index') }}" class="btn btn-outline-light position-relative me-3">
                🛒 Cart
            </a>
            <a href="{{ route('home') }}" class="btn btn-light">Home Menu</a>
        </div>
    </nav>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3>Your Cart</h3>
                    <div>
                        <a href="{{ route('home') }}" class="btn btn-outline-secondary btn-sm">← Continue Shopping</a>
                        @if(session('cart') && count(session('cart')) > 0)
                            <a href="{{ route('cart.clear') }}" class="btn btn-outline-danger btn-sm">🗑️ Clear Cart</a>
                        @endif
                    </div>
                </div>

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @php $cart = session('cart', []); @endphp

                @if(count($cart) > 0)
                    <div class="card shadow-sm border-0 p-4">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th>Meal</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                @php $total = 0; @endphp
                                @foreach($cart as $id => $details)
                                    @php $total += $details['price'] * $details['quantity']; @endphp
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @if(isset($details['image']))
                                                    <img src="{{ asset($details['image']) }}" width="50" height="50" class="rounded me-2" style="object-fit: cover;">
                                                @endif
                                                <span>{{ $details['name'] }}</span>
                                            </div>
                                        </td>
                                        <td>${{ number_format($details['price'], 2) }}</td>
                                        <td>{{ $details['quantity'] }}</td>
                                        <td>${{ number_format($details['price'] * $details['quantity'], 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="text-end mt-3">
                            <h4>Total: <span class="text-success">${{ number_format($total, 2) }}</span></h4>
                            <a href="{{ route('checkout') }}" class="btn btn-success px-4 mt-2">Proceed to Checkout</a>
                        </div>
                    </div>
                @else
                    <div class="card shadow-sm border-0 p-5 text-center">
                        <div class="mb-3">
                            <span style="font-size: 50px;">🛒</span>
                        </div>
                        <h4 class="fw-bold">Your cart is empty</h4>
                        <p class="text-muted">Add meals to your cart from the menu.</p>
                        <div class="mt-3">
                            <a href="{{ route('home') }}" class="btn btn-warning text-dark fw-bold px-4">Go to Menu</a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

</body>
</html>