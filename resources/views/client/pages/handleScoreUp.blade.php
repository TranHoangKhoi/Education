@extends('client.layout.clientLayout')
@section('custtomCss')
    <link rel="stylesheet" href="{{asset('assets/client')}}/css/scoreup.css">
@endsection

@section('srcJS')
    <script src="{{asset('assets/client')}}/js/handleAddformScrore.js"></script>
@endsection

@section('content')
    <div class='content'>
        <div class='wrapper'>
            @include('client.pages.checkSubject')

            <div class='lecturers-semester'>
                <form action="handleCaseScore" method='POST'>
                    @csrf()
                    <div id="form-block" class="form-block">
                        @foreach ($listCaseScore as $caseItem)
                            <div class="form-flex">
                                <div class='form-flex-group flex-3'>
                                    <div class="form-flex-tiltle">
                                        <label >Tiêu đề: </label>
                                    </div>
                                    <div class="form-flex-input">
                                        <input class="form-tbl-input" type="text" required name="titleUD[]" value="{{$caseItem->title}}" placeholder="Tiêu đề điểm...">
                                        <input type="text" name="id_case[]" value="{{$caseItem->id}}" hidden placeholder="Tiêu đề điểm...">
                                    </div>
                                </div>
                                <div class='form-flex-group flex-2'>
                                    <div class="form-flex-tiltle">
                                        <label >Trọng số: </label>
                                    </div>
                                    <div class="form-flex-input">
                                        <input name="percentUD[]" class="form-tbl-input" min="0" max="100" required type="number" value="{{$caseItem->percent}}" placeholder="Trọng số (%)">
                                    </div>
                                </div>

                                <div class='form-flex-group form-icon-close  flex-1'>
                                    {{-- <i class="closeFormBtn"><ion-icon name="close-outline"></ion-icon></i> --}}
                                </div>

                            </div>    
                        @endforeach
                        {{-- <div class="form-flex">
                            <div class='form-flex-group flex-3'>
                                <div class="form-flex-tiltle">
                                    <label >Tiêu đề: </label>
                                </div>
                                <div class="form-flex-input">
                                    <input type="text" required name="title[]" placeholder="Tiêu đề điểm...">
                                </div>
                            </div>
                            <div class='form-flex-group flex-2'>
                                <div class="form-flex-tiltle">
                                    <label >Trọng số: </label>
                                </div>
                                <div class="form-flex-input">
                                    <input name="percent[]" min="0" max="100" required type="number" placeholder="Trọng số (%)">
                                </div>
                            </div>

                            <div class='form-flex-group form-icon-close  flex-1'>
                                <i class="closeFormBtn"><ion-icon name="close-outline"></ion-icon></i>
                            </div>

                        </div> --}}
                    </div>

                    <div class="icon-plus__block">
                        <div id="addFormBtn" class="icon-plus__item">
                            <span>Thêm dữ liệu điểm</span>
                            <i><ion-icon name="add-circle-outline"></ion-icon></i>
                        </div>
                    </div>
                        <input type="text" hidden value="{{$idSubject}}" name="id_subject">

                    <div class='form-group'>
                        <div>
                            <button id="btn-form-ud" disabled class="btn btn-form disabled-btn">
                                Cập nhật dữ liệu điểm
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <form action="postScoreUp" method="POST">
                @csrf()
                @if ($listScores != '')    

                @foreach ($listScores as $key => $scoreItem)    
                    <div class='lecturers__name-table'>
                        <div class='lecturers__name'>
                            <p>#{{$key + 1}}: {{$scoreItem->students->name}} - {{$scoreItem->students->mssv}}</p>
                        </div>

                        <div class='lecturers__btn'>
                            <button>Print</button>
                            <button>Copy</button>
                            <button>Excel</button>
                            <button>CSV</button>
                            <button>PDF</button>
                        </div>

                        <div class='table__lecturers'>
                            <div class='table__content'>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>
                                                <span class='tbl__heading--item'>
                                                    #
                                                    <FontAwesomeIcon class='tbl__arr--up' icon={faArrowUpZA} />
                                                    <FontAwesomeIcon
                                                        class='tbl__arr--down'
                                                        icon={faArrowDownZA}
                                                    />
                                                </span>
                                            </th>
                                            <th>
                                                <span class='tbl__heading--item'>
                                                    Tên đầu điểm
                                                    <FontAwesomeIcon class='tbl__arr--up' icon={faArrowUpZA} />
                                                    <FontAwesomeIcon
                                                        class='tbl__arr--down'
                                                        icon={faArrowDownZA}
                                                    />
                                                </span>
                                            </th>
                                            <th>
                                                <span class='tbl__heading--item'>
                                                    Trọng số
                                                    <FontAwesomeIcon class='tbl__arr--up' icon={faArrowUpZA} />
                                                    <FontAwesomeIcon
                                                        class='tbl__arr--down'
                                                        icon={faArrowDownZA}
                                                    />
                                                </span>
                                            </th>
                                            <th>
                                                <span class='tbl__heading--item'>
                                                    Điểm
                                                    <FontAwesomeIcon class='tbl__arr--up' icon={faArrowUpZA} />
                                                    <FontAwesomeIcon
                                                        class='tbl__arr--down'
                                                        icon={faArrowDownZA}
                                                    />
                                                </span>
                                            </th>
                                            <th>
                                                <span class='tbl__heading--item'>
                                                    Ghi chú
                                                    <FontAwesomeIcon class='tbl__arr--up' icon={faArrowUpZA} />
                                                    <FontAwesomeIcon
                                                        class='tbl__arr--down'
                                                        icon={faArrowDownZA}
                                                    />
                                                </span>
                                            </th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @php
                                            $taltolScore = 0;
                                        @endphp
                                        @foreach ($scoreItem->detailsScore as $key => $detailsScore)
                                            <tr>
                                                <input type="text" hidden name="id_score_details[]" value="{{$detailsScore->id}}">
                                                <td style="width: 5%; text-align: center;">{{$key + 1}}</td>
                                                <td style="width: 40%">{{$detailsScore->caseScore->title}}</td>
                                                <td style="width: 10%; text-align: center;">{{$detailsScore->caseScore->percent}}</td>
                                                <td style="width: 20%; text-align: center;">
                                                    <input type="number" class="form-input-tbl" name="score[]" min="0" max="10"value="{{$detailsScore->score}}">
                                                </td>
                                                
                                                <td style="width: 30%">
                                                    <input type="text" class="form-input-tbl" name="note[]" min="0" max="10"value="{{$detailsScore->note}}">
                                                </td>
                                            </tr>
                                            @php
                                                echo (int)$detailsScore->caseScore->percent;
                                                echo (int)$detailsScore->score;
                                                $taltolScore += ((int)$detailsScore->caseScore->percent * (int)$detailsScore->score) / 100;
                                                @endphp
                                        @endforeach
                                        <tr>
                                            <input type="text" hiden name="totalScore[]" value="{{$taltolScore}}">
                                            <input type="text" hiden name="scoreId[]" value="{{$scoreItem->id}}">
                                            <td colspan="2" style="text-align: center;">Tổng điểm: </td>
                                            <td colspan="3" style="text-align: center;">{{$taltolScore}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                @endforeach


                <div class='lecturers_btn_add'>
                    <button class="btn btn-form">Thêm Điểm</button>
                </div>
            @endif
            </form>
        </div >
    </div >
@endsection