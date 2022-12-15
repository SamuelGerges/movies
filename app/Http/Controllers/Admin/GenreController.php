<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class GenreController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_genres')->only(['index']);
        $this->middleware('permission:create_genres')->only(['create', 'store']);
        $this->middleware('permission:update_genres')->only(['edit', 'update']);
        $this->middleware('permission:delete_genres')->only(['delete', 'bulk_delete']);

    }// end of __construct

    public function index()
    {
        return view('admin.genres.index');

    }// end of index

    public function data()
    {
        $genres = Genre::withCount(['movies']);

        return DataTables::of($genres)
            ->addColumn('record_select', 'admin.genres.data_table.record_select')
            ->addColumn('related_movies', 'admin.genres.data_table.related_movies')
            ->editColumn('created_at', function (Genre $genre) {
                return $genre->created_at->format('Y-m-d');
            })
            ->addColumn('actions', 'admin.genres.data_table.actions')
            ->rawColumns(['record_select', 'related_movies', 'actions'])
            ->toJson();


    }// end of data




    public function destroy(Genre $genre)
    {
        $this->delete($genre);
        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));
    }

    public function bulkDelete()
    {
        foreach (json_decode(request()->record_ids) as $recordId) {
            $genres = Genre::FindOrFail($recordId);
            $genres->delete();

        }//end of for each
        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));
    }
}
