<?php

namespace App\Http\Controllers\admin;

use App\Models\Diem;
use App\Models\Years;

use Illuminate\Http\Request;

use App\Exports\TonghopExport;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\GVtonghopExport;
use App\Exports\DoantonghopExport;
use App\Exports\KhoatonghopExport;
use App\Http\Controllers\Controller;
use App\Models\clients\Lop;
use Maatwebsite\Excel\Facades\Excel;


class TonghopController extends Controller
{
    private $diem;
    private $nam;
    private $lop;
    public function __construct()
    {
        $this->diem = new Diem();
        $this->nam = new Years();
        $this->lop = new Lop();
    }
//pctsv tong hop diem
    public function index(Request $request){
        $title = 'Tổng hợp điểm rèn luyện của sinh viên';

        $filters = [];

        if(!empty($request->idnh)){
            $Idnh = $request->idnh;

            $filters[] = ['idnh', '=', $Idnh];

        }

        if(!empty($request->idhk)){
            $Idhk = $request->idhk;

            $filters[] = ['idhk', '=', $Idhk];

        }

        if(!empty($request->idkhoa)){
            $Idkhoa = $request->idkhoa;

            $filters[] = ['idkhoa', '=', $Idkhoa];

        }

        if(!empty($request->idlop)){
            $Idlop = $request->idlop;

            $filters[] = ['lop.id', '=', $Idlop];

        }

        if(!empty($request->idgv)){
            $Idgv = $request->idgv;

            $filters[] = ['idgv', '=', $Idgv];

        }

        if(!empty($request->idkhoahoc)){
            $Idkhoahoc = $request->idkhoahoc;

            $filters[] = ['idnienkhoa', '=', $Idkhoahoc];

        }


        $getallnam = getAllnam();
        $getallhk = getAllhocky();

        $getkhoa = getkhoa();
        $getgv = getgv();
        $getlop = getlop();
        $getnk = getnk();

        $nh = $request->idnh;
        $hk = $request->idhk;
        $khoa = $request->idkhoa;
        $lop = $request->idlop;
        $gv = $request->idgv;
        $khoahoc = $request->idkhoahoc;
        // $slpage = $request->trang;
        //  dd($slpage);
        $thList = $this->diem->gettonghop($filters);
        // $Tongdat = $this->diem->getthdat($filters);
        // dd($thList);
        return view('admin/tonghop/view', compact('title','thList','nh','hk','khoa','lop','gv','khoahoc','getallnam','getallhk','getkhoa','getgv','getlop','getnk'));
    }

    // public function exportPDF(Request $request){
    //     $title = 'Tổng hợp điểm rèn luyện của sinh viên';

    //     $keywords = null;


    //     if(!empty($request->keywords)){
    //         $keywords = $request->keywords;
    //     }

    //     $idnh = null;
    //     $tennamhoc = null;


    //     if(!empty( $request->nh)){
    //         $idnh = $request->nh;
    //         $namenh = $this->nam->namenam($idnh);
    //         foreach($namenh as $item){
    //             $tennamhoc = $item->tennam;
    //         }
    //     }

    //     $idhk = null;
    //     $tenhocky = null;

    //     if(!empty($request->hk)){
    //         $idhk = $request->hk;
    //         $namehk = $this->nam->namehk($idhk);
    //         foreach($namehk as $i){
    //             $tenhocky = $i->tenhk;
    //         }
    //     }

    //     $idkhoa = null;
    //     $tenkhoa = null;

    //     if(!empty($request->khoa)){
    //         $idkhoa = $request->khoa;
    //         $namekhoa = $this->lop->getnamekhoa($idkhoa);
    //         foreach($namekhoa as $k){
    //             $tenkhoa = $k->tenkhoa;
    //         }
    //     }


    //     // dd($keywords,$tennamhoc,$tenhocky);
    //     $thList = $this->diem->gettonghopPDF($idnh,$idhk,$keywords);
    //     // dd($thList);
    //     Pdf::setOption(['dpi' => 150, 'defaultFont' => 'Times New Roman']);
    //     $pdf = Pdf::loadView('admin.tonghop.pdf.tonghop',[
    //         'thList' => $thList,
    //         'title'  => $title,
    //         'tukhoa' => $keywords,
    //         'namhoc' =>  $tennamhoc,
    //         'hocky' => $tenhocky
    //     ]);
    //     return $pdf->download('tonghop.pdf');
    // }

    public function exportEX(Request $request){
        $title = 'Tổng hợp điểm rèn luyện của sinh viên';

        $idnh = null;
        $tennamhoc = null;

        if(!empty( $request->nh)){
            $idnh = $request->nh;
            $namenh = $this->nam->namenam($idnh);
            foreach($namenh as $item){
                $tennamhoc = $item->tennam;
            }
        }

        $idhk = null;
        $tenhocky = null;

        if(!empty($request->hk)){
            $idhk = $request->hk;
            $namehk = $this->nam->namehk($idhk);
            foreach($namehk as $i){
                $tenhocky = $i->tenhk;
            }
        }

        $idkhoa = null;
        $tenkhoa = null;

        if(!empty($request->khoa)){
            $idkhoa = $request->khoa;
            $namekhoa = $this->lop->getnamekhoa($idkhoa);
            foreach($namekhoa as $k){
                $tenkhoa = $k->tenkhoa;
            }
        }

        $idlop = null;
        $tenlop = null;

        if(!empty($request->lop)){
            $idlop = $request->lop;
            $namelop = $this->lop->getnamelop($idlop);
            foreach($namelop as $l){
                $tenlop = $l->tenlop;
            }
        }

        $idgv = null;
        $tengv = null;

        if(!empty($request->gv)){
            $idgv = $request->gv;
            $namegv = $this->lop->getnamegv($idgv);
            foreach($namegv as $gv){
                $tengv = $gv->hotengv;
            }
        }
        $idkhoahoc = null;
        $tenkhoahoc = null;

        if(!empty($request->khoahoc)){
            $idkhoahoc = $request->khoahoc;
            $namekhoahoc = $this->lop->getnamekhoahoc($idkhoahoc);
            foreach($namekhoahoc as $nk){
                $tenkhoahoc = $nk->khoahoc;
            }
        }

        // dd($keywords,$idnh,$idhk);
        $thList = $this->diem->gettonghopPDF($idnh,$idhk,$idkhoa,$idlop,$idgv,$idkhoahoc);
        return (new TonghopExport($thList,$title,$tennamhoc,$tenhocky,$tenkhoa,$tenlop,$tengv,$tenkhoahoc))->download('tonghop.xlsx', \Maatwebsite\Excel\Excel::XLSX);
        // return Excel::download(new TonghopExport($thList), 'tonghop.xlsx');

    }




//khoa tong hop diem

    public function khoaview(Request $request){
        $title = 'Tổng hợp điểm rèn luyện của sinh viên';


        $filters = [];

        if(!empty($request->idnh)){
            $Idnh = $request->idnh;

            $filters[] = ['idnh', '=', $Idnh];

        }

        if(!empty($request->idhk)){
            $Idhk = $request->idhk;

            $filters[] = ['idhk', '=', $Idhk];

        }


        if(!empty($request->idlop)){
            $Idlop = $request->idlop;

            $filters[] = ['lop.id', '=', $Idlop];

        }

        if(!empty($request->idgv)){
            $Idgv = $request->idgv;

            $filters[] = ['idgv', '=', $Idgv];

        }

        if(!empty($request->idkhoahoc)){
            $Idkhoahoc = $request->idkhoahoc;

            $filters[] = ['idnienkhoa', '=', $Idkhoahoc];

        }

        $getallnam = getAllnam();
        $getallhk = getAllhocky();


        $getgv = getgvkhoa();
        $getlop = getlopkhoa();
        $getnk = getnk();


        $nh = $request->idnh;
        $hk = $request->idhk;
        $lop = $request->idlop;
        $gv = $request->idgv;
        $khoahoc = $request->idkhoahoc;
        // dd($filters);
        $thList = $this->diem->gettonghopkhoa($filters);
        // $Tongdat = $this->diem->getthdat($filters);
        // dd($thList);
        return view('clients/khoa/tonghop/view', compact('title','thList','nh','hk','lop','gv','khoahoc','getallnam','getallhk','getgv','getlop','getnk'));
    }

    // public function kexportPDF(Request $request){
    //     $title = 'Tổng hợp điểm rèn luyện của sinh viên';

    //     $keywords = null;


    //     if(!empty($request->keywords)){
    //         $keywords = $request->keywords;
    //     }

    //     $idnh = null;
    //     $tennamhoc = null;


    //     if(!empty( $request->nh)){
    //         $idnh = $request->nh;
    //         $namenh = $this->nam->namenam($idnh);
    //         foreach($namenh as $item){
    //             $tennamhoc = $item->tennam;
    //         }
    //     }

    //     $idhk = null;
    //     $tenhocky = null;

    //     if(!empty($request->hk)){
    //         $idhk = $request->hk;
    //         $namehk = $this->nam->namehk($idhk);
    //         foreach($namehk as $i){
    //             $tenhocky = $i->tenhk;
    //         }
    //     }

    //     // dd($keywords,$tennamhoc,$tenhocky);
    //     $thList = $this->diem->khoagettonghopPDF($idnh,$idhk,$keywords);
    //     // dd($thList);
    //     Pdf::setOption(['dpi' => 150, 'defaultFont' => 'Times New Roman']);
    //     $pdf = Pdf::loadView('clients.khoa.tonghop.pdf',[
    //         'thList' => $thList,
    //         'title'  => $title,
    //         'tukhoa' => $keywords,
    //         'namhoc' =>  $tennamhoc,
    //         'hocky' => $tenhocky
    //     ]);
    //     return $pdf->download('tonghop.pdf');
    // }

    public function kexportEX(Request $request){
        $title = 'Tổng hợp điểm rèn luyện của sinh viên';



        $idnh = null;
        $tennamhoc = null;

        if(!empty( $request->nh)){
            $idnh = $request->nh;
            $namenh = $this->nam->namenam($idnh);
            foreach($namenh as $item){
                $tennamhoc = $item->tennam;
            }
        }

        $idhk = null;
        $tenhocky = null;

        if(!empty($request->hk)){
            $idhk = $request->hk;
            $namehk = $this->nam->namehk($idhk);
            foreach($namehk as $i){
                $tenhocky = $i->tenhk;
            }
        }

        $idlop = null;
        $tenlop = null;

        if(!empty($request->lop)){
            $idlop = $request->lop;
            $namelop = $this->lop->getnamelop($idlop);
            foreach($namelop as $l){
                $tenlop = $l->tenlop;
            }
        }

        $idgv = null;
        $tengv = null;

        if(!empty($request->gv)){
            $idgv = $request->gv;
            $namegv = $this->lop->getnamegv($idgv);
            foreach($namegv as $gv){
                $tengv = $gv->hotengv;
            }
        }
        $idkhoahoc = null;
        $tenkhoahoc = null;

        if(!empty($request->khoahoc)){
            $idkhoahoc = $request->khoahoc;
            $namekhoahoc = $this->lop->getnamekhoahoc($idkhoahoc);
            foreach($namekhoahoc as $nk){
                $tenkhoahoc = $nk->khoahoc;
            }
        }


        // dd($keywords,$idnh,$idhk);
        $thList = $this->diem->khoagettonghopPDF($idnh,$idhk,$idlop,$idgv,$idkhoahoc);
        // dd($thList);
        return (new KhoatonghopExport($thList,$title,$tennamhoc,$tenhocky,$tenlop,$tengv,$tenkhoahoc))->download('tonghop.xlsx', \Maatwebsite\Excel\Excel::XLSX);
        // return Excel::download(new TonghopExport($thList), 'tonghop.xlsx');

    }





//doan tong hop diem

    public function doanview(Request $request){
        $title = 'Tổng hợp điểm rèn luyện của sinh viên';

        $filters = [];

        if(!empty($request->idnh)){
            $Idnh = $request->idnh;

            $filters[] = ['idnh', '=', $Idnh];

        }

        if(!empty($request->idhk)){
            $Idhk = $request->idhk;

            $filters[] = ['idhk', '=', $Idhk];

        }

        if(!empty($request->idlop)){
            $Idlop = $request->idlop;

            $filters[] = ['lop.id', '=', $Idlop];

        }


        if(!empty($request->idkhoahoc)){
            $Idkhoahoc = $request->idkhoahoc;

            $filters[] = ['idnienkhoa', '=', $Idkhoahoc];

        }

        $getallnam = getAllnam();
        $getallhk = getAllhocky();

        $getlop = getlopdoan();
        $getnk = getnk();

        $nh = $request->idnh;
        $hk = $request->idhk;
        $lop = $request->idlop;
        $khoahoc = $request->idkhoahoc;
        // dd($filters);
        $thList = $this->diem->gettonghopdoan($filters);
        // $Tongdat = $this->diem->getthdat($filters);
        // dd($thList);
        return view('clients/doan/tonghop/view', compact('title','thList','nh','hk','lop','khoahoc','getallnam','getallhk','getlop','getnk'));
    }


    // public function dexportPDF(Request $request){
    //     $title = 'Tổng hợp điểm rèn luyện của sinh viên';

    //     $keywords = null;


    //     if(!empty($request->keywords)){
    //         $keywords = $request->keywords;
    //     }

    //     $idnh = null;
    //     $tennamhoc = null;


    //     if(!empty( $request->nh)){
    //         $idnh = $request->nh;
    //         $namenh = $this->nam->namenam($idnh);
    //         foreach($namenh as $item){
    //             $tennamhoc = $item->tennam;
    //         }
    //     }

    //     $idhk = null;
    //     $tenhocky = null;

    //     if(!empty($request->hk)){
    //         $idhk = $request->hk;
    //         $namehk = $this->nam->namehk($idhk);
    //         foreach($namehk as $i){
    //             $tenhocky = $i->tenhk;
    //         }
    //     }

    //     // dd($keywords,$tennamhoc,$tenhocky);
    //     $thList = $this->diem->doangettonghopPDF($idnh,$idhk,$keywords);
    //     // dd($thList);
    //     Pdf::setOption(['dpi' => 150, 'defaultFont' => 'Times New Roman']);
    //     $pdf = Pdf::loadView('clients.doan.tonghop.pdf',[
    //         'thList' => $thList,
    //         'title'  => $title,
    //         'tukhoa' => $keywords,
    //         'namhoc' =>  $tennamhoc,
    //         'hocky' => $tenhocky
    //     ]);
    //     return $pdf->download('tonghop.pdf');
    // }

    public function dexportEX(Request $request){
        $title = 'Tổng hợp điểm rèn luyện của sinh viên';

        $idnh = null;
        $tennamhoc = null;

        if(!empty( $request->nh)){
            $idnh = $request->nh;
            $namenh = $this->nam->namenam($idnh);
            foreach($namenh as $item){
                $tennamhoc = $item->tennam;
            }
        }

        $idhk = null;
        $tenhocky = null;

        if(!empty($request->hk)){
            $idhk = $request->hk;
            $namehk = $this->nam->namehk($idhk);
            foreach($namehk as $i){
                $tenhocky = $i->tenhk;
            }
        }
        // dd($tenhocky);
        $idlop = null;
        $tenlop = null;

        if(!empty($request->lop)){
            $idlop = $request->lop;
            $namelop = $this->lop->getnamelop($idlop);
            foreach($namelop as $l){
                $tenlop = $l->tenlop;
            }
        }

        $idkhoahoc = null;
        $tenkhoahoc = null;

        if(!empty($request->khoahoc)){
            $idkhoahoc = $request->khoahoc;
            $namekhoahoc = $this->lop->getnamekhoahoc($idkhoahoc);
            foreach($namekhoahoc as $nk){
                $tenkhoahoc = $nk->khoahoc;
            }
        }
        // dd($keywords,$idnh,$idhk);
        $thList = $this->diem->doangettonghopPDF($idnh,$idhk,$idlop,$idkhoahoc);
        return (new DoantonghopExport($thList,$title,$tennamhoc,$tenhocky,$tenlop,$tenkhoahoc))->download('tonghop.xlsx', \Maatwebsite\Excel\Excel::XLSX);
        // return Excel::download(new TonghopExport($thList), 'tonghop.xlsx');

    }





//gvcv tong hop diem

    public function gvview(Request $request){
        $title = 'Tổng hợp điểm rèn luyện của sinh viên';

        $filters = [];

        if(!empty($request->idnh)){
            $Idnh = $request->idnh;

            $filters[] = ['idnh', '=', $Idnh];

        }

        if(!empty($request->idhk)){
            $Idhk = $request->idhk;

            $filters[] = ['idhk', '=', $Idhk];

        }

        if(!empty($request->idlop)){
            $Idlop = $request->idlop;

            $filters[] = ['lop.id', '=', $Idlop];

        }


        if(!empty($request->idkhoahoc)){
            $Idkhoahoc = $request->idkhoahoc;

            $filters[] = ['idnienkhoa', '=', $Idkhoahoc];

        }

        $getallnam = getAllnam();
        $getallhk = getAllhocky();

        $getlop = getlopgv();
        $getnk = getnk();

        $nh = $request->idnh;
        $hk = $request->idhk;
        $lop = $request->idlop;
        $khoahoc = $request->idkhoahoc;

        $thList = $this->diem->gettonghopgv($filters);
        // $Tongdat = $this->diem->getthdat($filters);
        // dd($thList);
        return view('clients/gv/tonghop/view', compact('title','thList','nh','hk','lop','khoahoc','getallnam','getallhk','getlop','getnk'));
    }

    // public function gvexportPDF(Request $request){
    //     $title = 'Tổng hợp điểm rèn luyện của sinh viên';

    //     $keywords = null;


    //     if(!empty($request->keywords)){
    //         $keywords = $request->keywords;
    //     }

    //     $idnh = null;
    //     $tennamhoc = null;


    //     if(!empty( $request->nh)){
    //         $idnh = $request->nh;
    //         $namenh = $this->nam->namenam($idnh);
    //         foreach($namenh as $item){
    //             $tennamhoc = $item->tennam;
    //         }
    //     }

    //     $idhk = null;
    //     $tenhocky = null;

    //     if(!empty($request->hk)){
    //         $idhk = $request->hk;
    //         $namehk = $this->nam->namehk($idhk);
    //         foreach($namehk as $i){
    //             $tenhocky = $i->tenhk;
    //         }
    //     }

    //     // dd($keywords,$tennamhoc,$tenhocky);
    //     $thList = $this->diem->gvgettonghopPDF($idnh,$idhk,$keywords);
    //     // dd($thList);
    //     Pdf::setOption(['dpi' => 150, 'defaultFont' => 'Times New Roman']);
    //     $pdf = Pdf::loadView('clients.gv.tonghop.pdf',[
    //         'thList' => $thList,
    //         'title'  => $title,
    //         'tukhoa' => $keywords,
    //         'namhoc' =>  $tennamhoc,
    //         'hocky' => $tenhocky
    //     ]);
    //     return $pdf->download('tonghop.pdf');
    // }

    public function gvexportEX(Request $request){
        $title = 'Tổng hợp điểm rèn luyện của sinh viên';

        $idnh = null;
        $tennamhoc = null;

        if(!empty( $request->nh)){
            $idnh = $request->nh;
            $namenh = $this->nam->namenam($idnh);
            foreach($namenh as $item){
                $tennamhoc = $item->tennam;
            }
        }

        $idhk = null;
        $tenhocky = null;

        if(!empty($request->hk)){
            $idhk = $request->hk;
            $namehk = $this->nam->namehk($idhk);
            foreach($namehk as $i){
                $tenhocky = $i->tenhk;
            }
        }

        $idlop = null;
        $tenlop = null;

        if(!empty($request->lop)){
            $idlop = $request->lop;
            $namelop = $this->lop->getnamelop($idlop);
            foreach($namelop as $l){
                $tenlop = $l->tenlop;
            }
        }

        $idkhoahoc = null;
        $tenkhoahoc = null;

        if(!empty($request->khoahoc)){
            $idkhoahoc = $request->khoahoc;
            $namekhoahoc = $this->lop->getnamekhoahoc($idkhoahoc);
            foreach($namekhoahoc as $nk){
                $tenkhoahoc = $nk->khoahoc;
            }
        }
        // dd($keywords,$idnh,$idhk);
        $thList = $this->diem->gvgettonghopPDF($idnh,$idhk,$idlop,$idkhoahoc);
        return (new GVtonghopExport($thList,$title,$tennamhoc,$tenhocky,$tenlop,$tenkhoahoc))->download('tonghop.xlsx', \Maatwebsite\Excel\Excel::XLSX);
        // return Excel::download(new TonghopExport($thList), 'tonghop.xlsx');

    }
}
