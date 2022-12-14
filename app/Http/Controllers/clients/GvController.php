<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\clients\Minhchung;
use App\Models\clients\Lop;
use App\Models\clients\Taikhoan;
use App\Models\Phieucham;
use App\Models\Diem;
use App\Models\Phanhoi;
use App\Models\admin\Time;
use App\Models\clients\Sinhvien;

class GvController extends Controller
{
    private $lop;
    private $pc;
    private $diem;
    private $mc;
    private $tk;
    private $ph;
    private $tg;
    private $sv;
    public function __construct()
    {
        $this->lop = new Lop();
        $this->pc = new Phieucham();
        $this->diem = new Diem();
        $this->mc = new Minhchung();
        $this->tk = new Taikhoan();
        $this->ph = new Phanhoi();
        $this->tg = new Time();
        $this->sv = new Sinhvien();
    }
    public function index(Request $request){
        $title = 'Danh sách lớp quản lý(chấm điểm)';

        $lopList = $this->lop->getalldslop();
        // dd($lopList);
        return view('clients/gv/dslop', compact('title','lopList'));
    }

    public function getdssv(Request $request){
        $title = 'Danh sách sinh viên quản lý';
        $keywords = null;

        if(!empty($request->keywords)){
            $keywords = $request->keywords;
        }
        $idlop = $request->idloph;
        $svDetail =  $this->lop->getDetail($idlop,$keywords);

        return view('clients/gv/dssinhvien', compact('title', 'svDetail','idlop'));
    }

    public function gvcham(Request $request){
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
            $bd = $i->ngaygvbd;
            $kt = $i->ngaygvkt;
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

        $sv = $this->sv->getallsv($idsv);
        $pcList = $this->pc->getallpc($filters);
        $mcList = $this->mc->getallmc($filters,$idsv);
        // $max = $this->pc->getIDPC($filters);
        //  dd($namhoc);
        return view('clients/gv/gvcham', compact('title','sv','pcList','mcList','idsv','k'));

    }


    public function addDiem(Request $request){
        // $request->validate([
        //         'svd' => ['required','integer',function($attribute, $value, $fail){
        //             for($i = 0;$i<count($value);$i++ ){
        //             $diemmax= $this->pc->getIDPCgv();
        //             // dd($diemmax);
        //             foreach ($diemmax as $item){
        //                 $diem[$i] = $item->diemmax;
        //                }
        //             // dd($diem[$i]);
        //             if($value>$diem[$i]&&$value<0){
        //                 $fail('Điểm nhập vào đã vượt quá điểm tối đa hoặc nhỏ hơn 0');
        //             }
        //             }
        //         }],
        //     ],[
        //         'svd.required' => 'Điểm tối đa bắt buộc phải nhập',
        //         'svd.integer' => 'Điểm tối đa bắt buộc phải là số nguyên',
        //     ]);
        // $diemmax= $this->pc->getIDPC();
        // dd($diemmax);
            $idsv = $request->idsv;
            $idp = $request->idp;
            $svd = $request->svd;

            // dd($idp,$svd,$idsv);

            for($i = 0;$i<count($idp);$i++ ){
                            $diemsv =[
                            'idpcd' =>  $idp[$i],
                            'gvdiem' => $svd[$i],
                            'diemdat' => $svd[$i],
                            'idsv' => $idsv,
                        ];
                        // dd($diemsv);
                        $this->diem->addDiem($diemsv);
            }
        return redirect()->route('gv.gvcham')->with('msg', 'Chấm điểm thành công!');
    }

    public function upLoadfile(Request $request){
        if(!empty($request->file)){
            $name = $request->file;
            return response()->download($name);
        }
    }
    public function dslop(){
        $title = 'Danh sách lớp quản lý (xem điểm)';

        $lopList = $this->lop->getalldslop();
        // dd($formList);
        return view('clients/gv/viewlop', compact('title','lopList'));
    }

    public function getlistsv(Request $request){
        $title = 'Danh sách sinh viên quản lý';

        $keywords = null;

        if(!empty($request->keywords)){
            $keywords = $request->keywords;
        }
        $idlop = $request->idloph;
        $svDetail =  $this->lop->getDetail($idlop,$keywords);
        return view('clients/gv/viewsv', compact('title', 'svDetail','idlop'));
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
        //  dd( $Tongsv);
        return view('clients/gv/gvxemdiem', compact('title','sv','dList','idsv','Tongdat','Tongsv','Tonggv','Tongkhoa','Tongdoan','Tongt','Tongmax'));

    }

    public function dslopph(){
        $title = 'Danh sách lớp';

        $lopList = $this->lop->getalldslop();
        // dd($formList);
        return view('clients/gv/phlop', compact('title','lopList'));
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

        $listtk = $this->tk->getidgv();
            foreach($listtk as $item){
                $idgv = $item->idgv;
            }


        $getallnam = getAllnam();
        $getallhk = getAllhocky();
        $phList = $this->ph->getallphsv($filters,$idgv);

        // dd($phList);

        return view('clients/gv/phsv', compact('title','phList','getallnam','getallhk'));
    }
    public function addPH(Request $request){
        $title = 'Phản hồi về điểm rèn luyện';

        $idph = $request->idph;

        $getallnam = getAllnam();
        $getallhk = getAllhocky();

        return view('clients/gv/phanhoi', compact('title','getallnam','getallhk','idph'));
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

        return redirect()->route('gv.guiph')->with('msg', 'Thêm phản hồi thành công!');
    }



    public function cvdslop(){
        $title = 'Danh sách lớp quản lý(Chức vụ)';

        $lopList = $this->lop->getalldslop();
        // dd($formList);
        return view('clients/gv/chucvu/cvlistlop', compact('title','lopList'));
    }

    public function cvlistSV(Request $request){
        $title = 'Danh sách sinh viên quản lý(Chức vụ)';


        $keywords = null;

        if(!empty($request->keywords)){
            $keywords = $request->keywords;
        }
        $idlop = $request->idloph;
        $svDetail =  $this->lop->getDetail($idlop,$keywords);
        // dd($svDetail);

        return view('clients/gv/chucvu/cvsvlist', compact('title', 'svDetail','idlop'));
    }

    public function upcvlistSV(Request $request){
        $title = 'Cập nhật chức vụ cho sinh viên';
        $idsv = $request->idsv;
        $idlop = $request->idloph;
        $sv = $this->sv->getallsv($idsv);
        $svCV =  $this->sv->chucvusv($idsv);

        return view('clients/gv/chucvu/chucvu', compact('title','sv','svCV','idsv','idlop'));
    }
    public function upchucvu(Request $request){
        // $request->validate([
        //     'chucvu' => 'required',
        // ],[
        //     'chucvu.required' => 'Chức vụ bắt buộc phải nhập',
        // ]);
        $idsv = $request->idsv;
        $cv = $request->chucvu;

        // dd($idsv,$cv);
        $this->sv->updatecv($idsv,$cv);
        return redirect()->route('gv.chucvulop')->with('msg', 'Cập nhật chức vụ thành công!');
    }

}
