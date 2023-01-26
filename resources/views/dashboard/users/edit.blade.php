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
                    <h2 class="box-title m-3">@lang('site.users')</h2>

                    <div class="row">
                        <h4 class="col-sm-6">@lang('site.edit')</h4>
                    </div>
                </div>
                @include('partials._errors')
                <div class="row">
                    <div class="col-md-12">
                        <div class="box-body">
                            <form action="{{ route('dashboard.users.update', $user->id) }}" enctype="multipart/form-data" method="POST">
                                {{method_field('PATCH')}}
                                {{-- @method('post') --}}
                                @csrf
                                <div class="form-group">
                                    <label for="">@lang('site.first_name')</label>
                                    <input type="text" class='form-control' name='first_name' value="{{ $user->first_name }}">
                                </div>

                                <div class="form-group">
                                    <label for="">@lang('site.last_name')</label>
                                    <input type="text" class='form-control'  name='last_name' value="{{ $user->last_name }}">
                                </div>

                                <div class="form-group">
                                    <label for="">@lang('site.email')</label>
                                    <input type="email" class='form-control'  name='email' value="{{ $user->email }}">
                                </div>

                                <div class="form-group">
                                    <label for="">@lang('site.img')</label>
                                    <input type="file" class='form-control-file image'  name='img'>
                                </div>

                                <div class="form-group">
                                    <img src="{{ asset('uploads/user_images/' . $user->img) }}" class="img-thumbnail image-preview" width="100px" alt="" srcset="">
                                </div>

                                {{-- <div class="form-group">
                                    <label for="">@lang('site.password')</label>
                                    <input type="password" class='form-control' name='password'>
                                </div>

                                <div class="form-group">
                                    <label for="">@lang('site.password_confirmation')</label>
                                    <input type="password" class='form-control' name='password_confirmation'>
                                </div> --}}

                                {{-- <div class="row">
                                    <div class="col-12"> --}}
                                      <!-- Custom Tabs -->
                                <div class="card">
                                    <div class="card-header d-flex p-0">
                                        <h3 class="card-title p-3">@lang('site.permissions')</h3>
                                        <div class="nav nav-tabs-custom">

                                        @php
                                            $models = ['users', 'categories', 'products'];
                                            $maps = ['create', 'read', 'update', 'delete'];
                                        @endphp

                                        <ul class="nav nav-tabs">

                                            @foreach ($models as $index=>$model)

                                                <li class="{{ $index == 0 ? 'active' : '' }}"><a href="#{{ $model }}" data-toggle="tab">@lang('site.'. $model)</a></li>

                                            @endforeach

                                        </ul>
                                    </div><!-- /.card-header -->
                                    <div class="card-body">
                                        <div class="tab-content">

                                            @foreach ($models as $index=>$model)


                                                <div class="tab-pane {{ $index==0 ? 'active' : '' }}" id="{{ $model }}">

                                                    @foreach ($maps as $index=>$map)

                                                        <label><input type="checkbox" name="permissions[]" value="{{ $map . '_' . $model }}">@lang('site.' . $map)</label>
                                                        {{-- <label><input type="checkbox" name="permissions[]" {{ $user->hasPermission($map . '_' . $model) ? 'checked' : ''  }}   value="{{ $map . '_' . $model }}">@lang('site.' . $map)</label> --}}

                                                    @endforeach
                                                    {{-- <label><input type="checkbox" name="permissions[]" value="read_{{ $model }}">@lang('site.read')</label>
                                                    <label><input type="checkbox" name="permissions[]" value="update_{{ $model }}">@lang('site.update')</label>
                                                    <label><input type="checkbox" name="permissions[]" value="delete_{{ $model }}">@lang('site.delete')</label> --}}
                                                </div>


                                            @endforeach
                                        <!-- /.tab-pane -->
                                        </div>
                                        <!-- /.tab-content -->
                                    </div><!-- /.card-body -->
                                </div>
                                      <!-- ./card -->

                                  <!-- END CUSTOM TABS -->

                                <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i>@lang('site.edit')</button>
                            </form>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </div>
        </div>
    </section>
</div>
@endsection
