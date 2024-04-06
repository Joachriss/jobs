<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostJobController extends Controller
{
    public function create() {
        return view('job.create');
    }

    public function store(Request $request) {
        $this->validate($request, [
            'feature_image'=>['required','mimes:png,jpg,jpeg','max:2048'],
            'title' => ['required', 'string', 'max:255','min:5'],
            'description' => ['required','min:5'],
            'role' => ['required','min:5'],
            'job_type' => ['required'],
            'address' => ['required'],
            'salary' => ['required'],
            'application_close_date' => ['required'],
        ]);
    }
}
