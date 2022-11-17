@extends('admin.layout.adminLayout');

@section('contentPanel')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12">
              <div class="content-block">
                    <form action="{{route('student.store')}}" method="POST">
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
                        <label for="nameST">Họ và tên</label>
                        <input id="nameST" required class="form-control" type="text" value="{{old('title')}}" name="name"  placeholder="Trần Văn A">
                        @error('name')
                            <span class="messError">{{$message}}</span>
                        @enderror

                      </div>
                      <div class="form-group">
                        <label for="mssv">MSSV</label>
                        <input id="mssv" required class="form-control" type="text" value="{{old('mssv')}}" name="mssv" placeholder="PC02042">
                        @error('mssv')
                          <span class="messError">{{$message}}</span>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="email">Email</label>
                        <input id="email" required class="form-control" type="email" value="{{old('email')}}" name="email" placeholder="atv@fpt.gmail.com">
                        @error('email')
                            <span class="messError">{{$message}}</span>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="password">Mật khẩu</label>
                        <input id="password" required class="form-control" type="password" name="password">
                        @error('password')
                            <span class="messError">{{$message}}</span>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="phone">Số điện thoại</label>
                        <input id="phone" required class="form-control" value="{{old('phone')}}" type="number" name="phone">
                        @error('phone')
                            <span class="messError">{{$message}}</span>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="id_class">Lớp học</label>
                        <select name="id_class" required id="id_class" class="form-control">
                          <option value="">Chọn lớp học</option>
                          @foreach ($class as $classItem)
                            <option  value="{{$classItem->id}}">{{$classItem->name_id}}</option>
                          @endforeach
                        </select>
                        @error('id_class')
                            <span class="messError">{{$message}}</span>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="id_major">Chuyên nghành</label>
                        <select name="id_major" required id="id_major" class="form-control">
                          <option value="">Chọn chuyên nghành</option>
                          @foreach ($majors as $majorsItem)
                            <option value="{{$majorsItem->id}}">{{$majorsItem->name_major}}</option>
                          @endforeach
                        </select>
                        @error('id_major')
                            <span class="messError">{{$message}}</span>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="id_course">Khóa học</label>
                        <select name="id_course" required id="id_course" class="form-control">
                          <option value="">Chọn khóa học</option>
                          @foreach ($course as $courseItem)
                            <option value="{{$courseItem->id}}">{{$courseItem->name_id}}</option>
                          @endforeach
                        </select>
                        @error('id_course')
                            <span class="messError">{{$message}}</span>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="gender">Giới tính</label>
                        <select name="gender" required id="gender" class="form-control">
                          <option value="Male">Male</option>
                          <option value="Female">Female</option>
                        </select>
                      </div>
                      <input type="text" hidden name="role" value="0">

                      <div class="form-group-btn">
                        <button class="btn btn-secondary btn-form">Thêm sinh viên</button>
                      </div>
                    </form>
              </div>
            </div>
          </div>
    </div>
@endsection
