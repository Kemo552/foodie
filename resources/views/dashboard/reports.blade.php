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
                                            <div class="col-12">
                                                <h4 class="sub-title">Selling Reports</h4>
                                                <div class="card-block table-border-style">
                                                    <div class="table-responsive">
                                                        <table class="table data-table-export table-hover nowrap">
                                                            <thead>
                                                                <tr>
                                                                    <th class="table-plus">#</th>
                                                                    <th>Name</th>
                                                                    <th>Email</th>
                                                                    <th>Phone</th>
                                                                    <th>Item Orders</th>
                                                                    <th>Total Cost</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($reports as $index => $report)
                                                                    <tr>
                                                                        <td>{{ $index + 1 }}</td>
                                                                        <td>{{ $report->name }}</td>
                                                                        <td>{{ $report->email }}</td>
                                                                        <td>{{ $report->phone }}</td>
                                                                        <td>{{ $report->orders }}</td>
                                                                        <td>{{ $report->total_cost }}</td>
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
