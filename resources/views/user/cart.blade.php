@extends('user.index')
@section('content')
    <section class="book_section layout_padding">
        <div class="container">
            <div class="heading_container">
                <div class="align-self-end">
                    @if (session()->has('msg'))
                        <label for="message" id="message" class="alert alert-{{ session('msg_cls') }} alert-dismissible">
                            {{ session('msg') }}
                            <a class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </a>
                        </label>
                    @endif
                </div>
                <h2>Shopping Cart</h2>
            </div>
            <div class="container">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Unit Price</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td>
                                    <img src="{{ asset('images/product/' . $item->imageUrl) }}" width="60">
                                </td>
                                <td>{{ $item->price }}</td>
                                <td>
                                    <div class="product__details__option">
                                        <div class="quantity">
                                            <div class="{{ $edit == true ? 'pro-qty' : null }}">
                                                <input type="number" name="quantity" class="border-0"
                                                    value="{{ old('quantity', $item->quantity) }}"
                                                    {{ $edit == true ? null : 'disabled' }}
                                                    form="update_form_{{ $item->id }}">
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $item->price * $item->quantity }}</td>
                                <td>
                                    <a href="{{ route('cart.index', ['edit' => $item->id]) }}" class="btn btn-info btn-sm"
                                        onchange="updateQuantity({{ $item->id }})">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    &nbsp;
                                    <a href="javascript:void(0)" class="btn btn-danger btn-sm"
                                        onclick="deleteButton('remove_'+{{ $item->id }})">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td class="m-0 p-0" colspan="5">
                                    <div class="p-1" style="display: none;" id="remove_{{ $item->id }}"
                                        role="alert" aria-live="assertive" aria-atomic="true">
                                        <form action="{{ route('cart.destroy', $item->id) }}" method="POST"
                                            class="toast-body">
                                            @csrf
                                            @method('DELETE')
                                            <div>
                                                <span>Do you really want to remove
                                                    this
                                                    <i class="fa fa-arrow-circle-up"></i>
                                                    item from Cart?
                                                </span>
                                                <button class="btn btn-danger btn-sm">Remove</button>
                                                <button type="button" class="btn btn-outline-secondary btn-sm"
                                                    data-bs-dismiss="toast"
                                                    onclick='deleteButton("remove_"+{{ $item->id }});'>Close</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="p-1" style="display: {{ $edit == $item->id ? 'block' : 'none' }};"
                                        role="alert" aria-live="assertive" aria-atomic="true">
                                        <form action="{{ route('cart.update', $item->id) }}" method="POST"
                                            id="update_form_{{ $item->id }}" class="toast-body">
                                            @csrf
                                            @method('PUT')
                                            <div>
                                                <span>Do you really want to update
                                                    this
                                                    <i class="fa fa-arrow-circle-up"></i>
                                                    item quantity?
                                                </span>
                                                <button class="btn btn-info btn-sm">Update</button>
                                                <a href="{{ route('cart.index') }}"
                                                    class="btn btn-outline-secondary btn-sm">Close</a>
                                            </div>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        @if ($items->isEmpty())
                            <tr>
                                <td class='user_option'>
                                    <b>Your cart is empty, nothing to show for now</b>
                                    <a href={{ route('menu') }} class='order_online'>Continue Shopping?</a>
                                </td>
                            </tr>
                        @else
                            <tr>
                                <td colspan="3"></td>
                                <td class="pl-lg-5">
                                    <b>Grand Total:</b>
                                </td>
                                <td>$ {{ $grand_total }}</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan="5" class="continue__btn">
                                    <a href="{{ route('menu') }}" class="btn btn-outline-dark"><i
                                            class="fa fa-arrow-circle-left mr-2"></i>Back to Menu</a>
                                    <a href="{{ route('payment.index') }}" class="btn btn-outline-success">To Payment<i
                                            class="fa fa-arrow-circle-right ml-2"></i></a>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <script>
        function deleteButton(id) {
            var toast = document.getElementById(id);
            if (toast.style.display == "none") {
                toast.style.display = "block";
            } else {
                toast.style.display = "none";
            }
        };
    </script>
@endsection
