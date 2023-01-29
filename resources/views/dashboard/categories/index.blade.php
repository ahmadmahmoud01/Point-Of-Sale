@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <h1>@lang('site.users')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li> @lang('site.users')</li>
                <li class="active"> <a href="{{ route('dashboard.categories.index') }}"></a>@lang('site.categories')</li>
            </ol>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="box box-primary box-bordered">
                    <div class="box-header">
                        <h2 class="box-title m-3">@lang('site.categories')</h2><small>{{ $categories->total() }}</small>

                        <form action="{{ route('dashboard.categories.index') }}" method="get">
                            <div class="row">
                                <div class="col-sm-4">
                                    <input type="text" class='form-control' name="search"
                                        placeholder="@lang('site.search')" value="{{ request()->search }}">

                                </div>
                                <div class="col-sm-4">
                                    <button class="orm-control btn btn-primary"><i
                                            class="fa fa-search"></i>@lang('site.search')</button>

                                    {{-- @if (auth()->user()->hasPermission('create_users')) --}}

                                    <a href="{{ route('dashboard.categories.create') }}" class="btn btn-primary"><i
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
                            @if ($categories->count() > 0)
                                <div class="box-body">
                                    <table class="table table-bordered text-center table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>@lang('site.name')</th>
                                                <th>@lang('site.action')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($categories as $index => $category)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $category->name }}</td>
                                                        {{-- @if (auth()->user()->hasPermission('update_users')) --}}
                                                    <td>
                                                        <a href="{{ route('dashboard.categories.edit', $category->id) }}"
                                                            class="btn btn-info btn-sm"><i
                                                                class="fa fa-edit">@lang('site.edit')</i></a>
                                                        {{-- @else --}}

                                                        {{-- <a href="#" class="btn btn-info btn-sm disabled"><i class="fa fa-edit">@lang('site.edit')</i></a> --}}

                                                        {{-- @endif --}}

                                                        {{-- @if (auth()->user()->hasPermission('delete_users')) --}}
                                                        <form action="{{ route('dashboard.categories.destroy', $category->id) }}"
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
                                    {{ $categories->appends(request()->query())->links() }}
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
