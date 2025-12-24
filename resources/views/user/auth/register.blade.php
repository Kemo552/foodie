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
                <h2>{{ isset($edit) ? 'Edit Profile' : 'Registration' }}</h2>
            </div>
            <form action="{{ isset($edit) ? route('profile.edit') : route('sign-up') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @if (isset($edit))
                    @method('PUT')
                @endif
                <div class="row">
                    <div class="col-md-5">
                        <div class="form_container">
                            <div class="mb-4">
                                <input type="text" placeholder="Full name"
                                    class="form-control mb-0 @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name', auth()->user()->name ?? '') }}">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <input type="text" placeholder="User name"
                                    class="form-control mb-0 @error('username') is-invalid @enderror" name="username"
                                    value="{{ old('username', auth()->user()->username ?? '') }}"
                                    {{ isset($edit) ? 'disabled' : null }}>
                                @error('username')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <input type="text" placeholder="Email"
                                    class="form-control mb-0 @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email', auth()->user()->email ?? '') }}">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <input type="text" placeholder="Phone"
                                    class="form-control mb-0 @error('phone') is-invalid @enderror" name="phone"
                                    value="{{ old('phone', auth()->user()->phone ?? '') }}">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="form_container">
                            <div class="mb-4">
                                <input type="text" placeholder="Address"
                                    class="form-control mb-0 @error('address') is-invalid @enderror" name="address"
                                    value="{{ old('address', auth()->user()->address ?? '') }}">
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="mb-4">
                                        <input type="password" placeholder="Password"
                                            class="form-control mb-0 @error('password') is-invalid @enderror"
                                            name="password">
                                        {{-- value="{{ old('password', auth()->user()->password ?? '') }}"> --}}
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <input type="number" placeholder="ZIP/Post code"
                                            class="form-control mb-0 @error('zip') is-invalid @enderror" name="zip"
                                            value="{{ old('zip', auth()->user()->zip ?? '') }}">
                                        @error('zip')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <input type="file"
                                            class="form-control mb-0 @error('imageUrl') is-invalid @enderror"
                                            name="imageUrl" onchange="imageView(this);">
                                        @error('imageUrl')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form_container">
                                        <div>
                                            <img src="{{ isset($edit) ? asset('images/user/' . auth()->user()->imageUrl) : null }}"
                                                id="imgThumbnail" class="img-thumbnail">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="">
                    <div class="align-self-center">
                        <div class="btn_box user_option">
                            <button class="btn order_online rounded-pill">
                                {{ isset($edit) ? 'Update Profile' : 'Register' }}
                            </button>
                            @if (!isset($edit))
                                <span class="pl-3 text-black-50">Already have an account?<a href="{{ route('login') }}"
                                        class="text-warning">Login here</a></span>
                            @endif
                        </div>
                    </div>
                </div>
            </form>
    </section>
    <script>
        function imageView(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    $('#imgThumbnail')
                        .attr('src', e.target.result)
                        .width(200)
                        .height(200)
                        .show();
                };
                reader.readAsDataURL(input.files[0]);
            }
        };
    </script>
@endsection
