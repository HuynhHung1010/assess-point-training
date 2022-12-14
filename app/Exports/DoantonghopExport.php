<?php

namespace App\Exports;


use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

class DoantonghopExport implements FromView
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    private $thList;
    public function __construct($thList,$title,$tennamhoc,$tenhocky,$tenlop,$tenkhoahoc)
    {
        $this->thList = $thList;
        $this->title = $title;
        $this->namhoc = $tennamhoc;
        $this->hocky = $tenhocky;
        $this->tenlop = $tenlop;
        $this->tenkhoahoc = $tenkhoahoc;
        // dd($this->hocky);
    }
    public function view(): View
    {
        // dd($this->thList);
        return view('clients.doan.tonghop.excel', [
            'thList' => $this->thList,
            'title' => $this->title,
            'lop' => $this->tenlop,
            'khoahoc' => $this->tenkhoahoc,
            'namhoc' => $this->namhoc,
            'hocky' => $this->hocky
        ]);
    }
}
