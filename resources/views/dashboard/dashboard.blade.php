@extends('dashboard.index')
@section('content')
    <div class="main-body">
        <div class="page-wrapper">
            <div class="page-body">
                <div class="row">

                    {{-- Categories --}}
                    <div class="col-sd-6 col-xl-3">
                        <div class="card widget-card-1">
                            <div class="card-block-small">
                                <i class="icofont icofont-muffin bg-c-blue card1-icon"></i>
                                <span class="text-c-blue f-w-600">Categories</span>
                                <h4>{{ $categories }}</h4>
                                <div>
                                    <span class="f-10 m-t-10 text-muted">
                                        <a href="/dashboard/category"><i
                                                class="text-c-blue f-16 icofont icofont-eye-alt m-r-15"></i>View
                                            Details</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Products --}}
                    <div class="col-sd-6 col-xl-3">
                        <div class="card widget-card-1">
                            <div class="card-block-small">
                                <i class="icofont icofont-fast-food bg-c-pink card1-icon"></i>
                                <span class="text-c-pink f-w-600">Products</span>
                                <h4>{{ $products }}</h4>
                                <div>
                                    <span class="f-10 m-t-10 text-muted">
                                        <a href="/dashboard/product"><i
                                                class="text-c-pink f-16 icofont icofont-eye-alt m-r-15"></i>View
                                            Details</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Orders --}}
                    <div class="col-sd-6 col-xl-3">
                        <div class="card widget-card-1">
                            <div class="card-block-small">
                                <i class="icofont icofont-muffin bg-c-green card1-icon"></i>
                                <span class="text-c-green f-w-600">Total Orders</span>
                                <h4>{{ $orders }}</h4>
                                <div>
                                    <span class="f-10 m-t-10 text-muted">
                                        <a href="/dashboard/orders"><i
                                                class="text-c-green f-16 icofont icofont-eye-alt m-r-15"></i>View
                                            Details</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Delivered Items --}}
                    <div class="col-sd-6 col-xl-3">
                        <div class="card widget-card-1">
                            <div class="card-block-small">
                                <i class="icofont icofont-muffin bg-c-yellow card1-icon"></i>
                                <span class="text-c-yellow f-w-600">Delivered Items</span>
                                <h4>{{ $delivered_items }}</h4>
                                <div>
                                    <span class="f-10 m-t-10 text-muted">
                                        <a href="/dashboard/ordersz"><i
                                                class="text-c-yellow f-16 icofont icofont-eye-alt m-r-15"></i>View
                                            Details</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="row">

                    {{-- Pending Items --}}
                    <div class="col-sd-6 col-xl-3">
                        <div class="card widget-card-1">
                            <div class="card-block-small">
                                <i class="icofont icofont-delivery-time bg-c-blue card1-icon"></i>
                                <span class="text-c-blue f-w-600">Pending Items</span>
                                <h4>{{ $pending_items }}</h4>
                                <div>
                                    <span class="f-10 m-t-10 text-muted">
                                        <a href="/dashboard/orders"><i
                                                class="text-c-blue f-16 icofont icofont-eye-alt m-r-15"></i>View
                                            Details</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Paid Items --}}
                    <div class="col-sd-6 col-xl-3">
                        <div class="card widget-card-1">
                            <div class="card-block-small">
                                <i class="icofont icofont-support-faq bg-c-yellow card1-icon"></i>
                                <span class="text-c-yellow f-w-600">Paid Items</span>
                                <h4>{{ $paid_items }}</h4>
                                <div>
                                    <span class="f-10 m-t-10 text-muted">
                                        <a href="/dashboard/orders"><i
                                                class="text-c-yellow f-16 icofont icofont-eye-alt m-r-15"></i>View
                                            Details</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Users --}}
                    <div class="col-sd-6 col-xl-3">
                        <div class="card widget-card-1">
                            <div class="card-block-small">
                                <i class="icofont icofont-users-social bg-c-pink card1-icon"></i>
                                <span class="text-c-pink f-w-600">Users</span>
                                <h4>{{ $users }}</h4>
                                <div>
                                    <span class="f-10 m-t-10 text-muted">
                                        <a href="/dashboard/users"><i
                                                class="text-c-pink f-16 icofont icofont-eye-alt m-r-15"></i>View
                                            Details</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Selling Amount --}}
                    <div class="col-sd-6 col-xl-3">
                        <div class="card widget-card-1">
                            <div class="card-block-small">
                                <i class="icofont icofont-money-bag bg-c-green card1-icon"></i>
                                <span class="text-c-green f-w-600">Sold Amounts</span>
                                <h4>{{ $amount }}$</h4>
                                <div>
                                    <span class="f-10 m-t-10 text-muted">
                                        <a href="/dashboard/reports"><i
                                                class="text-c-green f-16 icofont icofont-eye-alt m-r-15"></i>View
                                            Details</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
