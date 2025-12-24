@extends('user.index')
@section('content')
    <section class="book_section layout_padding">
        <div class="container">
            <div class="heading_container">
                <div class="align-self-center">
                    @if (session()->has('msg'))
                        <label for="message" id="message" class="alert alert-{{ session('msg_cls') }}">
                            {{ session('msg') }}
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
                                                class="btn btn-warning">
                                                <i class="fa fa-pencil"></i>Edit Details
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
                                            <a href="#connectedServices" class="nav-link active text-info"
                                                id="connectedServices-tab" data-toggle="tab" role="tab"
                                                aria-controls="connectedServices" aria-selected="true">
                                                <i class="fa fa-history mr-2"></i>Purchased History
                                            </a>
                                        </li>
                                    </ul>

                                    <div class="tab-content ml-1" id="myTabContent">
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
                                            <div class="row">
                                                <div class="col-sm-3 col-md-2 col-5">
                                                    <label style="font-weight:bold;">User Name</label>
                                                </div>
                                                <div class="col-md-8 col-6">
                                                    {{ $user->username }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-3 col-md-2 col-5">
                                                    <label style="font-weight:bold;">Email</label>
                                                </div>
                                                <div class="col-md-8 col-6">
                                                    {{ $user->email }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-3 col-md-2 col-5">
                                                    <label style="font-weight:bold;">Mobile phone</label>
                                                </div>
                                                <div class="col-md-8 col-6">
                                                    {{ $user->phone }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-3 col-md-2 col-5">
                                                    <label style="font-weight:bold;">ZIP / Post Code</label>
                                                </div>
                                                <div class="col-md-8 col-6">
                                                    {{ $user->zip }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-3 col-md-2 col-5">
                                                    <label style="font-weight:bold;">Address</label>
                                                </div>
                                                <div class="col-md-8 col-6">
                                                    {{ $user->address }}
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
    </section>
@endsection
