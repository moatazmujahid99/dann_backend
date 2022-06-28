@extends('admin.admin_master')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <div class="page-wrapper">
        <div class="page-content">

            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">eCommerce</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Add New Product</li>
                        </ol>
                    </nav>
                </div>

            </div>
            <!--end breadcrumb-->

            <div class="card">
                <div class="card-body p-4">
                    <h5 class="card-title">Add New Product</h5>
                    <hr>
                    <div class="form-body mt-4">

                        <form method="post" action="{{ route('product.store') }}" enctype="multipart/form-data">
                            @csrf


                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="border border-3 p-4 rounded">

                                        <div class="mb-3">
                                            <label for="inputProductTitle" class="form-label"
                                                style="font-weight: bold">Product Title

                                            </label>
                                            <input type="text" name="title" value="{{ old('title') }}"
                                                class="form-control{{ $errors->has('title') ? ' border-danger' : '' }}"
                                                id="inputProductTitle" placeholder="Enter product title">
                                            <small class="form-text text-danger">{!! $errors->first('title') !!}</small>
                                        </div>

                                        <div class="mb-3">
                                            <label for="inputProductTitle" class="form-label"
                                                style="font-weight: bold">Product Code

                                            </label>
                                            <input type="text" name="product_code" value="{{ old('product_code') }}"
                                                class="form-control{{ $errors->has('product_code') ? ' border-danger' : '' }}"
                                                id="inputProductTitle" placeholder="Enter product title">
                                            <small class="form-text text-danger">{!! $errors->first('product_code') !!}</small>
                                        </div>



                                        <div class="mb-3">
                                            <label for="formFile" class="form-label" style="font-weight: bold">Product
                                                Thumbnail

                                            </label>
                                            <input class="form-control{{ $errors->has('image') ? ' border-danger' : '' }}"
                                                name="image" type="file" id="image">
                                            <small class="form-text text-danger">{!! $errors->first('image') !!}</small>
                                        </div>


                                        <div class="mb-3">
                                            <img id="showImage" src="{{ url('upload/no_image.jpg') }}"
                                                style="width:100px; height: 100px;">
                                        </div>




                                        <div class="mb-3">
                                            <label for="formFile" class="form-label" style="font-weight: bold">Image One

                                            </label>
                                            <input
                                                class="form-control{{ $errors->has('image_one') ? ' border-danger' : '' }}"
                                                name="image_one" type="file">
                                            <small class="form-text text-danger">{!! $errors->first('image_one') !!}</small>
                                        </div>

                                        <div class="mb-3">
                                            <label for="formFile" class="form-label" style="font-weight: bold">Image
                                                Two</label>
                                            <span
                                                style="color: gray ; font-size:13px; margin-left:15px; font-style: italic">(optional)
                                            </span>
                                            <input class="form-control" name="image_two" type="file">
                                        </div>

                                        <div class="mb-3">
                                            <label for="formFile" class="form-label" style="font-weight: bold">Image
                                                Three</label>
                                            <span
                                                style="color: gray ; font-size:13px; margin-left:15px; font-style: italic">(optional)
                                            </span>
                                            <input class="form-control" name="image_three" type="file">
                                        </div>

                                        <div class="mb-3">
                                            <label for="formFile" class="form-label" style="font-weight: bold">Image
                                                Four</label>
                                            <span
                                                style="color: gray ; font-size:13px; margin-left:15px; font-style: italic">(optional)
                                            </span>
                                            <input class="form-control" name="image_four" type="file">
                                        </div>




                                        <div class="mb-3">
                                            <label for="inputProductDescription" class="form-label"
                                                style="font-weight: bold">Short Description

                                            </label>
                                            <textarea name="short_description" class="form-control{{ $errors->has('short_description') ? ' border-danger' : '' }}"
                                                id="inputProductDescription" rows="3">{{ old('short_description') }}</textarea>
                                            <small class="form-text text-danger">{!! $errors->first('short_description') !!}</small>
                                        </div>


                                        <div class="mb-3">
                                            <label for="inputProductDescription" class="form-label"
                                                style="font-weight: bold">Long
                                                Description</label>
                                            <span
                                                style="color: gray ; font-size:13px; margin-left:15px; font-style: italic">(optional)
                                            </span>
                                            <textarea id="mytextarea" name="long_description">{{ old('long_description') }}</textarea>
                                        </div>


                                    </div>
                                </div>




                                <div class="col-lg-4">
                                    <div class="border border-3 p-4 rounded">
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label for="inputPrice" class="form-label"
                                                    style="font-weight: bold">Price

                                                </label>
                                                <input type="text" name="price" value="{{ old('price') }}"
                                                    class="form-control{{ $errors->has('price') ? ' border-danger' : '' }}"
                                                    id="inputPrice" placeholder="00.00">
                                                <small class="form-text text-danger">{!! $errors->first('price') !!}</small>
                                            </div>


                                            <div class="col-md-6">
                                                <label for="inputCompareatprice" class="form-label"
                                                    style="font-weight: bold">Special
                                                    Price</label>
                                                <span
                                                    style="color: gray ; font-size:10.5px; margin-left:10px; font-style: italic">(optional)
                                                </span>
                                                <input type="text" name="special_price"
                                                    value="{{ old('special_price') }}" class="form-control"
                                                    id="inputCompareatprice" placeholder="00.00">
                                            </div>

                                            {{-- ------------------------- -------------------- COMMENT IT WHEN YOU VIEW THE SHOP--------------------------------------------- --}}
                                            <div class="col-12">
                                                <label for="shops" class="form-label" style="font-weight: bold">Shops

                                                </label>
                                                <select name="seller_id" class="form-select" id="shops">

                                                    <option selected="">Select Shop</option>
                                                    @foreach ($sellers as $seller)
                                                        <option value="{{ $seller->id }}">
                                                            {{ $seller->name }}</option>
                                                    @endforeach
                                                </select>
                                                <small class="form-text text-danger">{!! $errors->first('seller_id') !!}</small>
                                            </div>
                                            {{-- ----------------------------------------------------------------------------------------------------------- --}}
                                            <div class="col-12">
                                                <label for="inputProductType" class="form-label"
                                                    style="font-weight: bold">Product Category

                                                </label>
                                                <select name="category" class="form-select" id="inputProductType">

                                                    <option selected="">Select Category</option>
                                                    @foreach ($category as $item)
                                                        <option value="{{ $item->category_name }}">
                                                            {{ $item->category_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-12">
                                                <label for="inputProductType" class="form-label"
                                                    style="font-weight: bold">Product SubCategory

                                                </label>
                                                <select name="subcategory" class="form-select" id="inputProductType">

                                                    <option selected="">Select SubCategory</option>
                                                    @foreach ($subcategory as $item)
                                                        <option value="{{ $item->subcategory_name }}">
                                                            {{ $item->subcategory_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>


                                            <div class="col-12">
                                                <label for="inputCollection" class="form-label"
                                                    style="font-weight: bold">Brand

                                                </label>

                                                <span
                                                    style="color: gray ; font-size:13px; margin-left:15px; font-style: italic">(optional)
                                                </span>

                                                <select name="brand" class="form-select" id="inputCollection">
                                                    <option selected="">Select Brand</option>
                                                    <option value="Tony">Tony</option>
                                                    <option value="Apple">Apple</option>
                                                    <option value="OPPO">OPPO</option>
                                                    <option value="Samsung">Samsung</option>

                                                </select>
                                            </div>


                                            <div class="mb-3">
                                                <label class="form-label" style="font-weight: bold">Product Size</label>
                                                <span
                                                    style="color: gray ; font-size:13px; margin-left:15px; font-style: italic">(optional)
                                                </span>
                                                <input type="text" name="size" class="form-control visually-hidden"
                                                    data-role="tagsinput" value="S,M,L,XL">
                                            </div>


                                            <div class="mb-3">
                                                <label class="form-label" style="font-weight: bold">Product Color

                                                </label>
                                                <input type="text" name="color" class="form-control visually-hidden"
                                                    data-role="tagsinput" value="Red,White,Black">
                                            </div>

                                            <div class="mb-3 ">

                                                <label class="form-label" style="font-weight: bold">Remark</label>
                                                <span
                                                    style="color: gray ; font-size:13px; margin-left:15px; font-style: italic">(optional)
                                                </span>

                                                <div class="form-control" style="height: 130px;">
                                                    <div class="form-check " style=" margin-top:10px; margin-bottom:10px">
                                                        <input class="form-check-input" name="remark" type="checkbox"
                                                            value="FEATURED" id="flexCheckDefault">
                                                        <label class="form-check-label"
                                                            for="flexCheckDefault">FEATURED</label>
                                                    </div>

                                                    <div class="form-check" style=" margin-bottom:10px">
                                                        <input class=" form-check-input" name="remark" type="checkbox"
                                                            value="NEW" id="flexCheckDefault">
                                                        <label class="form-check-label" for="flexCheckDefault">NEW</label>
                                                    </div>


                                                    <div class="form-check">
                                                        <input class="form-check-input" name="remark" type="checkbox"
                                                            value="COLLECTION" id="flexCheckDefault">
                                                        <label class="form-check-label"
                                                            for="flexCheckDefault">COLLECTION</label>
                                                    </div>

                                                </div>
                                            </div>


                                            <div class="col-12">
                                                <div class="d-grid">
                                                    <button type="submit" class="btn btn-primary">Save Product</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end row-->


                        </form>


                    </div>
                </div>
            </div>

        </div>
    </div>





    <script type="text/javascript">
        $(document).ready(function() {
            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);

            });
        });
    </script>


    <script src='https://cdn.tiny.cloud/1/vdqx2klew412up5bcbpwivg1th6nrh3murc6maz8bukgos4v/tinymce/5/tinymce.min.js'
        referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#mytextarea'
        });
    </script>
@endsection
