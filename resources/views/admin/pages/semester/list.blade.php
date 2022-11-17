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
                        {{-- <th scope="col">Mã danh mục</th> --}}
                        <th scope="col">Tiêu đ</th>
                        <th scope="col">Loại thông báo</th>
                        <th scope="col" colspan="2" style="text-align: center">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($listNotify as $key => $semester)
                            <tr>
                                <th scope="row">{{$key}}</th>
                                <td>{{$semester->title}}</td>
                                <td style="text-align: center"><a href="{{route('semester.edit', [$semester->id])}}">Sửa</a></td>
                                <td style="text-align: center; font-size: 20px">
                                    <form class="form-tbl-mn" action="{{route('semester.destroy', [$semester->id])}}" method="POST">
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
