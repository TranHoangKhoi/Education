@extends('admin.layout.adminLayout');

@section('contentPanel')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12">
              <div class="heading-block">
                <div class="heading-title">
                    <h3>Cập nhật thông tin quản trị viên</h3>
                </div>
              </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
              <div class="content-block">
                    <form action="{{route('admins.update', [$admin->id])}}" method="POST">
                        @method('PATCH')
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
                        <input id="nameST" required class="form-control" type="text" value="{{old('name') ?? $admin->name}}" name="name"  placeholder="Trần Văn A">
                        @error('name')
                            <span class="messError">{{$message}}</span>
                        @enderror

                      </div>
                      <div class="form-group">
                        <label for="name_id">MSQTV</label>
                        <input id="name_id" required class="form-control" type="text" value="{{old('name_id') ?? $admin->name_id}}" name="name_id" placeholder="PC02042">
                        @error('name_id')
                          <span class="messError">{{$message}}</span>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="email">Email</label>
                        <input id="email" required class="form-control" type="email" value="{{old('email')  ?? $admin->user->email}}" name="email" placeholder="atv@fpt.gmail.com">
                        @error('email')
                            <span class="messError">{{$message}}</span>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="password">Mật khẩu</label>
                        <input id="password" required class="form-control" value="{{old('password')  ?? $admin->user->password}}" type="password" name="password">
                        @error('password')
                            <span class="messError">{{$message}}</span>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="phone">Số điện thoại</label>
                        <input id="phone" required class="form-control" value="{{old('phone') ?? $admin->password}}" type="number" name="phone">
                        @error('phone')
                            <span class="messError">{{$message}}</span>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="address">Địa chỉ</label>
                        <input id="address" required class="form-control" value="{{old('address') ?? $admin->address}}" type="text" name="address">
                        @error('address')
                            <span class="messError">{{$message}}</span>
                        @enderror
                      </div>
                      <input type="text" hidden name="role" value="2">

                      <div class="form-group-btn">
                        <button class="btn btn-secondary btn-form">Thêm giảng viên</button>
                      </div>
                    </form>
              </div>
            </div>
          </div>
    </div>
@endsection