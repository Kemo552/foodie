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
                                            <form
                                                action="{{ isset($category) ? route('category.update', $category->id) : route('category.store') }}"
                                                method="POST" enctype="multipart/form-data"
                                                class="col-sm-6 col-md-4 col-lg-4">
                                                @csrf
                                                <h4 class="sub-title">Category</h4>
                                                @if (isset($category))
                                                    @method('PUT')
                                                @endif
                                                <div class="">
                                                    <div class="form-group">
                                                        <label for="">Category name</label>
                                                        <div class="">
                                                            <input type="text"
                                                                class="form-control @error('name') is-invalid @enderror"
                                                                name="name"
                                                                value="{{ old('name', $category->name ?? '') }}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Category image</label>
                                                        <div class="">
                                                            <input type="file" class="form-control" name="imageUrl"
                                                                onchange="imageView(this);">
                                                        </div>
                                                    </div>
                                                    <div class="form-check pl-4">
                                                        <input type="hidden" name="active" value="0">
                                                        <input type="checkbox" name="active" value="1" id="checkbox"
                                                            {{ old('active', $category->active ?? 0) ? 'checked' : '' }}
                                                            class="form-check-input">
                                                        <label for="checkbox">
                                                            Active?
                                                        </label>
                                                    </div>
                                                    <div class="pb-5">
                                                        <input type="submit" value="{{ $cmd_name }}"
                                                            class="btn btn-primary">
                                                        &nbsp;
                                                        <a href="{{ route('category.index') }}"
                                                            class="btn btn-primary">Cancel</a>
                                                    </div>
                                                    <div class="">
                                                        <img src="{{ isset($category) ? asset('images/category/' . $category->imageUrl) : null }}"
                                                            id="imgThumbnail" class="img-thumbnail">
                                                    </div>
                                                </div>
                                            </form>

                                            <div class="col-sm-6 col-md-8 col-lg-8 mobile-inputs">
                                                <h4 class="sub-title">Category Lists</h4>
                                                <div class="card-block table-border-style">
                                                    <div class="table-responsive">
                                                        <table class="table data-table-export table-hover nowrap">
                                                            <thead>
                                                                <tr>
                                                                    <th class="table-plus">Name</th>
                                                                    <th>Image</th>
                                                                    <th>IsActive</th>
                                                                    <th>CreatedDate</th>
                                                                    <th class="datatable-nosort">Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($categories as $category)
                                                                    <tr>
                                                                        <td>{{ $category->name }}</td>
                                                                        <td>
                                                                            <img width="35"
                                                                                src="{{ 'images/category/' . $category->imageUrl }}" />
                                                                        </td>
                                                                        <td>
                                                                            <label for="isActive"
                                                                                class="badge badge-{{ $category->active == 1 ? 'success' : 'danger' }}">
                                                                                {{ $category->active == 1 ? 'Active' : 'Inactive' }}
                                                                            </label>
                                                                        </td>
                                                                        <td>{{ $category->created_at }}</td>
                                                                        <td>
                                                                            <a href="{{ route('category.index', ['edit' => $category->id]) }}"
                                                                                class="btn btn-primary btn-sm">
                                                                                <i class="ti-pencil mr-0"></i>
                                                                            </a>
                                                                            &nbsp;
                                                                            <a href="javascript:void(0)"
                                                                                class="btn btn-danger btn-sm"
                                                                                onclick="deleteButton({{ $category->id }})">
                                                                                <i class="ti-trash mr-0"></i>
                                                                            </a>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="m-0 p-0" colspan="5">
                                                                            <div class="toast p-1" style="display: none;"
                                                                                id="toast_{{ $category->id }}"
                                                                                role="alert" aria-live="assertive"
                                                                                aria-atomic="true">

                                                                                <form
                                                                                    action="{{ route('category.destroy', $category->id) }}"
                                                                                    method="POST" class="toast-body">
                                                                                    @csrf
                                                                                    @method('DELETE')
                                                                                    <div>
                                                                                        <span>Do you really want to delete
                                                                                            this
                                                                                            <i
                                                                                                class="fa fa-arrow-circle-up"></i>
                                                                                            category?
                                                                                        </span>
                                                                                        <button
                                                                                            class="btn btn-danger btn-sm">Delete</button>
                                                                                        <button type="button"
                                                                                            class="btn btn-outline-secondary btn-sm"
                                                                                            data-bs-dismiss="toast"
                                                                                            onclick='deleteButton({{ $category->id }});'>Close</button>
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
