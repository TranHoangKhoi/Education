@extends('admin.layout.adminLayout');

@section('contentPanel')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12">
              <div class="heading-block">
                <div class="heading-title">
                    <h3>Cập nhật môn học</h3>
                </div>
              </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
              <div class="content-block">
                    <form action="{{route('subject.update',[$subject->id])}}" method="POST">
                      @csrf()
                      @method('PUT')
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
                        <label for="nameST">Mã môn học</label>
                        <input id="nameST" required class="form-control" type="text" value="{{old('name_id_subject') ?? $subject->name_id_subject}}" name="name_id_subject"  placeholder="Mã môn học">
                        @error('name_id_subject')
                            <span class="messError">{{$message}}</span>
                        @enderror

                      </div>
                      <div class="form-group">
                        <label for="nameST">Tên môn học</label>
                        <input id="nameST" required class="form-control" type="text" value="{{old('name') ?? $subject->name }}" name="name"  placeholder="Tên môn học">
                        @error('name')
                            <span class="messError">{{$message}}</span>
                        @enderror

                      </div>

                      <div class="form-group">
                        <label for="nameST">Tín chỉ</label>
                        <input id="nameST" required class="form-control" type="text" value="{{old('credit') ?? $subject->credit}}" name="credit"  placeholder="Tín chỉ môn học">
                        @error('credit')
                            <span class="messError">{{$message}}</span>
                        @enderror

                      </div>
                      <div class="form-group">
                        <label for="id_semester">Kỳ học</label>
                        <select name="id_semester" required id="id_semester" class="form-control">
                          <option value="">Chọn kỳ học</option>
                          @foreach ($semester as $listSemester)
                            <option {{old('id_course') == $listSemester->id || $subject->id_semester == $listSemester->id ? 'selected' : false}}
                             value="{{$listSemester->id}}">{{$listSemester->name_id}}</option>
                          @endforeach
                        </select>
                        @error('id_semester')
                            <span class="messError">{{$message}}</span>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="id_class">Lớp học</label>
                        <select name="id_class" required id="id_class" class="form-control">
                          <option value="">Chọn lớp học</option>
                          @foreach ($class as $listClass)
                            <option {{old('id_class') == $listClass->id || $subject->id_class == $listClass->id ? 'selected' : false}}
                            value="{{$listClass->id}}">{{$listClass->name_id}}</option>
                          @endforeach
                        </select>
                        @error('id_class')
                            <span class="messError">{{$message}}</span>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="id_major">Loại ngành học</label>
                        <select name="id_major" required id="id_major" class="form-control">
                          <option value="">Chọn ngành học</option>
                          @foreach ($majors as $listMajors)
                            <option {{old('id_major') == $listMajors->id || $subject->id_major == $listMajors->id ? 'selected' : false}}
                            value="{{$listMajors->id}}">{{$listMajors->name_major}}</option>
                          @endforeach
                        </select>
                        @error('id_major')
                            <span class="messError">{{$message}}</span>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="subject_type">Loại môn học</label>
                        <select name="subject_type" required id="subject_type" class="form-control">
                          <option value="">Chọn loại môn học</option>
                          @foreach ($subjectType as $listSubjectType)
                            <option  {{old('subject_type') == $listSubjectType->id || $subject->subject_type == $listSubjectType->id ? 'selected' : false}}
                            value="{{$listSubjectType->id}}">{{$listSubjectType->type}}</>
                          @endforeach
                        </select>
                        @error('subject_type')
                            <span class="messError">{{$message}}</span>
                        @enderror
                      </div>
                      <div class="form-group-btn">
                        <button class="btn btn-secondary btn-form">Cập nhật thông báo</button>
                      </div>
                    </form>
              </div>
            </div>
          </div>
    </div>

@endsection
