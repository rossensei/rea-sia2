<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia('Student/Index', [
            'students' => Student::with('records')->get()
        ]);
    }

    public function search($searchKey) 
    {
        return inertia('Student/Index', [
            'students' => Student::where('fname', 'like', "%".$searchKey."%")
                                ->orWhere('lname', 'like', "%".$searchKey."%")
                                ->get()
        ]); 
    }

    public function toggleActive(Student $student) 
    {
        // dd($student);
        $student->active = !$student->active;
        $student->save();
        return back()->banner('Student status updated successfully!');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Student/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'fname' => 'required|string',
            'lname' => 'required|string',
            'course' => 'required|string',
            'year' => 'required|numeric',
            'phone' => 'required|string',
            'email' => 'required|email|unique:students'
        ]);

        $fileName = null;

        if($request->profile_pic) {
            $fileName = time().'.'.$request->profile_pic->extension();
            $request->profile_pic->move(public_path('images/student_profile_pics'), $fileName);
            $fields['profile_pic'] = $fileName;
        }

        Student::create($fields);

        return redirect('/students')->banner('Student added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        $records = $student->records;

        return inertia('Student/Show', [
            'student' => $student,
            'records' => $records
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        return inertia('Student/Edit', [
            'student' => $student
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {

        // dd($request);
        $fields = $request->validate([
            'fname' => 'required|string',
            'lname' => 'required|string',
            'course' => 'required|string',
            'year' => 'required|numeric',
            'phone' => 'required|string',
            'email' => ['required', 'email', 'max:255', Rule::unique('students')->ignore($student->id)]
        ]);

        $fileName = null;

        if($request->profile_pic) {
            $fileName = time().'.'.$request->profile_pic->extension();
            $request->profile_pic->move(public_path('images/student_profile_pics'), $fileName);
            $fields['profile_pic'] = $fileName;
        }

        $student->update($fields);

        return redirect('/students')->banner('Student details updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        if(!$student->records()->exists()) {
            $student->delete();
            return redirect('/students')->banner('Student has been removed.');
        } else {
            return back()->dangerBanner('You cannot delete this student because it has existing records.');
        }

    }
}
