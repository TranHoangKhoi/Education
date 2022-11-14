@extends('admin.layout.adminLayout');

@section('contentPanel')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12">
              <div class="heading-block">
                <div class="heading-title">
                    <h3>Danh sách giảng viên</h3>
                </div>
              </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
              <div class="content-block">
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Mã giảng viên</th>
                        <th scope="col">Tên giảng viên</th>
                        <th scope="col">Email</th>
                        <th scope="col">Số điện thoại</th>
                        <th scope="col">Giới tính</th>
                        <th scope="col">Địa chỉ</th>
                        <th scope="col" colspan="2" style="text-align: center">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($listLecturers as $key => $lecturers)    
                            <tr>
                                <th scope="row">{{$key}}</th>
                                <td>{{$lecturers->name_id}}</td>
                                <td>{{$lecturers->name}}</td>
                                <td>{{$lecturers->user->email}}</td>
                                <td>{{$lecturers->phone}}</td>
                                <td>{{$lecturers->gender}}</td>
                                <td>{{$lecturers->address}}</td>
                                <td style="text-align: center"><a href="{{route('lecturers.edit', [$lecturers->id])}}">Sửa</a></td>
                                <td style="text-align: center; font-size: 20px">
                                    <form class="form-tbl-mn" action="{{route('lecturers.destroy', [$lecturers->id])}}" method="POST">
                                        @csrf()
                                        @method('DELETE')
                                        <button class="btn-tbl">
                                            <i class="mdi mdi-delete"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                            
                    </tbody>
                </table>
                {{$listLecturers->links()}}
              </div>
                @if (Session::has('msg'))
                        <div class="alert alert-success" role="alert">
                            {{ Session::get('msg') }}
                            {{-- @php --}}
                                {{ Session::forget('msg') }}  
                            {{-- @endphp --}}
                        </div>
                @endif
            </div>
          </div>
    </div>
@endsection