<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use App\Models\Form;

use App\Models\Phieucham;
use App\Models\admin\Time;
use Illuminate\Http\Request;

class PhieuChamController extends Controller
{
    private $form;
    private $pc;
    private $time;
    public function __construct()
    {
        $this->pc = new Phieucham();
        $this->time = new Time();
        $this->form = new Form();
    }
    public function index(Request $request){
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
        $getallnam = getAllnam();
        $getallhk = getAllhocky();
        $pcList = $this->pc->getallpc($filters);
        //  dd( $pcList);
        return view('admin/phieucham/viewphieu', compact('title','pcList','getallnam','getallhk'));

    }


    public function add(){
        $title = 'Thêm Phiếu chấm điểm rèn luyện';
        // $han = $this->time->gethanlap();
        // foreach($han as $i){
        //     $hanlap = $i->hanlapphieu;
        // }
        // $now = date('Y-m-d');
        // // dd($hanlap,$now);
        // if($hanlap >= $now){
        //     $k = 1;
        // }else{
        //     $k = 0;
        // }

        // dd($k);
        $getallnam = getAllnam();
        $getallhk = getAllhocky();
        return view('admin/phieucham/addphieu', compact('title','getallnam','getallhk'));
    }
    public function postAdd(Request $request){
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
        ],[
            'idnh.integer' => 'Năm không hợp lệ',
            'idnh.required' => 'Năm không được để trống',
            'idnh.integer' => 'Học kỳ không hợp lệ',
            'idnh.required' => 'Học kỳ không được để trống',
            // 'idnh.unique' => 'Năm học đã tồn tại',
            // 'idhk.unique' => 'Học kỳ đã tồn tại chí đã tồn tại',
        ]);
        $muc = $this->form->muc();
        foreach ($muc as $i){
            $muc = $i->muc;
        }
        $PcInsert = [
            $request->idnh,
            $request->idhk,
            $muc,
        ];
        // dd($PcInsert);
        $this->pc->addpc($PcInsert);

        return redirect()->route('admin.addpc')->with('msg', 'Thêm Phiếu chấm điểm RL thành công!');
    }

    public function postDelete(Request $request){
        $request->validate([
            // 'matc' => 'required',
            'idnhx' => ['required','integer',function($attribute, $value, $fail){
                if($value==0){
                    $fail('Bắt buộc phải chọn năm học');
                }
            }],
            'idhkx' => ['required','integer',function($attribute, $value, $fail){
                if($value==0){
                    $fail('Bắt buộc phải chọn học kỳ');
                }
            }],
        ],[
            'idnhx.integer' => 'Năm không hợp lệ',
            'idnhx.required' => 'Năm không được để trống',
            'idnhx.integer' => 'Học kỳ không hợp lệ',
            'idnhx.required' => 'Học kỳ không được để trống',
        ]);
           $idnh = $request->idnhx;
           $idhk = $request->idhkx;
        $pcDetail = $this->pc->getDetail($idnh,$idhk);
        // dd($pcDetail);
        if(!empty($pcDetail)){
            $this->pc->deletepc($idnh,$idhk);
            return redirect()->route('admin.addpc')->with('msg', 'Xoá Phiếu chấm điểm RL thành công!');
        }else{
            return redirect()->route('admin.addpc')->with('msg', 'Phiếu chấm điểm RL không tồn tại!');
        }

    }


}
