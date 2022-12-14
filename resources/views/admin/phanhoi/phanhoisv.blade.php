@extends('admin.dashboard.index')
@section('content')
    <main>
        <h1 class="title">Quản lý phản hồi</h1>
        <ul class="breadcrumbs">
            <li><a href="{{route('admin.homead')}}">Home</a></li>
            <li class="divider">/</li>
            <li><a href="#" class="active">Quản lý phản hồi</a></li>
        </ul>
        <div class="text-center">
            <h2 style="color: red;">{{$title}}</h2>
        </div>
        @if (session('msg'))
            <div class="alert alert-success">{{session('msg')}}</div>
        @endif
        <hr>
<h3>PCTSV trả lời phản hồi cho sinh viên:</h3>
<form action="{{route('admin.postguiph')}}" method="POST">
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
        <div class="col-12" style="margin-top: 10px;">
            <button type="submit" class="btn btn-success">Thêm phản hồi <i class="fa-solid fa-check"></i></button>
            <a href="{{route('admin.svph')}}" class="btn btn-danger">Trở về <i class="fa-solid fa-rotate-left"></i></a>
        </div>
    </form>


    </main>
@endsection

@section('css')
    @parent
    <style>
        #customers {
    font-family: Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 980px;
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
