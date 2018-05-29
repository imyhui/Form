<?php

namespace App\Http\Controllers;

use App\Services\StudentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{

    private $studentService;

    private $rules = [
        'name' => 'required',
        'sex' => 'required|in:男,女',
        'mobile' => 'required',
        'email' => 'required|email',
        'stuid' => 'required',
        'department' => 'required',
        'major' => 'required',
        'remark' => 'max:200',
    ];

    public function __construct(StudentService $studentService)
    {
        $this->studentService = $studentService;
    }

    public function createStudent(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules);
        if ($validator->fails())
            return response()->json([
                'code' => 1001,
                'message' => $validator->errors()
            ]);

        $data = [];
        foreach ($this->rules as $key => $value) {
            $data[$key] = $request->input($key);
        }

        $id = $this->studentService->iseExist($data['mobile']);
        if ($id > 0) {
            $this->studentService->update($id, $data);
            return response()->json([
                'code' => 1000,
                'message' => '更新成功'
            ]);
        } else {
            $this->studentService->create($data);
            return response()->json([
                'code' => 1000,
                'message' => '报名成功'
            ]);
        }
    }

    public function showStudentsById($id)
    {
        $student = $this->studentService->showById($id);
        return response()->json([
            'code' => 1000,
            'message' => '请求成功',
            'data' => $student
        ]);
    }

    public function showStudents()
    {
        $students = $this->studentService->showAll();
        return response()->json([
            'code' => 1000,
            'message' => '请求成功',
            'data' => $students
        ]);
    }

    public function updateStudent(int $id, Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules);
        if ($validator->fails())
            return response()->json([
                'code' => 1001,
                'message' => $validator->errors()
            ]);

        $data = [];
        foreach ($this->rules as $key => $value) {
            $data[$key] = $request->input($key);
        }
        $this->studentService->update($id, $data);
        return response()->json([
            'code' => 1000,
            'message' => '更新成功'
        ]);
    }

    public function deleteStudent($id)
    {
        $this->studentService->delete($id);
        return response()->json([
            'code' => 1000,
            'message' => '删除成功'
        ]);
    }
}
