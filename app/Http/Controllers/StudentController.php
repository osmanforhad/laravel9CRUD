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

    public function edit($id){
        $student = Student::find($id);
        return view('students.edit', compact('student'));
    }

    public function update(Request $request, $id){
        $student = Student::find($id);
        $student->name = $request->input('name');
        $student->email = $request->input('email');
        $student->course = $request->input('course');
        if($request->hasFile('profile_image')){
            $destination_path = 'uploads/students/'.$student->profile_image;
            if(File::exists($destination_path)){
                File::delete($destination_path);
            }
            $file = $request->file('profile_image');
            $extension = $file->getClientOriginalExtension();
            $fileName = time().'.'.$extension;
            $file->move('uploads/students/', $fileName);
            $student->profile_image = $fileName;
        }
        $student->update();
        return redirect()->route('student.show')->with('status', 'Student Updated Successfully');
    }

    public function destroy($id){
        $student = Student::find($id);
        $destination_path = 'uploads/students/'.$student->profile_image;
        if(File::exists($destination_path)){
            File::delete($destination_path);
        }
        $student->delete();
        return redirect()->route('student.show')->with('status', 'Student info deleted Successfully');
    }

}
