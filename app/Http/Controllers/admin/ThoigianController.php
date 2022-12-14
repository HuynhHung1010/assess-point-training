<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\admin\Time;

class ThoigianController extends Controller
{
    private $time;
    public function __construct()
    {
        $this->time = new Time();
    }
    public function index(Request $request){
        $title = 'Thời gian chấm điểm rèn luyện';

        $timeList = $this->time->getalltime();
        return view('admin/timecham/view', compact('title','timeList'));

    }

    public function add(){
        $title = 'Thêm Phiếu thời gian chấm điểm rèn luyện';

        $getallnam = getAllnam();
        $getallhk = getAllhocky();

        return view('admin/timecham/add', compact('title','getallnam','getallhk'));
    }
    public function postAdd(Request $request){
        $request->validate([
            // 'matc' => 'required',
            'idnh' => ['required','integer',function($attribute, $value, $fail){
                if($value==0){
                    $fail('Bắt buộc phải chọn năm học');
                }
            }],
            'idhk' => ['required','integer',function($attribute, $value, $fail){
                if($value==0){
                    $fail('Bắt buộc phải chọn học kỳ');
                }
            }],
            'svbd' => 'required',
            'svkt' => 'required',
            'gvbd' => 'required',
            'gvkt' => 'required',
            'dbd' => 'required',
            'dkt' => 'required',
            'kbd' => 'required',
            'kkt' => 'required',
            'hanlap' => 'required'
        ],[
            'idnh.integer' => 'Năm không hợp lệ',
            'idnh.required' => 'Năm không được để trống',
            'idnh.integer' => 'Học kỳ không hợp lệ',
            'idnh.required' => 'Học kỳ không được để trống',
            'svbd.required' => 'Ngày sinh viên bắt đầu chấm bắt buộc phải nhập',
            'svkt.required' => 'Ngày sinh viên kết thúc chấm bắt buộc phải nhập',
            'gvbd.required' => 'Ngày GVCV bắt đầu chấm bắt buộc phải nhập',
            'gvkt.required' => 'Ngày GVCV kết thúc chấm bắt buộc phải nhập',
            'dbd.required' => 'Ngày đoàn khoa bắt đầu chấm bắt buộc phải nhập',
            'dkt.required' => 'Ngày đoàn khoa kết thúc chấm bắt buộc phải nhập',
            'kbd.required' => 'Ngày khoa bắt đầu chấm bắt buộc phải nhập',
            'kkt.required' => 'Ngày khoa kết thúc chấm bắt buộc phải nhập',
            'hanlap.required' => 'Hạn lập phiếu chấm bắt buộc phải nhập',
        ]);

        $TimeInsert = [
           'idnh' => $request->idnh,
           'idhk'=> $request->idhk,
           'ngaysvbd' => $request->svbd,
           'ngaysvkt' => $request->svkt,
           'ngaygvbd' => $request->gvbd,
           'ngaygvkt' => $request->gvkt,
           'ngaydbd' => $request->dbd,
           'ngaydkt' => $request->dkt,
           'ngaykbd' => $request->kbd,
           'ngaykkt' => $request->kkt,
           'hanlapphieu' => $request->hanlap
        ];
        // dd($TimeInsert);
        $this->time->addtime($TimeInsert);

        return redirect()->route('admin.thoigian')->with('msg', 'Thêm thời gian chấm thành công!');
    }

    public function getEdit(Request $request, $idt=0){
        $title = 'Cập nhật thời gian chấm điểm rèn luyện';

        $getallnam = getAllnam();
        $getallhk = getAllhocky();

        if (!empty($idt)){
            $timeDetail =  $this->time->getDetail($idt);
            // dd($timeDetail);
            if (!empty($timeDetail[0])){
                $request->session()->put('idt', $idt);
                $timeDetail = $timeDetail[0];
            }else{
                return redirect()->route('admin.thoigian')->with('msg', 'Thời gian không tồn tại');
            }
        }else{
            return redirect()->route('admin.thoigian')->with('msg', 'Liên kết  không tồn tại');
        }
        return view('admin/timecham/edit', compact('title', 'timeDetail','getallnam','getallhk'));
    }

    public function postEdit(Request $request, $idt=0){
        $idt = session('idt');
        if(empty($idt)){
            return back()->with('msg', 'Liên kết không tồn tại');
        }
        $request->validate([
            // 'matc' => 'required',
            'idnh' => ['required','integer',function($attribute, $value, $fail){
                if($value==0){
                    $fail('Bắt buộc phải chọn năm học');
                }
            }],
            'idhk' => ['required','integer',function($attribute, $value, $fail){
                if($value==0){
                    $fail('Bắt buộc phải chọn học kỳ');
                }
            }],
            'svbd' => 'required',
            'svkt' => 'required',
            'gvbd' => 'required',
            'gvkt' => 'required',
            'dbd' => 'required',
            'dkt' => 'required',
            'kbd' => 'required',
            'kkt' => 'required',
            'hanlap' => 'required'
        ],[
            'idnh.integer' => 'Năm không hợp lệ',
            'idnh.required' => 'Năm không được để trống',
            'idnh.integer' => 'Học kỳ không hợp lệ',
            'idnh.required' => 'Học kỳ không được để trống',
            'svbd.required' => 'Ngày sinh viên bắt đầu chấm bắt buộc phải nhập',
            'svkt.required' => 'Ngày sinh viên kết thúc chấm bắt buộc phải nhập',
            'gvbd.required' => 'Ngày GVCV bắt đầu chấm bắt buộc phải nhập',
            'gvkt.required' => 'Ngày GVCV kết thúc chấm bắt buộc phải nhập',
            'dbd.required' => 'Ngày đoàn khoa bắt đầu chấm bắt buộc phải nhập',
            'dkt.required' => 'Ngày đoàn khoa kết thúc chấm bắt buộc phải nhập',
            'kbd.required' => 'Ngày khoa bắt đầu chấm bắt buộc phải nhập',
            'kkt.required' => 'Ngày khoa kết thúc chấm bắt buộc phải nhập',
            'hanlap.required' => 'Hạn lập phiếu chấm bắt buộc phải nhập',
        ]);

        $Timeup = [
           'idnh' => $request->idnh,
           'idhk'=> $request->idhk,
           'ngaysvbd' => $request->svbd,
           'ngaysvkt' => $request->svkt,
           'ngaygvbd' => $request->gvbd,
           'ngaygvkt' => $request->gvkt,
           'ngaydbd' => $request->dbd,
           'ngaydkt' => $request->dkt,
           'ngaykbd' => $request->kbd,
           'ngaykkt' => $request->kkt,
           'hanlapphieu' => $request->hanlap
        ];
        // dd($Timeup);
        $this->time->edittime($Timeup,$idt);

        return back()->with('msg', 'Cập nhật thời gian chấm thành công!');
    }

    public function getDelete($idt=0){
        if (!empty($idt)){
            $timeDetail =  $this->time->getDetail($idt);
            if (!empty($timeDetail[0])){
                $deletestatus = $this->time->deleteTime($idt);
                if($deletestatus){
                    $msg = 'Xóa tiêu chí thành công';
                }else{
                    $msg= 'Bạn không thể xóa tiêu chí này.Vui lòng quay lại sau!';
                }
            }else{
                $msg = 'Tiêu chí  không tồn tại';
            }
        }else{
            $msg = 'Liên kết không tồn tại ';
        }
        return redirect()->route('admin.thoigian')->with('msg', $msg);
        // return view('admin/controlform/formad', compact('title', 'formDetail'));
    }
}
