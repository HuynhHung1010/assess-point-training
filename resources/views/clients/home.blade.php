@extends('clients.layout.layouthome')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-9 border">
            <section class="section">
                <div class="slider">
                    <div class="slide">
                        <input type="radio" name="radio-btn" id="radio1">
                        <input type="radio" name="radio-btn" id="radio2">
                        <input type="radio" name="radio-btn" id="radio3">
                        <input type="radio" name="radio-btn" id="radio4">

                        <div class="st">
                            <img src="https://www.ctu.edu.vn/images/2022/08/12/hitech-2.jpg" alt="không thể hiển thị">
                            {{-- <p style="background-color: aqua"></p> --}}
                        </div>
                        <div class="st">
                            <img src="http://lienhehotro.vn/wp-content/uploads/2021/09/truong-dai-hoc-can-tho.jpg" alt="không thể hiển thị">
                            {{-- <p style="background-color: rgb(147, 203, 50)"></p> --}}
                        </div>
                        <div class="st">
                            <img src="https://reviewedu.net/wp-content/uploads/2021/09/truong-dai-hoc-can-tho-ctu.jpg" alt="không thể hiển thị">
                            {{-- <p style="background-color: rgb(215, 109, 22)"></p> --}}
                        </div>
                        <div class="st">
                            <img src="https://1.bp.blogspot.com/-Sood4mhG1ak/YRT2WsSHDKI/AAAAAAAAEkY/kCVhAcMMydM8zTCOu9RLicGdr6si1ZvuwCPcBGAYYCw/s960/CTU-DHCT-truong-dai-hoc-can-tho%2B%25283%2529.jpg" alt="không thể hiển thị">
                            {{-- <p style="background-color: rgb(229, 27, 84)"></p> --}}
                        </div>

                        <div class="nav-auto">
                            <div class="a-b1"></div>
                            <div class="a-b2"></div>
                            <div class="a-b3"></div>
                            <div class="a-b4"></div>
                        </div>
                    </div>

                    <div class="nav-m">
                        <label for="radio1" class="m-btn"></label>
                        <label for="radio2" class="m-btn"></label>
                        <label for="radio3" class="m-btn"></label>
                        <label for="radio4" class="m-btn"></label>
                    </div>
            </section>
        </div>
        <div class="p-3 col-3 border" style="background-color: #F1F1EE;">
            {{-- <p class="tb">THÔNG BÁO</p> --}}
                <div class="p-3 mb-1 bg-danger text-white tex">
                    TIN MỚI NHẤT
                </div>
                <div class="ps-4">
                    @if (!empty($ttList))
                    @foreach ($ttList as $key => $item)
                    <a href="{{route('thongbao', ['id'=>$item->id])}}" style="text-decoration: none" class="tt">{{$item->tieude}}</a><br>
                    <p>{{$item->ngaylap}}</p>
                    <hr>
                    @endforeach
                    @else
                        <p>Không có tin tức!</p>
                    @endif
                </div>
        </div>
    </div>
</div>

@endsection

@section('cssslider')
    <style>
        a.tt:hover{
            color: red;
        }
        /*slider*/
        .section{
            margin: 0;
            padding: 0;
            height: 100pv;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .slider{
            width: 800px;
            height: 500px;
            border-radius: 10px;
            overflow: hidden;
        }

        .slide{
            width: 500%;
            height: 500px;
            display: flex;
        }
        .slide input{
            display: none;
        }
        .st{
            width: 20%;
            transition: 2s;
        }
        .st img{
            width: 850px;
            height: 400px;
        }
        .nav-m{
            position:absolute;
            width: 800px;
            margin-top: -40px;
            justify-content: center;
            display: flex;

        }
        .m-btn{
            border: 2px solid rgb(21, 220, 224);
            padding: 5px;
            border-radius: 10px;
            cursor: pointer;
            transition: 1s;
        }
        .m-btn:not(:last-child){
            margin-right: 30px;
        }
        .m-btn:hover{
            background-color: aqua;
        }
        #radio1:checked ~.first{
            margin-left: 0;
        }
        #radio2:checked ~.first{
            margin-left: -20%;
        }
        #radio3:checked ~.first{
            margin-left: -40%;
        }
        #radio4:checked ~.first{
            margin-left: -60%;
        }
        .nav-auto{
            position: absolute;
            width: 800px;
            margin-top: 460px;
            display: flex;
            justify-content: center;
        }
        .nav-auto div{
            border: 2px solid aqua;
            padding: 5px;
            border-radius: 10px;
            transition: 1s;
        }
        .nav-auto div:not(:last-child){
            margin-right: 30px;
            justify-content: center;
        }
        #radio1:checked ~ .nav-auto .a-b1{
            background-color: aqua;
        }
        #radio2:checked ~ .nav-auto .a-b2{
            background-color: aqua;
        }
        #radio3:checked ~ .nav-auto .a-b3{
            background-color: aqua;
        }
        #radio4:checked ~ .nav-auto .a-b4{
            background-color: aqua;
        }
    </style>
@endsection

@section('jsslider')
    <script type="text/javascript">
        var counter = 1;
        setInterval(function() => {
            document.getElementById?('radio' + counter).checked=true;
            counter++;
            if(counter > 4){
                counter = 1;
            }
        }, 5000);
        // setInterval(function(){
        //     document.getElementById?('radio' + counter).checked=true;
        //     counter++;
        //     if(counter > 4){
        //         counter = 1;
        //     }
        // },5000);
    </script>
@endsection
