@extends('layouts.dashboard.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>@lang('site.users')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li> @lang('site.users')</li>
                <li class="active"> @lang('site.edit')</li>
            </ol>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="box box-primary box-bordered">
                    <div class="box-header">
                        <h2 class="box-title m-3">@lang('site.products')</h2>

                        <div class="row">
                            <h4 class="col-sm-6">@lang('site.edit')</h4>
                        </div>
                    </div>
                    @include('partials._errors')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box-body">
                                <form action="{{ route('dashboard.products.update', $product->id) }}" method="post"
                                    enctype="multipart/form-data">
                                    {{ method_field('PUT') }}
                                    @csrf


                                    <div class="form-group">
                                        <label for="">@lang('site.category')</label>
                                        <select name="category_id" class="form-control">
                                            <option value="">@lang('site.all_categories')</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}" {{ $product->category_id== $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="">@lang('site.name')</label>
                                        <input type="text" class='form-control' name='name'
                                            value="{{ $product->name }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="">@lang('site.description')</label>
                                        <textarea type="text" class='form-control' name='description'>{{ $product->description }}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="">@lang('site.img')</label>
                                        <input type="file" class='form-control-file image' name='img'>
                                    </div>
                                    <div class="form-group">
                                        <img src="{{ asset('uploads/product_images/' . $product->img) }}"
                                            class="img-thumbnail image-preview" width="100px" alt=""
                                            srcset="">
                                    </div>


                                    <div class="form-group">
                                        <label for="">@lang('site.purchase_price')</label>
                                        <input type="number" class='form-control' name='purchase_price'
                                            value="{{ $product->purchase_price }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="">@lang('site.sale_price')</label>
                                        <input type="number" class='form-control' name='sale_price'
                                            value="{{ $product->sale_price }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="">@lang('site.stock')</label>
                                        <input type="number" class='form-control' name='stock'
                                            value="{{ $product->stock }}">
                                    </div>





                                    <!-- END CUSTOM TABS -->

                                    <button type="submit" class="btn btn-primary"><i
                                            class="fa fa-plus"></i>@lang('site.edit')</button>
                                </form>
                            </div>
                        </div>
                    </div><!-- /.container-fluid -->
                </div>
            </div>
        </section>
    </div>
@endsection
