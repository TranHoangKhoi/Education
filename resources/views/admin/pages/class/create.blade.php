@extends('admin.layout.adminLayout');

@section('contentPanel')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12">
              <div class="heading-block">
                <div class="heading-title">
                    <h3>Thêm mới lớp</h3>
                </div>
              </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
              <div class="content-block">
                    <form action="{{route('class.store')}}" method="POST">
                      @csrf()
                      {{-- @if ($messes)
                        <div class="alert alert-success" role="alert">
                          A simple success alert—check it out!
                        </div>
                      @endif --}}

                      @if($errors->any())
                        <div class="alert alert-danger" role="alert">
                          Kiểm tra lại dữ liệu !!
                        </div>
                      @elseif (Session::has('msg'))
                        <div class="alert alert-success" role="alert">
                            {{ Session::get('msg') }}
                            {{-- @php --}}
                                {{ Session::forget('msg') }}
                            {{-- @endphp --}}
                        </div>
                      @endif
                      <div class="form-group">
                        <label for="nameST">Tên lớp</label>
                        <input id="nameST" required class="form-control" type="text" value="{{old('name_id')}}" name="name_id"  placeholder="Tên lớp học">
                        @error('name_id')
                            <span class="messError">{{$message}}</span>
                        @enderror

                      </div>
                      <div class="form-group">
                        <label for="id_course">Khóa học</label>
                        <select name="id_course" required id="id_course" class="form-control">
                          <option value="">Chọn khóa học</option>
                          @foreach ($course as $listCourse)
                            <option  value="{{$listCourse->id}}">{{$listCourse->name_id}}</option>
                          @endforeach
                        </select>
                        @error('id_course')
                            <span class="messError">{{$message}}</span>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="id_major">Loại ngành học</label>
                        <select name="id_major" required id="id_major" class="form-control">
                          <option value="">Chọn ngành học</option>
                          @foreach ($majors as $listMajors)
                            <option  value="{{$listMajors->id}}">{{$listMajors->name_major}}</option>
                          @endforeach
                        </select>
                        @error('id_major')
                            <span class="messError">{{$message}}</span>
                        @enderror
                      </div>
                      <div class="form-group-btn">
                        <button class="btn btn-secondary btn-form">Thêm thông báo</button>
                      </div>
                    </form>
              </div>
            </div>
          </div>
    </div>

@endsection
