<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubmitRequest;
use App\Models\Submit_Form;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubmitFormController extends Controller
{
    public function submit(SubmitRequest $request)
    {
        if(!Auth::user()){
            return redirect()->back()->with('mustLogged', 'You must be logged in!');
        }
        
        $submitForm = new Submit_Form();
        $submitForm->job_id = $request->job_id;
        $submitForm->user_id = Auth::user()->id;
        $request->has('experience') ? $submitForm->experience = "yes" : $submitForm->experience = "no";

        $isAlreadySent = Submit_Form::where('user_id', Auth::user()->id)->get();
         if($isAlreadySent->isNotEmpty()){
            return redirect()->back()->with('alreadySent', 'You have already submitted your application');
        } else{
            $submitForm->save();
        }
        return redirect('/')->with('successSubmit', 'Success submitted.');
    }

    public function approve(Request $request)
    {
        $submitForm = Submit_Form::find($request->formId);
        $submitForm->approveDeny = 1;
        $submitForm->approveDeny == 1 ? $submitForm->status = "Approved" : $submitForm->status = "In progress";
        $submitForm->save();

        return redirect()->back();
    }

    public function deny(Request $request)
    {
        $submitForm = Submit_Form::find($request->formId);
        $submitForm->approveDeny = 2;
        $submitForm->approveDeny == 2 ? $submitForm->status = "Denied" : $submitForm->status = "In progress";
        $submitForm->save();

        return redirect()->back();
    }

    public function delete($id)
    {
        $submitForm = Submit_Form::findOrFail($id);
        $submitForm->delete();

        return redirect()->back()->with('delete', 'Applications success soft deleted');
    }

    public function search(Request $request)
    {
        $keyword = $request->keyword;
        $searchResults = Submit_Form::join('users', 'users.id', '=', 'submit_forms.user_id')
                                     ->join('jobs', 'jobs.id', '=', 'submit_forms.job_id')
                                    ->select('users.firstName', 'users.lastName', 'users.email', 'users.phoneNumber',
                                    'submit_forms.date', 'submit_forms.id', 'users.birth', 'jobs.name',
                                    'submit_forms.experience', 'submit_forms.status')
                                    ->where('users.firstName', 'like', '%' . $keyword . '%')
                                    ->orWhere('users.lastName', 'like', '%' . $keyword . '%')
                                    ->orWhere('users.email', 'like', '%' . $keyword . '%')
                                    ->orWhere('users.phoneNumber', 'like', '%' . $keyword . '%')
                                    ->orderBy('jobs.name', 'desc')
                                    ->paginate(5);

        return view('admin.searchResult', ['searchResults'=> $searchResults, 'keyword'=> $keyword]);
    }

    public function showAppDetails()
    {
        $applicationDetails = Submit_Form::with('user', 'job')->where('user_id', Auth::user()->id)->get();
        return view('appDetails', ['applicationDetails'=> $applicationDetails]);
    }

}
