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
                                        <form
                                            action="{{ isset($product) ? route('product.update', $product->id) : route('product.store') }}"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <h4 class="sub-title">Product</h4>
                                            @if (isset($product))
                                                @method('PUT')
                                            @endif
                                            <div class="row">
                                                <div class="col-sm-8 col-md-8 col-lg-8 pb-5">
                                                    <div>
                                                        <div class="form-group">
                                                            <label for="">Product name</label>
                                                            <div class="">
                                                                <input type="text"
                                                                    class="form-control @error('name') is-invalid @enderror"
                                                                    name="name"
                                                                    value="{{ old('name', $product->name ?? '') }}">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Product description</label>
                                                            <div class="">
                                                                <textarea class="form-control @error('description') is-invalid @enderror" name="description"
                                                                    placeholder="Enter description here">{{ old('description', $product->description ?? '') }}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Product price</label>
                                                            <div class="">
                                                                <input type="number"
                                                                    class="form-control @error('price') is-invalid @enderror"
                                                                    name="price" step="0.1"
                                                                    value="{{ old('price', $product->price ?? '') }}">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Product quantity</label>
                                                            <div class="">
                                                                <input type="number"
                                                                    class="form-control @error('quantity') is-invalid @enderror"
                                                                    name="quantity" min="1"
                                                                    value="{{ old('quantity', $product->quantity ?? '') }}">
                                                            </div>
                                                        </div>
                                                        <div class="form-check pl-4">
                                                            <input type="hidden" name="active" value="0">
                                                            <input type="checkbox" name="active" value="1"
                                                                id="checkbox"
                                                                {{ old('active', $product->active ?? 0) ? 'checked' : '' }}
                                                                class="form-check-input">
                                                            <label for="checkbox">
                                                                Active?
                                                            </label>
                                                        </div>
                                                        <div class='pb-2'>
                                                            <input type="submit" value="{{ $cmd_name }}"
                                                                class="btn btn-primary">
                                                            &nbsp;
                                                            <a href="{{ route('product.index') }}"
                                                                class="btn btn-primary">Cancel</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4 col-md-4 col-lg-4">
                                                    <div>
                                                        <div class="form-group">
                                                            <label for="">Product category</label>
                                                            <select name="category_id" class="form-control">
                                                                <option value="0" disabled>Select a category
                                                                </option>
                                                                @foreach ($categories as $category)
                                                                    <option value="{{ $category->id }}">
                                                                        {{ $category->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Product image</label>
                                                            <div class="">
                                                                <input type="file" class="form-control" name="imageUrl"
                                                                    onchange="imageView(this);">
                                                            </div>
                                                        </div>

                                                        <div class="">
                                                            <img src="{{ isset($product) ? asset('images/product/' . $product->imageUrl) : null }}"
                                                                id="imgThumbnail" class="img-thumbnail">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>

                                        <div class="col-sm-12 mobile-inputs">
                                            <h4 class="sub-title">Product Lists</h4>
                                            <div class="card-block table-border-style">
                                                <div class="table-responsive">
                                                    <table class="table data-table-export table-hover nowrap">
                                                        <thead>
                                                            <tr>
                                                                <th class="table-plus">Name</th>
                                                                <th>Description</th>
                                                                <th>Price</th>
                                                                <th>Quantity</th>
                                                                <th>Category</th>
                                                                <th>Image</th>
                                                                <th>IsActive</th>
                                                                <th>CreatedDate</th>
                                                                <th class="datatable-nosort">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($products as $product)
                                                                <tr>
                                                                    <td>{{ $product->name }}</td>
                                                                    <td>{{ $product->description }}</td>
                                                                    <td>{{ $product->price }}</td>
                                                                    <td>{{ $product->quantity }}</td>
                                                                    <td>{{ $product->category_name }}</td>
                                                                    <td>
                                                                        <img width="35"
                                                                            src="{{ asset('images/product/' . $product->imageUrl) }}" />
                                                                    </td>
                                                                    <td>
                                                                        <label for="isActive"
                                                                            class="badge badge-{{ $product->active == 1 ? 'success' : 'danger' }}">
                                                                            {{ $product->active == 1 ? 'Active' : 'Inactive' }}
                                                                        </label>
                                                                    </td>
                                                                    <td>{{ $product->created_at }}</td>
                                                                    <td>
                                                                        <a href="{{ route('product.index', ['edit' => $product->id]) }}"
                                                                            class="btn btn-primary btn-sm">
                                                                            <i class="ti-pencil mr-0"></i>
                                                                        </a>
                                                                        &nbsp;
                                                                        <a href="javascript:void(0)"
                                                                            class="btn btn-danger btn-sm"
                                                                            onclick="deleteButton({{ $product->id }})">
                                                                            <i class="ti-trash mr-0"></i>
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="m-0 p-0" colspan="5">
                                                                        <div class="toast p-1" style="display: none;"
                                                                            id="toast_{{ $product->id }}" role="alert"
                                                                            aria-live="assertive" aria-atomic="true">

                                                                            <form
                                                                                action="{{ route('product.destroy', $product->id) }}"
                                                                                method="POST" class="toast-body">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <div>
                                                                                    <span>Do you really want to delete
                                                                                        this
                                                                                        <i
                                                                                            class="fa fa-arrow-circle-up"></i>
                                                                                        product?
                                                                                    </span>
                                                                                    <button
                                                                                        class="btn btn-danger btn-sm">Delete</button>
                                                                                    <button type="button"
                                                                                        class="btn btn-outline-secondary btn-sm"
                                                                                        data-bs-dismiss="toast"
                                                                                        onclick='deleteButton({{ $product->id }});'>Close</button>
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
