<?php
/**
 * Created by PhpStorm.
 * User: lyh
 * Date: 18/5/29
 * Time: 下午2:04
 */

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class StudentService
{
    public function create($data)
    {
        $time = Carbon::now();
        $data = array_merge($data, [
            'created_at' => $time,
            'updated_at' => $time
        ]);
        DB::table('students')->insert($data);
    }

    public function update($id, $data)
    {
        $time = Carbon::now();
        $data = array_merge($data, [
            'updated_at' => $time
        ]);
        DB::table('students')->where('id', $id)->update($data);
    }

    public function showById($id)
    {
        $student = DB::table('students')->where('id', $id)->first();
        return $student;

    }

    public function showAll()
    {
        $students = DB::table('students')->get();
        return $students;
    }

    public function delete($id)
    {
        DB::table('students')->where('id', $id)->delete();
    }

    public function iseExist($mobile)
    {
        $id = DB::table('students')->where('mobile', $mobile)->value('id');
        return $id;
    }
}