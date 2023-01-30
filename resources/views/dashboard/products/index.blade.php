@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <h1>@lang('site.users')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li> @lang('site.users')</li>
                <li class="active"> <a href="{{ route('dashboard.products.index') }}"></a>@lang('site.products')</li>
            </ol>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="box box-primary box-bordered">
                    <div class="box-header">
                        <h2 class="box-title m-3">@lang('site.products')</h2><small>{{ $products->total() }}</small>

                        <form action="{{ route('dashboard.products.index') }}" method="get">
                            <div class="row">
                                <div class="col-sm-4">
                                    <input type="text" class='form-control' name="search"
                                        placeholder="@lang('site.search')" value="{{ request()->search }}">

                                </div>
                                <div class="col-sm-4">

                                    <select name="category_id" class="form-control" id="">
                                        <option value="">@lang('site.all_categories')</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ request()->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>

                                </div>
                                <div class="col-sm-4">
                                    <button class="orm-control btn btn-primary"><i
                                            class="fa fa-search"></i>@lang('site.search')</button>


                                    {{-- @if (auth()->user()->hasPermission('create_users')) --}}

                                    <a href="{{ route('dashboard.products.create') }}" class="btn btn-primary"><i
                                            class="fa fa-plus"></i>@lang('site.add')</a>

                                    {{-- @else

                                    <a href="#" class="btn btn-primary disabled"><i class="fa fa-plus"></i>@lang('site.add')</a>

                                @endif --}}
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            @if ($products->count() > 0)
                                <div class="box-body">
                                    <table class="table table-bordered text-center table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>@lang('site.name')</th>
                                                <th>@lang('site.category')</th>
                                                <th>@lang('site.description')</th>
                                                <th>@lang('site.img')</th>
                                                <th>@lang('site.purchase_price')</th>
                                                <th>@lang('site.sale_price')</th>
                                                <th>@lang('site.profit')</th>
                                                <th>@lang('site.profit_percentage')</th>
                                                <th>@lang('site.stock')</th>
                                                <th>@lang('site.action')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($products as $index => $product)
                                            @php
                                                $profit = $product->sale_price - $product->purchase_price;
                                                $profit_percentage = number_format($profit * 100 / $product->purchase_price, 2);
                                            @endphp
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $product->name }}</td>
                                                    <td>{{ $product->category->name }}</td>
                                                    <td>{{ $product->description }}</td>
                                                    <td><img src="{{ asset('/uploads/product_images/' . $product->img) }}" width="100px" class="img-thumbnail" alt=""></td>
                                                    <td>{{ $product->purchase_price }}</td>
                                                    <td>{{ $product->sale_price }}</td>
                                                    <td>{{ $profit }}</td>
                                                    <td>{{ $profit_percentage }} %</td>
                                                    <td>{{ $product->stock }}</td>
                                                        {{-- @if (auth()->user()->hasPermission('update_users')) --}}
                                                    <td>
                                                        <a href="{{ route('dashboard.products.edit', $product->id) }}"
                                                            class="btn btn-info btn-sm"><i
                                                                class="fa fa-edit">@lang('site.edit')</i></a>
                                                        {{-- @else --}}

                                                        {{-- <a href="#" class="btn btn-info btn-sm disabled"><i class="fa fa-edit">@lang('site.edit')</i></a> --}}

                                                        {{-- @endif --}}

                                                        {{-- @if (auth()->user()->hasPermission('delete_users')) --}}
                                                        <form action="{{ route('dashboard.products.destroy', $product->id) }}"
                                                            method="post" style="display: inline-block">
                                                            {{ csrf_field() }}
                                                            {{ method_field('delete') }}

                                                            <button class="btn btn-danger btn-sm delete"><i
                                                                    class="fa fa-trash">@lang('site.delete')</i></button>
                                                        </form>
                                                        {{-- @else

                                                    <button class="btn btn-danger btn-sm disabled"<i class="fa fa-trash">@lang('site.delete')</i></button>

                                                @endif --}}
                                                     </td>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{ $products->appends(request()->query())->links() }}
                                </div>
                            @else
                                <h4>@lang('site.no_data_found')</h4>
                            @endif
                        </div>
                    </div><!-- /.container-fluid -->
                </div>
            </div>
        </section>
    </div>
@endsection
