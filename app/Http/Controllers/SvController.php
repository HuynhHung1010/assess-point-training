<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\Phieucham;

use App\Models\Diem;

use App\Models\clients\Taikhoan;

use App\Models\clients\Minhchung;

use App\Models\clients\Sinhvien;

use App\Models\admin\Time;

class SvController extends Controller
{
    private $pc;
    private $diem;
    private $tk;
    private $mc;
    private $sv;
    private $tg;
    public function __construct()
    {
        $this->pc = new Phieucham();
        $this->diem = new Diem();
        $this->tk = new Taikhoan();
        $this->mc = new Minhchung();
        $this->sv = new Sinhvien();
        $this->tg = new Time();
    }
    public function index(){
        return view('clients/sv/bieumau');
    }

    public function svcham(Request $request){
        $title = 'Phiếu chấm điểm rèn luyện';

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
            $bd = $i->ngaysvbd;
            $kt = $i->ngaysvkt;
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
        $listtk = $this->tk->getidsv();
            foreach($listtk as $item){
                $idsv = $item->idsv;
            }
        $sv = $this->sv->getallsv($idsv);
        $pcList = $this->pc->getallpc($filters);
        //  dd( $pcList);
        return view('clients/sv/bieumau', compact('title','sv','pcList','k'));

    }

    public function addDiem(Request $request){
        // $request->validate([
        //         // 'svd' => ['required','integer',function($attribute, $value, $fail){
        //         //     for($i = 0;$i<count($value);$i++ ){
        //         //     $diemmax= $this->pc->getIDPCsv();
        //         //     // dd($diemmax);
        //         //     foreach ($diemmax as $item){
        //         //         $diem[$i] = $item->diemmax;
        //         //        }
        //         //     // dd($diem[$i]);
        //         //     if($value>$diem[$i]&&$value<0){
        //         //         $fail('Điểm nhập vào đã vượt quá điểm tối đa hoặc nhỏ hơn 0');
        //         //     }
        //         //     }
        //         // }],
        //         'svd' => 'required|integer'
        //     ],[
        //         'svd.required' => 'Điểm tối đa bắt buộc phải nhập',
        //         'svd.integer' => 'Điểm tối đa bắt buộc phải là số nguyên',
        //      ]);
        // $diemmax= $this->pc->getIDPCsv();
        // dd($diemmax);
            $idp = $request->idp;
            $svd = $request->svd;
            // $idsv = Auth::id();
            // $idsv = getidsv($idnd);
            $listtk = $this->tk->getidsv();
            foreach($listtk as $item){
                $idsv = $item->idsv;
            }
            for($i = 0;$i<count($idp);$i++ ){
                            $diemsv =[
                            'idpcd' =>  $idp[$i],
                            'svdiem' => $svd[$i],
                            'diemdat' => $svd[$i],
                            'idsv' => $idsv,
                        ];
                        $this->diem->addDiem($diemsv);
            }
        return redirect()->route('sv.chamdiemsv')->with('msg', 'Chấm điểm thành công!');
    }

    public function svViewdiem(Request $request){
        $title = 'Phiếu chấm điểm rèn luyện';

        $filters = [];

        if(!empty($request->idnh)){
            $Idnh = $request->idnh;

            $filters[] = ['idnh', '=', $Idnh];

        }

        if(!empty($request->idhk)){
            $Idhk = $request->idhk;

            $filters[] = ['idhk', '=', $Idhk];

        }
        $listtk = $this->tk->getidsv();
        foreach($listtk as $item){
            $idsv = $item->idsv;
        }
        // dd($idsv);
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
        return view('clients/sv/xemdiem', compact('title','sv','dList','Tongdat','Tongsv','Tonggv','Tongkhoa','Tongdoan','Tongt','Tongmax'));

    }

    public function svtaiFile(){
        $title = 'Tải minh chứng';

        $getallnam = getAllnam();
        $getallhk = getAllhocky();

        return view('clients/sv/taifile', compact('title','getallnam','getallhk'));
    }

    public function upLoadfile(Request $request){

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
            'tenmc' => 'required',
            'file' => 'required'
        ],[
            'idnh.integer' => 'Năm không hợp lệ',
            'idnh.required' => 'Năm không được để trống',
            'idhk.integer' => 'Học kỳ không hợp lệ',
            'idhk.required' => 'Học kỳ không được để trống',
            'tenmc.required' => 'Tên minh chứng bắt buộc phải nhập',
            'file.required' => 'File không được để trống',
        ]);

        if(!empty($request->file)){
            $idnh = $request->idnh;
            $idhk = $request->idhk;
            $tenmc = $request->tenmc;
            // dd($tenmc,$file);
            // $file = trim($request->file);
            // $filename = basename($file);
            $name = $request->file->getClientOriginalName();
            $request->file->storeAs('public',$name);
            // dd($idnh,$idhk,$tenmc,$name);
            $this->mc->addFile($tenmc,$name,$idnh,$idhk);
            return redirect()->route('sv.taiminhchung')->with('msg', 'Tải minh chứng thành công');
        }else{
            return redirect()->route('sv.taiminhchung')->with('msg', 'Tải minh chứng không thành công!');
        }
    }

    public function svPhanhoi(Request $request){
        $title = 'Phản hồi về điểm rèn luyện';

        $listtk = $this->tk->getidsv();
            foreach($listtk as $item){
                $idsv = $item->idsv;
            }
        $filters = [];

        if(!empty($request->idnh)){
            $Idnh = $request->idnh;

            $filters[] = ['idnh', '=', $Idnh];

        }

        if(!empty($request->idhk)){
            $Idhk = $request->idhk;

            $filters[] = ['idhk', '=', $Idhk];
        }

        $han = $this->tg->gethanphanhoi($filters);
        foreach($han as $h){
            $bd = $h->ngaybd;
            $kt = $h->ngaykt;
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

        $getallnam = getAllnam();
        $getallhk = getAllhocky();
        $phList = $this->sv->getallph($idsv,$filters);

        return view('clients/sv/phanhoi', compact('title','phList','getallnam','getallhk','idsv','k'));
    }

    public function svphanhoiGV(Request $request){
        $request->validate([
            'phanhoi' => 'required'
        ],[
            'phanhoi.required' => 'Phản hồi bắt buộc phải nhập',
        ]);
            $ph = $request->phanhoi;
            $id = $request->idsv;
            $gv = 1;
            $ngph = date('Y-m-d H:i:s');
            // dd($TimeInsert);
            $this->sv->addphgv($ph,$id,$gv,$ngph);
            return redirect()->route('sv.phanhoig')->with('msg', 'Thêm phản hồi thành công!');
    }



    public function svPhanhoidkhoa(Request $request){
        $title = 'Phản hồi về điểm rèn luyện';

        $listtk = $this->tk->getidsv();
            foreach($listtk as $item){
                $idsv = $item->idsv;
            }
            $filters = [];

            if(!empty($request->idnh)){
                $Idnh = $request->idnh;

                $filters[] = ['idnh', '=', $Idnh];

            }

            if(!empty($request->idhk)){
                $Idhk = $request->idhk;

                $filters[] = ['idhk', '=', $Idhk];

        }

        $han = $this->tg->gethanphanhoi($filters);
        foreach($han as $h){
            $bd = $h->ngaybd;
            $kt = $h->ngaykt;
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

        $getallnam = getAllnam();
        $getallhk = getAllhocky();
        $phList = $this->sv->getallphdkhoa($idsv,$filters);

        return view('clients/sv/phdoan', compact('title','phList','getallnam','getallhk','idsv','k'));
    }

    public function svphanhoidk(Request $request){
        $request->validate([
            'phanhoi' => 'required'
        ],[
            'phanhoi.required' => 'Phản hồi bắt buộc phải nhập',
        ]);
        $ph = $request->phanhoi;
        $id = $request->idsv;
        $gv = 1;
        $ngph = date('Y-m-d H:i:s');
        // dd($TimeInsert);
        $this->sv->addphd($ph,$id,$gv,$ngph);

        return redirect()->route('sv.phanhoidk')->with('msg', 'Thêm phản hồi thành công!');
    }





    public function svPhanhoikhoa(Request $request){
        $title = 'Phản hồi về điểm rèn luyện';

        $listtk = $this->tk->getidsv();
            foreach($listtk as $item){
                $idsv = $item->idsv;
            }
            $filters = [];

            if(!empty($request->idnh)){
                $Idnh = $request->idnh;

                $filters[] = ['idnh', '=', $Idnh];

            }

            if(!empty($request->idhk)){
                $Idhk = $request->idhk;

                $filters[] = ['idhk', '=', $Idhk];

        }

        $han = $this->tg->gethanphanhoi($filters);
        foreach($han as $h){
            $bd = $h->ngaybd;
            $kt = $h->ngaykt;
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
        $getallnam = getAllnam();
        $getallhk = getAllhocky();
        $phList = $this->sv->getallphkhoa($idsv,$filters);

        return view('clients/sv/phkhoa', compact('title','phList','getallnam','getallhk','idsv','k'));
    }

    public function svphanhoiK(Request $request){
        $request->validate([
            'phanhoi' => 'required'
        ],[
            'phanhoi.required' => 'Phản hồi bắt buộc phải nhập',
        ]);
        $ph = $request->phanhoi;
        $id = $request->idsv;
        $gv = 1;
        $ngph = date('Y-m-d H:i:s');
        // dd($TimeInsert);
        $this->sv->addphk($ph,$id,$gv,$ngph);

        return redirect()->route('sv.phanhoikhoa')->with('msg', 'Thêm phản hồi thành công!');
    }


    public function svPhanhoitr(Request $request){
        $title = 'Phản hồi về điểm rèn luyện';

        $listtk = $this->tk->getidsv();
            foreach($listtk as $item){
                $idsv = $item->idsv;
            }

            // $listtk = $this->tk->getidsv();
            // foreach($listtk as $item){
            //     $idsv = $item->idsv;
            // }
            $filters = [];

            if(!empty($request->idnh)){
                $Idnh = $request->idnh;

                $filters[] = ['idnh', '=', $Idnh];

            }

            if(!empty($request->idhk)){
                $Idhk = $request->idhk;

                $filters[] = ['idhk', '=', $Idhk];

        }
        $han = $this->tg->gethanphanhoi($filters);
        foreach($han as $h){
            $bd = $h->ngaybd;
            $kt = $h->ngaykt;
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
        $getallnam = getAllnam();
        $getallhk = getAllhocky();
        $phList = $this->sv->getallphtr($idsv,$filters);

        return view('clients/sv/phpct', compact('title','phList','getallnam','getallhk','idsv','k'));
    }

    public function svphanhoipct(Request $request){
        $request->validate([
            'phanhoi' => 'required'
        ],[
            'phanhoi.required' => 'Phản hồi bắt buộc phải nhập',
        ]);
        $ph = $request->phanhoi;
        $id = $request->idsv;
        $gv = 1;
        $ngph = date('Y-m-d H:i:s');
        // dd($TimeInsert);
        $this->sv->addphpct($ph,$id,$gv,$ngph);

        return redirect()->route('sv.phanhoitruong')->with('msg', 'Thêm phản hồi thành công!');
    }

}
