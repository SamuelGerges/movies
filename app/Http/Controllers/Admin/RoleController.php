<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RoleRequest;
use Illuminate\Http\Request;
use App\Models\Role;
use Yajra\DataTables\DataTables;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_roles')->only(['index']);
        $this->middleware('permission:create_roles')->only(['create', 'store']);
        $this->middleware('permission:update_roles')->only(['edit', 'update']);
        $this->middleware('permission:delete_roles')->only(['delete', 'bulk_delete']);

    }// end of __construct

    public function index()
    {
        return view('admin.roles.index');

    }// end of index

    public function data()
    {
        $roles = Role::whereNotIn('name', ['super_admin', 'admin', 'user'])
            ->withCount(['users'])->get();

        return DataTables::of($roles)
            ->addColumn('record_select', 'admin.roles.data_table.record_select')
            ->editColumn('created_at', function (Role $role) {
                return $role->created_at->format('Y-m-d');
            })
            ->addColumn('actions', 'admin.roles.data_table.actions')
            ->rawColumns(['record_select', 'actions'])
            ->toJson();

    }// end of data


    public function create()
    {
        return view('admin.roles.create');
    }


    public function store(RoleRequest $request)
    {
        $role = Role::create($request->only(['name']));
        $role->attachPermissions($request->permissions);
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('admin.roles.index');
    }




    public function edit(Role $role)
    {
        return view('admin.roles.edit', compact('role'));
    }


    public function update(Request $request, Role $role)
    {
        $role->update($request->only(['name']));
        $role->syncPermissions($request->permissions);

        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('admin.roles.index');
    }


    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));
    }

    public function bulkDelete()
    {
        foreach (json_decode(request()->record_ids) as $recordId) {
            $roles = Role::FindOrFail($recordId);
            $roles->delete();

        }//end of for each
        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));
    }
}
