<?php

namespace App\Http\Controllers;

use App\Http\Resources\MajorsResource;
use App\Models\Majors;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MajorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $input = $request->all();
        $input['limit'] = $request->limit;
        try{
            $data = Majors::where(function($query) use($input) {
                if(!empty($input['name_id'])){
                    $query->where('name_id', 'like', '%'.$input['name_id'].'%');
                }
                if(!empty($input['name_major'])){
                    $query->where('name_major', 'like', '%'.$input['name_major'].'%');
                }

            })->orderBy('created_at', 'desc')->paginate(!empty($input['limit']) ? $input['limit'] : 10);
            $resource= MajorsResource::collection($data);
        }
        catch(Exception $e){
            return response()->json([
                       'status' => 'Error',
                       'message' => $e->getMessage()
                             ],400);
        }
        return response()->json([
                'data' => $resource,
                'success' => true,
                'message' => 'Lấy dữ liệu thành công',
            ],200);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'id_field' => 'required',
            'name_id' => 'required|max:255|unique:majors',
            'name_major' => 'required|max:255|unique:majors',
        ];

        try {
            DB::beginTransaction();
            $validator = Validator::make($request->all(), $rules,);
            if($validator->fails()){
                return response()->json([
                    'status' => 'error',
                    'message' => $validator->errors(),
                ], 422);
            }
            if($validator->fails()){
                return response()->json([
                    'status' => 'error',
                    'message' => $validator->errors(),
                ], 422);
            }

            $data = Majors::create([
                'id_field'=> $request->id_field,
                'name_id' => mb_strtoupper($request->name_id),
                'name_major'=>mb_strtoupper(mb_substr($request->name_major, 0, 1)).mb_substr($request->name_major, 1)
            ]);
            DB::commit();
        } catch(Exception $e) {
            DB::rollback();
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 400);

        }
        return response()->json([
            'data' => new MajorsResource($data),
            'status' => 'success',
            'message' =>'Ngành '. $data->name_major . ' đã được tạo thành công !',
        ]);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Majors  $Majors
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            $data = Majors::find($id);

            if(empty($data)){
                return response()->json([
                    'status' => 'error',
                    'message' => 'Ngành này không tồn tại, vui lòng kiểm tra lại'

                ],400);
            }

            return response()->json([
                'data' => new MajorsResource($data),
            ],200);

        } catch(Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Majors  $Majors
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'name_id' => 'required|max:255',
            'id_field' => 'required',
            'name_major' => 'required|max:255'
        ];
        try {
            $validator = Validator::make($request->all(), $rules,);
            if($validator->fails()){
                return response()->json([
                    'status' => 'error',
                    'message' => $validator->errors(),
                ], 422);
            }
            $data = Majors::find($id);
            if(!empty($data)){
                 $data->update([
                    'id_field'=> $request->id_field,
                    'name_id' => mb_strtoupper($request->name_id),
                    'name_major'=>mb_strtoupper(mb_substr($request->name_major, 0, 1)).mb_substr($request->name_major, 1)
                ]);
            }



        } catch(Exception $e) {
            DB::rollback();
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 400);

        }
        return response()->json([
            'status' => 'success',
            'message' =>'Ngành học đã được cập nhật !',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Majors  $Majors
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Majors::find($id);
        if($data) {
            $data->delete();
            return response()->json([
                'data' => [],
                'status' => true,
                'message' => 'Đã xóa '
            ], 200);
        } else {
            return response()->json([
                'data' => [],
                'status' => false,
                'message' => 'id not found'
            ]);
        }
    }
}
