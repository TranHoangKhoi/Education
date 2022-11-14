@extends('client.layout.clientLayout')
@section('custtomCss')
    <link rel="stylesheet" href="{{asset('assets/client')}}/css/historyStdent.css">
@endsection

@section('content')
    <div class='wrapper'>
        <div class='heading'>
            <h3>Danh sách các môn đã học</h3>
        </div>
        <div class='table__wrapper'>
            <div class='table__content'>
                <table>
                    <thead>
                        <tr>
                            <th>
                                <span class='tbl__heading--item'>
                                    #
                                </span>
                            </th>
                            <th>
                                <span class='tbl__heading--item'>
                                    Tên môn
                                </span>
                            </th>
                            <th>
                                <span class='tbl__heading--item'>
                                    Mã môn
                                </span>
                            </th>
                            <th>
                                <span class='tbl__heading--item'>
                                    Lớp
                                </span>
                            </th>
                            <th>
                                <span class='tbl__heading--item'>
                                    Số tín chỉ
                                </span>
                            </th>
                            <th>
                                <span class='tbl__heading--item'>
                                    Khóa
                                </span>
                            </th>
                            <th>
                                <span class='tbl__heading--item'>
                                    Điểm trung bình
                                </span>
                            </th>
                            <th>
                                <span class='tbl__heading--item'>
                                    Trạng thái
                                </span>
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($listScores as $key => $item)
                            <tr>
                                <td class='text-center'>{{$key + 1}}</td>
                                <td>{{$item->subject->name}}</td>
                                <td>{{$item->subject->name_id_subject}}</td>
                                <td>{{$item->subject->name_id_subject}}</td>
                                <td class='text-center'>3</td>
                                <td>{{$user->course->name_id}}</td>
                                <td class='text-center'>{{$item->toltal}}</td>
                                <td class='{{$item->toltal >= 5 ? 'success' : 'error'}} text-center'>
                                    {{$item->toltal >= 5 ? 'Passs' : 'Failse'}}
                                </td>
                            </tr>
                        @endforeach
                        {{-- <tr>
                            <td class='text-center'>1</td>
                            <td>Khởi sự doanh nghiệp</td>
                            <td>SYB3011</td>
                            <td>SYB3011.16</td>
                            <td class='text-center'>3</td>
                            <td>Summer 2022</td>
                            <td class='text-center'>5.9</td>
                            <td class='success text-center'>Passed</td>
                            <td class='text-center'>17</td>
                        </tr> --}}
                    </tbody>
                </table>
            </div>

            {{-- <div class='table__control'>
                <div class='table__control--left'>
                    <span>Đang xem 1 đến 10 trong tổng số 31 mục</span>
                </div>
                <div class='table__control--right'>
                    <div class='tbl__ctrl--wrapper'>
                        <ul class='tbl__ctrl--list'>
                            <li class='ctrl__btn', 'tbl__ctrl--btn', 'disabled'>Trước</li>
                            <li class='num__btn', 'tbl__ctrl--btn', 'active'>1</li>
                            <li class='num__btn', 'tbl__ctrl--btn'>2</li>
                            <li class='num__btn', 'tbl__ctrl--btn'>3</li>
                            <li class='num__btn', 'tbl__ctrl--btn'>4</li>
                            <li class='ctrl__btn', 'tbl__ctrl--btn'>Tiếp</li>
                        </ul>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
@endsection