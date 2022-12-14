@extends('clients.layout.layouthome')


@section('content')
<div class="p-3 border">
    <main>
        <ul class="breadcrumbs">
            <li><a href="{{route('home')}}" class="home">Trang chủ</a></li>
            <li class="divider">/</li>
            <li><a href="#" class="active">Khoa</a></li>
            <li class="divider">/</li>
            <li><a href="{{route('khoa.svph')}}">Xem phản hồi</a></li>
            li class="divider">/</li>
            <li><a href="#" class="active">Trả lời phản hồi</a></li>
        </ul>
    </main>
    <div class="text-center">
        <h2 style="color: red;">{{$title}}</h2>
        @if (session('msg'))
            <div class="alert alert-success">{{session('msg')}}</div>
        @endif
        <hr>
    </div>
    <div class="text-center">
        <h3>Khoa trả lời phản hồi cho sinh viên:</h3>
    </div>
    <div class="d-flex justify-content-center">
        <form action="{{route('khoa.postguiph')}}" method="POST">
            @csrf
            <input type="hidden" name="idph" value="{{$idph}}">

            <br>
            <div class="field">
                <div class="control">
                <textarea class="textarea"  name="phanhoi" rows="7" cols="130" placeholder="Phản hồi...." style="padding-top: 10px;"></textarea>
                </div>
                @error('phanhoi')
                    <span style="color: red;">{{$message}}</span>
                @enderror
            </div>
                <div class="col-12 p-3 text-end">
                    <button type="submit" class="btn btn-success">Thêm phản hồi <i class="fa-solid fa-check"></i></button>
                    <a href="{{route('khoa.svph')}}" class="btn btn-danger">Trở về <i class="fa-solid fa-rotate-left"></i></a>
                </div>
        </form>
    </div>
</div>
@endsection

@section('css')
    @parent
    <style>
        #customers {
    font-family: Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 68em;
    justify-content: center;
  }

  #customers td, #customers th {
    border: 1px solid #ddd;
    padding: 8px;
  }

  #customers tr:nth-child(even){background-color: #f2f2f2;}

  #customers tr:hover {background-color: #ddd;}

  #customers th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #1d86ee;
    color: white;
  }

.inmath{
  width: 60px;
  text-align: center;
}

.select-box{
  width: 150px;
}
.select-box select{
  height: 40px;
  padding: 10px 15px;
  line-height: 18px;
  font-size: 16px;
  width: 100%;
  border: 2px solid #ccc;
  border-radius: 8px;
  -webkit-appearance: none;
  appearance: none;
}

.select-box:after{
  content: "";
  position: absolute;
  right: 8px;
  top: 50%;
  margin-top: -4px;
  border-top: 8px solid #ccc;
  border-left: 6px solid transparent;
  border-right: 6px solid transparent;
  pointer-events: none;
}
    </style>
@endsection
