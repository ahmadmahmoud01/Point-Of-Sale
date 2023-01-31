@extends('layouts.dashboard.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>@lang('site.clients')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li> @lang('site.clients')</li>
                <li class="active"> @lang('site.edit')</li>
            </ol>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="box box-primary box-bordered">
                    <div class="box-header">
                        <h2 class="box-title m-3">@lang('site.clients')</h2>

                        <div class="row">
                            <h4 class="col-sm-6">@lang('site.edit')</h4>
                        </div>
                    </div>
                    @include('partials._errors')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box-body">
                                <form action="{{ route('dashboard.clients.update', $client->id) }}" method="POST">
                                    {{ method_field('PATCH') }}
                                    {{-- @method('post') --}}
                                    @csrf
                                    <div class="form-group">
                                        <label for="">@lang('site.name')</label>
                                        <input type="text" class='form-control' name='name'
                                            value="{{ $client->name }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="">@lang('site.phone')</label>
                                        <input type="number" class='form-control' name='phone'
                                            value="{{ $client->phone }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="">@lang('site.address')</label>
                                        <textarea type="text" class='form-control' name='address' ">{{ $client->address }}</textarea>
                                    </div>


                                    <!-- END CUSTOM TABS -->

                                    <button type="submit" class="btn btn-primary"><i
                                            class="fa fa-edit"></i>@lang('site.edit')</button>
                                </form>
                            </div>
                        </div>
                    </div><!-- /.container-fluid -->
                </div>
            </div>
        </section>
    </div>
@endsection
