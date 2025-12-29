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
                <h2>Login</h2>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form_container">
                        <div class="heading_container">
                            <img src="template/images/login.avif" width="250" class="align-self-center">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <form action="{{ route('sign-in') }}" method="POST" class="form_container">
                        @csrf
                        <div>
                            <input type="text" placeholder="Username"
                                class="form-control @error('username') is-invalid @enderror" name="username">
                        </div>
                        <div>
                            <input type="password" placeholder="Password"
                                class="form-control @error('password') is-invalid @enderror" name="password">
                        </div>
                        <div class="user_option">
                            <button class="order_online mt-0">Login</button>
                            <span class="pl-3 text-black-50">Don't you have an account yet?<a href="{{ route('register') }}"
                                    class="text-warning">Register here..</a></span>
                        </div>
                    </form>
                </div>
            </div>
    </section>
@endsection
