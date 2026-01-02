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
                                        <div class="row">
                                            <div class="col-md-12 mobile-inputs">
                                                <h4 class="sub-title">User Lists</h4>
                                                <div class="card-block table-border-style">
                                                    <div class="table-responsive">
                                                        <table class="table data-table-export table-hover nowrap">
                                                            <thead>
                                                                <tr>
                                                                    <th class="table-plus">Name</th>
                                                                    <th>Image</th>
                                                                    <th>Username</th>
                                                                    <th>Email</th>
                                                                    <th>Phone</th>
                                                                    <th>Joint At</th>
                                                                    <th class="datatable-nosort">Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($users as $user)
                                                                    <tr>
                                                                        <td>{{ $user->name }}</td>
                                                                        <td>
                                                                            <img width="35" class="rounded-circle"
                                                                                src="{{ asset('images/user/' . $user->imageUrl) }}" />
                                                                        </td>
                                                                        <td>
                                                                            {{ $user->username }}
                                                                        </td>
                                                                        <td>{{ $user->email }}</td>
                                                                        <td>{{ $user->phone }}</td>
                                                                        <td>{{ $user->created_at }}</td>
                                                                        <td>
                                                                            <a href="javascript:void(0)"
                                                                                class="btn btn-danger btn-sm"
                                                                                onclick="deleteButton({{ $user->id }})">
                                                                                <i class="ti-trash mr-0"></i>
                                                                            </a>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="m-0 p-0" colspan="7">
                                                                            <div class="toast p-1" style="display: none;"
                                                                                id="toast_{{ $user->id }}"
                                                                                role="alert" aria-live="assertive"
                                                                                aria-atomic="true">

                                                                                <form
                                                                                    action="{{ route('user.destroy', $user->id) }}"
                                                                                    method="POST" class="toast-body">
                                                                                    @csrf
                                                                                    @method('DELETE')
                                                                                    <div>
                                                                                        <span>Do you really want to delete
                                                                                            this
                                                                                            <i
                                                                                                class="fa fa-arrow-circle-up"></i>
                                                                                            user?
                                                                                        </span>
                                                                                        <button
                                                                                            class="btn btn-danger btn-sm">Delete</button>
                                                                                        <button type="button"
                                                                                            class="btn btn-outline-secondary btn-sm"
                                                                                            data-bs-dismiss="toast"
                                                                                            onclick='deleteButton({{ $user->id }});'>Close</button>
                                                                                    </div>
                                                                                </form>
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

    <script>
        function deleteButton(id) {
            var toast = document.getElementById("toast_" + id);
            if (toast.style.display == "none") {
                toast.style.display = "block";
            } else {
                toast.style.display = "none";
            }
        };
    </script>
@endsection
