@extends('layouts.site')



@section('content')

    <div>
        <h2>@lang('roles.roles')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.roles.index') }}">@lang('roles.roles')</a></li>
        <li class="breadcrumb-item">@lang('site.create')</li>
    </ul>

    <div class="row">

        <div class="col-md-12">

            <div class="tile shadow">

                <form method="post" action="{{ route('admin.roles.store') }}" id="roleForm">
                    @csrf
                    @method('post')
                    @include('layouts.includes.partials._errors')

                    {{--name--}}
                    <div class="form-group">
                        <input type="text" name="name" placeholder="Role Name" autofocus class="form-control"
                               value="{{ old('name') }}" required>
                    </div>

                    <h5>@lang('roles.permissions') <span class="text-danger">*</span></h5>

                    @php
                        $models = ['roles', 'admins'];
                    @endphp

                    <table class="table">
                        <thead>
                        <tr>
                            <th>@lang('roles.model')</th>
                            <th>@lang('roles.permissions')</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach ($models as $model)
                            <tr>
                                <td>@lang($model . '.' . $model)</td>
                                <td>
                                    <div class="animated-checkbox mx-2" style="display:inline-block;">
                                        <label class="m-0">
                                            <input type="checkbox" value="" name="" class="all-roles">
                                            <span class="label-text">@lang('site.all')</span>
                                        </label>
                                    </div>

                                    @php
                                        //create_roles, read_roles, update_roles, delete_roles
                                            $permissionMaps = ['create', 'read', 'update', 'delete'];
                                    @endphp

                                    @foreach ($permissionMaps as $permissionMap)
                                        <div class="animated-checkbox mx-2" style="display:inline-block;">
                                            <label class="m-0">
                                                <input type="checkbox" value="{{ $permissionMap . '_' . $model }}"
                                                       name="permissions[]" class="role">
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
                        <button type="submit" class="btn btn-primary add_role"><i class="fa fa-plus"></i>@lang('site.create')
                        </button>
                    </div>

                </form><!-- end of form -->

            </div><!-- end of tile -->

        </div><!-- end of col -->

    </div><!-- end of row -->

@endsection


