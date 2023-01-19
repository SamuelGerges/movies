@extends('layouts.site')

@section('content')

    <div>
        <h2>@lang('admins.admins')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.sliders.index') }}">Slider</a></li>
        <li class="breadcrumb-item">@lang('site.create')</li>
    </ul>

    <div class="row">

        <div class="col-md-12">

            <div class="tile shadow">

                <form method="post" action="{{ route('admin.sliders.store') }}" enctype="multipart/form-data">
                    @csrf
                    @method('post')

                    @include('layouts.includes.partials._errors')

                    {{--name--}}
                    <div class="form-group">
                        <input type="text" placeholder="name" name="name" autofocus class="form-control">
                    </div>

                    {{--age--}}
                    <div class="form-group">
                        <input type="text" placeholder="age" name="age" class="form-control">
                    </div>

                    {{--slider--}}
                    <div class="form-control m-1 h-50">
                            <div class="form-group">
                                <input type="text" placeholder="title" name="slider[title]" class="form-group w-25 h-0">
                                <input type="text" placeholder="alt" name="slider[alt]" class="form-group w-25 h-0">
                                <input type="file" placeholder="file" name="slider[url]" class="form-group w-25 h-0">
                            </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>@lang('site.create')</button>
                    </div>

                </form><!-- end of form -->

            </div><!-- end of tile -->

        </div><!-- end of col -->

    </div><!-- end of row -->

@endsection
