@extends('clients.layout.layouthome')

@section('content')
{{-- <i class="fa-solid fa-slash-back"></i> --}}
    <div class="container">
    <div class="row">
        <div class="col-9 border">
            <main>
                <ul class="breadcrumbs">
                    <li><a href="{{route('home')}}" class="home">Trang chủ</a></li>
                    <li class="divider">/</li>
                    <li><a href="#" class="active">Thông báo</a></li>
                </ul>
            </main>
            <h2 class="text-center text-danger">{{$title}}</h2>
            <div>
                @if (!empty($ttbList))
                    @foreach ($ttbList as $key => $item)
                    <h3>{{$item->tieude}}</h3>
                    <p>{{$item->ngaylap}}</p>
                    <hr>
                    <p>{{$item->noidung}}</p>
                    @endforeach
                @else
                    <p>Không có tin tức!</p>
                @endif
            </div>
        </div>
        <div class="p-3 col-3 border" style="background-color: #F1F1EE;">
            {{-- <p class="tb">THÔNG BÁO</p> --}}
                <div class="p-3 mb-1 bg-danger text-white tex">
                    TIN MỚI NHẤT
                </div>
                <div class="ps-4">
                    @if (!empty($ttList))
                    @foreach ($ttList as $key => $item)
                    <a href="{{route('thongbao', ['id'=>$item->id])}}" style="text-decoration: none;" class="tt">{{$item->tieude}}</a><br>
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

@section('csstt')
    <style>
        a.tt:hover{
            color: red;
        }
    </style>
@endsection

