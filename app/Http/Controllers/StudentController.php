<?php

namespace App\Http\Controllers;

use App\Exports\StudentsExport;
use App\Models\Student;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class StudentController extends Controller
{
    public function index(Request $request) {

        $students = Student::latest('id');

        if($request->get('keyword') != "") {
            $students = $students->where('name','like','%'.$request->get('keyword').'%');
        }

        $data['students'] = $students->get();

        // $students = Student::latest('id')->get();
        // $data['students'] = $students;
        
        return view('students',$data);
    }

    public function export(Request $request) {
        return Excel::download(new StudentsExport($request), 'students.xlsx');
    }
}
