@extends('layouts.site')

@section('content')

    <div>
        <h2>@lang('users.change_password')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item">@lang('users.change_password')</li>
    </ul>

    <div class="row">

        <div class="col-md-12">

            <div class="tile shadow">

                <form method="post" action="{{ route('admin.profile.password.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('put')

                    @include('layouts.includes.partials._errors')

                    {{--old_password--}}
                    <div class="form-group">
                        <input type="password" placeholder="Old Password" name="old_password" class="form-control"
                               value="" required>
                    </div>

                    {{--password--}}
                    <div class="form-group">
                        <input type="password" name="password" placeholder="New Password" class="form-control" value=""
                               required>
                    </div>

                    {{--password_confirmation--}}
                    <div class="form-group">
                        <input type="password" placeholder="Confirmation Password" name="password_confirmation"
                               class="form-control" value="" required>
                    </div>

                    {{--submit--}}
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-edit"></i>
                            @lang('site.update_password')
                        </button>
                    </div>

                </form><!-- end of form -->

            </div><!-- end of tile -->

        </div><!-- end of col -->

    </div><!-- end of row -->
@endsection
