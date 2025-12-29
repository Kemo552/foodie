@extends('user.index')
@section('content')
    <section class="book_section layout_padding">
        <div class="container py-5">
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
        </div>
        <div class="container">
            <form action="{{ route('invoice.download', ['payment_id', $payment_id]) }}">
                @csrf
                <table class="table table-responsive-sm table-bordered table-hover" id="tblInvoice">
                    <thead class="bg-dark text-white">
                        <tr>
                            <th>#</th>
                            <th>Order Number</th>
                            <th>Item Name</th>
                            <th>Unit Price</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->order_no }}</td>
                                <td>{{ $item->product->name }}</td>
                                <td>{{ $item->unit_price }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ $item->total_price }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="text-center user_option">
                    <button class="order_online">
                        <i class="fa fa-file-pdf mr-2"></i> Download Invoice
                    </button>
                </div>
            </form>
        </div>
    </section>
@endsection
