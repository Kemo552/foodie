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
                                        <div class="row {{ isset($order_id) ? '' : 'd-none' }}">
                                            <div class="col-12 mobile-inputs">
                                                <form
                                                    action="{{ isset($order_id) ? route('order.status.update', ['order_id' => $order_id]) : null }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <h4 class="sub-title">Update Status</h4>
                                                    <div class="form-group">
                                                        <label>Order Status</label>
                                                        <div class="d-inline-flex ml-2">
                                                            <div>
                                                                <select name="status"
                                                                    class="form-control @error('status')
                                                                    is-invalid
                                                                @enderror">
                                                                    <option value="0" selected disabled>
                                                                        Select a
                                                                        status
                                                                    </option>
                                                                    <option value="pending">Pending</option>
                                                                    <option value="paid">Paid</option>
                                                                    <option value="delivered">Delivered</option>
                                                                </select>
                                                                @error('status')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                            <div class="pb-5 ml-3">
                                                                <button class="btn btn-primary">Update</button>
                                                                &nbsp;
                                                                <a href="{{ route('order.status') }}"
                                                                    class="btn btn-primary">Cancel</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <h4 class="sub-title">Order Status</h4>
                                                <div class="card-block table-border-style">
                                                    <div class="table-responsive">

                                                        <table class="table data-table-export table-hover nowrap">
                                                            <thead>
                                                                <tr>
                                                                    <th class="table-plus">Order No.</th>
                                                                    <th>Status</th>
                                                                    <th>Product</th>
                                                                    <th>Total Price</th>
                                                                    <th>Date</th>
                                                                    <th>Payment Mode</th>
                                                                    <th class="datatable-nosort">Edit</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($orders as $order)
                                                                    <tr>
                                                                        <td>{{ $order->order_no }}</td>
                                                                        <td>
                                                                            <label
                                                                                class="badge badge-{{ $order->status == 'delivered' ? 'success' : ($order->status == 'paid' ? 'primary' : 'warning') }}">
                                                                                {{ $order->status }}
                                                                            </label>
                                                                        </td>
                                                                        <td>{{ $order->product->name }}</td>
                                                                        <td>{{ $order->total_price }}</td>
                                                                        <td>{{ $order->created_at }}</td>
                                                                        <td>{{ $order->payment->payment_mode }}</td>
                                                                        <td>
                                                                            <a href="{{ route('order.status', ['order_id' => $order->id]) }}"
                                                                                class="btn btn-primary btn-sm">
                                                                                <i class="ti-pencil mr-0"></i>
                                                                            </a>
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
        function imageView(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    $('#imgThumbnail')
                        .attr('src', e.target.result)
                        .width(260)
                        .height(260)
                        .show();
                };

                reader.readAsDataURL(input.files[0]);
            }
        };

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
