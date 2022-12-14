<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Imports\TaikhoanImport;
use App\Models\clients\Taikhoan;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class TaikhoanController extends Controller
{
    private $tk;
    public function __construct()
    {
        $this->tk = new Taikhoan();
    }

    public function index(Request $request){
        $title = 'Danh sách tài khoản người dùng';

        $keywords = null;

        if(!empty($request->keywords)){
            $keywords = $request->keywords;
        }


        $ndList = $this->tk->getall($keywords);
        //  dd($ndList);
        return view('admin/taikhoan/viewlist', compact('title','ndList'));
    }

    public function add(){
        $title = 'Thêm tài khoản người dùng';

        return view('admin/taikhoan/add', compact('title'));
    }

    public function postadd(Request $request){
        $request->validate([
            'file' => 'required'
        ],[
            'file.required' => 'File bắt buộc phải nhập',
        ]);
        try {
            Excel::import(new TaikhoanImport, $request->file);
            return redirect()->route('admin.taikhoan')->with('msg', 'Thêm tài khoản thành công!');
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
             $failures = $e->failures();
             return redirect()->route('admin.addtaikhoan')->with('erromsg', $failures);
        }
    }

    public function getDelete($idtk=0){
        if (!empty($idtk)){
            $tkDetail =  $this->tk->getDetail($idtk);
            if (!empty($tkDetail[0])){
                $deletestatus = $this->tk->deleteTK($idtk);
                if($deletestatus){
                    $msg = 'Xóa tài khoản thành công';
                }else{
                    $msg= 'Bạn không thể xóa tài khoản này.Vui lòng quay lại sau!';
                }
            }else{
                $msg = 'Tài khoản  không tồn tại';
            }
        }else{
            $msg = 'Liên kết không tồn tại ';
        }
        return redirect()->route('admin.taikhoan')->with('msg', $msg);
        // return view('admin/controlform/formad', compact('title', 'formDetail'));
    }
}
