<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\User;
use App\Http\Resources\AdminResource;
use Exception;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{
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
    //         $data  =  Admin::select(
    //             'admin.id',
    //             'admin.name',
    //             'admin.name_id',
    //             'admin.id_user',
    //             'admin.phone',
    //             'admin.address'
    //         )
    //             ->join('users', 'admin.id_user', '=', 'users.id')
    //             ->where(function ($query) use ($input) {
    //                 //Lọc theo  Email
    //                 if (!empty($input['email'])) {
    //                     $query->where('users.email', 'like', '%' . $input['email'] . '%');
    //                 }
    //                 //lọc theo tên
    //                 if (!empty($input['name'])) {
    //                     $query->where('name', 'like', '%' . $input['name'] . '%');
    //                 }
    //                 //lọc theo mã số sinh viên
    //                 if (!empty($input['nameID'])) {
    //                     $query->where('name_id', 'like', '%' . $input['nameID'] . '%');
    //                 }
    //                 //loc theo sdt
    //                 if (!empty($input['phone'])) {
    //                     $query->where('phone', $input['phone']);
    //                 }
    //                 //loc theo dia chi
    //                 if (!empty($input['address'])) {
    //                     $query->where('address', '%' . $input['address'] . '%');
    //                 }
    //             })->orderBy('admin.id', 'desc')->paginate(!empty($input['limit']) ? $input['limit'] : 10);
    //         //    $resource = NotifyResource::collection($data)->response()->getdata(true);
    //         $resource =  AdminResource::collection($data);
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
        $listAdmin = Admin::with('user')->orderBy('id_user', 'desc')->paginate(10);
        return view('admin.pages.admin.index', compact('listAdmin'));
    }

    public function create()
    {
        return view('admin.pages.admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    // {
    //     if (Auth::check()) {
    //         $user = Auth::user();
    //         if ($user->role == 2) {
    //             $admin = Admin::where('id_user', $user->id)->first();
    //             if ($admin->role == 1) {
    //                 // 
    //                 $validator = Validator::make($request->all(), [
    //                     'id_user' => 'required|unique:admin',
    //                     'name' => 'required',
    //                     'name_id' => 'required|unique:admin',
    //                     'phone' => 'required',
    //                     'address' => 'required',
    //                 ]);

    //                 if ($validator->fails()) {
    //                     $arr = [
    //                         'success' => false,
    //                         'message' => 'Lỗi kiểm tra dữ liệu',
    //                         'data' => $validator->errors()
    //                     ];
    //                     return response()->json($arr, 200);
    //                 }

    //                 $admin = Admin::create(
    //                     [
    //                         'id_user' => $request->id_user,
    //                         'name_id' => mb_strtoupper($request->name_id),
    //                         'name' => mb_convert_case($request->name, MB_CASE_TITLE, "UTF-8"),
    //                         'phone' => $request->phone,
    //                         'address' =>  mb_convert_case($request->address, MB_CASE_TITLE, "UTF-8"),
    //                         'role' => $request->role,
    //                     ]
    //                 );

    //                 $adminResource = new AdminResource($admin);

    //                 return response()->json([
    //                     'data' => $adminResource,
    //                     'success' => true,
    //                     'message' => 'Thêm admin thành công',
    //                 ]);
    //             }
    //         }
    //     }
    //     return response()->json([
    //         'data' => 'Đường dẫn không tồn tại',
    //     ], 404);
    // }
    {
        $Input = $request->all();
        $request->validate([
            'email' => 'required|Email|unique:users',
            'password' => 'required|min:6',
            'name_id' => 'required|unique:admin',
            'name' => 'required',
            'phone' => 'required|min:10|alpha_num',
            'address' => 'required',
        ]);

        $userStore = User::create([
            'email' => $Input['email'],
            'password' => Hash::make($Input['password']),
            'role' => $Input['role'],
        ]);
        // dd($userStore->id);
        if ($userStore->id) {
            Admin::create(
                [
                    'id_user' => $userStore->id,
                    'name_id' => mb_strtoupper($request->name_id),
                    'name' => mb_convert_case($request->name, MB_CASE_TITLE, "UTF-8"),
                    'phone' => $request->phone,
                    'address' => $request->address,
                ]
            );
        }
        return redirect()->back()->with('msg', 'Thêm giảng viên thành công');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $admin =  Admin::where('id_user', $id)->first();
        if ($admin) {
            $adminResource = new AdminResource($admin);

            return response()->json([
                'data' => $adminResource,
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
        $admin = Admin::find($id);
        return view('admin.pages.admin.edit', compact('admin'));
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
    //     if (Auth::check()) {
    //         $user = Auth::user();
    //         if ($user->role == 2) {
    //             $admin = Admin::where('id_user', $user->id)->first();
    //             if ($admin->role == 1) {
    //                 $admin =  Admin::where('id_user', $id)->first();
    //                 if ($admin) {
    //                     // $studentsResource = new Stu dentsResource($student);

    //                     $dataUpdate = $request->all();
    //                     // dd($admin->id);

    //                     $validator = Validator::make($dataUpdate, [
    //                         'id_user' => 'required|unique:admin,id_user,' . $admin->id,
    //                         // 'email' => 'required|Email|unique:students,email,'.$id,

    //                         'name' => 'required',
    //                         'name_id' => 'required',
    //                         'phone' => 'required',
    //                         'address' => 'required',
    //                     ]);

    //                     if ($validator->fails()) {
    //                         $arr = [
    //                             'success' => false,
    //                             'message' => 'Lỗi kiểm tra dữ liệu',
    //                             'data' => $validator->errors()
    //                         ];
    //                         return response()->json($arr, 200);
    //                     }

    //                     $admin->update();

    //                     $adminResource = new AdminResource($admin);

    //                     return response()->json([
    //                         'data' => $adminResource,
    //                         'status' => true,
    //                         'message' => 'Update data cucess'
    //                     ]);
    //                 } else {
    //                     return response()->json([
    //                         'data' => '',
    //                         'status' => false,
    //                         'message' => 'id not found'
    //                     ]);
    //                 }
    //             }
    //         }
    //     }
    //     return response()->json([
    //         'data' => 'Đường dẫn không tồn tại',
    //     ], 404);
    // }
    {
        $admin = Admin::find($id);
        if ($admin) {
            $user = User::find($admin->id_user);
            $Input = $request->all();
            $request->validate([
                'email' => 'required|Email|unique:users,email,' . $user->id,
                'password' => 'required|min:6',
                'name_id' => 'required|unique:admin',
                'name' => 'required',
                'phone' => 'required|min:10|alpha_num',
                'address' => 'required',
            ]);

            $user->update([
                'email' => $Input['email'],
                'password' => Hash::make($Input['password']),
                'role' => $Input['role'],
            ]);

            $admin->update(
                [
                    // 'id_user' => $userStore->id,
                    'name_id' => mb_strtoupper($request->name_id),
                    'name' => mb_convert_case($request->name, MB_CASE_TITLE, "UTF-8"),
                    'phone' => $request->phone,
                    'address' => $request->address,
                ]
            );
            return redirect()->back()->with('msg', 'Cập nhật quản trị viên thành công');
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    // { {
    //         if (Auth::check()) {
    //             $user = Auth::user();
    //             if ($user->role == 2) {
    //                 $admin = Admin::where('id_user', $user->id)->first();
    //                 if ($admin->role == 1) {
    //                     $admin =  Admin::where('id_user', $id)->first();
    //                     if ($admin) {
    //                         $admin->delete();
    //                         return response()->json([
    //                             'data' => [],
    //                             'status' => true,
    //                             'message' => 'Đã xóa sinh viên'
    //                         ], 200);
    //                     } else {
    //                         return response()->json([
    //                             'data' => [],
    //                             'status' => false,
    //                             'message' => 'id not found'
    //                         ]);
    //                     }
    //                 }
    //             }
    //         }
    //         return response()->json([
    //             'data' => 'Đường dẫn không tồn tại',
    //         ], 404);
    //     }
    // }
    {
        $admin = Admin::find($id);
        if ($admin) {
            $idUer = $admin->id_user;
            $user = User::find($idUer);
            $admin->delete();
            $user->delete();
            return redirect()->back()->with('msg', 'Xóa quản trị viên thành công');
        } else {
            return redirect()->back()->with('msg', 'Quản trị viên không tồn tại !');
        }
    }
}
