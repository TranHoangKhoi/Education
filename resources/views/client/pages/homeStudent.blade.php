@extends('client.layout.clientLayout')
@section('custtomCss')
    <link rel="stylesheet" href="{{asset('assets/client')}}/css/homeStudent.css">
@endsection

@section('content')
    <div class='Wrapper'>
        {{-- <div class='row no-gutters'> --}}
            <div class='grid'>
                <div class='kt--portlet'>
                    <div class='row'>
                        @foreach ($listCateNotifi as $cateNotiItem)
                            <div class='col c-3 border-right list-notifi'>
                                <div id="show-newsletter-student" class='newsletter-student'>
                                    <h3 class='kt-link'>{{$cateNotiItem->name_cate}}</h3>
                                    @foreach ($cateNotiItem->notify as $notifiItem)    
                                        <div class='witget1__item'>
                                            <div class='witget1__info'>
                                                <a href="#" class='Link'>
                                                    {{$notifiItem->title}}
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                    {{-- <div class='witget1__item'>
                                        <div class='witget1__info'>
                                            <div class='witget1__info'>
                                                <a href="#" class='Link'>
                                                    🥉 THÔNG BÁO QUAN TRỌNG _ MỘT SỐ ĐIỂM MỚI TRONG CÔNG TÁC ĐÀO TẠO BẮT
                                                    ĐẦU TỪ KỲ FALL 2022
                                                </a>
                                            </div>
                                        </div>
                                    </div> --}}

                                    {{-- <div>
                                        <a href="#" class='seen_more'>
                                            Xem thêm
                                        </a>
                                    </div> --}}
                                </div>
                            </div>
                        @endforeach
                        {{-- <div class='col c-3 border-right'>
                            <div id="show-newsletter-student" class='newsletter-student'>
                                <h3 class='kt-link'>Thông tin hoạt động</h3>
                                <div class='witget1__item'>
                                    <div class='witget1__info'>
                                        <a href="#" class='Link'>
                                            🥇 ĐĂNG KÝ BHYT HỌC KỲ FALL 2022
                                        </a>
                                    </div>
                                </div>
                                <div class='witget1__item'>
                                    <div class='witget1__info'>
                                        <div class='witget1__info'>
                                            <a href="#" class='Link'>
                                                THÔNG BÁO NHẬN GIÁO TRÌNH KỲ FALL NĂM 2022 (ĐỢT 3)
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class='col c-3 border-right'>
                            <div id="show-newsletter-student" class='newsletter-student'>
                                <h3 class='kt-link'>Thông tin học phí</h3>
                                <div class='witget1__item'>
                                    <div class='witget1__info'>
                                        <a href="#" class='Link'>
                                            🥇 THÔNG BÁO THU HỌC PHÍ FALL 2022
                                        </a>
                                    </div>
                                </div>
                                <div class='witget1__item'>
                                    <div class='witget1__info'>
                                        <div class='witget1__info'>
                                            <a href="#" class='Link'>
                                                🥈 TRIỂN KHAI KÊNH THANH TOÁN VIETINBANK
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class='witget1__item'>
                                    <div class='witget1__info'>
                                        <div class='witget1__info'>
                                            <a href="#" class='Link'>
                                                🥉 THÔNG BÁO CHÍNH SÁCH ƯU ĐÃI HỌC PHÍ
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class='col c-3'>
                            <div id="show-newsletter-student" class='newsletter-student'>
                                <h3 class='kt-link'>Thông tin việc làm</h3>
                                <div class='witget1__item'>
                                    <div class='witget1__info'>
                                        <a href="#" class='Link'>
                                            🥇 THÔNG BÁO THỜI GIAN TỔ CHỨC THI LẠI ĐỢT 1 - FALL 2022
                                        </a>
                                    </div>
                                </div>
                                <div class='witget1__item'>
                                    <div class='witget1__info'>
                                        <div class='witget1__info'>
                                            <a href="#" class='Link'>
                                                🥈 Thông báo kế hoạch TỔ CHỨC các đợt thi lại các môn Online - HỌC
                                                KỲ FALL 2022
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class='witget1__item'>
                                    <div class='witget1__info'>
                                        <div class='witget1__info'>
                                            <a href="#" class='Link'>
                                                🥉 THÔNG BÁO QUAN TRỌNG _ MỘT SỐ ĐIỂM MỚI TRONG CÔNG TÁC ĐÀO TẠO BẮT
                                                ĐẦU TỪ KỲ FALL 2022
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        {{-- </div> --}}
    </div>
@endsection