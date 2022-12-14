
  <div class="menu-bar">
    <div class="text-center">
        <ul>
        <li><a href="{{route('home')}}">Trang chủ</a></li>
        <li><a href="{{route('sv.xemdiemsv')}}">Sinh viên <i class="fas fa-caret-down"></i></a>

            <div class="dropdown-menu">
                <ul>
                    <li><a href="{{route('sv.chamdiemsv')}}">Chấm điểm</a></li>
                    <li><a href="{{route('sv.xemdiemsv')}}">Xem điểm</a></li>
                    <li>
                    <a href="{{route('sv.phanhoig')}}">Phản hồi<i class="fas fa-caret-right"></i></a>

                    <div class="dropdown-menu-1">
                        <ul>
                        <li><a href="{{route('sv.phanhoig')}}">PH cho GVCV</a></li>
                        <li><a href="{{route('sv.phanhoidk')}}">PH cho Đoàn khoa</a></li>
                        <li><a href="{{route('sv.phanhoik')}}">PH cho Khoa</a></li>
                        <li><a href="{{route('sv.phanhoitruong')}}">PH cho PCTSV</a></li>
                        </ul>
                    </div>
                    </li>
                    <li><a href="{{route('sv.taiminhchung')}}">Tải minh chứng</a></li>
                </ul>
                </div>
        </li>
        <li><a href="{{route('gv.lopdiemsv')}}">Giáo viên cố vấn <i class="fas fa-caret-down"></i></a>

            <div class="dropdown-menu">
                <ul>
                    <li><a href="{{route('gv.xemdslop')}}">Chấm điểm</a></li>
                    <li><a href="{{route('gv.lopdiemsv')}}">Xem điểm</a></li>
                    <li><a href="{{route('gv.chucvulop')}}"> Cập nhật chức vụ</a></li>
                    <li><a href="{{route('gv.svph')}}"> Xem phản hồi</a></li>
                    <li><a href="{{route('gv.gvtonghop')}}">Tổng hợp điểm RL</a></li>
                </ul>
                </div>
        </li>
        <li><a href="{{route('doan.dslop')}}">Đoàn khoa<i class="fas fa-caret-down"></i></a>

            <div class="dropdown-menu">
                <ul>
                    <li><a href="{{route('doan.doandslop')}}">Chấm điểm</a></li>
                    <li><a href="{{route('doan.dslop')}}">Xem điểm</a></li>
                    <li><a href="{{route('doan.chucvulop')}}">Cập nhật chức vụ</a></li>
                    <li><a href="{{route('doan.svph')}}"> Xem phản hồi</a></li>
                    <li><a href="{{route('doan.doantonghop')}}">Tổng hợp điểm RL</a></li>
                </ul>
                </div>
        </li>
        <li><a href="{{route('khoa.dslop')}}">Trường <i class="fas fa-caret-down"></i></a>

            <div class="dropdown-menu">
                <ul>
                    <li><a href="{{route('khoa.khoadslop')}}">Chấm điểm</a></li>
                    <li><a href="{{route('khoa.dslop')}}">Xem điểm</a></li>
                    <li><a href="{{route('khoa.chucvulop')}}">Cập nhật chức vụ</a></li>
                    <li><a href="{{route('khoa.svph')}}"> Xem phản hồi</a></li>
                    <li><a href="{{route('khoa.khoatonghop')}}">Tổng hợp điểm RL</a></li>
                </ul>
                </div>
        </li>
            <div class="user">
                <li><a class="dn" href="{{route('login')}}"><i class="fa-solid fa-user"></i></a>
                    <div class="dropdown-menu">
                        <ul>
                            <li><a href="{{route('logout')}}">Logout<i class="fa-solid fa-right-to-bracket"></i></a></li>
                        </ul>
                        </div>
                </li>
            </div>

        </ul>
    </div>
  </div>


{{-- <div class="menu-bar">
        <ul>
            <li><a href=""></a>TRANG CHỦ</li>
            <li><a href="">SINH VIÊN</a>
                <ul class="dropdown">
                    <li><a href="">Chấm điểm RL</a></li>
                    <li><a href="">Xem điểm RK</a></li>
                    <li><a href="">Tải minh chứng</a></li>
                    <li><a href="">Phản hồi</a></li>
                </ul>
            </li>
            <li><a href=""></a>GIÁO VIÊN CỐ VẤN</li>
            <li><a href=""></a>KHOA</li>
        </ul>
</div> --}}
