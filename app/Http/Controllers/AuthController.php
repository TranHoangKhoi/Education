<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Students;
use App\Models\Lecturers;
use App\Models\Admin;

use App\Http\Resources\StudentsResource;
use App\Http\Resources\LecturersResource;
use App\Http\Resources\AdminResource;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'role' => $request->role])) {
            if ($request->role == 0) {
                return redirect()->route('studentHome');
            } elseif ($request->role == 1) {
                return redirect()->route('scoreup');
            } elseif ($request->role == 2) {
                return redirect()->route('admin.dashboard');
            }
        } else {
            echo 'đăng nhập không thành công';
        }
        // $user = User::where('email', $request->email)->first();

        // if (!$user || !Hash::check($request->password, $user->password, [])) {
        //     $arr = [
        //         'success' => false,
        //         'message' => 'Email hoặc mật khẩu không đúng',
        //         'data' => []
        //     ];
        //     return response()->json($arr, 404);
        // }

        // $token = $user->createToken('authToken')->plainTextToken;

        // return response()->json([
        //     'data' => $user,
        //     'access_token' => $token,
        //     'type_token' => 'Bearer'
        // ], 200);
    }

    public function register(Request $request)
    {
        $messages = [
            'email.required' => 'Email không được bỏ trống',
            'email.email' => 'Email không đúng định dạng',
            'email.unique' => 'Email đã tồn tại trong hệ thống',
            'password.required' => 'Mật khẩu không được bỏ trống',
            'password.min' => 'Mật khẩu phải nhiều hơn :min ký tự',
        ];

        $dataCreate = $request->all();
        $validator = Validator::make($dataCreate, [
            'email' => 'required|Email|unique:users',
            'password' => 'required|min:6',
        ], $messages);

        if ($validator->fails()) {
            $arr = [
                'success' => false,
                'message' => 'Lỗi kiểm tra dữ liệu',
                'data' => $validator->errors()
            ];
            return response()->json($arr, 200);
        }

        // Check Role
        if ($dataCreate['role'] == 0) {
            $validator = Validator::make($dataCreate, [
                'id_course' => 'required',
                'id_class' => 'required',
                'id_major' => 'required',
                'mssv' => 'required|unique:students',
                'name' => 'required',
                // 'id_user' => 'required',
                // 'email' => 'required|Email|unique:students',
                // 'password' => 'required|min:6',
                'phone' => 'required|min:10|alpha_num',
                'gender' => 'required',
            ]);

            if ($validator->fails()) {
                $arr = [
                    'success' => false,
                    'message' => 'Lỗi kiểm tra dữ liệu',
                    'data' => $validator->errors()
                ];
                return response()->json($arr, 422);
            }

            // Create User
            $userRegister = User::create([
                'email' => $dataCreate['email'],
                'password' => Hash::make($dataCreate['password']),
                'role' => $dataCreate['role'],
            ]);

            if ($userRegister->id > 0) {
                $student = Students::create(
                    [
                        'id_user' => $userRegister->id,
                        'id_course' => $dataCreate['id_course'],
                        'id_class' => $dataCreate['id_class'],
                        'id_major' => $dataCreate['id_major'],
                        'mssv' => mb_strtoupper($dataCreate['mssv']),
                        'name' => mb_convert_case($dataCreate['name'], MB_CASE_TITLE, "UTF-8"),
                        'phone' => $dataCreate['phone'],
                        'gender' => $dataCreate['gender'],
                    ]
                );

                $studentsResource = new StudentsResource($student);

                return response()->json([
                    'data' => $studentsResource,
                    'success' => true,
                    'message' => 'Thêm sinh viên thành công',
                ]);
            }
        }

        // Role Lecturers
        if ($dataCreate['role'] == 1) {
            $validator = Validator::make($request->all(), [
                // 'id_user' => 'required',
                'name_id' => 'required|unique:lecturers',
                'name' => 'required',
                // 'email' => 'required|Email|unique:lecturers',
                // 'password' => 'required|min:6',
                'phone' => 'required|min:10',
                'address' => 'required',
                'gender' => 'required',
            ]);

            if ($validator->fails()) {
                $arr = [
                    'success' => false,
                    'message' => 'Lỗi kiểm tra dữ liệu',
                    'data' => $validator->errors()
                ];
                return response()->json($arr, 200);
            }

            // Create User
            $userRegister = User::create([
                'email' => $dataCreate['email'],
                'password' => Hash::make($dataCreate['password']),
                'role' => $dataCreate['role'],
            ]);

            if ($userRegister->id > 0) {
                $lecturers = Lecturers::create(
                    [
                        'id_user' => $userRegister->id,
                        'name_id' => mb_strtoupper($request->name_id),
                        'name' => mb_convert_case($request->name, MB_CASE_TITLE, "UTF-8"),
                        'phone' => $request->phone,
                        'address' =>  mb_convert_case($request->address, MB_CASE_TITLE, "UTF-8"),
                        'gender' => $request->gender,
                    ]
                );

                $lecturersResource = new LecturersResource($lecturers);

                return response()->json([
                    'data' => $lecturersResource,
                    'success' => true,
                    'message' => 'Thêm giảng viên thành công',
                ]);
            }
        }

        // Role Admin
        if ($dataCreate['role'] == 2) {
            $validator = Validator::make($request->all(), [
                // 'id_user' => 'required|unique:admin',
                'name' => 'required',
                'name_id' => 'required|unique:admin',
                'phone' => 'required',
                'address' => 'required',
            ]);

            if ($validator->fails()) {
                $arr = [
                    'success' => false,
                    'message' => 'Lỗi kiểm tra dữ liệu',
                    'data' => $validator->errors()
                ];
                return response()->json($arr, 200);
            }

            $userRegister = User::create([
                'email' => $dataCreate['email'],
                'password' => Hash::make($dataCreate['password']),
                'role' => $dataCreate['role'],
            ]);

            if ($userRegister->id > 0) {
                $admin = Admin::create(
                    [
                        'id_user' => $userRegister->id,
                        'name_id' => mb_strtoupper($request->name_id),
                        'name' => mb_convert_case($request->name, MB_CASE_TITLE, "UTF-8"),
                        'phone' => $request->phone,
                        'address' =>  mb_convert_case($request->address, MB_CASE_TITLE, "UTF-8"),
                        'role' => $request->role_ad,
                    ]
                );

                $adminResource = new AdminResource($admin);

                return response()->json([
                    'data' => $adminResource,
                    'success' => true,
                    'message' => 'Thêm admin thành công',
                ]);
            }
        }

        return response()->json([
            'data' => 'Register Failed',
        ], 200);
    }

    public function user(Request $request)
    {
        $role = $request->user()->role;
        if ($role == 0) {
            $userDetails = Students::where('id_user', $request->user()->id)->first();
            // $userDetails = Students::with('majors')->where('id', $request->user()->id)->first();

            // $className = ClassModel::find($userDetails->id_class);
            // $userDetails->class;
            // $userDetails->user;
            // $userDetails->majors;
            // $userDetails->course;
            $userDetailsRs = new StudentsResource($userDetails);

            return response()->json([
                'data' => $userDetailsRs,
            ], 200);
        } else if ($role == 1) {
            $userDetails = Lecturers::with('user')->where('id_user',  $request->user()->id)->first();

            $userDetailsRs = new LecturersResource($userDetails);
            return response()->json([
                'data' => $userDetailsRs,
            ], 200);
        } else if ($role == 2) {
            $userDetails = Admin::with('user')->where('id_user',  $request->user()->id)->first();
            $userDetailsRs = new AdminResource($userDetails);

            return response()->json([
                'data' => $userDetailsRs,
            ], 200);
        };

        return response()->json([
            'data' => $request->user()->role,
        ], 200);
    }

    public function logOut()
    {
        Auth::logOut();
        return redirect()->route('auth.formLogin');
    }

    public function showFormLogin()
    {
        if (!Auth::check()) {
            return view("auth.login");
            // return redirect()->route('auth.formLogin');
        } else {
            return redirect()->back();
        }
    }
}
