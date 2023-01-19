@extends('layouts.site')

@section('content')

    <div>
        <h2>@lang('admins.admins')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item">Sliders</li>
    </ul>

    <div class="row">

        <div class="col-md-12">

            <div class="tile shadow">

                <div class="row mb-2">

                    <div class="col-md-12">
                            <a href="{{ route('admin.sliders.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.create')</a>
                    </div>

                </div><!-- end of row -->
            </div><!-- end of tile -->
        </div><!-- end of col -->
    </div><!-- end of row -->

@endsection


