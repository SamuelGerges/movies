@extends('layouts.site')

@section('content')

    <div>
        <h2>@lang('users.edit_profile')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item">@lang('users.edit_profile')</li>
    </ul>

    <div class="row">

        <div class="col-md-12">

            <div class="tile shadow">

                <form method="post" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('put')

                    @include('layouts.includes.partials._errors')

                    {{--name--}}
                    <div class="form-group">
                        <input type="text" name="name" placeholder="Name" class="form-control" value="{{ old('name', auth()->user()->name) }}" required>
                    </div>

                    {{--email--}}
                    <div class="form-group">
                        <input type="email" placeholder="Email" name="email" class="form-control" value="{{ old('email', auth()->user()->email) }}" required>
                    </div>

                    {{--image--}}
                    <div class="form-group">
                        <input type="file" name="image" placeholder="Image" class="form-control load-image">
                        <img src="{{ auth()->user()->image_path }}" class="loaded-image" alt="" style="display: block; width: 200px; margin: 10px 0;">
                    </div>

                    {{--submit--}}
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-edit"></i>
                            @lang('site.update_profile')
                        </button>
                    </div>

                </form><!-- end of form -->

            </div><!-- end of tile -->

        </div><!-- end of col -->

    </div><!-- end of row -->
@endsection
