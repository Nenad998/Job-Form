<?php

namespace App\Http\Controllers;

use App\Models\Submit_Form;
use Illuminate\Http\Request;

class SoftDeleteController extends Controller
{
    public function deletedApps()
    {
        $trashedApps = Submit_Form::onlyTrashed()->with('user', 'job')->get();
        return view('admin.deletedApps', ['trashedApps'=> $trashedApps]);
    }

    public function restore($id)
    {
        Submit_Form::withTrashed()->findOrFail($id)->restore();
        return redirect()->back();
    }

    public function delete($id)
    {
        Submit_Form::where('id', $id)->forceDelete();
        return redirect()->back();
    }
}
