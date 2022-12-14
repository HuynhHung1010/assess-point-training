@extends('clients.layout.layouthome')


@section('content')
<div class="p-3 border">
    <main>
        <ul class="breadcrumbs">
            <li><a href="{{route('home')}}" class="home">Trang chủ</a></li>
            <li class="divider">/</li>
            <li><a href="#" class="active">Giáo viên</a></li>
            <li class="divider">/</li>
            <li><a href="#" class="active">Xem điểm rèn luyện</a></li>
        </ul>
    </main>
    <div class="text-center">
        <h2>{{$title}}</h2>
        @if (session('msg'))
                <div class="alert alert-success">{{session('msg')}}</div>
        @endif
        {{-- @if (session('msgerro'))
                <div class="alert alert-danger">{{session('msgerro')}}</div>
        @endif --}}
    </div>
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
    <div class="ps-4 d-flex flex-row mb-3" id="tdxl">
        @if (!empty($Tongdat))
            @foreach ($Tongdat as $key => $item)
                <p class="tdtd"><span><b>Tổng điểm rèn luyện:</b></span><b class="tdiem">{{$item->tongdiem}}</b></p>
                <p class="iconxl"><i class="fa-solid fa-share"></i></p>
                @if($item->tongdiem<=$item->muccham&&$item->tongdiem>=($item->muccham-10))
                    <p class="tdxl"><b>Xếp loại:</b></p>
                    <p class="xl"><b>Xuất sắc</b></p>
                @elseif($item->tongdiem<($item->muccham-10)&&$item->tongdiem>=($item->muccham-20))
                    <p class="tdxl"><b>Xếp loại:</b></p>
                    <p class="xl"><b>Tốt</b></p>
                @elseif($item->tongdiem<($item->muccham-20)&&$item->tongdiem>=($item->muccham-30))
                    <p class="tdxl"><b>Xếp loại:</b></p>
                    <p class="xl"><b>Khá</b></p>
                @elseif($item->tongdiem<($item->muccham-30)&&$item->tongdiem>=($item->muccham-40))
                    <p class="tdxl"><b>Xếp loại:</b></p>
                    <p class="xl"><b>Trung bình-Khá</b></p>
                @elseif($item->tongdiem<($item->muccham-40)&&$item->tongdiem>=($item->muccham-50))
                    <p class="tdxl"><b>Xếp loại:</b></p>
                    <p class="xl"><b>Trung bình</b></p>
                @elseif($item->tongdiem<($item->muccham-50)&&$item->tongdiem>=($item->muccham-70))
                    <p class="tdxl"><b>Xếp loại:</b></p>
                    <p class="xl"><b>Yếu</b></p>
                @else
                    <p class="tdxl"><b>Xếp loại:</b></p>
                    <p class="xl"><b>Kém</b></p>
                @endif
            @endforeach
        @endif
    </div>
    <div class="d-flex justify-content-center">
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
            <th>Điểm RL đạt</th>
        </tr>
            @if (!empty($dList))
            @foreach ($dList as $key => $item)
            <tr>
                <td>{{$item->matc}}</td>
                <td>{{$item->tentc}}</td>
                <td>{{$item->diemmax}}</td>
                <td>{{$item->pctdiem}}</td>
                <td>{{$item->khoadiem}}</td>
                <td>{{$item->doandiem}}</td>
                <td>{{$item->svdiem}}</td>
                <td>{{$item->gvdiem}}</td>
                <td>{{$item->diemdat}}</td>
            </tr>
            @endforeach
            @else
                <tr>
                    <td colspan="8">Không có dữ liệu</td>
                </tr>
            @endif
        </tr>


        <tr>
            <td colspan="2"><b>Tổng điểm</b></td>

            @if (!empty($Tongmax))
                @foreach ($Tongmax as $key => $m)
                    <td>{{$m->tongmax}}</td>
                @endforeach
            @endif

            @if (!empty($Tongt))
                @foreach ($Tongt as $key => $i)
                    <td>{{$i->tongpct}}</td>
                @endforeach
            @endif

            @if (!empty($Tongkhoa))
                @foreach ($Tongkhoa as $key => $k)
                    <td>{{$k->tongkhoa}}</td>
                @endforeach
            @endif

            @if (!empty($Tongdoan))
            @foreach ($Tongdoan as $key => $dk)
                <td>{{$dk->tongdoan}}</td>
            @endforeach
            @endif

            @if (!empty($Tongsv))
                @foreach ($Tongsv as $key => $ite)
                    <td>{{$ite->tongsv}}</td>
                @endforeach
            @endif

            @if (!empty($Tonggv))
                @foreach ($Tonggv as $key => $t)
                    <td>{{$t->tonggv}}</td>
                @endforeach
            @endif


            @if (!empty($Tongdat))
                @foreach ($Tongdat as $key => $item)
                    <td><b>{{$item->tongdiem}}</td>
                @endforeach
             @endif
        </tr>
        </table>
    </div>
    <div class="p-3 text-end">
        <a href="{{route('gv.lopdiemsv')}}" class="btn btn-danger">Trở về <i class="fa-solid fa-rotate-left"></i></a>
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
