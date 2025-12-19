@extends('dashboard.index')
@section('content')
    <div class="row">
        <div class="pcoded-inner-content pt-0">
            <div class="main-body">
                <div class="page-wrapper pt-0 pb-0">
                    <div class="align-align-self-end">
                        <label for="message" id="message">Message</label>
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
                                            <div class="col-sm-6 col-md-4 col-lg-4">
                                                <h4 class="sub-title">Category</h4>
                                                <div class="">
                                                    <div class="form-group">
                                                        <label for="">Category name</label>
                                                        <div class="">
                                                            <input type="text" class="form-control">
                                                            <input type="hidden" value="0">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Category image</label>
                                                        <div class="">
                                                            <input type="file" class="form-control"
                                                                onchange="imageView(this);">
                                                        </div>
                                                    </div>
                                                    <div class="form-check pl-4">
                                                        <input type="checkbox" name="" id=""
                                                            class="form-check-input">
                                                        <span>
                                                            Active?
                                                        </span>
                                                    </div>
                                                    <div class="pb-5">
                                                        <input type="submit" value="Add" class="btn btn-primary">
                                                        &nbsp;
                                                        <input type="reset" value="Cancel" class="btn btn-primary">
                                                    </div>
                                                    <div class=""><img id="imgThumbnail" alt=""
                                                            class="img-thumbnail"></div>
                                                </div>
                                            </div>

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
                                                                <tr>
                                                                    <td>Name</td>
                                                                    <td>
                                                                        <img width="35" src="" />
                                                                    </td>
                                                                    <td>
                                                                        <label for="isActive">Active</label>
                                                                    </td>
                                                                    <td>CreatedDate</td>
                                                                    <td>
                                                                        <button class="badge badge-primary">
                                                                            <i class="ti-pencil"></i>
                                                                        </button>
                                                                        &nbsp;
                                                                        <a href="javascript:void(0)"
                                                                            class="badge badge-danger"
                                                                            onclick="deleteButton()">
                                                                            <i class="ti-trash"></i>
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="m-0 p-0" colspan="5">
                                                                        <div class="toast p-1" style="display: none"
                                                                            id="" role="alert"
                                                                            aria-live="assertive" aria-atomic="true">
                                                                            <div class="toast-body">
                                                                                <div>
                                                                                    <span>Do you really want to delete this
                                                                                        <i
                                                                                            class="fa fa-arrow-circle-up"></i>
                                                                                        category?</span>
                                                                                    <button type="button"
                                                                                        class="btn btn-outline-secondary btn-sm"
                                                                                        data-bs-dismiss="toast"
                                                                                        onclick='deleteButton();'>Close</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
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
                    var reader = new FileReader();
                    var img = document.getElementById("imgThumbnail");
                    reader.onload = function(e) {
                        img.prop('src', e.target.result).width(200).height(200);
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
