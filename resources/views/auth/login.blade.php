<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Login</title>
        <link rel="stylesheet" href="{{asset('assets')}}/gird.css">
        <link rel="stylesheet" href="{{asset('assets/client')}}/css/base.css">
        <link rel="stylesheet" href="{{asset('assets/client')}}/css/main.css">
        <link rel="stylesheet" href="{{asset('assets/client')}}/css/login.css">

        {{-- SRC --}}
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    </head>
    <body>
        <div>
            <div class='wrapper_login'>
                <div class="login__bg">
                    <div class="login__img">
                        {{-- <img src="{{asset('assets/img')}}/banner/dashboardBanner.jpg" alt=""> --}}
                        <img src="https://png.pngtree.com/background/20220714/original/pngtree-real-estate-buying-real-estate-2-5d-three-dimensional-creative-background-picture-image_1618461.jpg" alt="">
                    </div>
                    <div class="login__block">
                        <a href="" class="login__title">
                            <img class='login__title--img' src="https://ap.poly.edu.vn/images/logo.png" alt="Logo" />
                        </a>
                        <form action="{{route('auth.handleLogin')}}" method="post" class="login__form">
                            @csrf()
                            <div class="input__group">
                                <input type="email" name="email" class="input__item" value="" placeholder="Email">
                            </div>
                            <div class="input__group">
                                <input type="password" name="password" class="input__item" value="" placeholder="Mật khẩu">
                            </div>
                            <div class="input__group">
                                <select name="role" id="" class="input__item">
                                    <option>Chọn vai trò</option>
                                    <option value="0">Sinh viên</option>
                                    <option value="1">Giảng viên</option>
                                    <option value="2">Quản trị</option>
                                </select>
                            </div>
                            <div class="input__group input__group--btn">
                                <button class="input__btn">Đăng nhập</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
