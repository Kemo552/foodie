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
                <h2>Profile</h2>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title mb-4">
                                <div class="d-flex justify-content-start">
                                    <div class="image-container">
                                        <img src="{{ 'images/user/' . $user->imageUrl }}"
                                            style="width: 150px; height: 150px;" class="img-thumbnail" />
                                        <div class="middle pt-2">
                                            <a href="{{ route('profile.edit.form', ['edit' => $user->id]) }}"
                                                class="btn btn-warning pl-3 pr-3">
                                                <i class="fa fa-pencil mr-2"></i>Edit Details
                                            </a>
                                        </div>
                                    </div>

                                    <div class="userData ml-3">
                                        <h2 class="d-block" style="font-size: 1.5rem; font-weight: bold">
                                            <a href="javascript:void(0);">{{ $user->name }}</a>
                                        </h2>
                                        <h6 class="d-block">
                                            <a href="javascript:void(0);">
                                                {{ $user->username }}
                                            </a>
                                        </h6>
                                        <h6 class="d-block">
                                            <a href="javascript:void(0);">
                                                {{ $user->email }}
                                            </a>
                                        </h6>
                                        <h6 class="d-block">
                                            <a href="javascript:void(0);">
                                                {{ $user->address }}
                                            </a>
                                        </h6>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                                        <li class="nav-item">
                                            <a href="#basicInfo" class="nav-link active text-info" id="basicInfo-tab"
                                                data-toggle="tab" role="tab" aria-controls="basicInfo"
                                                aria-selected="true">
                                                <i class="fa fa-id-badge mr-2"></i>Basic Info
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#connectedServices" class="nav-link text-info"
                                                id="connectedServices-tab" data-toggle="tab" role="tab"
                                                aria-controls="connectedServices" aria-selected="true">
                                                <i class="fa fa-history mr-2"></i>Purchased History
                                            </a>
                                        </li>
                                    </ul>

                                    <div class="tab-content ml-1" id="myTabContent">
                                        {{-- Basic Info --}}
                                        <div class="tab-pane fade show active" id="basicInfo" role="tabpanel"
                                            aria-labelledby="basicInfo-tab">
                                            <div class="row">
                                                <div class="col-sm-3 col-md-2 col-5">
                                                    <label style="font-weight:bold;">Full Name</label>
                                                </div>
                                                <div class="col-md-8 col-6">
                                                    {{ $user->name }}
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-3 col-md-2 col-5">
                                                    <label style="font-weight:bold;">User Name</label>
                                                </div>
                                                <div class="col-md-8 col-6">
                                                    {{ $user->username }}
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-3 col-md-2 col-5">
                                                    <label style="font-weight:bold;">Email</label>
                                                </div>
                                                <div class="col-md-8 col-6">
                                                    {{ $user->email }}
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-3 col-md-2 col-5">
                                                    <label style="font-weight:bold;">Mobile phone</label>
                                                </div>
                                                <div class="col-md-8 col-6">
                                                    {{ $user->phone }}
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-3 col-md-2 col-5">
                                                    <label style="font-weight:bold;">ZIP / Post Code</label>
                                                </div>
                                                <div class="col-md-8 col-6">
                                                    {{ $user->zip }}
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-3 col-md-2 col-5">
                                                    <label style="font-weight:bold;">Address</label>
                                                </div>
                                                <div class="col-md-8 col-6">
                                                    {{ $user->address }}
                                                </div>
                                            </div>
                                        </div>
                                        {{-- End of Basic Info --}}
                                        <div class="tab-pane fade" id="connectedServices" role="tabpanel"
                                            aria-labelledby="ConnectedServices-tab">
                                            <div class="container">
                                                <div class="row pt-1 pb-1" style="background-color: lightgray;">
                                                    <div class="col-4">
                                                        <span class="badge badge-pill badge-dark text-white">
                                                            <%# Eval("SrNo") %>
                                                        </span>
                                                        Payment Mode:
                                                        <%# Eval("PaymentMode").ToString() == "cod" ? "Cash On Delievery" : Eval("PaymentMode").ToString().ToUpper() %>
                                                    </div>
                                                    <div class="col-6">
                                                        <%# string.IsNullOrEmpty(Eval("CardNo").ToString()) ? "" : "Card No:" + Eval("CardNo") %>
                                                    </div>
                                                    <div class="col-2" style="text-align: end;">
                                                        <a href='Invoice.aspx?id=<%# Eval("PaymentId") %>'
                                                            class="btn btn-info"><i
                                                                class="fa fa-download mr-2"></i>Invoice</a>
                                                    </div>
                                                </div>
                                                <table
                                                    class="table data-table-export table-responsive-sm table-bordered table-hover">
                                                    <thead class="bg-dark text-white">
                                                        <tr>
                                                            <th>Product Name</th>
                                                            <th>Unit Price</th>
                                                            <th>Qty</th>
                                                            <th>Total Price</th>
                                                            <th>OrderId</th>
                                                            <th>Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <asp:Label ID="lblName" runat="server"
                                                                    Text='<%# Eval("Name") %>'></asp:Label>
                                                            </td>
                                                            <td>
                                                                <asp:Label ID="lblPrice" runat="server"
                                                                    Text='<%# string.IsNullOrEmpty(Eval("Price").ToString())? "" : "$"+Eval("Price") %>'>
                                                                </asp:Label>
                                                            </td>
                                                            <td>
                                                                <asp:Label ID="lblQuantity" runat="server"
                                                                    Text='<%# Eval("Quantity") %>'></asp:Label>
                                                            </td>
                                                            <td>
                                                                $<asp:Label ID="lblTotalPrice" runat="server"
                                                                    Text='<%# Eval("TotalPrice") %>'></asp:Label>
                                                            </td>
                                                            <td>
                                                                <asp:Label ID="lblOrderNo" runat="server"
                                                                    Text='<%# Eval("OrderNo") %>'></asp:Label>
                                                            </td>
                                                            <td>
                                                                <asp:Label ID="lblStatus" runat="server"
                                                                    Text='<%# Eval("Status") %>'
                                                                    CssClass='<%# Eval("Status").ToString() == "Delivered"? "badge badge-success" :"badge badge-warning" %>'>
                                                                </asp:Label>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        {{-- Purchased History --}}
                                        {{-- End of Purchased History --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
