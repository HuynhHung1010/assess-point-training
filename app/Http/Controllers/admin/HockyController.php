<?php

namespace App\Http\Controllers\admin;

use App\Models\Years;
use Illuminate\Support\Str;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HockyController extends Controller
{
    private $year;
    public function __construct()
    {
        $this->year = new Years();
    }
    public function index(Request $request){
        $title = 'Danh sách học kỳ-năm học';

        $formList = $this->year->getallhknh();
        // dd($formList);
        return view('admin/year/viewnam', compact('title','formList'));

    }
    public function addNam(){
        $title = 'Thêm học kỳ-năm học';
        $getallnam = getAllnam();
        $getallhk = getAllhocky();
        return view('admin/year/add', compact('title','getallnam','getallhk'));
    }
    public function postAdd(Request $request){
        $request->validate([
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
            'ngbd' => 'required',
            'ngkt' => 'required'
        ],[
            'idnh.integer' => 'Năm không hợp lệ',
            'idnh.required' => 'Năm không được để trống',
            'idhk.integer' => 'Học kỳ không hợp lệ',
            'idhk.required' => 'Học kỳ không được để trống',
            'ngbd.required' => 'Ngày bắt đầu học kỳ bắt buộc phải nhập',
            'ngkt.required' => 'Ngày kết thúc học kỳ bắt buộc phải nhập',
        ]);

        $FormInsert = [
            $request->idnh,
            $request->idhk,
            $request->ngbd,
            $request->ngkt,
        ];
        // dd($FormInsert);
        $this->year-> addhknh($FormInsert);

        return redirect()->route('admin.addnam')->with('msg', 'Thêm năm học-học kỳ thành công!');
    }
    public function getEdit(Request $request, $idhknh=0){
        $title = 'Cập nhật năm học-học kỳ';

        // $idnh = $request->idnh;
        if (!empty($idhknh)){
            $formDetail =  $this->year->getDetailhknh($idhknh);
            if (!empty($formDetail[0])){
                $request->session()->put('idhknh', $idhknh);
                $formDetail = $formDetail[0];
            }else{
                return redirect()->route('admin.viewnam')->with('msg', 'Năm học-học kỳ không tồn tại');
            }
        }else{
            return redirect()->route('admin.viewnam')->with('msg', 'Liên kết  không tồn tại');
        }
        return view('admin/year/edit', compact('title', 'formDetail'));
    }
    public function postEdit(Request $request, $idhknh=0){
        $idhknh = session('idhknh');
        if(empty($idhknh)){
            return back()->with('msg', 'Liên kết không tồn tại');
        }
        $request->validate([
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
            'ngbd' => 'required',
            'ngkt' => 'required'
        ],[
            'idnh.integer' => 'Năm không hợp lệ',
            'idnh.required' => 'Năm không được để trống',
            'idhk.integer' => 'Học kỳ không hợp lệ',
            'idhk.required' => 'Học kỳ không được để trống',
            'ngbd.required' => 'Ngày bắt đầu học kỳ bắt buộc phải nhập',
            'ngkt.required' => 'Ngày kết thúc học kỳ bắt buộc phải nhập',
        ]);
        $dataupdate = [
            'idnh' => $request->idnh,
           'idhk' => $request->idhk,
           'ngaybd' => $request->ngbd,
           'ngaykt' => $request->ngkt,
        ];
        $this->year->updatehknh($dataupdate, $idhknh);

        return back()->with('msg', 'Cập nhật năm học-học kỳ thành công!');
    }
    public function getDelete($idhknh=0){
        if (!empty($idhknh)){
            $formDetail =  $this->year->getDetailhknh($idhknh);
            if (!empty($formDetail[0])){
                $deletestatus = $this->year->deletehknh($idhknh);
                if($deletestatus){
                    $msg = 'Xóa học kỳ-năm học thành công';
                }else{
                    $msg= 'Bạn không thể xóa năm học-học kỳ này.Vui lòng quay lại sau!';
                }
            }else{
                $msg = 'Năm học-học kỳ  không tồn tại';
            }
        }else{
            $msg = 'Liên kết không tồn tại ';
        }
        return redirect()->route('admin.viewnam')->with('msg', $msg);
    }







    public function ListNam(Request $request){
        $title = 'Danh sách năm học';

        $formList = $this->year->getall();
        // dd($formList);
        return view('admin/year/nam/listnam', compact('title','formList'));

    }
    public function addNamhoc(){
        $title = 'Thêm năm học';
        return view('admin/year/nam/add', compact('title'));
    }
    public function postAddnam(Request $request){
        // $tnh = Str::of($request->tennam)->beforeLast('-');

        //         dd($tnh.'1');
        $request->validate([
            'tennam' => ['required','unique:namhoc',function($attribute, $value, $fail){
                // $tnh = Str::of($value)->beforeLast('-');
                // $snh = Str::of($value)->after('-');
                // if($tnh=$snh){
                //     $fail('Năm học không hợp lệ,năm trước phải bé và liền kề năm sau');
                // }
            }],
        ],[

            'tennam.required' => 'Năm học bắt buộc phải nhập',
             'tennam.unique' => 'Năm học đã tồn tại',
        ]);


           $data = $request->tennam;

        // dd($FormInsert);
        $this->year->addNam($data);

        return redirect()->route('admin.themnam')->with('msg', 'Thêm năm học thành công!');
    }

    public function getEditnh(Request $request, $idnh=0){
        $title = 'Cập nhật năm học';

        // $idnh = $request->idnh;
        if (!empty($idnh)){
            $formDetail =  $this->year->getDetail($idnh);
            if (!empty($formDetail[0])){
                $request->session()->put('idnh', $idnh);
                $formDetail = $formDetail[0];
            }else{
                return redirect()->route('admin.listnam')->with('msg', 'Năm học không tồn tại');
            }
        }else{
            return redirect()->route('admin.listnam')->with('msg', 'Liên kết  không tồn tại');
        }
        return view('admin/year/nam/edit', compact('title', 'formDetail'));
    }

    public function postEditnh(Request $request, $idnh=0){
        $idnh = session('idnh');
        if(empty($idnh)){
            return back()->with('msg', 'Liên kết không tồn tại');
        }
        $request->validate([
            'nh' => 'required',
        ],[
            'nh.required' => 'Tên năm học bắt buộc phải nhập',
        ]);
           $nh = $request->nh;

        $this->year->updateNH($nh, $idnh);

        return back()->with('msg', 'Cập nhật năm học thành công!');
    }

    public function getDeletenamhoc($idnh=0){
        if (!empty($idnh)){
            $nhDetail =  $this->year->getDetail($idnh);
            if (!empty($nhDetail[0])){
                $deletestatus = $this->year->deleteNamhoc($idnh);
                if($deletestatus){
                    $msg = 'Xóa năm học thành công';
                }else{
                    $msg= 'Bạn không thể xóa năm học này.Vui lòng quay lại sau!';
                }
            }else{
                $msg = 'Năm học không tồn tại';
            }
        }else{
            $msg = 'Liên kết không tồn tại ';
        }
        return redirect()->route('admin.listnam')->with('msg', $msg);
        // return view('admin/controlform/formad', compact('title', 'formDetail'));
    }




    public function Listhk(Request $request){
        $title = 'Danh sách học kỳ';

        $formList = $this->year->getAllhk();
        // dd($formList);
        return view('admin/year/hk/view', compact('title','formList'));

    }
    public function addhk(){
        $title = 'Thêm học kỳ';
        return view('admin/year/hk/add', compact('title'));
    }
    public function postAddhk(Request $request){
        $request->validate([
            'tenhk' => ['required','unique:hocky',function($attribute, $value, $fail){
                $tnh = Str::of($value)->beforeLast('-');
                $snh = Str::of($value)->after('-');
                if($tnh>$snh){
                    $fail('học kỳ không hợp lệ,năm trước phải bé và liền kề năm sau');
                }
            }],
        ],[

            'tenhk.required' => 'Học kỳ bắt buộc phải nhập',
             'tenhk.unique' => 'Học kỳ đã tồn tại',
        ]);


           $data = $request->tenhk;

        // dd($FormInsert);
        $this->year->addHK($data);

        return redirect()->route('admin.themhk')->with('msg', 'Thêm học kỳ thành công!');
    }

    public function getEdithk(Request $request, $idhk=0){
        $title = 'Cập nhật học kỳ';

        // $idnh = $request->idnh;
        if (!empty($idhk)){
            $formDetail =  $this->year->getDetailhk($idhk);
            if (!empty($formDetail[0])){
                $request->session()->put('idhk', $idhk);
                $formDetail = $formDetail[0];
            }else{
                return redirect()->route('admin.listhk')->with('msg', 'Học kỳ không tồn tại');
            }
        }else{
            return redirect()->route('admin.listhk')->with('msg', 'Liên kết  không tồn tại');
        }
        return view('admin/year/hk/edit', compact('title', 'formDetail'));
    }

    public function postEdithk(Request $request, $idhk=0){
        $idhk = session('idhk');
        if(empty($idhk)){
            return back()->with('msg', 'Liên kết không tồn tại');
        }
        $request->validate([
            'hk' => 'required',
        ],[
            'hk.required' => 'Tên học kỳ bắt buộc phải nhập',
        ]);
           $hk = $request->hk;

        $this->year->updatehk($hk, $idhk);

        return back()->with('msg', 'Cập nhật học kỳ thành công!');
    }

    public function getDeletehk($idhk=0){
        if (!empty($idhk)){
            $nhDetail =  $this->year->getDetailhk($idhk);
            if (!empty($nhDetail[0])){
                $deletestatus = $this->year->deletehk($idhk);
                if($deletestatus){
                    $msg = 'Xóa học kỳ thành công';
                }else{
                    $msg= 'Bạn không thể xóa học kỳ này.Vui lòng quay lại sau!';
                }
            }else{
                $msg = 'Học kỳ không tồn tại';
            }
        }else{
            $msg = 'Liên kết không tồn tại ';
        }
        return redirect()->route('admin.listhk')->with('msg', $msg);
        // return view('admin/controlform/formad', compact('title', 'formDetail'));
    }
}
