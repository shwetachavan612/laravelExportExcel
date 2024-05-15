<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;


// class StudentsExport implements FromCollection
// {
//     /**
//     * @return \Illuminate\Support\Collection
//     */
//     public function collection()
//     {
//         return Student::all();
//     }
// }

class StudentsExport implements FromView  //for getting headings in excel file
{
    public function __construct($request)
    {
        $this->request = $request;
    }

    public function view(): View
    {


        $students = Student::latest('id');

        if($this->request->get('keyword') != "") {
            $students = $students->where('name','like','%'.$this->request->get('keyword').'%');
        }


        // $students = Student::latest('id')->get();
        return view('student-export', [
            'students' => $students->get()
        ]);
    }
}