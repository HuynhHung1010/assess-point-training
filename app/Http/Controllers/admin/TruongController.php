<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\clients\Lop;
use App\Models\clients\Sinhvien;
use App\Models\Phieucham;
use App\Models\Diem;
use App\Models\admin\Time;

class TruongController extends Controller
{
    private $lop;
    private $pc;
    private $diem;
    private $sv;
    private $tg;
    public function __construct()
    {
        $this->lop = new Lop();
        $this->pc = new Phieucham();
        $this->diem = new Diem();
        $this->sv = new Sinhvien();
        $this->tg = new Time();
    }
    public function index(){
        $title = 'Danh sách khoa';

        $khoaList = $this->lop->getallkhoa();
        // dd($formList);
        return view('admin/chamdiem/khoads', compact('title','khoaList'));
    }

    public function getdsgv(Request $request){
        $title = 'Danh sách giáo viên cố vấn học tập';


        $idkhoa = $request->idkhoa;
        $gvDetail =  $this->lop->getgv($idkhoa);

        return view('admin/chamdiem/gvds', compact('title', 'gvDetail'));
    }

    public function getlop(Request $request){
        $title = 'Danh sách lớp';

        $idgv = $request->idgv;
        $lopList = $this->lop->getalldslopad($idgv);
        // dd($formList);
        return view('admin/chamdiem/lopds', compact('title','lopList'));
    }


    public function getdssv(Request $request){
        $title = 'Danh sách sinh viên';

        $keywords = null;

        if(!empty($request->keywords)){
            $keywords = $request->keywords;
        }

        $idlop = $request->idloph;
        $svDetail =  $this->lop->getDetail($idlop,$keywords);

        return view('admin/chamdiem/dssv', compact('title', 'svDetail','idlop'));
    }

    public function pctsvcham(Request $request){
        $title = 'Phiếu chấm điểm rèn luyện';

        $idsv = $request->idsv;
        $filters = [];

        if(!empty($request->idnh)){
            $Idnh = $request->idnh;

            $filters[] = ['idnh', '=', $Idnh];

        }

        if(!empty($request->idhk)){
            $Idhk = $request->idhk;

            $filters[] = ['idhk', '=', $Idhk];

        }
        // $han = $this->tg->gettimecham($filters);
        // foreach($han as $i){
        //     $bd = $i->ngaygvbd;
        //     $kt = $i->ngaygvkt;
        // }
        // $now = date('Y-m-d');
        // if($kt >= $now && $now >= $bd){
        //     $k = 1;
        // }else{
        //     $k = 0;
        // }
        $getallnam = getAllnam();
        $getallhk = getAllhocky();
        $sv = $this->sv->getallsv($idsv);
        $pcList = $this->pc->getallpc($filters);
        // $diemtb = $this->diem->getDiemTB($filters,$idsv);
         $diemtb = $this->diem->getDTB($filters,$idsv);
        //  dd( $pcList);
        // dd($idsv);
        return view('admin/chamdiem/chamdiem', compact('title','sv','pcList','idsv','getallnam','getallhk','diemtb'));

    }

    public function addDiem(Request $request){
        // $request->validate([
        //     'svd' => ['required','integer',function($attribute, $value, $fail){
        //         //  for($i = 0;$i<count($value);$i++ ){
        //         // //     $diemmax = $this->pc->getdmax($idp[$i]);
        //         // //     foreach ($diemmax as $item){
        //         // //         $diem = $item->diemmax;
        //         // //     }
        //         // // }
        //         // if($value[$i]<0){
        //         //     $fail('Điểm nhập vào đã vượt quá điểm tối đa hoặc nhỏ hơn 0');
        //         // }
        //         // }
        //     }],
        // ],[
        //     'svd.required' => 'Điểm tối đa bắt buộc phải nhập',
        //     'svd.integer' => 'Điểm tối đa bắt buộc phải là số nguyên',
        // ]);
            $idsv = $request->idsv;
            $idp = $request->idp;
            $svd = $request->svd;
            for($i = 0;$i<count($idp);$i++ ){
                            $diemsv =[
                            'idpcd' =>  $idp[$i],
                            'pctdiem' => $svd[$i],
                            'diemdat' => $svd[$i],
                            'idsv' => $idsv,
                        ];
                        $this->diem->addDiem($diemsv);
            }
        return redirect()->route('admin.chamdiem')->with('msg', 'Chấm điểm thành công!');
    }

    public function dskhoa(){
        $title = 'Danh sách khoa';

        $khoaList = $this->lop->getallkhoa();
        return view('admin/chamdiem/viewkhoa', compact('title','khoaList'));
    }

    public function getdsgvd(Request $request){
        $title = 'Danh sách giáo viên cố vấn học tập';


        $idkhoa = $request->idkhoa;
        $gvDetail =  $this->lop->getgv($idkhoa);

        return view('admin/chamdiem/viewgv', compact('title', 'gvDetail'));
    }

    public function getlopd(Request $request){
        $title = 'Danh sách lớp';

        $idgv = $request->idgv;
        $lopList = $this->lop->getalldslopad($idgv);
        // dd($formList);
        return view('admin/chamdiem/viewlop', compact('title','lopList'));
    }

    public function getdssvd(Request $request){
        $title = 'Danh sách sinh viên';

        $keywords = null;

        if(!empty($request->keywords)){
            $keywords = $request->keywords;
        }

        $idlop = $request->idloph;
        $svDetail =  $this->lop->getDetail($idlop,$keywords);

        return view('admin/chamdiem/viewsv', compact('title', 'svDetail','idlop'));
    }

    public function xemDiemsv(Request $request){
        $title = 'Phiếu chấm điểm rèn luyện';

        $idsv = $request->idsv;

        // dd($idsv);

        $filters = [];

        if(!empty($request->idnh)){
            $Idnh = $request->idnh;

            $filters[] = ['idnh', '=', $Idnh];

        }

        if(!empty($request->idhk)){
            $Idhk = $request->idhk;

            $filters[] = ['idhk', '=', $Idhk];

        }

        $getallnam = getAllnam();
        $getallhk = getAllhocky();
        $sv = $this->sv->getallsv($idsv);
        $dList = $this->diem->getalldiem($filters,$idsv);
        // dd($dList);
        $Tongdat = $this->diem->getSUMdd($filters,$idsv);
        $Tongsv = $this->diem->getSUMsv($filters,$idsv);
        $Tonggv = $this->diem->getSUMgv($filters,$idsv);
        $Tongkhoa = $this->diem->getSUMkhoa($filters,$idsv);
        $Tongdoan = $this->diem->getSUMdoan($filters,$idsv);
        $Tongt = $this->diem->getSUMpct($filters,$idsv);
        $Tongmax = $this->diem->getSUMmax($filters,$idsv);
        //  dd( $pcList);
        return view('admin/chamdiem/xemdiem', compact('title','sv','getallnam','getallhk','dList','idsv','Tongdat','Tongsv','Tonggv','Tongkhoa','Tongdoan','Tongt','Tongmax'));

    }


}
