<?php

namespace App\Models\clients;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class Sinhvien extends Model
{
    use HasFactory;
    protected $table = 'sinhvien';

    protected $table1 = 'phanhoi';

    public function getallsv($idsv){
        $sv = DB::table($this->table)
        ->where('idhs',$idsv)
        ->get();
        return $sv;
    }
//chuc vu sv
    public function chucvusv($idsv){
        $cvsv = DB::table($this->table)
        ->select('chucvu')
        ->where('idhs',$idsv)
        ->get();
        return $cvsv;
    }
//chuc nang tai minh chung
    public function updatecv($id,$cv){
        DB::table($this->table)
        ->where('idhs',$id)
        ->update(['chucvu' => $cv]);
    }

    public function updatecvdoan($id,$cv){
        DB::table($this->table)
        ->where('idhs',$id)
        ->update(['chucvudoan' => $cv]);
    }
//chuc nang sinh vien xem phan hoi
    public function getallph($idsv,$filters = []){
        $hanhk = DB::table('hknh')
        ->get();
        foreach($hanhk as $item){
            $bd = $item->ngaybd;
            $kt = $item->ngaykt;
            $now = date('Y-m-d');

            if($kt >= $now && $now >= $bd){
                $idnam = $item->idnh;
                $idhocky = $item->idhk;
            }
        }
        $hknhtruoc = DB::table('hknh')
        ->select(DB::raw('max(idhknh) as idm'))
        ->groupBy('idhknh')
        ->get();
        foreach($hknhtruoc as $item){
            $idmax = $item->idm;
        }
        $namt = DB::table('hknh')
        ->where('idhknh',$idmax)
        ->get();
        foreach($namt as $item){
                $idnamt = $item->idnh;
                $idhockyt = $item->idhk;
        }
        $phgv = DB::table($this->table1)
        ->where('idsv',$idsv)
        ->where('gv',1)
        ->orderBy('idph', 'ASC');
        if(!empty($filters)){
            $phgv = $phgv->where($filters);
        }elseif (!empty($idnam)&&!empty($idhocky)){
            $phgv = $phgv->where('idnh',$idnam);
            $phgv = $phgv->where('idhk',$idhocky);
        }else{
            $phgv = $phgv->where('idnh',$idnamt);
            $phgv = $phgv->where('idhk',$idhockyt);
        }

        $phgv = $phgv->get();
        return $phgv;
    }


    public function getallphdkhoa($idsv,$filters = []){
        $hanhk = DB::table('hknh')
        ->get();
        foreach($hanhk as $item){
            $bd = $item->ngaybd;
            $kt = $item->ngaykt;
            $now = date('Y-m-d');

            if($kt >= $now && $now >= $bd){
                $idnam = $item->idnh;
                $idhocky = $item->idhk;
            }
        }
        $hknhtruoc = DB::table('hknh')
        ->select(DB::raw('max(idhknh) as idm'))
        ->groupBy('idhknh')
        ->get();
        foreach($hknhtruoc as $item){
            $idmax = $item->idm;
        }
        $namt = DB::table('hknh')
        ->where('idhknh',$idmax)
        ->get();
        foreach($namt as $item){
                $idnamt = $item->idnh;
                $idhockyt = $item->idhk;
        }
        $phk = DB::table($this->table1)
        ->where('idsv',$idsv)
        ->where('doan',1)
        ->orderBy('idph', 'ASC');
        if(!empty($filters)){
            $phk = $phk->where($filters);
        }elseif (!empty($idnam)&&!empty($idhocky)){
            $phk = $phk->where('idnh',$idnam);
            $phk = $phk->where('idhk',$idhocky);
        }else{
            $phk = $phk->where('idnh',$idnamt);
            $phk = $phk->where('idhk',$idhockyt);
        }

        $phk = $phk->get();
        return $phk;
    }

    public function getallphkhoa($idsv,$filters = []){
        $hanhk = DB::table('hknh')
        ->get();
        foreach($hanhk as $item){
            $bd = $item->ngaybd;
            $kt = $item->ngaykt;
            $now = date('Y-m-d');

            if($kt >= $now && $now >= $bd){
                $idnam = $item->idnh;
                $idhocky = $item->idhk;
            }
        }
        $hknhtruoc = DB::table('hknh')
        ->select(DB::raw('max(idhknh) as idm'))
        ->groupBy('idhknh')
        ->get();
        foreach($hknhtruoc as $item){
            $idmax = $item->idm;
        }
        $namt = DB::table('hknh')
        ->where('idhknh',$idmax)
        ->get();
        foreach($namt as $item){
                $idnamt = $item->idnh;
                $idhockyt = $item->idhk;
        }
        $phk = DB::table($this->table1)
        ->where('idsv',$idsv)
        ->where('khoa',1)
        ->orderBy('idph', 'ASC');
        if(!empty($filters)){
            $phk = $phk->where($filters);
        }elseif (!empty($idnam)&&!empty($idhocky)){
            $phk = $phk->where('idnh',$idnam);
            $phk = $phk->where('idhk',$idhocky);
        }else{
            $phk = $phk->where('idnh',$idnamt);
            $phk = $phk->where('idhk',$idhockyt);
        }

        $phk = $phk->get();
        return $phk;
    }

    public function getallphtr($idsv,$filters = []){
        $hanhk = DB::table('hknh')
        ->get();
        foreach($hanhk as $item){
            $bd = $item->ngaybd;
            $kt = $item->ngaykt;
            $now = date('Y-m-d');

            if($kt >= $now && $now >= $bd){
                $idnam = $item->idnh;
                $idhocky = $item->idhk;
            }
        }
        $hknhtruoc = DB::table('hknh')
        ->select(DB::raw('max(idhknh) as idm'))
        ->groupBy('idhknh')
        ->get();
        foreach($hknhtruoc as $item){
            $idmax = $item->idm;
        }
        $namt = DB::table('hknh')
        ->where('idhknh',$idmax)
        ->get();
        foreach($namt as $item){
                $idnamt = $item->idnh;
                $idhockyt = $item->idhk;
        }
        $phtr = DB::table($this->table1)
        ->where('idsv',$idsv)
        ->where('truong',1)
        ->orderBy('idph', 'ASC');
        if(!empty($filters)){
            $phtr = $phtr->where($filters);
        }elseif (!empty($idnam)&&!empty($idhocky)){
            $phtr = $phtr->where('idnh',$idnam);
            $phtr = $phtr->where('idhk',$idhocky);
        }else{
            $phtr = $phtr->where('idnh',$idnamt);
            $phtr = $phtr->where('idhk',$idhockyt);
        }

        $phtr = $phtr->get();
        return $phtr;
    }
//chuc nang sinh vien phan hoi
    public function addphgv($ph,$id,$gv,$ngph){
        $hanhk = DB::table('hknh')
        ->get();
        foreach($hanhk as $item){
            $bd = $item->ngaybd;
            $kt = $item->ngaykt;
            $now = date('Y-m-d');

            if($kt >= $now && $now >= $bd){
                $idnam = $item->idnh;
                $idhocky = $item->idhk;
            }
        }
        DB::table($this->table1)->insert([
            'svph' => $ph,
            'idsv' => $id,
            'gv' => $gv,
            'idnh' => $idnam,
            'idhk' => $idhocky,
            'ngayph' => $ngph
        ]);
    }

    public function addphd($ph,$id,$gv,$ngph){
        $hanhk = DB::table('hknh')
        ->get();
        foreach($hanhk as $item){
            $bd = $item->ngaybd;
            $kt = $item->ngaykt;
            $now = date('Y-m-d');

            if($kt >= $now && $now >= $bd){
                $idnam = $item->idnh;
                $idhocky = $item->idhk;
            }
        }
        DB::table($this->table1)->insert([
            'svph' => $ph,
            'idsv' => $id,
            'doan' => $gv,
            'idnh' => $idnam,
            'idhk' => $idhocky,
            'ngayph' => $ngph
        ]);
    }

    public function addphk($ph,$id,$gv,$ngph){
        $hanhk = DB::table('hknh')
        ->get();
        foreach($hanhk as $item){
            $bd = $item->ngaybd;
            $kt = $item->ngaykt;
            $now = date('Y-m-d');

            if($kt >= $now && $now >= $bd){
                $idnam = $item->idnh;
                $idhocky = $item->idhk;
            }
        }
        DB::table($this->table1)->insert([
            'svph' => $ph,
            'idsv' => $id,
            'khoa' => $gv,
            'idnh' => $idnam,
            'idhk' => $idhocky,
            'ngayph' => $ngph
        ]);
    }

    public function addphpct($ph,$id,$gv,$ngph){
        $hanhk = DB::table('hknh')
        ->get();
        foreach($hanhk as $item){
            $bd = $item->ngaybd;
            $kt = $item->ngaykt;
            $now = date('Y-m-d');

            if($kt >= $now && $now >= $bd){
                $idnam = $item->idnh;
                $idhocky = $item->idhk;
            }
        }
        DB::table($this->table1)->insert([
            'svph' => $ph,
            'idsv' => $id,
            'truong' => $gv,
            'idnh' => $idnam,
            'idhk' => $idhocky,
            'ngayph' => $ngph
        ]);
    }
}
