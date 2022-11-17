@extends('admin.layout.adminLayout');

@section('contentPanel')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12">
              <div class="heading-block">
                <div class="heading-title">
                    <h3>Thêm mới ngành học</h3>
                </div>
              </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
              <div class="content-block">
                    <form action="{{route('majors.store')}}" method="POST">
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
                        <label for="nameST">Mã ngành học</label>
                        <input id="nameST" required class="form-control" type="text" value="{{old('name_id')}}" name="name_id"  placeholder="Mã cho ngành học">
                        @error('name_id')
                            <span class="messError">{{$message}}</span>
                        @enderror

                      </div>
                      <div class="form-group">
                        <label for="nameST">Tên ngành học</label>
                        <input id="nameST" required class="form-control" type="text" value="{{old('name_major')}}" name="name_major"  placeholder="Tên cho ngành học">
                        @error('name_major')
                            <span class="messError">{{$message}}</span>
                        @enderror

                      </div>
                      <div class="form-group">
                        <label for="id_field">Loại lĩnh vực</label>
                        <select name="id_field" required id="id_field" class="form-control">
                          <option value="">Chọn lĩnh vực của ngành học</option>
                          @foreach ($field as $listField)
                            <option  value="{{$listField->id}}">{{$listField->field_type}}</option>
                          @endforeach
                        </select>
                        @error('id_class')
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
