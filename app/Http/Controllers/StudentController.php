<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class StudentController extends Controller
{
    public function index(){
        $students = Student::all();
        return view('students.index', compact('students'));
    }

    public function create(){
        return view('students.create');
    }

    public function store(Request $request){
        $student = new Student();
        $student->name = $request->input('name');
        $student->email = $request->input('email');
        $student->course = $request->input('course');
        if($request->hasFile('profile_image')){
            $file = $request->file('profile_image');
            $extension = $file->getClientOriginalExtension();
            $fileName = time().'.'.$extension;
            $file->move('uploads/students/', $fileName);
            $student->profile_image = $fileName;
        }
        $student->save();
        return redirect()->route('student.show')->with('status', 'Student Created Successfully');
    }

}
