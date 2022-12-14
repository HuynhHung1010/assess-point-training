<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\admin\Tintuc;

class ThongbaoController extends Controller
{
    private $tt ;
    public function __construct()
    {
        $this->tt = new Tintuc();
    }
//view thong bao
    public function getalltintuc(){
        $title = 'Danh sách thông báo';

        $ttList = $this->tt->getalltt();
        return view('admin/thongbao/view',compact('title','ttList'));
    }
//add thong bao
    public function add(){
        $title = 'Thêm thông báo';

        return view('admin/thongbao/add',compact('title'));
    }

    public function postAdd(Request $request){
        $request->validate([
            'td' => 'required',
            'nd' => 'required'
        ],[
            'td.required' => 'Tiêu đề thông báo bắt buộc phải nhập',
            'nd.required' => 'Nội dung thông báo bắt buộc phải nhập',
        ]);

        $ttInsert = [
           'tieude' => $request->td,
           'noidung' => $request->nd,
           'ngaylap' => date('Y-m-d H:i:s')
        ];
        $this->tt->addtt($ttInsert);

        return redirect()->route('admin.addtb')->with('msg', 'Thêm thông báo thành công!');
    }
//edit thong bao
    public function getEdit(Request $request, $idtb=0){
        $title = 'Cập nhật thông báo';

        if (!empty($idtb)){
            $formDetail =  $this->tt->getDetail($idtb);
            if (!empty($formDetail[0])){
                $request->session()->put('idform', $idtb);
                $formDetail = $formDetail[0];
            }else{
                return redirect()->route('admin.thongbao')->with('msg', 'Thông báo không tồn tại');
            }
        }else{
            return redirect()->route('admin.thongbao')->with('msg', 'Liên kết  không tồn tại');
        }
        return view('admin/thongbao/edit', compact('title', 'formDetail'));
    }
    public function postEdit(Request $request){
        $idtb = session('idtb');
        if(empty($idtb)){
            return back()->with('msg', 'Liên kết không tồn tại');
        }
        $request->validate([
            'td' => 'required',
            'nd' => 'required'
        ],[
            'td.required' => 'Tiêu đề thông báo bắt buộc phải nhập',
            'nd.required' => 'Nội dung thông báo bắt buộc phải nhập',
        ]);

        $ttInsert = [
           'tieude' => $request->td,
           'noidung' => $request->nd,
           'ngaylap' => date('Y-m-d H:i:s')
        ];
        $this->tt->edittt($ttInsert,$idtb);

        return redirect()->route('admin.edittb')->with('msg', 'Cập nhật thông báo thành công!');
    }
//delete thong bao
    public function getDelete($idtb=0){
        if (!empty($idtb)){
            $formDetail =  $this->tt->getDetail($idtb);
            if (!empty($formDetail[0])){
                $deletestatus = $this->tt->deleteForm($idtb);
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
        return redirect()->route('admin.thongbao')->with('msg', $msg);
        // return view('admin/controlform/formad', compact('title', 'formDetail'));
    }
}
