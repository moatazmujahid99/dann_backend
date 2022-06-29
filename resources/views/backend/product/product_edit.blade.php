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
                            <li class="breadcrumb-item active" aria-current="page">Edit Product</li>
                        </ol>
                    </nav>
                </div>

            </div>
            <!--end breadcrumb-->

            <div class="card">
                <div class="card-body p-4">
                    <h5 class="card-title">Edit Product</h5>
                    <hr>
                    <div class="form-body mt-4">

                        <form method="post" action="{{ route('product.update', $product->id) }}"
                            enctype="multipart/form-data">
                            @csrf


                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="border border-3 p-4 rounded">

                                        <div class="mb-3">
                                            <label for="inputProductTitle" class="form-label"
                                                style="font-weight: bold">Product Title</label>
                                            <input type="text" name="title"
                                                class="form-control{{ $errors->has('title') ? ' border-danger' : '' }}"
                                                id="inputProductTitle" value="{{ old('title') ?? $product->title }}">
                                            <small class="form-text text-danger">{!! $errors->first('title') !!}</small>
                                        </div>

                                        <div class="mb-3">
                                            <label for="inputProductTitle" class="form-label"
                                                style="font-weight: bold">Product Code</label>
                                            <input type="text" name="product_code"
                                                class="form-control{{ $errors->has('product_code') ? ' border-danger' : '' }}"
                                                id="inputProductTitle"
                                                value="{{ old('product_code') ?? $product->product_code }}">
                                            <small class="form-text text-danger">{!! $errors->first('product_code') !!}</small>
                                        </div>



                                        <div class="mb-3">
                                            <label for="formFile" class="form-label" style="font-weight: bold">Product
                                                Thumbnail </label>
                                            <input class="form-control{{ $errors->has('image') ? ' border-danger' : '' }}"
                                                name="image" type="file" id="image">
                                            <small class="form-text text-danger">{!! $errors->first('image') !!}</small>
                                        </div>


                                        <div class="mb-3">
                                            <img id="showImage" src="{{ asset($product->image) }}"
                                                style="width:100px; height: 100px;">
                                        </div>



                                        @foreach ($details as $item)
                                            <div class="mb-3">
                                                <label for="formFile" class="form-label" style="font-weight: bold">Image
                                                    One</label>
                                                <input
                                                    class="form-control{{ $errors->has('image_one') ? ' border-danger' : '' }}"
                                                    name="image_one" type="file" id="image_one">
                                                <small class="form-text text-danger">{!! $errors->first('image_one') !!}</small>
                                            </div>

                                            <div class="mb-3">
                                                <img id="showImage_one" src="{{ asset($item->image_one) }}"
                                                    style="width:100px; height: 100px;">
                                            </div>

                                            <div class="mb-3">
                                                <label for="formFile" class="form-label" style="font-weight: bold">Image
                                                    Two</label>
                                                <span
                                                    style="color: gray ; font-size:13px; margin-left:15px; font-style: italic">(optional)
                                                </span>
                                                <input class="form-control" name="image_two" type="file" id="image_two">
                                            </div>

                                            @if (isset($item->image_two))
                                                <div class="mb-3">
                                                    <img id="showImage_two" src="{{ asset($item->image_two) }}"
                                                        style="width:100px; height: 100px;">
                                                </div>
                                            @endif

                                            <div class="mb-3">
                                                <label for="formFile" class="form-label" style="font-weight: bold">Image
                                                    Three</label>
                                                <span
                                                    style="color: gray ; font-size:13px; margin-left:15px; font-style: italic">(optional)
                                                </span>
                                                <input class="form-control" name="image_three" type="file"
                                                    id="image_three">
                                            </div>

                                            @if (isset($item->image_three))
                                                <div class="mb-3">
                                                    <img id="showImage_three" src="{{ asset($item->image_three) }}"
                                                        style="width:100px; height: 100px;">
                                                </div>
                                            @endif


                                            <div class="mb-3">
                                                <label for="formFile" class="form-label" style="font-weight: bold">Image
                                                    Four</label>
                                                <span
                                                    style="color: gray ; font-size:13px; margin-left:15px; font-style: italic">(optional)
                                                </span>
                                                <input class="form-control" name="image_four" type="file"
                                                    id="image_four">
                                            </div>

                                            @if (isset($item->image_four))
                                                <div class="mb-3">
                                                    <img id="showImage_four" src="{{ asset($item->image_four) }}"
                                                        style="width:100px; height: 100px;">
                                                </div>
                                            @endif

                                            <div class="mb-3">
                                                <label for="inputProductDescription" class="form-label"
                                                    style="font-weight: bold">ShortDescription</label>
                                                <textarea name="short_description" class="form-control" id="inputProductDescription" rows="3">{{ old('short_description') ?? $item->short_description }}</textarea>
                                                <small class="form-text text-danger">{!! $errors->first('short_description') !!}</small>
                                            </div>


                                            <div class="mb-3">
                                                <label for="inputProductDescription" class="form-label"
                                                    style="font-weight: bold">Long Description</label>

                                                <span
                                                    style="color: gray ; font-size:13px; margin-left:15px; font-style: italic">(optional)
                                                </span>

                                                <textarea id="mytextarea" name="long_description">{{ $item->long_description }}</textarea>

                                            </div>
                                        @endforeach

                                    </div>
                                </div>




                                <div class="col-lg-4">
                                    <div class="border border-3 p-4 rounded">
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label for="inputPrice" class="form-label"
                                                    style="font-weight: bold">Price</label>
                                                <input type="text" name="price"
                                                    class="form-control{{ $errors->has('price') ? ' border-danger' : '' }}"
                                                    id="inputPrice" value="{{ old('price') ?? $product->price }}">
                                                <small class="form-text text-danger">{!! $errors->first('price') !!}</small>
                                            </div>


                                            <div class="col-md-6">
                                                <label for="inputCompareatprice" class="form-label"
                                                    style="font-weight: bold">Special
                                                    Price</label>
                                                <span
                                                    style="color: gray ; font-size:10.5px; margin-left:10px; font-style: italic">(optional)
                                                </span>
                                                <input type="text" name="special_price" class="form-control"
                                                    id="inputCompareatprice" value="{{ $product->special_price }}">
                                            </div>

                                            {{-- ------------------------- -------------------- COMMENT IT WHEN YOU VIEW THE SHOP--------------------------------------------- --}}
                                            @if (Auth::guard('seller')->check())
                                                <input type="hidden" name="seller_id"
                                                    value="{{ Auth::guard('seller')->user()->id }}">
                                            @endif
                                            @if (Auth::guard('web')->check())
                                                <div class="col-12">
                                                    <label for="shops" class="form-label"
                                                        style="font-weight: bold">Shops

                                                    </label>
                                                    <select name="seller_id" class="form-select" id="shops">

                                                        <option selected="">Select Shop</option>
                                                        @foreach ($sellers as $seller)
                                                            <option value="{{ $seller->id }}"
                                                                @if (isset($product->seller->name)) {{ $seller->name == $product->seller->name ? 'selected' : '' }} @endif>
                                                                {{ $seller->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <small class="form-text text-danger">{!! $errors->first('seller_id') !!}</small>
                                                </div>
                                            @endif
                                            {{-- ----------------------------------------------------------------------------------------------------------- --}}
                                            <div class="col-12">
                                                <label for="inputProductType" class="form-label"
                                                    style="font-weight: bold">Product
                                                    Category</label>
                                                <select name=" category" class="form-select" id="inputProductType">

                                                    <option selected="">Select Category</option>
                                                    @foreach ($category as $item)
                                                        <option value="{{ $item->category_name }}"
                                                            {{ $item->category_name == $product->category ? 'selected' : '' }}>
                                                            {{ $item->category_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-12">
                                                <label for="inputProductType" class="form-label"
                                                    style="font-weight: bold">Product
                                                    SubCategory</label>
                                                <select name="subcategory" class="form-select" id="inputProductType">

                                                    <option selected="">Select SubCategory</option>
                                                    @foreach ($subcategory as $item)
                                                        <option value="{{ $item->subcategory_name }}"
                                                            {{ $item->subcategory_name == $product->subcategory ? 'selected' : '' }}>
                                                            {{ $item->subcategory_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>


                                            <div class="col-12">
                                                <label for="inputCollection" class="form-label"
                                                    style="font-weight: bold">Brand </label>
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

                                            @foreach ($details as $item)
                                                <div class="mb-3">
                                                    <label class="form-label" style="font-weight: bold">Product
                                                        Size</label>
                                                    <span
                                                        style="color: gray ; font-size:13px; margin-left:15px; font-style: italic">(optional)
                                                    </span>
                                                    <input type="text" name="size"
                                                        class="form-control visually-hidden" data-role="tagsinput"
                                                        value="{{ $item->size }}">
                                                </div>


                                                <div class="mb-3">
                                                    <label class="form-label" style="font-weight: bold">Product
                                                        Color</label>
                                                    <input type="text" name="color"
                                                        class="form-control visually-hidden" data-role="tagsinput"
                                                        value="{{ $item->color }}">
                                                </div>
                                            @endforeach

                                            <div class="mb-3 ">

                                                <label class="form-label" style="font-weight: bold">Remark</label>
                                                <span
                                                    style="color: gray ; font-size:13px; margin-left:15px; font-style: italic">(optional)
                                                </span>

                                                <div class="form-control" style="height: 130px;">
                                                    <div class="form-check" style=" margin-top:10px; margin-bottom:10px">
                                                        <input class="form-check-input" name="remark" type="checkbox"
                                                            value="FEATURED" id="flexCheckDefault1"
                                                            {{ $product->remark == 'FEATURED' ? 'checked' : '' }}>
                                                        <label class="form-check-label"
                                                            for="flexCheckDefault1">FEATURED</label>
                                                    </div>

                                                    <div class="form-check" style=" margin-bottom:10px">
                                                        <input class="form-check-input" name="remark" type="checkbox"
                                                            value="NEW" id="flexCheckDefault2"
                                                            {{ $product->remark == 'NEW' ? 'checked' : '' }}>
                                                        <label class="form-check-label"
                                                            for="flexCheckDefault2">NEW</label>
                                                    </div>


                                                    <div class="form-check">
                                                        <input class="form-check-input" name="remark" type="checkbox"
                                                            value="COLLECTION" id="flexCheckDefault3"
                                                            {{ $product->remark == 'COLLECTION' ? 'checked' : '' }}>
                                                        <label class="form-check-label"
                                                            for="flexCheckDefault3">COLLECTION</label>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-12">
                                                <div class="d-grid">
                                                    <button type="submit" class="btn btn-primary">Update
                                                        Product</button>
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
        $(document).ready(function() {
            $('#image_one').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage_one').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);

            });
        });
        $(document).ready(function() {
            $('#image_two').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage_two').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);

            });
        });
        $(document).ready(function() {
            $('#image_three').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage_three').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);

            });
        });
        $(document).ready(function() {
            $('#image_four').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage_four').attr('src', e.target.result);
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
