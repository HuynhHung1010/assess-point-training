<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Form;


class FormController extends Controller
{
    private $form;
    public function __construct()
    {
        $this->form = new Form();
    }
    public function index(Request $request){
        $title = 'Tiêu chí chấm điểm rèn luyện';

        $formList = $this->form->getallform();
        $Tongdiem = $this->form->getSUM();
        $muc = $this->form->muc();
        // dd($Tongdiem);
        // dd($formList);
        return view('admin/controlform/viewform', compact('title','formList','Tongdiem','muc'));

    }

    public function addmuc(){
        $title = 'Cập nhật tổng điểm phiếu chấm';
        return view('admin/controlform/addmuc', compact('title'));
    }
    public function postaddmuc(Request $request){
        $request->validate([
            'muc' => 'required|integer',
        ],[
            // 'matc.required' => 'Mã tiêu chí bắt buộc phải nhập',
            'muc.required' => 'Tổng điểm tối đa bắt buộc phải nhập',
            'muc.integer' => 'Tổng điểm tối đa bắt buộc phải là số nguyên',
        ]);

            $muc = $request->muc;
        $this->form->addmuc($muc);

        return redirect()->route('admin.formad')->with('msg', 'Cập nhật tổng điểm tối đa thành công!');
    }
    public function add(){
        $title = 'Thêm tiêu chí chấm điểm rèn luyện';
        return view('admin/controlform/addform', compact('title'));
    }
    public function postAdd(Request $request){
        $request->validate([
            'diemmax' => ['required','integer',function($attribute, $value, $fail){
                $Tongdiem = $this->form->getSUM();
                foreach ($Tongdiem as $item){
                 $tong = $item->tongdiem;
                }
                $muc = $this->form->muc();
                foreach ($muc as $i){
                    $muc = $i->muc;
                   }
                if($value+$tong>$muc){
                    $fail('Điểm tối đa của tiêu chí đã vượt quá điểm cho phép');
                }
            }],
            'matc' => 'unique:form',
            'tentc' => 'required|unique:form',
        ],[
            'matc.unique' => 'Mã tiêu chí đã tồn tại',
            'diemmax.required' => 'Điểm tối đa bắt buộc phải nhập',
            'diemmax.integer' => 'Điểm tối đa bắt buộc phải là số nguyên',
            'tentc.required' => 'Tên tiêu chí bắt buộc phải nhập',
            'tentc.unique' => 'Tên tiêu chí đã tồn tại',
        ]);

        $FormInsert = [
            $request->matc,
            $request->tentc,
            $request->diemmax,
            $request->quyen
            // $request->dtb
        ];
        $this->form->addform($FormInsert);

        return redirect()->route('admin.formad')->with('msg', 'Thêm tiêu chí thành công!');
    }
    public function getEdit(Request $request, $idform=0){
        $title = 'Cập nhật tiêu chí chấm điểm rèn luyện';

        if (!empty($idform)){
            $formDetail =  $this->form->getDetail($idform);
            if (!empty($formDetail[0])){
                $request->session()->put('idform', $idform);
                $formDetail = $formDetail[0];
            }else{
                return redirect()->route('admin.formad')->with('msg', 'Tiêu chí không tồn tại');
            }
        }else{
            return redirect()->route('admin.formad')->with('msg', 'Liên kết  không tồn tại');
        }
        return view('admin/controlform/editform', compact('title', 'formDetail'));
    }
    public function postEdit(Request $request, $idform=0){
        $idform = session('idform');
        if(empty($idform)){
            return back()->with('msg', 'Liên kết không tồn tại');
        }
        $request->validate([
            // 'matc' => 'required',
            'diemmax' => ['required','integer',function($attribute, $value, $fail){
                $Tongdiem = $this->form->getSUM();
                foreach ($Tongdiem as $item){
                 $tong = $item->tongdiem;
                }
                $muc = $this->form->muc();
                foreach ($muc as $i){
                    $muc = $i->muc;
                   }
                $idform = session('idform');
                $dmax = $this->form->dmax($idform);
                foreach ($dmax as $k){
                    $max = $k->diemmax;
                }
                if($tong-$max+$value>$muc){
                    $fail('Điểm tối đa của tiêu chí đã vượt quá điểm cho phép');
                }
            }],
            'tentc' => 'required'
        ],[
            'diemmax.required' => 'Điểm tối đa bắt buộc phải nhập',
            'diemmax.integer' => 'Điểm tối đa bắt buộc phải là số nguyên',
            'tentc.required' => 'Tên tiêu chí bắt buộc phải nhập',
        ]);
        $dataupdate = [
           'matc' => $request->matc,
           'tentc' => $request->tentc,
           'diemmax' => $request->diemmax,
            'quyen' => $request->quyen
            // 'tbhk' => $request->dtb
        ];
        // dd($dataupdate,$idform);
        $this->form->updateForm($dataupdate, $idform);

        return back()->with('msg', 'Cập nhật tiêu chí thành công!');
    }
    public function getDelete($idform=0){
        if (!empty($idform)){
            $formDetail =  $this->form->getDetail($idform);
            if (!empty($formDetail[0])){
                $deletestatus = $this->form->deleteForm($idform);
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
        return redirect()->route('admin.formad')->with('msg', $msg);
        // return view('admin/controlform/formad', compact('title', 'formDetail'));
    }
}
