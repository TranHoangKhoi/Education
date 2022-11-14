<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Students;
use App\Models\Course;
use App\Models\Majors;
use App\Models\ClassModel;
use App\Models\User;
// use App\Models\Students;
use App\Http\Resources\StudentsResource;
// use App\Models\ClassModel;
// use App\Http\Resources\StudentsCollection;
use Exception;

class StudentController extends Controller
{
    // protected $students;

    // public function __construct(Students $students) {
    //     $this->students = $students;
    // }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    // {
    //     $input = $request->all();
    //     $input['limit'] = $request->limit;
    //     try {
    //         // $data=Students::all();
    //         $data  =  Students::select(
    //             'students.id',
    //             'students.id_course',
    //             'students.id_class',
    //             'students.id_user',
    //             'students.id_major',
    //             'students.mssv',
    //             'students.gender',
    //             'students.name',
    //             'students.phone',
    //             'students.created_at',
    //             'students.updated_at'
    //         )
    //             ->join('course', 'students.id_course', '=', 'course.id')
    //             ->join('class', 'students.id_class', '=', 'class.id')
    //             ->join('majors', 'students.id_major', '=', 'majors.id')
    //             ->join('users', 'students.id_user', '=', 'users.id')

    //             ->where(function ($query) use ($input) {
    //                 //Lọc theo  Email sinh viên
    //                 if (!empty($input['email'])) {
    //                     $query->where('users.email', 'like', '%' . $input['email'] . '%');
    //                 }
    //                 //lọc theo tên sinh viên
    //                 if (!empty($input['name'])) {
    //                     $query->where('students.name', 'like', '%' . $input['name'] . '%');
    //                 }
    //                 //lọc theo mã số sinh viên
    //                 if (!empty($input['mssv'])) {
    //                     $query->where('students.mssv', 'like', '%' . $input['mssv'] . '%');
    //                 }
    //                 //Lọc theo giới tính
    //                 if (!empty($input['gender'])) {
    //                     $query->where('students.gender', $input['gender']);
    //                 }
    //                 //Lọc theo lớp
    //                 if (!empty($input['nameClass'])) {
    //                     $query->where('class.name_class', 'like', '%' . $input['nameClass'] . '%');
    //                 }
    //                 //Lọc theo khóa
    //                 if (!empty($input['nameCourse'])) {
    //                     $query->where('course.name_id', 'like', '%' . $input['nameCourse'] . '%');
    //                 }
    //                 //Lọc theo tên chuyên ngành
    //                 if (!empty($input['nameMajor'])) {
    //                     $query->where('majors.name_major', 'like', '%' . $input['nameMajor'] . '%');
    //                 }
    //                 //Lọc theo mã Chuyên ngành
    //                 if (!empty($input['nameIdMajor'])) {
    //                     $query->where('majors.name_id', 'like', '%' . $input['nameIdMajor'] . '%');
    //                 }
    //             })->orderBy('students.created_at', 'desc')->paginate(!empty($input['limit']) ? $input['limit'] : 10);
    //         $resource =  StudentsResource::collection($data);
    //     } catch (Exception $e) {
    //         return response()->json([
    //             'status' => 'Error',
    //             'message' => $e->getMessage()
    //         ], 400);
    //     }
    //     return response()->json([
    //         'data' => $resource,
    //         'success' => true,
    //         'message' => 'Lấy dữ liệu thành công!',
    //     ], 200);
    // }
    {
        $listStudent = Students::orderBy('id_class', 'desc')->paginate(12);
        return view('admin.pages.student.index', compact('listStudent'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $class = ClassModel::get();
        $course = Course::get();
        $majors = Majors::get();
        return view('admin.pages.student.create', compact('class', 'course', 'majors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    // {
    //     $Input = $request->all();
    //     $validator = Validator::make($request->all(), [
    //         'id_course' => 'required',
    //         'id_class' => 'required',
    //         'id_major' => 'required',
    //         'mssv' => 'required|unique:students',
    //         'name' => 'required',
    //         'id_user' => 'required',
    //         // 'email' => 'required|Email|unique:students',
    //         // 'password' => 'required|min:6',
    //         'phone' => 'required|min:10|alpha_num',
    //         'gender' => 'required',
    //     ]);

    //     if ($validator->fails()) {
    //         $arr = [
    //             'success' => false,
    //             'message' => 'Lỗi kiểm tra dữ liệu',
    //             'data' => $validator->errors()
    //         ];
    //         return response()->json($arr, 422);
    //     }

    //     $student = Students::create(
    //         [
    //             'id_user' => $Input['id_user'],
    //             'id_course' => $request->id_course,
    //             'id_class' => $request->id_class,
    //             'id_major' => $request->id_major,
    //             'mssv' => mb_strtoupper($request->mssv),
    //             'name' => mb_convert_case($request->name, MB_CASE_TITLE, "UTF-8"),
    //             'phone' => $request->phone,
    //             'gender' => $request->gender,
    //         ]
    //     );

    //     $studentsResource = new StudentsResource($student);

    //     return response()->json([
    //         'data' => $studentsResource,
    //         'success' => true,
    //         'message' => 'Thêm sinh viên thành công',
    //     ]);
    // }
    {
        $Input = $request->all();
        $request->validate([
            'email' => 'required|Email|unique:users',
            'password' => 'required|min:6',
            'id_course' => 'required',
            'id_class' => 'required',
            'id_major' => 'required',
            'mssv' => 'required|unique:students',
            'name' => 'required',
            'phone' => 'required|min:10|alpha_num',
            'gender' => 'required',
        ]);

        $userStore = User::create([
            'email' => $Input['email'],
            'password' => Hash::make($Input['password']),
            'role' => $Input['role'],
        ]);
        // dd($userStore->id);
        if ($userStore->id) {
            Students::create(
                [
                    'id_user' => $userStore->id,
                    'id_course' => $request->id_course,
                    'id_class' => $request->id_class,
                    'id_major' => $request->id_major,
                    'mssv' => mb_strtoupper($request->mssv),
                    'name' => mb_convert_case($request->name, MB_CASE_TITLE, "UTF-8"),
                    'phone' => $request->phone,
                    'gender' => $request->gender,
                ]
            );
        }
        return redirect()->back()->with('msg', 'Thêm sinh viên thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        // $student =  Students::find($id);
        $student = Students::where('id_user', $id)->first();
        if ($student) {
            $studentsResource = new StudentsResource($student);

            return response()->json([
                'data' => $studentsResource,
                'status' => true,
                'message' => 'Get data success'
            ]);
        } else {
            return response()->json([
                'data' => '',
                'status' => false,
                'message' => 'id not found'
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $class = ClassModel::get();
        $course = Course::get();
        $majors = Majors::get();
        $student = Students::find($id);
        $user = User::find($student->id_user);
        return view('admin.pages.student.edit', compact('student', 'class', 'course', 'majors', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    // {
    //     $student =  Students::find($id);
    //     // dd($request->all());
    //     if ($student) {
    //         // $studentsResource = new Stu dentsResource($student);

    //         // $dataUpdate = $request->all();
    //         // dd($student);
    //         $validator = Validator::make($request->all(), [
    //             'id_course' => 'required',
    //             'id_class' => 'required',
    //             'id_major' => 'required',
    //             'mssv' => 'required|unique:students',
    //             'name' => 'required',
    //             // 'email' => 'required|Email|unique:students',
    //             // 'password' => 'required|min:6',
    //             'phone' => 'required|min:10|alpha_num',
    //             'gender' => 'required',
    //         ]);

    //         if ($validator->fails()) {
    //             $arr = [
    //                 'success' => false,
    //                 'message' => 'Lỗi kiểm tra dữ liệu',
    //                 'data' => $validator->errors()
    //             ];
    //             return response()->json($arr, 200);
    //         }

    //         $student->update(
    //             [

    //                 'id_course' => $request->id_course,
    //                 'id_class' => $request->id_class,
    //                 'id_major' => $request->id_major,
    //                 'mssv' => mb_strtoupper($request->mssv),
    //                 'name' => mb_convert_case($request->name, MB_CASE_TITLE, "UTF-8"),
    //                 'phone' => $request->phone,
    //                 'gender' => $request->gender,
    //             ]
    //         );

    //         $studentsResource = new StudentsResource($student);

    //         return response()->json([
    //             'data' => $studentsResource,
    //             'status' => true,
    //             'message' => 'Update data cucess'
    //         ]);
    //     } else {
    //         return response()->json([
    //             'data' => '',
    //             'status' => false,
    //             'message' => 'id not found'
    //         ]);
    //     }
    // }
    {
        $student = Students::find($id);
        if ($student) {
            $user = User::find($student->id_user);
            $Input = $request->all();
            $request->validate([
                'email' => 'required|Email|unique:users,email,' . $user->id,
                'password' => 'required|min:6',
                'id_course' => 'required',
                'id_class' => 'required',
                'id_major' => 'required',
                'mssv' => 'required|unique:students,mssv,' . $id,
                'name' => 'required',
                'phone' => 'required|min:10|alpha_num',
                'gender' => 'required',
            ]);

            $user->update([
                'email' => $Input['email'],
                'password' => Hash::make($Input['password']),
                'role' => $Input['role'],
            ]);

            $student->update(
                [
                    // 'id_user' => $userStore->id,
                    'id_course' => $request->id_course,
                    'id_class' => $request->id_class,
                    'id_major' => $request->id_major,
                    'mssv' => mb_strtoupper($request->mssv),
                    'name' => mb_convert_case($request->name, MB_CASE_TITLE, "UTF-8"),
                    'phone' => $request->phone,
                    'gender' => $request->gender,
                ]
            );
            return redirect()->back()->with('msg', 'Cập nhật sinh viên thành công');
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // dd($id);
        $student = Students::find($id);
        if ($student) {
            $idUer = $student->id_user;
            $user = User::find($idUer);
            $student->delete();
            $user->delete();
            return redirect()->back()->with('msg', 'Xóa sinh viên thành công');
        } else {
            return redirect()->back()->with('msg', 'Sinh viên không tồn tại !');
        }
    }
}
