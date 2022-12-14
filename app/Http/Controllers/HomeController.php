<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\admin\Tintuc;

class HomeController extends Controller
{
    private $tt;
    public function __construct()
    {
        $this->tt = new Tintuc();
    }
    public function index(){
        $ttList = $this->tt->getalltt();
        return view('clients/home',compact('ttList'));
    }

    public function tintuc(Request $request){
        $title = 'THÔNG BÁO';
        $idtt = $request->id;
        $ttList = $this->tt->getalltt();
        $ttbList = $this->tt->getalltb($idtt);
        return view('clients/thongbao',compact('title','ttbList','ttList'));
    }

}
