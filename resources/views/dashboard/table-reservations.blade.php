@extends('dashboard.index')
@section('content')
    <div class="row">
        <div class="pcoded-inner-content pt-0">
            <div class="main-body">
                <div class="page-wrapper pt-0 pb-0">
                    <div class="align-self-end">
                        @if (session()->has('msg'))
                            <label for="message" id="message"
                                class="alert alert-{{ session('msg_cls') }} alert-dismissible">
                                {{ session('msg') }}
                                <a class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </a>
                            </label>
                        @endif
                    </div>
                </div>
            </div>

            <div class="main-body">
                <div class="page-wrapper">
                    <div class="page-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-header">
                                    </div>
                                    <div class="card-block">
                                        <div class="row {{ isset($table) ? '' : 'd-none' }}">
                                            <div class="col-12 mobile-inputs">
                                                <form
                                                    action="{{ isset($table) ? route('table-reservations.update', ['table_reservation' => $table->id]) : null }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <h4 class="sub-title">Update Reservation</h4>
                                                    <div class="form-group">
                                                        <label>Invited People</label>
                                                        <div class="d-inline-flex ml-2">
                                                            <div>
                                                                <select name="people"
                                                                    class="form-control @error('people')
                                                                    is-invalid
                                                                @enderror">
                                                                    @if (isset($table))
                                                                        <option value="{{ $table->people }}">
                                                                            {{ $table->people }} (Current
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
                                                            </div> &nbsp;
                                                            <div>
                                                                <input type="date"
                                                                    class="form-control @error('reservation_date') is-invalid @enderror"
                                                                    name="reservation_date"
                                                                    value="{{ old('reservation_date', $table->reservation_date ?? '') }}">
                                                                @error('reservation_date')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                            <div class="pb-5 ml-3">
                                                                <button class="btn btn-primary">Update</button>
                                                                &nbsp;
                                                                <a href="{{ route('table-reservations.index') }}"
                                                                    class="btn btn-primary">Cancel</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">

                                                <label data-toggle="tooltip"
                                                    title="Notice: Results are sorted by date of reservation">
                                                    <h4 class="sub-title"><i
                                                            class="fa fa-question-circle d-inline mr-1"></i>Reservations
                                                    </h4>
                                                </label>
                                                <div class="card-block table-border-style">
                                                    <div class="table-responsive">
                                                        <table class="table data-table-export table-hover nowrap">
                                                            <thead>
                                                                <tr>
                                                                    <th class="table-plus">#</th>
                                                                    <th>Reserved by</th>
                                                                    <th>Email</th>
                                                                    <th>Phone</th>
                                                                    <th>Invited people</th>
                                                                    <th>Date of reservation</th>
                                                                    <th class="datatable-nosort">Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($reservations as $reservation)
                                                                    <tr>
                                                                        <td>{{ $reservation->id }}</td>
                                                                        <td>{{ $reservation->name }}</td>
                                                                        <td>{{ $reservation->email }}</td>
                                                                        <td>{{ $reservation->phone }}</td>
                                                                        <td>{{ $reservation->people }}</td>
                                                                        <td>{{ $reservation->reservation_date }}</td>
                                                                        <td>
                                                                            <a href="{{ route('table-reservations.index', ['table_reservation' => $reservation->id]) }}"
                                                                                class="btn btn-primary btn-sm"
                                                                                onclick="toast_show({{ $reservation->id }});">
                                                                                <i class="ti-pencil mr-0"></i>
                                                                            </a>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="m-0 p-0" colspan="5">
                                                                            <div class="p-1 {{ isset($table) ? '' : 'd-none' }}"
                                                                                role="alert" aria-live="assertive"
                                                                                aria-atomic="true">
                                                                                <div>
                                                                                    <span>Updating this<i
                                                                                            class="fa fa-arrow-circle-up"></i>
                                                                                        table
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
