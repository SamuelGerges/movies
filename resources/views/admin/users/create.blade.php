@extends('layouts.site')

@section('content')

    <div>
        <h2>@lang('users.users')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">@lang('users.users')</a></li>
        <li class="breadcrumb-item">@lang('site.create')</li>
    </ul>

    <div class="row">

        <div class="col-md-12">

            <div class="tile shadow">

                <form method="post" action="{{ route('admin.users.store') }}">
                    @csrf
                    @method('post')

                    @include('layouts.includes.partials._errors')

                    {{--name--}}
                    <div class="form-group">
                        <input type="text" name="name" placeholder="Name" class="form-control" value="{{ old('name') }}" required autofocus>
                    </div>

                    {{--email--}}
                    <div class="form-group">
                        <input type="email" name="email" placeholder="Email" class="form-control" value="{{ old('email') }}" required>
                    </div>

                    {{--password--}}
                    <div class="form-group">
                        <input type="password" placeholder="Password" name="password" class="form-control" value="{{ old('password') }}" required>
                    </div>

                    {{--password_confirmation--}}
                    <div class="form-group">
                        <input type="password" placeholder="Password Confirmation" name="password_confirmation" class="form-control" value="{{ old('password_confirmation') }}" required>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>@lang('site.create')</button>
                    </div>

                </form><!-- end of form -->

            </div><!-- end of tile -->

        </div><!-- end of col -->

    </div><!-- end of row -->

@endsection


