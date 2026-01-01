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
                <h2>Your Reservations</h2>
            </div>
            <div class="container">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Reserved by</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Invited people</th>
                            <th>Date of reservation</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reservations as $reservation)
                            <tr>
                                <td>{{ $reservation->name }}</td>
                                <td>{{ $reservation->email }}</td>
                                <td>{{ $reservation->phone }}</td>
                                <td>
                                    <div class="product__details__option">
                                        <div class="quantity">
                                            <div class="{{ $edit == true ? 'pro-qty' : null }}">
                                                <input type="number" name="people" class="border-0"
                                                    value="{{ old('people', $reservation->people) }}" max="10"
                                                    min="2" {{ $edit == true ? null : 'disabled' }}
                                                    form="update_form_{{ $reservation->id }}">
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $reservation->reservation_date }}</td>
                                <td>
                                    <label data-toggle="tooltip" title="Edit whole reservation details">
                                        <a href="{{ route('reservation.edit', ['reservation' => $reservation->id]) }}"
                                            class="btn btn-info btn-sm">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                    </label>

                                    &nbsp;
                                    <label data-toggle="tooltip" title="Quickly update invited people">
                                        <a href="{{ route('reservation.index', ['edit' => $reservation->id]) }}"
                                            class="btn btn-success btn-sm"
                                            onchange="updateQuantity({{ $reservation->id }})">
                                            <i class="fa fa-user"></i>
                                        </a>
                                    </label>

                                    &nbsp;
                                    <a href="javascript:void(0)" class="btn btn-danger btn-sm"
                                        onclick="deleteButton('remove_'+{{ $reservation->id }})">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td class="m-0 p-0" colspan="5">
                                    <div class="p-1" style="display: none;" id="remove_{{ $reservation->id }}"
                                        role="alert" aria-live="assertive" aria-atomic="true">
                                        <form action="{{ route('reservation.destroy', $reservation->id) }}" method="POST"
                                            class="toast-body">
                                            @csrf
                                            @method('DELETE')
                                            <div>
                                                <span>Do you really want to remove
                                                    this
                                                    <i class="fa fa-arrow-circle-up"></i>
                                                    reservation?
                                                </span>
                                                <button class="btn btn-danger btn-sm">Remove</button>
                                                <button type="button" class="btn btn-outline-secondary btn-sm"
                                                    data-bs-dismiss="toast"
                                                    onclick='deleteButton("remove_"+{{ $reservation->id }});'>Close</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="p-1"
                                        style="display: {{ $edit == $reservation->id ? 'block' : 'none' }};" role="alert"
                                        aria-live="assertive" aria-atomic="true">
                                        <form action="{{ route('reservation.update', $reservation->id) }}" method="POST"
                                            id="update_form_{{ $reservation->id }}" class="toast-body">
                                            @csrf
                                            @method('PUT')
                                            <div>
                                                <span>Do you really want to update
                                                    this
                                                    <i class="fa fa-arrow-circle-up"></i>
                                                    number of invited people?
                                                </span>
                                                <button class="btn btn-info btn-sm">Update</button>
                                                <a href="{{ route('reservation.index') }}"
                                                    class="btn btn-outline-secondary btn-sm">Close</a>
                                            </div>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        @if ($reservations->isEmpty())
                            <tr>
                                <td colspan="2" class="pt-3">
                                    <b>Your reservations are empty, nothing to show for now</b>
                                </td>
                                <td class='user_option'>
                                    <a href={{ route('book-table') }} class='order_online'>Reserve a table?</a>
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
