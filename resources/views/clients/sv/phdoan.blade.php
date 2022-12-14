@extends('clients.layout.layouthome')


@section('content')
<div class="p-3 border">
    <main>
        <ul class="breadcrumbs">
            <li><a href="{{route('home')}}" class="home">Trang chủ</a></li>
            <li class="divider">/</li>
            <li><a href="#" class="active">Sinh viên</a></li>
            <li class="divider">/</li>
            <li><a href="#" class="active">Phản hồi cho đoàn khoa</a></li>
        </ul>
    </main>
    <div class="text-center">
        <h2 style="color: red;">{{$title}}</h2>
        @if (session('msg'))
            <div class="alert alert-success">{{session('msg')}}</div>
        @endif
    <hr>
    <h3>Phản hồi của đoàn khoa:</h3>
    </div>
    <div class="d-flex justify-content-center">
    <form action="" method="get" class="mb-3">
        <div class="row">
            <div class="col-6">
                <select class="form-control" name="idnh">
                    <option value="0">Năm học</option>
                    @if (!empty($getallnam))
                        @foreach ($getallnam as $item)
                            <option value="{{$item->idnh}}"
                                {{request()->old('id')==$item->idnh?'selected':false}}>{{$item->tennam}}</option>
                            {{-- {{request()->id==$item->id?'selected':true}} --}}
                        @endforeach
                    @endif
                </select>
            </div>
            <div class="col-5">
                <select class="form-control" name="idhk">
                    <option value="0">Học kỳ</option>
                    @if (!empty($getallhk))
                        @foreach ($getallhk as $item)
                            <option value="{{$item->idhk}}"
                                {{request()->old('id')==$item->idhk?'selected':false}}>{{$item->tenhk}}</option>
                            {{-- {{request()->id==$item->id?'selected':true}} --}}
                        @endforeach
                    @endif
                </select>
            </div>
            {{-- <input type="hidden" name="idf"> --}}
            <div class="col-1">
                <button type="submit" class="btn btn-info btn-block"><i class="fa-solid fa-magnifying-glass"></i></button>
            </div>
        </div>
      </form>
    </div>
    <div class="d-flex justify-content-center">
        <table id="customers">
        <tr>
            <th width="5%">STT</th>
            <th>Phản hồi của sinh viên</th>
            <th>Phản hồi của đoàn khoa</th>
            <th width="17%">Ngày trả lời</th>
            @if (!empty($phList))
            @foreach ($phList as $key => $item)
            <tr>
                <td>{{$key+1}}</td>
                <td>{{$item->svph}}</td>
                <td>{{$item->traloi}}</td>
                <td>{{$item->ngaytl}}</td>
            </tr>
            @endforeach
            @else
                <tr>
                    <td colspan="4">Không có dữ liệu</td>
                </tr>
            @endif
        </tr>
        </table>
    </div>
    <hr>
    <div class="text-center">
        <h3>Phản hồi về điểm rèn luyện với đoàn khoa:</h3>
    </div>
    <div class="d-flex justify-content-center">
        <form action="{{route('sv.postphanhoidk')}}" method="POST" class="mb-3">
            @csrf
            <input type="hidden" name="idsv" value="{{$idsv}}">

            <div class="field">
                <div class="control">
                <textarea class="textarea"  name="phanhoi" rows="7" cols="130" placeholder="Phản hồi...." style="padding-top: 10px;"></textarea>
                </div>
                @error('phanhoi')
                    <span style="color: red;">{{$message}}</span>
                @enderror
            </div>
                <div class="text-end">
                    <div class="col-12" style="margin-top: 10px;">
                        @if(!empty($k))
                            @if($k == 1)
                                <button type="submit" class="btn btn-success">Thêm phản hồi <i class="fa-solid fa-check"></i></button>
                            @else
                            @endif
                        @else
                        @endif
                        <a href="{{route('home')}}" class="btn btn-danger">Trở về <i class="fa-solid fa-rotate-left"></i></a>
                    </div>
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
