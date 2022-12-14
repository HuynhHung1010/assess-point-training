<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\clients\Lop;
use App\Models\clients\Sinhvien;
use App\Models\clients\Taikhoan;
use App\Models\Phieucham;
use App\Models\Diem;
use App\Models\Phanhoi;
use App\Models\admin\Time;

class KhoaController extends Controller
{
    private $lop;
    private $pc;
    private $diem;
    private $sv;
    private $tk;
    private $ph;
    private $tg;
    public function __construct()
    {
        $this->lop = new Lop();
        $this->pc = new Phieucham();
        $this->diem = new Diem();
        $this->sv = new Sinhvien();
        $this->tk = new Taikhoan();
        $this->ph = new Phanhoi();
        $this->tg = new Time();
    }
    public function index(Request $request){
        $title = 'Danh sách lớp quản lý(chấm điểm)';

        $lopList = $this->lop->getalldslopk();
        // dd($formList);
        return view('clients/khoa/dslop', compact('title','lopList'));
    }
    // public function dssv(){
    //     return view('clients/gv/dssinhvien');
    // }

    public function getdssv(Request $request){
        $title = 'Danh sách sinh viên quản lý';

        $keywords = null;

        if(!empty($request->keywords)){
            $keywords = $request->keywords;
        }

        $idlop = $request->idloph;
        $svDetail =  $this->lop->getDetail($idlop,$keywords) ;

        return view('clients/khoa/dssinhvien', compact('title', 'svDetail','idlop'));
    }

    public function khoacham(Request $request){
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
        $han = $this->tg->gettimecham($filters);
        foreach($han as $i){
            $bd = $i->ngaykbd;
            $kt = $i->ngaykkt;
        }
        $now = date('Y-m-d');
        if(!empty($bd) && !empty($kt)){
            if($kt >= $now && $now >= $bd){
                $k = 1;
            }else{
                $k = 0;
            }
        }else{
            $k = null;
        }
        $namhk = $this->pc->getnh();
        // dd($namhk);
        foreach($namhk as $item){
            $bd = $item->ngaybd;
            $kt = $item->ngaykt;
            $now = date('Y-m-d');

            if($kt >= $now && $now >= $bd){
                $idnam = $item->tennam;
                $idhocky = $item->tenhk;
            }else{

            }
        }
        $sv = $this->sv->getallsv($idsv);
        $pcList = $this->pc->getallpc($filters);
        return view('clients/khoa/khoacham', compact('title','sv','pcList','idsv','k','idnam','idhocky'));

    }

    public function addDiem(Request $request){
            $idsv = $request->idsv;
            $idp = $request->idp;
            $svd = $request->svd;

            for($i = 0;$i<count($idp);$i++ ){
                            $diemsv =[
                            'idpcd' =>  $idp[$i],
                            'khoadiem' => $svd[$i],
                            'diemdat' => $svd[$i],
                            'idsv' => $idsv,
                        ];
                        $this->diem->addDiem($diemsv);
            }
        return redirect()->route('khoa.khoacham')->with('msg', 'Chấm điểm thành công!');
    }

    public function dslop(){
        $title = 'Danh sách lớp quản lý(xem điểm)';

        $lopList = $this->lop->getalldslopk();
        // dd($formList);
        return view('clients/khoa/listlop', compact('title','lopList'));
    }
    // public function dssv(){
    //     return view('clients/gv/dssinhvien');
    // }

    public function listSV(Request $request){
        $title = 'Danh sách sinh viên quản lý';

        $keywords = null;

        if(!empty($request->keywords)){
            $keywords = $request->keywords;
        }
        $idlop = $request->idloph;
        $svDetail =  $this->lop->getDetail($idlop,$keywords);

        return view('clients/khoa/svlist', compact('title', 'svDetail','idlop'));
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

        $sv = $this->sv->getallsv($idsv);
        $dList = $this->diem->getalldiem($filters,$idsv);
        $Tongdat = $this->diem->getSUMdd($filters,$idsv);
        $Tongsv = $this->diem->getSUMsv($filters,$idsv);
        $Tonggv = $this->diem->getSUMgv($filters,$idsv);
        $Tongkhoa = $this->diem->getSUMkhoa($filters,$idsv);
        $Tongdoan = $this->diem->getSUMdoan($filters,$idsv);
        $Tongt = $this->diem->getSUMpct($filters,$idsv);
        $Tongmax = $this->diem->getSUMmax($filters,$idsv);
        //  dd( $pcList);
        return view('clients/khoa/khoaview', compact('title','sv','dList','idsv','Tongdat','Tongsv','Tonggv','Tongkhoa','Tongdoan','Tongt','Tongmax'));

    }

    public function cvdslop(){
        $title = 'Danh sách lớp quản lý(chức vụ)';

        $lopList = $this->lop->getalldslopk();
        // dd($formList);
        return view('clients/khoa/cvlistlop', compact('title','lopList'));
    }

    public function cvlistSV(Request $request){
        $title = 'Danh sách sinh viên quản lý';


        $keywords = null;

        if(!empty($request->keywords)){
            $keywords = $request->keywords;
        }
        $idlop = $request->idloph;
        $svDetail =  $this->lop->getDetail($idlop,$keywords);
        // dd($svDetail);

        return view('clients/khoa/cvsvlist', compact('title', 'svDetail','idlop'));
    }

    public function upcvlistSV(Request $request){
        $title = 'Cập nhật chức vụ cho sinh viên';
        $idsv = $request->idsv;
        $sv = $this->sv->getallsv($idsv);
        $svCV =  $this->sv->chucvusv($idsv);

        return view('clients/khoa/chucvu', compact('title','sv','svCV','idsv'));
    }
    public function upchucvu(Request $request){
        // $request->validate([
        //     'chucvu' => 'required',
        // ],[
        //     'chucvu.required' => 'Chức vụ bắt buộc phải nhập',
        // ]);
        $idsv = $request->idsv;
        $cvd = $request->chucvud;
        $cv = $request->chucvu;

        // dd($idsv,$cv);
        $this->sv->updatecvdoan($idsv,$cvd);
        $this->sv->updatecv($idsv,$cv);
        return redirect()->route('khoa.chucvulop')->with('msg', 'Cập nhật chức vụ thành công!');
    }

    public function getlistsvph(Request $request){
        $title = 'Danh sách sinh viên Phản hồi về điểm rèn luyện';

            $filters = [];

            if(!empty($request->idnh)){
                $Idnh = $request->idnh;

                $filters[] = ['idnh', '=', $Idnh];

            }

            if(!empty($request->idhk)){
                $Idhk = $request->idhk;

                $filters[] = ['idhk', '=', $Idhk];

        }

        $listtk = $this->tk->getidkhoa();
            foreach($listtk as $item){
                $idk = $item->idk;
            }


        $getallnam = getAllnam();
        $getallhk = getAllhocky();
        $phList = $this->ph->getallphsvk($filters,$idk);

        // dd($phList);

        return view('clients/khoa/svph', compact('title','phList','getallnam','getallhk'));
    }
    public function addPH(Request $request){
        $title = 'Phản hồi về điểm rèn luyện';

        $idph = $request->idph;

        $getallnam = getAllnam();
        $getallhk = getAllhocky();

        return view('clients/khoa/phanhoi', compact('title','getallnam','getallhk','idph'));
    }

    public function postaddPH(Request $request){
        $request->validate([
            // 'matc' => 'required',
            // 'idnh' => ['required','integer',function($attribute, $value, $fail){
            //     if($value==0){
            //         $fail('Bắt buộc phải chọn năm học');
            //     }
            // }],
            // 'idhk' => ['required','integer',function($attribute, $value, $fail){
            //     if($value==0){
            //         $fail('Bắt buộc phải chọn học kỳ');
            //     }
            // }],
            'phanhoi' => 'required'
        ],[
            // 'idnh.integer' => 'Năm không hợp lệ',
            // 'idnh.required' => 'Năm không được để trống',
            // 'idnh.integer' => 'Học kỳ không hợp lệ',
            // 'idnh.required' => 'Học kỳ không được để trống',
            'phanhoi.required' => 'Phản hồi bắt buộc phải nhập',
        ]);
        $idph = $request->idph;
        $phInsert = [
           'traloi' => $request->phanhoi,
           'ngaytl' => date('Y-m-d H:i:s')
        ];
        // dd($TimeInsert);
        $this->ph->updateph($phInsert,$idph);

        return redirect()->route('khoa.guiph')->with('msg', 'Thêm phản hồi thành công!');
    }

}
