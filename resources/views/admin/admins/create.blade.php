@extends('layouts.site')

@section('content')

    <div>
        <h2>@lang('admins.admins')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.admins.index') }}">@lang('admins.admins')</a></li>
        <li class="breadcrumb-item">@lang('site.create')</li>
    </ul>

    <div class="row">

        <div class="col-md-12">

            <div class="tile shadow">

                <form method="post" action="{{ route('admin.admins.store') }}">
                    @csrf
                    @method('post')

                    @include('layouts.includes.partials._errors')

                    {{--name--}}
                    <div class="form-group">
                        <input type="text" placeholder="Name" name="name" autofocus class="form-control" value="{{ old('name') }}" required>
                    </div>

                    {{--email--}}
                    <div class="form-group">
                        <input type="email" placeholder="Email" name="email" class="form-control" value="{{ old('email') }}" required>
                    </div>

                    {{--password--}}
                    <div class="form-group">
                        <input type="password" placeholder="Password" name="password" class="form-control" value="" required>
                    </div>

                    {{--password_confirmation--}}
                    <div class="form-group">
                        <input type="password" placeholder="Password Conformation" name="password_confirmation" class="form-control" value="" required>
                    </div>

                    {{--role_id--}}
                    <div class="form-group">
                        <label>@lang('roles.role') <span class="text-danger">*</span></label>
                        <select name="role_id" class="form-control select2" required>
                            <option value="">@lang('site.choose') @lang('roles.role')</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}" {{ $role->id == old('role_id') ? 'selected' : '' }}>{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>@lang('site.create')</button>
                    </div>

                </form><!-- end of form -->

            </div><!-- end of tile -->

        </div><!-- end of col -->

    </div><!-- end of row -->

@endsection
