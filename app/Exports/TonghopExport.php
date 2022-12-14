<?php

namespace App\Exports;

use App\Models\Diem;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

class TonghopExport implements FromView
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    private $thList;
    public function __construct($thList,$title,$tennamhoc,$tenhocky,$tenkhoa,$tenlop,$tengv,$tenkhoahoc)
    {
        $this->thList = $thList;
        $this->title = $title;
        $this->namhoc = $tennamhoc;
        $this->hocky = $tenhocky;
        $this->tenkhoa = $tenkhoa;
        $this->tenlop = $tenlop;
        $this->tengv = $tengv;
        $this->tenkhoahoc = $tenkhoahoc;
    }
    public function view(): View
    {
        // dd($this->thList);
        return view('admin.tonghop.excel', [
            'thList' => $this->thList,
            'title' => $this->title,
            'khoa' => $this->tenkhoa,
            'lop' => $this->tenlop,
            'gv' => $this->tengv,
            'khoahoc' => $this->tenkhoahoc,
            'namhoc' => $this->namhoc,
            'hocky' => $this->hocky
        ]);
    }
}
