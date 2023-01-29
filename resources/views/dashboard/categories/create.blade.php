@extends('layouts.dashboard.app')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <h1>@lang('site.users')</h1>

        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
            <li> @lang('site.users')</li>
            <li class="active"> @lang('site.add')</li>
        </ol>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="box box-primary box-bordered">
                <div class="box-header">
                    <h2 class="box-title m-3">@lang('site.categories')</h2>

                    <div class="row">
                        <h4 class="col-sm-6">@lang('site.add')</h4>
                    </div>
                </div>
                @include('partials._errors')
                <div class="row">
                    <div class="col-md-12">
                        <div class="box-body">
                            <form action="{{ route('dashboard.categories.store') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="">@lang('site.name')</label>
                                    <input type="text" class='form-control' name='name' value="{{ old('name') }}">
                                </div>



                                  <!-- END CUSTOM TABS -->

                                <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>@lang('site.add')</button>
                            </form>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </div>
        </div>
    </section>
</div>
@endsection
