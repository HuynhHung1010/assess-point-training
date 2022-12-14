@extends('clients.layout.layouthome')


@section('content')
<div class="p-3 border">
    <main>
        <ul class="breadcrumbs">
            <li><a href="{{route('home')}}" class="home">Trang chủ</a></li>
            <li class="divider">/</li>
            <li><a href="#" class="active">Sinh viên</a></li>
            <li class="divider">/</li>
            <li><a href="#" class="active">Chấm điểm rèn luyện</a></li>
        </ul>
    </main>
        @if (session('msg'))
            <div class="alert alert-success">{{session('msg')}}</div>
        @endif
        <div class="text-center">
            <h2>{{$title}}</h2>
        </div>
        {{-- {{$errors->any()}}
        @if($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger">{{$error}}</div>
            @endforeach
        @endif --}}
        {{-- @if (session('msgerro'))
                <div class="alert alert-danger">{{session('msgerro')}}</div>
        @endif --}}
        <div class="d-flex justify-content-center">
          <form action="" method="get" class="mb-3">
            <div class="row">
                <div class="col-6">
                    <select class="form-control" name="idnh">
                        <option value="0">Năm học</option>
                        @if (!empty(getAllnam()))
                            @foreach (getAllnam() as $item)
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
                        @if (!empty(getAllhocky()))
                            @foreach (getAllhocky() as $item)
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
<div class="ps-4 d-flex flex-row mb-3">
    @if (!empty($sv))
        @foreach ($sv as $key => $i)
            <p style="font-size: 18px"><b>MSSV:</b><span style="font-weight: 800;color: #34BE82;padding-right: 10px;">{{$i->mssv}}</span></p>
            <p style="font-size: 18px"><b>Họ tên Sinh viên:</b><span style="font-weight: 800;color: #34BE82;padding-right: 10px;">{{$i->hoten}}</span></p>
            <p style="font-size: 18px"><b>Chức vụ:</b><span style="font-weight: 800;color: #34BE82;padding-right: 10px;">{{$i->chucvu}}</span></p>
            <p style="font-size: 18px"><b>Gmail:</b><span style="font-weight: 800;color: #34BE82;padding-right: 10px;">{{$i->gmail}}</span></p>
        @endforeach
    @else
        <h3>Không có dữ liệu</h3>
    @endif
</div>
<form action="{{route('sv.postchamsv')}}" method="POST">
    @csrf
    <div class="d-flex justify-content-center">
    <table id="customers">
    <div class="text-center">
        <tr>
            <th>Mã tiêu chí</th>
            <th>Tiêu chí</th>
            <th>Điểm tối đa</th>
            <th>Trường</th>
            <th>Khoa</th>
            <th>Đoàn khoa</th>
            <th>Sinh viên đánh giá</th>
            <th>GVCV đánh giá</th>
            <th>Điểm RL đạt</th>
        </tr>
    </div>
        @if (!empty($pcList))
        @foreach ($pcList as $key => $item)
        <tr>
            <td>{{$item->matc}}</td>
            <td>{{$item->tentc}}</td>
            <td>{{$item->diemmax}}</td>
            <td></td>
            <td></td>
            <td></td>
            @if ($item->quyen == 1)
                <input type="hidden" name="idp[]" value="{{$item->idpc}}">
                <td><input type="text" class="inmath" name="svd[]" value="{{old('svd')}}">

                        {{-- @foreach ($error as $i)
                            <span style="color: red;">{{$i}}</span>
                        @endforeach --}}

                    {{-- @foreach ($errors->get('svd') as $message)
                    <span style="color: red;">{{$message}}</span>
                    @endforeach --}}
                    {{-- @if (!empty($message))
                @foreach ($message as $i)
                <span style="color: red;">{{$i}}</span>
                @endforeach
            @endif --}}
                </td>
            @else
                <td></td>
            @endif
            <td></td>
            <td></td>
        </tr>
        @endforeach
        @else
            <tr>
                <td colspan="7">Không có dữ liệu</td>
            </tr>
        @endif
    </tr>
    </table>
</div>
        <div class="p-3 text-end">
            @if(!empty($k))
                @if($k == 1)
                    <button type="submit" class="btn btn-success">Lưu <i class="fa-solid fa-check"></i></button>
                @else
                @endif
            @else
            @endif
            <a href="{{route('home')}}" class="btn btn-danger">Trở về <i class="fa-solid fa-rotate-left"></i></a>
        </div>
</form>
</div>
@endsection

@section('css')
    @parent
    <style>
    #customers {
    font-family: Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    max-width: 1100px;
    min-width: 980px;
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
