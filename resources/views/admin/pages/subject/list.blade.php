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
                        <th scope="col">Mã môn học</th>
                        <th scope="col">Tên môn học</th>
                        <th scope="col">Kỳ của môn học</th>
                        <th scope="col">Lớp học</th>
                        <th scope="col">Ngành học của môn học</th>
                        {{-- <th scope="col">Loại của môn học</th> --}}
                        <th scope="col">Tín chỉ</th>
                        <th scope="col" colspan="2" style="text-align: center">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($listSubject as $key => $subject)
                            <tr>
                                <th scope="row">{{$key}}</th>
                                <td>{{$subject->name_id_subject}}</td>
                                <td>{{$subject->name}}</td>
                                <td>{{$subject->semester->name_id}}</td>
                                <td>{{$subject->classData->name_id}}</td>
                                <td>{{$subject->majors->name_major}}</td>
                                <td>{{$subject->credit}}</td>
                                <td style="text-align: center"><a href="{{route('subject.edit', [$subject->id])}}">Sửa</a></td>
                                <td style="text-align: center; font-size: 20px">
                                    <form class="form-tbl-mn" action="{{route('subject.destroy', [$subject->id])}}" method="POST">
                                        @csrf()
                                        @method('DELETE')
                                        <button class="btn-tbl">
                                            <i class="mdi mdi-delete"></i>
                                        </button>
                                    </form>
                                </td>
                                {{-- <td style="text-align: center"><a href="{{route('catenotification.show', [$cateItem->id])}}">Sửa</a></td> --}}
                                {{-- <td style="text-align: center; font-size: 20px">
                                    <form class="form-tbl-mn" action="{{route('catenotification.destroy', [$cateItem->id])}}" method="POST">
                                        <button class="btn-tbl">
                                            <i class="mdi mdi-delete"></i>
                                        </button>
                                    </form>
                                </td> --}}
                            </tr>
                        @endforeach

                    </tbody>
                </table>
              </div>
            </div>
          </div>
    </div>
@endsection
