<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormInformationRequest;
use App\Models\FormInformation;
use Illuminate\Http\Request;

class FormInformationController extends Controller
{
    public function create()
    {
        return view('forms.create');
    }
    public function store(FormInformationRequest $request)
    {
        $data = $request->all();

        $image = time().'.'.$data['image']->getClientOriginalExtension();
        $data['image']->move(public_path('images'), $image);

        FormInformation::create($data);

        return back()->with('success', 'Submission  successfully.');
    }
}
