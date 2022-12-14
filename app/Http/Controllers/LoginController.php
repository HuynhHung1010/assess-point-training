<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\clients\Taikhoan;

use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    private $taik;
    public function __construct()
    {
        $this->taik = new Taikhoan();
    }
    public function index(){
        return view('clients/login');
    }

    public function indexgv(){
        return view('clients/logingv');
    }

    public function indexd(){
        return view('clients/logind');
    }

    public function indexk(){
        return view('clients/logink');
    }

    public function indexadmin(){
        return view('admin/login');
    }

    public function login(Request $request){

        $request->validate([
            // 'matc' => 'required',
            'username' => 'required|min:8',
            'pass' => 'required'
        ],[
            // 'matc.required' => 'Mã tiêu chí bắt buộc phải nhập',
            'username.required' => 'Tên tài khoản bắt buộc phải nhập',
            'username.min' => 'Tên tài khoản phải từ :min ký tự trở lên',
            'pass.required' => 'Mật khẩu bắt buộc phải nhập',
        ]);


        $ten = $request->username;
        $mk = $request->pass;

        if (Auth::attempt(['tentk'=>$ten, 'password'=>$mk])) {
            // if (Auth::taikhoan()->ngdung === 'sv'){
                    $quyen = $this->taik->getquyen();
                    foreach($quyen as $item){
                        $quyennd = $item->ngdung;
                        $ten = $item->tentk;
                    }
                    // dd($quyennd,$ten);
                    if ($quyennd === 'sv'){
                        return redirect()->route('sv.xemdiemsv')->with('ten', $ten);
                    }else{
                        return redirect()->route('login')->with('msg', 'Tài khoản hoặc mật khẩu không đúng');
                    }
                    // return redirect()->route('home');
        }else{
            return redirect()->route('login')->with('msg', 'Tài khoản hoặc mật khẩu không đúng');
        }

    }

    public function logingv(Request $request){

        $request->validate([
            // 'matc' => 'required',
            'username' => 'required|min:8',
            'pass' => 'required'
        ],[
            // 'matc.required' => 'Mã tiêu chí bắt buộc phải nhập',
            'username.required' => 'Tên tài khoản bắt buộc phải nhập',
            'username.min' => 'Tên tài khoản phải từ :min ký tự trở lên',
            'pass.required' => 'Mật khẩu bắt buộc phải nhập',
        ]);


        $ten = $request->username;
        $mk = $request->pass;

        if (Auth::attempt(['tentk'=>$ten, 'password'=>$mk])) {
            // if (Auth::taikhoan()->ngdung === 'sv'){
                    $quyen = $this->taik->getquyen();
                    foreach($quyen as $item){
                        $quyennd = $item->ngdung;
                        $ten = $item->tentk;
                    }
                    // dd($quyennd,$ten);
                    if ($quyennd === 'gv'){
                        return redirect()->route('gv.xemdslop')->with('ten', $ten);
                    }else{
                        return redirect()->route('logingv')->with('msg', 'Tài khoản hoặc mật khẩu không đúng');
                    }
                    // return redirect()->route('home');
        }else{
            return redirect()->route('logingv')->with('msg', 'Tài khoản hoặc mật khẩu không đúng');
        }
    }


    public function logink(Request $request){

        $request->validate([
            // 'matc' => 'required',
            'username' => 'required|min:8',
            'pass' => 'required'
        ],[
            // 'matc.required' => 'Mã tiêu chí bắt buộc phải nhập',
            'username.required' => 'Tên tài khoản bắt buộc phải nhập',
            'username.min' => 'Tên tài khoản phải từ :min ký tự trở lên',
            'pass.required' => 'Mật khẩu bắt buộc phải nhập',
        ]);


        $ten = $request->username;
        $mk = $request->pass;

        if (Auth::attempt(['tentk'=>$ten, 'password'=>$mk])) {
            // if (Auth::taikhoan()->ngdung === 'sv'){
                    $quyen = $this->taik->getquyen();
                    foreach($quyen as $item){
                        $quyennd = $item->ngdung;
                        $ten = $item->tentk;
                    }
                    // dd($quyennd,$ten);
                    if ($quyennd === 'khoa'){
                        return redirect()->route('khoa.khoadslop')->with('ten', $ten);
                    }else{
                        return redirect()->route('logink')->with('msg', 'Tài khoản hoặc mật khẩu không đúng');
                    }
                    // return redirect()->route('home');
        }else{
            return redirect()->route('logink')->with('msg', 'Tài khoản hoặc mật khẩu không đúng');
        }

    }



    public function logind(Request $request){

        $request->validate([
            // 'matc' => 'required',
            'username' => 'required|min:8',
            'pass' => 'required'
        ],[
            // 'matc.required' => 'Mã tiêu chí bắt buộc phải nhập',
            'username.required' => 'Tên tài khoản bắt buộc phải nhập',
            'username.min' => 'Tên tài khoản phải từ :min ký tự trở lên',
            'pass.required' => 'Mật khẩu bắt buộc phải nhập',
        ]);


        $ten = $request->username;
        $mk = $request->pass;

        if (Auth::attempt(['tentk'=>$ten, 'password'=>$mk])) {
            // if (Auth::taikhoan()->ngdung === 'sv'){
                    $quyen = $this->taik->getquyen();
                    foreach($quyen as $item){
                        $quyennd = $item->ngdung;
                        $ten = $item->tentk;
                    }
                    // dd($quyennd,$ten);
                    if ($quyennd === 'doan'){
                        return redirect()->route('doan.doandslop')->with('ten', $ten);
                    }else{
                        return redirect()->route('logind')->with('msg', 'Tài khoản hoặc mật khẩu không đúng');
                    }
                    // return redirect()->route('home');
        }else{
            return redirect()->route('logind')->with('msg', 'Tài khoản hoặc mật khẩu không đúng');
        }

    }

    public function loginadmin(Request $request){

        $request->validate([
            // 'matc' => 'required',
            'username' => 'required|min:8',
            'pass' => 'required'
        ],[
            // 'matc.required' => 'Mã tiêu chí bắt buộc phải nhập',
            'username.required' => 'Tên tài khoản bắt buộc phải nhập',
            'username.min' => 'Tên tài khoản phải từ :min ký tự trở lên',
            'pass.required' => 'Mật khẩu bắt buộc phải nhập',
        ]);


        $ten = $request->username;
        $mk = $request->pass;


        if (Auth::attempt(['tentk'=>$ten, 'password'=>$mk])) {
            $quyen = $this->taik->getquyen();
            foreach($quyen as $item){
                $quyennd = $item->ngdung;
                $ten = $item->tentk;
            }
            // dd($quyennd,$ten);
            if ($quyennd === 'admin'){
                return redirect()->route('admin.homead',compact('ten'));

            }else{
                return redirect()->route('loginadmin')->with('msg', 'Tài khoản hoặc mật khẩu không đúng');
            }
        }else{
            return redirect()->route('loginadmin')->with('msg', 'Tài khoản hoặc mật khẩu không đúng');
        }

    }


    public function logout(Request $request){
        Auth::logout();


        return redirect()->route('home');
    }

    public function logoutgv(Request $request){
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('home');
    }


    public function logoutd(Request $request){
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('home');
    }

    public function logoutk(Request $request){
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('home');
    }

    public function logoutadmin(Request $request){
        Auth::logout();


        return redirect()->route('loginadmin');
    }

}
