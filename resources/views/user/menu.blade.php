@extends('user.index')
@section('content')
    <section class="food_section layout_padding">
        <div class="container">
            <div class="heading_container heading_center">
                <h2>
                    Our Menu
                </h2>
            </div>

            <ul class="filters_menu">
                <li class="active" data-filter="*" data-id='0'>All</li>
                @foreach ($categories as $category)
                    <li data-filter=".{{ Str::lower($category->name) }}" data-id="{{ $category->id }}">{{ $category->name }}
                    </li>
                @endforeach
            </ul>

            <div class="filters-content">
                <div class="row grid">
                    @foreach ($products as $product)
                        <div class="col-sm-6 col-lg-4 all {{ Str::lower($product->category->name) }}">
                            <div class="box">
                                <div>
                                    <div class="img-box">
                                        <img src="{{ asset('images/product/' . $product->imageUrl) }}" alt="">
                                    </div>
                                    <div class="detail-box">
                                        <h5>
                                            {{ $product->name }}
                                        </h5>
                                        <p>
                                            {{ $product->description }}
                                        </p>
                                        <form action="{{ route('cart.store') }}" method="POST" class="options">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <h6>
                                                {{ $product->price }}
                                            </h6>
                                            <button type="submit" class="btn btn-outline-warning">
                                                <i class="fa fa-shopping-cart"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            {{-- <div class="btn-box">
                <a href="">
                    View More
                </a>
            </div> --}}
        </div>
    </section>
@endsection
