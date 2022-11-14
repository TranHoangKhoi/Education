<div class='lecturers-semester'>
    <form action="handleScoreup" method='GET'>
        <div class='form-group'>
            <div>
                <label >Khóa học</label>
            </div>
            <div>
                <select name="" id="" disabled>
                    <option value="">Fall 2022</option>
                    <option value="">Summer 2022 </option>
                    <option value="">Spring 2022</option>
                </select>
            </div>
            <div>
                <span>Lựa chọn học kỳ để hiện thị chi tiết điểm theo kỳ</span>
            </div>
        </div>

        <div class='form-group'>
            <div>
                <label >Học kỳ</label>
            </div>
            <div>
                <select name="" id="" disabled>
                    <option value="">Fall 2022</option>
                    <option value="">Summer 2022 </option>
                    <option value="">Spring 2022</option>
                </select>
            </div>
            <div>
                <span>Lựa chọn học kỳ để hiện thị chi tiết điểm theo kỳ</span>
            </div>
        </div>

        {{-- <div class='form-group'>
            <div>
                <label >Lớp</label>
            </div>
            <div>
                <select name="" id="">
                    <option value="">WE16301</option>

                </select>
            </div>
            <div>
                <span>Lựa chọn học kỳ để hiện thị chi tiết điểm theo kỳ</span>
            </div>
        </div> --}}

        <div class='form-group'>
            <div>
                <label >Môn học</label>
            </div>
            <div>
                <select required name="id_subject">
                    <option value="">Chọn môn học</option>
                    @foreach ($listSubject as $subjectItem)
                    <option value="{{$subjectItem->id}}">{{$subjectItem->name}} ({{$subjectItem->name_id_subject}})</option>
                        
                    @endforeach
                </select>
            </div>
            <div>
                <span>Lựa chọn học kỳ để hiện thị chi tiết điểm theo kỳ</span>
            </div>
        </div>

        <div class='form-group'>
            <div>
                <button class="btn btn-form">
                    Nhập điểm sinh viên
                </button>
            </div>
        </div>

    </form>
</div>