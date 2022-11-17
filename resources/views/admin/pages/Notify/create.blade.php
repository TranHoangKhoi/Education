@extends('admin.layout.adminLayout');

@section('contentPanel')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12">
              <div class="heading-block">
                <div class="heading-title">
                    <h3>Thêm mới thông báo</h3>
                </div>
              </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
              <div class="content-block">
                    <form action="{{route('notify.store')}}" method="POST">
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
                        <label for="nameST">Tiêu đề thông báo</label>
                        <input id="nameST" required class="form-control" type="text" value="{{old('name')}}" name="title"  placeholder="Tiêu đề cho thông báo">
                        @error('name')
                            <span class="messError">{{$message}}</span>
                        @enderror

                      </div>
                      <div class="form-group">
                        <label for="id_cate">Loại thông báo</label>
                        <select name="id_cate" required id="id_cate" class="form-control">
                          <option value="">Chọn loại thông báo</option>
                          @foreach ($notifyCate as $Cate)
                            <option  value="{{$Cate->id}}">{{$Cate->name_cate}}</option>
                          @endforeach
                        </select>
                        @error('id_class')
                            <span class="messError">{{$message}}</span>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="exampleTextarea1">Nội dung thông báo</label>
                        <textarea id="exampleTextarea1" name="content" cols="80" rows="10" class="form-control ckeditor"></textarea>

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
