@extends('user.index')
@section('content')
    <style>
        .rounded {
            border-radius: 1rem;
        }

        .nav-pills .nav-link {
            color: #555;
        }

        .nav-pills .nav-link.active {
            color: #000;
            background-color: #ffbe33;
        }

        input[type="radio"] {
            margin-right: 5px;
        }

        .bold {
            font-weight: bold;
        }
    </style>
    <script>
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
    {{-- function for disable back button --}}
    {{-- <script type="text/javascript">
        function DisableBackButton() {
            window.history.forward();
        }
        DisableBackButton();
        window.onload = DisableBackButton;
        window.onpageshow = function(evt) {
            if (evt.persisted) DisableBackButton()
        }
        window.onunload = function() {
            void(0)
        }
    </script> --}}
    {{ $month = 1 }}
    <section class="book_section"
        style="background-image: url('../Images/payment-bg.png'); width: 100%; height: 100%; background-repeat: no-repeat; background-size: auto; background-attachment: fixed; background-position: left;">

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
            <!-- For demo purpose -->
            <div class="row mb-4">
                <div class="col-lg-8 mx-auto text-center">
                    <h1 class="display-6">Order Payment</h1>
                </div>
            </div>
            <!-- End -->
            <div class="row pb-5">
                <div class="col-lg-6 mx-auto">
                    <div class="card ">
                        <div class="card-header">
                            <div class="bg-white shadow-sm pt-4 pl-2 pr-2 pb-2">
                                <!-- Payment type tabs -->
                                <ul role="tablist" class="nav bg-light nav-pills rounded nav-fill mb-3">
                                    <li class="nav-item">
                                        <a data-toggle="pill" href="#credit-card" class="nav-link active ">
                                            <i class="fa fa-credit-card mr-2"></i>Credit Card
                                        </a>
                                    </li>
                                    <li class="nav-item"><a data-toggle="pill" href="#paypal" class="nav-link ">
                                            <i class="fa fa-money mr-2"></i>Cash On Delivery </a>
                                    </li>
                                </ul>
                                <!-- End -->
                            </div>
                            <!-- Credit card form content -->
                            <div class="tab-content">
                                <!-- credit card info-->
                                <form action="{{ route('payment.store') }}" method="POST" id="credit-card"
                                    class="tab-pane fade show active pt-3">
                                    @csrf
                                    <div role="form">
                                        <div class="form-group">
                                            <label for="name">
                                                <h6>Card Owner</h6>
                                            </label>
                                            <input type="text" placeholder="Full name"
                                                class="form-control mb-0 @error('name') is-invalid @enderror"
                                                name="name">
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="card_no">
                                                <h6>Card number</h6>
                                            </label>
                                            <div class="input-group">
                                                <input type="text" placeholder="Card Number"
                                                    class="form-control mb-0 @error('card_no') is-invalid @enderror"
                                                    name="card_no">
                                                @error('card_no')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                <div class="input-group-append">
                                                    <span class="input-group-text text-muted">
                                                        <i class="fab fa-cc-visa mx-1"></i>
                                                        <i class="fab fa-cc-mastercard mx-1"></i>
                                                        <i class="fab fa-cc-amex mx-1"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <div class="form-group">
                                                    <label>
                                                        <span class="hidden-xs">
                                                            <h6>Expiration Date</h6>
                                                        </span>
                                                    </label>
                                                    <div class="input-group">
                                                        <select name="month"
                                                            class="form-control mb-0 @error('month') is-invalid @enderror">
                                                            <option value="0" selected disabled>Select a month
                                                            </option>
                                                            @for ($month; $month <= 12; $month++)
                                                                <option value="{{ $month }}">{{ $month }}
                                                                </option>
                                                            @endfor
                                                        </select>
                                                        @error('month')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                        <select name="year"
                                                            class="form-control mb-0 @error('year') is-invalid @enderror">
                                                            <option value="0" selected disabled>Select a year
                                                            </option>
                                                            @for ($year; $year <= $last; $year++)
                                                                <option value="{{ $year }}">{{ $year }}
                                                                </option>
                                                            @endfor
                                                        </select>
                                                        @error('year')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group mb-4">
                                                    <label data-toggle="tooltip"
                                                        title="Three digit CV code on the back of your card">
                                                        <h6>CVV <i class="fa fa-question-circle d-inline"></i></h6>
                                                    </label>
                                                    <input type="number" placeholder="cvv" max="999" min="001"
                                                        class="form-control mb-0 @error('cvv') is-invalid @enderror"
                                                        name="cvv">
                                                    @error('cvv')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="txtAddress">
                                            <h6>Delivery Address</h6>
                                        </label>
                                        <input type="text" placeholder="Delivery Address"
                                            class="form-control mb-0 @error('delivery_address') is-invalid @enderror"
                                            name="delivery_address">
                                        @error('delivery_address')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="">
                                        <button class="btn btn-outline-success btn-block shadow-sm subscribe">
                                            <i class="fa fa-cart-arrow-down mr-2"></i>Confirm Payment
                                        </button>
                                    </div>
                                </form>
                                <!-- End -->
                                <!-- Cash On Delivery info -->
                                <form action="{{ route('payment.store') }}" method="POST" id="paypal"
                                    class="tab-pane fade pt-3">
                                    @csrf
                                    <div class="form-group">
                                        <label for="txtCODAddress">
                                            <h6>Delivery Address</h6>
                                        </label>
                                        <input type="text" placeholder="Cash on delivery address"
                                            class="form-control mb-0 @error('cod_address') is-invalid @enderror"
                                            name="cod_address" required>
                                        @error('cod_address')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <p class="user_option">
                                        <button class="btn btn-outline-success">
                                            <i class="fa fa-cart-arrow-down mr-2"></i>Confirm Payment
                                        </button>
                                    </p>
                                    <p class="text-muted">
                                        Note: At the point of recieving your order, you need to do full payment.
                                        After completing the payment process, you can check your updated order status.
                                    </p>
                                </form>
                                <!-- End -->
                            </div>
                            <!-- End -->
                        </div>
                        {{-- <div class="card-footer">
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
