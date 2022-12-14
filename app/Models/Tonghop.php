<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tonghop extends Model
{
    use HasFactory;
    protected $table = 'diemrl';

    public function gettonghop($filters = [],$keywords=null){
        $th = DB::table('khoa')
        ->join('giaovien','khoa.idkhoa','=','giaovien.idk')
        ->join('lop','giaovien.idgv','=','lop.idgvv')
        ->join('nienkhoa','lop.idkh','=','nienkhoa.idnienkhoa')
        ->join('sinhvien','lop.id','=','sinhvien.idlop')
        ->join('diemrl','sinhvien.idhs','=','diemrl.idsv')
        ->join('phieucham', 'diemrl.idpcd', '=', 'phieucham.idpc')
        ->join('form', 'phieucham.idf', '=', 'form.idform')

       ;
        if(!empty($filters)){
            $th = $th->where($filters);
        }
        if(!empty($keywords)){
            $th = $th->where(function($query) use ($keywords) {
                $query->orwhere('mssv', 'like', '%'.$keywords.'%');
                $query->orwhere('hoten', 'like', '%'.$keywords.'%');
                $query->orwhere('magv', 'like', '%'.$keywords.'%');
                $query->orwhere('hotengv', 'like', '%'.$keywords.'%');
                $query->orwhere('malop', 'like', '%'.$keywords.'%');
                $query->orwhere('tenlop', 'like', '%'.$keywords.'%');
                $query->orwhere('makhoa', 'like', '%'.$keywords.'%');
                $query->orwhere('tenkhoa', 'like', '%'.$keywords.'%');
                 $query->orwhere('khoahoc', 'like', '%'.$keywords.'%');
            });
        }
        $th = $th->get();
        return $th;
    }
}
