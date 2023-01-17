@extends('layouts.dashboard.app')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <h1>@lang('site.users')</h1>

        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
            <li class="active"> @lang('site.users')</li>
        </ol>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="box box-primary box-bordered">
                <div class="box-header">
                    <h2 class="box-title m-3">@lang('site.users')</h2>

                    <div class="row">
                        <div class="col-sm-4">
                            <input type="text" class='form-control' name="search" placeholder="@lang('site.search')">
                        </div>
                        <div class="col-sm-4">
                            <button class="btn btn-primary"><i class="fa fa-search"></i>@lang('site.search')</button>
                            <a href="{{ route('dashboard.users.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i>@lang('site.add')</a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        @if($users->count() > 0)
                        <div class="box-body">
                            <table class="table table-bordered text-center table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>@lang('site.first_name')</th>
                                        <th>@lang('site.last_name') </th>
                                        <th>@lang('site.email')</th>
                                        <th>@lang('site.action')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $index=>$user)

                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $user->first_name }}</td>
                                        <td>{{ $user->last_name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            <a href="{{ route('dashboard.users.edit', $user->id) }}" class="btn btn-info btn-sm">@lang('site.edit')</a>
                                            <form action="{{ route('dashboard.users.destroy', $user->id) }}" method="post" style="display: inline-block">
                                            {{ csrf_field() }}
                                            {{ method_field('delete') }}
                                                <button class="btn btn-danger btn-sm">@lang('site.delete')</button>
                                            </form>
                                        </td>
                                    </tr>

                                    @endforeach
                                </tbody>
                            </table>
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