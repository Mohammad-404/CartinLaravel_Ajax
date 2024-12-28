<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Document</title>
</head>
<body>
    
    <form action="{{ Route('product.create') }}" method="POST">
        @csrf
        Category : 
        <select name="category">
            @foreach ($categories as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
            @endforeach
        </select>

        <input type="text" name="name" placeholder="name">
        <input type="text" name="details" placeholder="details">
        <input type="number" name="qty" placeholder="qty">
        <input type="number" name="price" placeholder="price">
        <input type="submit" value="save">
    </form>
    <br>
    <br>
    <br>
    <br>

    @if (Session::has('error_add'))
        {{ Session::get('error_add') }}
    @endif 

    @foreach ($products as $item)
        <div>
            <p>Category: {{ $item->category->name }}</p>
            <p>ID: {{ $item->id }}</p>
            <p>Name: {{ $item->name }}</p>
            <p>Details: {{ $item->details }}</p>
            <p>QTY: {{ $item->qty }}</p>
       
            {{-- <form action="{{ route('cart.add', $item->id) }}" method="POST">
                @csrf
                <input type="number" name="qty" value="{{ $item->qty }}">
                <button type="submit">Add to Cart</button>
            </form> --}}

            <form id="cart-form-{{ $item->id }}">
                @csrf
                <input type="number" name="qty" value="{{ $item->qty }}">
                <button type="button" onclick="addToCart({{ $item->id }})">Add to Cart</button>
            </form>
    
        </div>
    @endforeach



Fuckkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkk
{{-- <br>
@if (session('cart'))
    @foreach (session('cart') as $item)
        <p>Name : {{ $item['name'] }}</p>
        <p>QTY : {{ $item['qty'] }}</p>
    @endforeach
@endif --}}

Fuckkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkk 2222222222
<div id="cart-section">
    <h3>Your Cart</h3>
    <div id="cart-content">
        <!-- Cart items will be dynamically added here -->
        <p>Your cart is empty.</p>
    </div>
</div>

<script>
    function addToCart(productId) {
        const form = document.getElementById(`cart-form-${productId}`);
        const formData = new FormData(form);

        fetch(`{{ url('/cart/add') }}/${productId}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                // alert(data.message);
                fetchCart(); // Update the cart dynamically
            } else {
                // alert(data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
</script>

<script>
    function fetchCart() {
        fetch('{{ route('cart.view') }}')
            .then(response => response.json())
            .then(data => {
                const cartContent = document.getElementById('cart-content');
                cartContent.innerHTML = ''; // Clear the cart section
                
                if (data.cart && Object.keys(data.cart).length > 0) {
                    Object.values(data.cart).forEach(item => {
                        cartContent.innerHTML += `
                            <p>Name: ${item.name}</p>
                            <p>QTY: ${item.qty}</p>
                            <hr>
                        `;
                    });
                } else {
                    cartContent.innerHTML = '<p>Your cart is empty.</p>';
                }
            })
            .catch(error => {
                console.error('Error fetching cart:', error);
            });
    }

    // Call fetchCart whenever the page loads or after adding to the cart
    document.addEventListener('DOMContentLoaded', () => {
        fetchCart();
    });
</script>

    
</body>
</html>