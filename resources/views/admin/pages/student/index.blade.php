@extends('admin.layout.adminLayout');

@section('contentPanel')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12">
              <div class="content-block">
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Mã sinh viên</th>
                        <th scope="col">Tên sinh viên</th>
                        <th scope="col">Số điện thoại</th>
                        <th scope="col">Giới tính</th>
                        <th scope="col">Khóa học</th>
                        <th scope="col">Lớp</th>
                        <th scope="col">Chuyên ngành</th>
                        <th scope="col" colspan="2" style="text-align: center">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($listStudent as $key => $student)
                            <tr>
                                <th scope="row">{{$key}}</th>
                                <td>{{$student->mssv}}</td>
                                <td>{{$student->name}}</td>
                                <td>{{$student->phone}}</td>
                                <td>{{$student->gender}}</td>
                                <td>{{$student->course->name_id}}</td>
                                <td>{{$student->class->name_id}}</td>
                                <td>{{$student->majors->name_major}}</td>
                                <td style="text-align: center"><a href="{{route('student.edit', [$student->id])}}">Sửa</a></td>
                                <td style="text-align: center; font-size: 20px">
                                    <form class="form-tbl-mn" action="{{route('student.destroy', [$student->id])}}" method="POST">
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
                {{$listStudent->links()}}
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
