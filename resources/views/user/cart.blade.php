@extends('app')

@section('content')
<div>
    <section class="mt-5">
        <div>
            <h5 class="text-muted">
                <small>
                    Fresh produce is just a step away.
                </small>
            </h5>
            <h2>Your Basket of Freshness</h2>
        </div>
        
        <div class="mt-5 container-fluid m-0 p-0 overflow-hidden border-bottom">
            
            @forelse ($cart->cartItems as $cart_item)
                <div class="row border-top py-2 m-0">
                    <a href="{{ route('product-detail.page', ['product' => $cart_item->product]) }}" class="col-3 col-md-2 overflow-hidden p-0">
                        <img src="{{ asset($cart_item->product->image) }}" alt="{{ $cart_item->product->name }}" class="img-fluid">
                    </a>
                    <div class="col-9 col-md-10 d-flex flex-column justify-content-between">
                        <div>
                            <div>
                                <h5 class="fw-normal text-truncate">{{ $cart_item->product->name }} Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ducimus, officiis nihil aspernatur deleniti voluptate impedit est debitis iste aperiam suscipit natus unde nesciunt dolorem magnam dolores a ex mollitia eaque, iusto voluptates fugiat saepe. Distinctio omnis, obcaecati possimus nobis iste quia, vitae velit aliquam provident qui nisi tempore praesentium maiores aperiam ratione, illo beatae hic cum facilis dolor voluptatibus autem temporibus animi. Laboriosam delectus architecto omnis impedit ducimus, facilis animi libero? Nobis porro blanditiis repellendus, eligendi facere animi est ut vitae quis dolor excepturi ipsa natus dicta eaque neque quidem, iusto voluptatum ducimus tempora! Fugit cumque adipisci nobis quaerat quisquam.</h5>
                            </div>
                            <div class="d-flex flex-row gap-3 align-items-center">
                                <h5 class="fw-bold m-0">Rp {{ number_format($cart_item->cartItemPrice(), 0, ',', '.') }}</h5>
                                @if ($cart_item->product->stock < $cart_item->quantity)
                                    <span class="m-0 badge text-bg-secondary bg-danger">
                                        Out of Stock
                                    </span>
                                @elseif ($cart_item->product->stock == $cart_item->quantity)
                                    <span class="m-0 badge text bg-secondary bg-warning">
                                        {{ $cart_item->product->stock }} items left
                                    </span>
                                @else
                                    <span class="m-0 badge text bg-secondary bg-success">
                                        {{ $cart_item->product->stock }} items left
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="mt-3 mt-md-0 w-100 d-flex flex-row justify-content-end">
                            <div class="d-flex w-75-md-25 flex-row justify-content-end gap-1">       
                                <form action="{{ route('update-cart-item.decrement.action', ['cart_item' => $cart_item]) }}" method="POST" class="m-0">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn">
                                        @if ($cart_item->quantity == 1)
                                            <i class="fa-solid fa-trash"></i>
                                        @else
                                            <i class="fa-solid fa-minus"></i>
                                        @endif
                                    </button>
                                </form>
                                
                                <input type="number" value={{ $cart_item->quantity }} class="w-75 p-0 m-0 text-center" disabled>
                                
                                <form action="{{ route('update-cart-item.increment.action', ['cart_item' => $cart_item]) }}" method="POST" class="m-0">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn">
                                        <i class="fa-solid fa-plus"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="alert alert-info mt-2">
                    Your cart is empty
                </div>
            @endforelse
        </div>

    </section>
    
    @if (!$cart->cartItems->isEmpty())
        <section class="mt-3 d-flex align-items-end justify-content-between bg-white" style="height: 5rem; width: 100%;">
            <div class="">
                <h6 class="text-muted">Total Price</h6>
                <h5>Rp {{number_format($cart->total_price, 0, ',', '.') }}</h5>
            </div>
            <a href="{{ route('checkout.page') }}" class="btn btn-success">
                Checkout
            </a>
        </section>
    @endif
    
</div>

@endsection
