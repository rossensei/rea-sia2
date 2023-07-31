<?php

namespace App\Http\Controllers;

use App\Models\Record;
use App\Models\Student;
use Illuminate\Http\Request;

class RecordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Student $student)
    {
        return inertia('Record/Create', [
            'student' => $student
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'violation' => 'required|string',
            'violation_date' => 'required|date',
            'action' => 'required|string'
        ]);

        Record::create($request->all());

        return redirect('/students/view/'.$request->student_id)->banner('Record added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Record $record)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student, Record $record)
    {
        return inertia('Record/Edit', [
            'student' => $student,
            'record' => $record
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student, Record $record)
    {
        $request->validate([
            'violation' => 'required|string',
            'violation_date' => 'required|date',
            'action' => 'required|string'
        ]);

        $record->update($request->all());

        return redirect('/students/view/'.$request->student_id)->banner('Record updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student, Record $record)
    {
        $record->delete();

        return back()->banner('Record deleted successfully!');
    }
}
