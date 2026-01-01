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
                <h2>Book A Table</h2>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form_container">
                        <form
                            action="{{ isset($reservation) ? route('reservation.update', ['reservation' => $reservation->id]) : route('reservation.store') }}"
                            method="POST">
                            @csrf
                            @if (isset($reservation))
                                @method('PUT')
                            @endif
                            <div>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    placeholder="Your Name" name="name"
                                    value="{{ old('name', $reservation->name ?? '') }}">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div>
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                    placeholder="Phone Number" name="phone"
                                    value="{{ old('phone', $reservation->phone ?? '') }}">

                            </div>
                            <div>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <input type="text" class="form-control @error('email') is-invalid @enderror"
                                    placeholder="Your Email" name="email"
                                    value="{{ old('email', $reservation->email ?? '') }}">

                            </div>
                            <div>
                                <select class="form-control nice-select wide @error('people') is-invalid @enderror"
                                    name="people">
                                    @if (isset($reservation))
                                        <option value="{{ $reservation->people }}">{{ $reservation->people }} (Current
                                            Option)</option>
                                    @else
                                        <option value="" disabled selected>
                                            How many persons are invited?
                                        </option>
                                    @endif
                                    <option value="2">
                                        2
                                    </option>
                                    <option value="3">
                                        3
                                    </option>
                                    <option value="4">
                                        4
                                    </option>
                                    <option value="5">
                                        5
                                    </option>
                                </select>
                                @error('people')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div>
                                <input type="date" class="form-control @error('reservation_date') is-invalid @enderror"
                                    name="reservation_date"
                                    value="{{ old('reservation_date', $reservation->reservation_date ?? '') }}">
                                @error('reservation_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="btn_box">
                                @if (isset($reservation))
                                    <button>Edit Reservation</button>
                                @else
                                    <button>Book Now</button>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="map_container ">
                        <div id="googleMap"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
