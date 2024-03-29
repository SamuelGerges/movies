@extends('layouts.site')

@section('content')

    <div>
        <h2>@lang('genres.genres')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.genres.index') }}">@lang('genres.genres')</a></li>
        <li class="breadcrumb-item">@lang('site.create')</li>
    </ul>

    <div class="row">

        <div class="col-md-12">

            <div class="tile shadow">

                <form method="post" action="{{ route('admin.genres.store') }}">
                    @csrf
                    @method('post')

                    @include('layouts.includes.partials._errors')

                    {{--name--}}
                    <div class="form-group">
                        <label>@lang('genres.name') <span class="text-danger">*</span></label>
                        <input type="text" name="name" autofocus class="form-control" value="{{ old('name') }}" required>
                    </div>

                    <h5>@lang('genres.permissions') <span class="text-danger">*</span></h5>

                    @php
                        $models = ['genres', 'admins'];
                    @endphp

                    <table class="table">
                        <thead>
                        <tr>
                            <th>@lang('genres.model')</th>
                            <th>@lang('genres.permissions')</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach ($models as $model)
                            <tr>
                                <td>@lang($model . '.' . $model)</td>
                                <td>
                                    <div class="animated-checkbox mx-2" style="display:inline-block;">
                                        <label class="m-0">
                                            <input type="checkbox" value="" name="" class="all-genres">
                                            <span class="label-text">@lang('site.all')</span>
                                        </label>
                                    </div>

                                    @php
                                        //create_genres, read_genres, update_genres, delete_genres
                                            $permissionMaps = ['create', 'read', 'update', 'delete'];
                                    @endphp

                                    @foreach ($permissionMaps as $permissionMap)
                                        <div class="animated-checkbox mx-2" style="display:inline-block;">
                                            <label class="m-0">
                                                <input type="checkbox" value="{{ $permissionMap . '_' . $model }}" name="permissions[]" class="genre">
                                                <span class="label-text">@lang('site.' . $permissionMap)</span>
                                            </label>
                                        </div>
                                    @endforeach
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table><!-- end of table -->

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>@lang('site.create')</button>
                    </div>

                </form><!-- end of form -->

            </div><!-- end of tile -->

        </div><!-- end of col -->

    </div><!-- end of row -->

@endsection


