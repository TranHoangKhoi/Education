<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Education</title>
        <link rel="stylesheet" href="{{asset('assets')}}/gird.css">
        <link rel="stylesheet" href="{{asset('assets/client')}}/css/base.css">
        <link rel="stylesheet" href="{{asset('assets/client')}}/css/main.css">
        @yield('custtomCss')

        {{-- SRC --}}
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    </head>
    <body>
        <div>
            <div class='wrapper'>
                <div class='wrapper__header'>
                    {{-- Side bar --}}
                    <div class='aside'>
                        <div class='aside_Brand'>
                            <div class='asideBrandLogo'>
                                <a href="http://localhost:3001/Student">
                                    <img class='asideImageLogo' src="https://ap.poly.edu.vn/images/logo.png" />
                                </a>
                            </div>
                            {{-- <div class='ToolSidebar'>
                                <button class='asideToggle'>
                                    <span class='asideBarToggleBox'>
                                        <FontAwesomeIcon class='bar_toggle' icon={faAnglesLeft} />
                                    </span>
                                </button>
                            </div> --}}
                        </div>
                        <div class='navBar-wrapper'>
                            <div class='navBar'>
                                <div class='navBarMenu'>
                                    <ul class="navBarMenu__list">
                                        @if (Auth::check() && Auth::user()->role === 0)
                                        <li  class="navBarMenu__item">
                                            <a href="{{route('studentHome')}}" class="navBarMenu__item--link">
                                                <i><ion-icon name="notifications-outline"></ion-icon></i>
                                                Thông báo và tin tức
                                            </a>
                                        </li>
                                        <li  class="navBarMenu__item">
                                            <a href="{{route('studentHistory')}}" class="navBarMenu__item--link">
                                                <i><ion-icon name="stats-chart-outline"></ion-icon></i>
                                                Lịch sử học
                                            </a>
                                        </li>
                                        {{-- <li  class="navBarMenu__item">
                                            <a href="" class="navBarMenu__item--link">
                                                <i><ion-icon name="receipt-outline"></ion-icon></i>
                                                Bảng điểm
                                            </a>
                                        </li> --}}
                                        @endif
                                        @if (Auth::check() && Auth::user()->role === 1)
                                            <li  class="navBarMenu__item">
                                                <a href="{{route('scoreup')}}" class="navBarMenu__item--link">
                                                    <i><ion-icon name="calculator"></ion-icon></i>
                                                    Nhập điểm sinh viên
                                                </a>
                                            </li>
                                        @endif;
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class='wrapper_main'>
                        <header class='header'>
                            <label id="header__topbar" for="checkTopbarClick" class='header__topbar'>
                                <form action="{{route('auth.logout')}}" method="POST">
                                    @csrf()
                                    <button class='btn header__topbar--item'>
                                        <div class='header__topbar--wrapper'>
                                            <span class='header__topbar--icon'>
                                                <i><ion-icon name="log-out-outline"></ion-icon></i>
                                            </span>
                                        </div>
                                    </button>
                                </form>
                                <div class='header__topbar-item--user'>
                                    <div class='header__topbar-item--welcome'>Xin chào,</div>
                                    <div class='header__topbar-item--username'>{{$user->name}}</div>
                                </div>
                                <input hidden type="checkbox" id="checkTopbarClick">
                                <div class='dropdown_student'>
                                    <div class='dropdown_student--title'>
                                        <div class='dropdown_student--Name'>{{$user->name}}</div>
                                    </div>
                                    <div class='notification'>
                                        <a href="" class='notification__item'>
                                            <div class='notification__item-icon'>
                                                <i><ion-icon name="shirt-outline"></ion-icon></i>
                                            </div>
                                            <div class='notification__item-details'>
                                                <div class='notification__item-title'>Hồ sơ cá nhân</div>
                                                <div class='notification__item-time'>Thông tin cá nhân</div>
                                            </div>
                                        </a>
                                        <div class='notification__custom'>
                                            <form action="{{route('auth.logout')}}" method="POST">
                                                @csrf()
                                                <button class='btn notification_btn-login'>
                                                    Đăng xuất
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </label>
                            <div class='header__bottom'>
                                <h3>Lịch sử học</h3>
                                <span class='header__bottom--line'></span>
                                <span class='header__bottom--icon'>
                                    <FontAwesomeIcon icon={faHouseDamage} />
                                    <p class='header__bottom--subText'>Điểm</p>
                                </span>
                            </div>
                        </header>
                        <main class='main'>
                            <div class='content'>
                                @yield('content')
                            </div>
                        </main>
                    </div>
                </div>


                <footer id="footer_client" class='footer'>
                    <div class='footer__content'>
                        <div class='grid'>
                            <div class='row'>
                                <div class='col l-4'>
                                    <div class='footer__content--logo', 'footer__content--item'>
                                        <img
                                            class='footer__logo--img'
                                            src="https://ap.poly.edu.vn/images/logo.png"
                                            alt="Logo"
                                        />
                                        <p class='footer__logo--text'>
                                            <FontAwesomeIcon icon={faLocationDot} />
                                            <span>
                                                Số 288, Nguyễn Văn Linh, phường An Khánh, quận Ninh Kiều, Tp. Cần Thơ.
                                            </span>
                                        </p>
                                    </div>
                                </div>

                                <div class='col l-8'>
                                    <div class='footer__content--info', 'footer__content--item'>
                                        <div class='info__heading'>
                                            <h3>Thông tin liên hệ</h3>
                                        </div>
                                        <div class='info__wrapper'>
                                            <div class='info__content'>
                                                <p>
                                                    <i>
                                                        <FontAwesomeIcon icon={faPhone} />
                                                    </i>
                                                    Số điện thoại liên hệ giải đáp ý kiến sinh viên:
                                                    <span class='strong'>02927300468</span>
                                                </p>
                                            </div>

                                            <div class='info__content'>
                                                <p>
                                                    <i>
                                                        <FontAwesomeIcon icon={faEnvelope} />
                                                    </i>
                                                    Địa chỉ email các phòng ban:
                                                </p>
                                                <ul class='info__content--list'>
                                                    <li>
                                                        Phòng dịch vụ sinh viên:
                                                        <span class='strong'>dvsvpoly.ct@poly.edu.vn</span>
                                                    </li>
                                                    <li>
                                                        Phòng Tổ chức và quản lý đào tạo:
                                                        <ul class='info__content--subList'>
                                                            <li>
                                                                Đào tạo:
                                                                <span class='strong'>
                                                                    daotaopolyct@fe.edu.vn
                                                                </span>
                                                            </li>
                                                            <li>
                                                                Khảo thí:
                                                                <span class='strong'>
                                                                    khaothi.fplct@fpt.edu.vn
                                                                </span>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li>
                                                        Phòng hành chính:
                                                        <span class='strong'>hanhchinhpolyct@fe.edu.vn</span>
                                                    </li>
                                                    <li>
                                                        Phòng quan hệ doanh nghiệp:
                                                        <span class='strong'>qhdn.fplct@fpt.edu.vn</span>
                                                    </li>
                                                </ul>
                                            </div>

                                            <div class='info__content'>
                                                <p>
                                                    Ý kiến đóng góp chung gửi về ykien.poly@fpt.edu.vn bằng email
                                                    @fpt.edu.vn
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    </body>

    @yield('srcJS')
    
</html>
