@extends('clients.layout.layouthome')


@section('content')
<div class="p-3 border">
    <main>
        <ul class="breadcrumbs">
            <li><a href="{{route('home')}}" class="home">Trang chủ</a></li>
            <li class="divider">/</li>
            <li><a href="#" class="active">Giáo viên</a></li>
            <li class="divider">/</li>
            <li><a href="#" class="active">Chấm điểm rèn luyện</a></li>
        </ul>
    </main>
    <div class="text-center">
        @if (session('msg'))
                <div class="alert alert-success">{{session('msg')}}</div>
        @endif
        {{-- @if ($errors-> any())
                <div class="alert alert-danger">Du lieu loi</div>
        @endif --}}
        <h2>Bảng minh chứng sinh viên</h2>
    </div>
    <div class="d-flex justify-content-center">
        <table id="customers">
            <tr>
                <th>STT</th>
                <th>Tên minh chứng</th>
                <th>Ngày tải minh chứng</th>
                <th>Download File</th>
            </tr>
                @if (!empty($mcList))
                @foreach ($mcList as $key => $item)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$item->tenmc}}</td>
                    <td>{{$item->ngaytao}}</td>
                    <td><a href="{{route('gv.download').'?file='.public_path('storage/'.$item->tenfile)}}">{{$item->tenfile}}</a></td>
                </tr>
                @endforeach
                @else
                    <tr>
                        <td colspan="4">Không có dữ liệu</td>
                    </tr>
                @endif
            </tr>
            </table>
        <br>
        <br>
    </div>
    <hr>
    <div class="text-center">
        <h2>{{$title}}</h2>
    </div>
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
                <input type="hidden" name="idsv" value="{{$idsv}}">
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
                <p style="font-size: 18px"><b>Chức vụ:</b><span style="font-weight: 800;color: #34BE82;padding-right: 10px;">{{$i->chucvu}},{{$i->chucvudoan}}</span></p>
                <p style="font-size: 18px"><b>Gmail:</b><span style="font-weight: 800;color: #34BE82;padding-right: 10px;">{{$i->gmail}}</span></p>
            @endforeach
        @else
            <h3>Không có dữ liệu</h3>
        @endif
    </div>
    <div class="d-flex justify-content-center">
        <form action="{{route('gv.postgvcham')}}" method="POST">
            @csrf
            <input type="hidden" name="idsv" value="{{$idsv}}">
            <table id="customers">
            <tr>
                <th>Mã tiêu chí</th>
                <th>Tiêu chí</th>
                <th>Điểm tối đa</th>
                <th>Trường</th>
                <th>Khoa</th>
                <th>Đoàn khoa</th>
                <th>Sinh viên đánh giá</th>
                <th>GVCV đánh giá</th>
                <th>Điểm RL dạt</th>
            </tr>
                @if (!empty($pcList))
                @foreach ($pcList as $key => $item)
                <tr>
                    <td>{{$item->matc}}</td>
                    <td>{{$item->tentc}}</td>
                    <td>{{$item->diemmax}}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    @if ($item->quyen == 2)
                        <input type="hidden" name="idp[]" value="{{$item->idpc}}">
                        <td><input type="text" class="inmath" name="svd[]" value="{{old('svd')}}"></td>
                        {{-- @error('svd[]')
                                <span style="color: red;">{{$message}}</span>
                        @enderror --}}
                    @else
                        <td></td>
                    @endif
                    <td></td>
                </tr>
                @endforeach
                @else
                    <tr>
                        <td colspan="8">Không có dữ liệu</td>
                    </tr>
                @endif
            </tr>
            </table>
            <div class="p-3 text-end">
                <div class="col-12">
                    @if(!empty($k))
                        @if($k == 1)
                            <button type="submit" class="btn btn-success">Lưu <i class="fa-solid fa-check"></i></button>
                        @else
                        @endif
                    @else
                    @endif
                    <a href="{{route('gv.xemdslop')}}" class="btn btn-danger">Trở về <i class="fa-solid fa-rotate-left"></i></a>
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
