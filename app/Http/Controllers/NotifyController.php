<?php

namespace App\Http\Controllers;

use App\Http\Resources\NotifyResource;
use App\Models\NotificationCate;
use App\Models\Notify;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class NotifyController extends Controller
{
    // protected $notify;

    // public function __construct(Notify $notify) {
    //     $this->notify = $notify;
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $listNotify = Notify::get();

        // dd($listCate);
        return view('admin.pages.Notify.listNotify', compact('listNotify'));
    //     $input = $request->all();
    //     $input['limit'] = $request->limit;
    //    try {
    //         $data  =  Notify::select('notify.id','notify.id_cate','notify.title','notify.content','notify.created_at','notify.updated_at')
    //         ->join('notification_categories','notify.id_cate','=','notification_categories.id')
    //         ->where(function($query) use($input) {
    //                 if(!empty($input['title'])){
    //                     $query->where('title', 'like', '%'.$input['title'].'%');
    //                  }
    //                  if(!empty($input['nameCate'])){
    //                     $query->where('notification_categories.name_cate', 'like', '%'.$input['nameCate'].'%');
    //                  }

    //        })->orderBy('notify.created_at', 'desc')->paginate(!empty($input['limit']) ? $input['limit'] : 10);
    //     //    $resource = NotifyResource::collection($data)->response()->getdata(true);
    //        $resource =  NotifyResource::collection($data);
    //    } catch (Exception $e) {
    //         return response()->json([
    //             'status' => 'Error',
    //         'message' => $e->getMessage()
    //      ],400);
    //    }
    //    return response()->json([
    //             'data' => $resource,
    //             'success' => true,
    //             'message' => 'Lấy dữ liệu thành công',
    //     ],200);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $rules = [
        //     'title' => 'required|max:255',
        //     'content'=>'required',
        //     'id_cate'=>'required',
        // ];
        // try {
        //     DB::beginTransaction();
        //     $validator = Validator::make($request->all(), $rules,);
        //     if($validator->fails()){
        //         return response()->json([
        //             'status' => 'error',
        //             'message' => $validator->errors(),
        //         ], 422);
        //     }
        //     $data = Notify::create([
        //         'title' => mb_strtolower($request->title),
        //         'id_cate' => $request -> id_cate,
        //         'content' => $request -> content,
        //         // 'slug' => Str::slug($request->title)

        //     ]);
        //     DB::commit();
        // } catch(Exception $e) {
        //     DB::rollback();
        //     return response()->json([
        //         'status' => 'error',
        //         'message' => $e->getMessage(),
        //     ], 400);

        // }
        // return response()->json([
        //     'data'=>$data,
        //     'status' => 'success',
        //     'message' =>'Thông báo '. $data->title . ' đã được tạo thành công !',
        // ]);
        {
            $Input = $request->all();
            $request->validate([
                'title' => 'required',
                'content' => 'required',
                'id_cate' => 'required',

            ]);


            // dd($userStore->id);

                Notify::create(
                    [

                        'id_cate' => $request->id_cate,
                        'title' => mb_strtoupper($request->title),
                        'content' => $request->content,
                    ]
                );

            return redirect()->back()->with('msg', 'Thêm thông báo thành công');
        }



    }
    public function edit($id)
    {
        $notifyCate = NotificationCate::get();
        $notify = Notify::find($id);
        return view('admin.pages.Notify.edit', compact('notifyCate','notify'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Notify  $notify
     * @return \Illuminate\Http\Response
     */

        public function show($id)
        {
            try{
                $data = Notify::find($id);
                if(empty($data)){

                    return response()->json([
                        'status' => 'error',
                        'message' => 'Thông báo này không tồn tại, vui lòng kiểm tra lại'

                    ],400);
                }
                $notifyResource = new NotifyResource($data);

                return response()->json([
                    'data' => $notifyResource,
                ],200);

            } catch(Exception $e){
                return response()->json([
                    'status' => 'error',
                    'message' => $e->getMessage(),
                ], 400);
            }
        }

        public function create()
        {
            $notifyCate = NotificationCate::get();

            return view('admin.pages.Notify.create', compact('notifyCate',));
        }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Notify  $notify
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $rules = [
        //      'title' => 'required|max:255',
        //      'content'=>'required',
        //      'id_cate'=>'required',

        // ];
        // try {
        //     $validator = Validator::make($request->all(), $rules,);
        //     if($validator->fails()){
        //         return response()->json([
        //             'status' => 'error',
        //             'message' => $validator->errors(),
        //         ], 422);
        //     }
        //     $data = Notify::find($id);
        //     if(!empty($data)){
        //          $data->update([
        //             'id_cate'=>$request->id_cate,
        //             'title' => mb_strtolower($request->title),
        //             'content'=>$request->content,
        //         ]);
        //     }
        // } catch(Exception $e) {
        //     DB::rollback();
        //     return response()->json([
        //         'status' => 'error',
        //         'message' => $e->getMessage(),
        //     ], 400);

        // }
        // return response()->json([
        //     'status' => 'success',
        //     'message' =>'Thông báo đã được cập nhật !',
        // ]);
        $notify = Notify::find($id);
        if ($notify) {
            $Input = $request->all();
                $request->validate([
                    'title' => 'required',
                    'content' => 'required',
                    'id_cate' => 'required',
            ]);


            $notify->update(
                [
                    // 'id_user' => $userStore->id,
                        'id_cate' => $request->id_cate,
                        'title' => mb_strtoupper($request->title),
                        'content' => $request->content,
                ]
            );
            return redirect()->back()->with('msg', 'Cập nhật sinh viên thành công');
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Notify  $notify
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $data = Notify::find($id);
        // if($subject) {
        //     $data->delete();
        //     return response()->json([
        //         'data' => [],
        //         'status' => true,
        //         'message' => 'Đã xóa thông báo này'
        //     ], 200);
        // } else {
        //     return response()->json([
        //         'data' => [],
        //         'status' => false,
        //         'message' => 'Thông báo không tồn tại'
        //     ]);
        // }

        $notify = Notify::find($id);
        $notify ->delete();
        return redirect()->back()->with('msg', 'Xóa thành công');
    }
    // public function search($name){
    //     $data = Notify::where("title","like","%".$name."%")
    //                     // ->orWhere("id")
    //                     ->get();
    //     // $dataResource = new NotifyResource($data);
    //      return response()->json([
    //         //  'data'=>$dataResource,
    //         'data'=>$data,

    //      ]);
    //  }
}
