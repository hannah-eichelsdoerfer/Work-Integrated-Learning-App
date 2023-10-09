<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Student;
use App\Models\StudentRole;

class StudentController extends Controller
{
    public function __construct()
    {
        // $this->middleware(["checkUserType:Teacher", "auth"])->except(["show"]);
    }

    // Index
    public function index()
    {
        if (auth()->user()->type != 'Teacher') {
            return redirect('dashboard');
        }

        // paginate
        $students = Student::paginate(10);
        return view('students.index')->with('students', $students);
    }
    
    // Show
    public function show($id)
    {
        if (
            $id != auth()->user()->student->id &&
            auth()->user()->type != 'Teacher'
        ) {
            return redirect('dashboard');
        }
        $student = Student::find($id);
        return view('students.show')->with('student', $student);
    }

    // edit
    public function edit($id)
    {
        $student = Student::find($id);
        return view('students.edit')->with('student', $student);
    }

    // update
    public function update(Request $request, $studentId)
    {
        // validate
        $request->validate([
            'gpa' => 'required|numeric|min:0|max:7',
            'roles' => 'required|array',
            // 'roles.*' => 'in:Software Developer,Project Manager,Business Analyst,Tester,Client Liaison',
        ]);

        $student = Student::find($studentId);

        // Check if nothing has changed
        if ($student->gpa == $request->gpa && $student->roles->pluck('role_id')->toArray() == $request->roles) {
            // Nothing has changed, so you can return without doing anything
            return redirect()->back();
        }

        // update
        $student->gpa = $request->gpa;
        $student->save();

        // check if new roles are the same as old roles
        if ($student->roles->pluck('role_id')->toArray() != $request->roles) {
            /// Delete all the old roles
            StudentRole::where('student_id', $student->id)->delete();
            // Create the new roles
            foreach ($request->roles as $roleId) {
                StudentRole::create([
                    'student_id' => $student->id,
                    'role_id' => $roleId,
                ]);
            }
        }

        toast()
            ->success('Profile updated successfully!')
            ->push();

        // stay on the same page
        return redirect()->back();
    }
}
