<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SvController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PhieuChamController;
use App\Http\Controllers\clients\GvController;
use App\Http\Controllers\admin\HockyController;
use App\Http\Controllers\admin\TruongController;
use App\Http\Controllers\clients\DoanController;
use App\Http\Controllers\clients\KhoaController;
use App\Http\Controllers\admin\PhanhoiController;
use App\Http\Controllers\admin\TonghopController;
use App\Http\Controllers\admin\TaikhoanController;
use App\Http\Controllers\admin\ThoigianController;
use App\Http\Controllers\admin\ThongbaoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/',[HomeController::class, 'index'])->name('home');

Route::get('/thongbao/{id}',[HomeController::class, 'tintuc'])->name('thongbao');

Route::get('/logout',[LoginController::class, 'logout'])->name('logout');

Route::get('/login',[LoginController::class, 'index'])->name('login');

Route::post('/login',[LoginController::class, 'login'])->name('postlogin');


Route::middleware('sv.login')->prefix('sv')->name('sv.')->group(function () {

    Route::get('/',[SvController::class, 'svViewdiem'])->name('xemdiemsv');

    Route::get('/chamdiemsv',[SvController::class, 'svcham'])->name('chamdiemsv');

    Route::post('/chamdiemsv',[SvController::class, 'addDiem'])->name('postchamsv');

    Route::get('/taiminhchung',[SvController::class, 'svtaiFile'])->name('taiminhchung');

    Route::post('/taiminhchung',[SvController::class, 'upLoadfile'])->name('postmc');

    Route::get('/phanhoi',[SvController::class, 'svPhanhoi'])->name('phanhoig');

    Route::post('/phanhoigv',[SvController::class, 'svphanhoiGV'])->name('phanhoigv');

    Route::get('/phanhoidk',[SvController::class, 'svPhanhoidkhoa'])->name('phanhoidk');

    Route::post('/phanhoidk',[SvController::class, 'svphanhoidk'])->name('postphanhoidk');

    Route::get('/phanhoikhoa',[SvController::class, 'svPhanhoikhoa'])->name('phanhoik');

    Route::post('/phanhoikhoa',[SvController::class, 'svphanhoiK'])->name('phanhoikhoa');

    Route::get('/phanhoitruong',[SvController::class, 'svPhanhoitr'])->name('phanhoitruong');

    Route::post('/phanhoipct',[SvController::class, 'svphanhoipct'])->name('phanhoipct');

});

Route::get('/logoutgv',[LoginController::class, 'logoutgv'])->name('logoutgv');

Route::get('/logingv',[LoginController::class, 'indexgv'])->name('logingv');

Route::post('/logingv',[LoginController::class, 'logingv'])->name('postlogingv');

Route::middleware('gv.login')->prefix('gv')->name('gv.')->group(function () {

    Route::get('/',[GvController::class, 'index'])->name('xemdslop');

    Route::get('/xemdssv',[GvController::class, 'getdssv'])->name('xemdssv');

    Route::get('/gvcham',[GvController::class, 'gvcham'])->name('gvcham');

    Route::post('/gvcham',[GvController::class, 'addDiem'])->name('postgvcham');

    Route::get('/download',[GvController::class, 'upLoadfile'])->name('download');

    Route::get('/lopdiemsv',[GvController::class, 'dslop'])->name('lopdiemsv');

    Route::get('/xemdssvdiem',[GvController::class, 'getlistsv'])->name('xemdssvdiem');

    Route::get('/gvxemdiem',[GvController::class, 'xemDiemsv'])->name('gvxemdiem');

    Route::get('/chucvulop',[GvController::class, 'cvdslop'])->name('chucvulop');

    Route::get('/chucvudssv',[GvController::class, 'cvlistSV'])->name('chucvudssv');

    Route::get('/cnchucvudssv',[GvController::class, 'upcvlistSV'])->name('cnchucvudssv');

    Route::post('/chucvudssv',[GvController::class, 'upchucvu'])->name('postchucvu');

    Route::get('/phanhoisv',[GvController::class, 'getlistsvph'])->name('svph');

    Route::get('/guiph',[GvController::class, 'addPH'])->name('guiph');

    Route::post('/guiph',[GvController::class, 'postaddPH'])->name('postguiph');

    Route::get('/gvtonghop',[TonghopController::class, 'gvview'])->name('gvtonghop');

    Route::get('/gvxuatfilePDF',[TonghopController::class, 'gvexportPDF'])->name('gvxuatfilePDF');

    Route::get('/gvxuatfileEX',[TonghopController::class, 'gvexportEX'])->name('gvxuatfileEX');

});


Route::get('/logoutk',[LoginController::class, 'logoutk'])->name('logoutk');

Route::get('/logink',[LoginController::class, 'indexk'])->name('logink');

Route::post('/logink',[LoginController::class, 'logink'])->name('postlogink');

Route::middleware('khoa.login')->prefix('khoa')->name('khoa.')->group(function () {

    Route::get('/',[KhoaController::class, 'index'])->name('khoadslop');

    Route::get('/xemdssv',[KhoaController::class, 'getdssv'])->name('khoadssv');

    Route::get('/khoacham',[KhoaController::class, 'khoacham'])->name('khoacham');

    Route::post('/khoacham',[KhoaController::class, 'addDiem'])->name('postkhoacham');

    Route::get('/diemdslop',[KhoaController::class, 'dslop'])->name('dslop');

    Route::get('/dssv',[KhoaController::class, 'listSV'])->name('dssv');

    Route::get('/khoaxemdiem',[KhoaController::class, 'xemDiemsv'])->name('khoaxemdiem');

    Route::get('/chucvulop',[KhoaController::class, 'cvdslop'])->name('chucvulop');

    Route::get('/chucvudssv',[KhoaController::class, 'cvlistSV'])->name('chucvudssv');

    Route::get('/cnchucvudssv',[KhoaController::class, 'upcvlistSV'])->name('cnchucvudssv');

    Route::post('/chucvudssv',[KhoaController::class, 'upchucvu'])->name('postchucvu');

    Route::get('/phanhoisv',[KhoaController::class, 'getlistsvph'])->name('svph');

    Route::get('/guiph',[KhoaController::class, 'addPH'])->name('guiph');

    Route::post('/guiph',[KhoaController::class, 'postaddPH'])->name('postguiph');

    Route::get('/khoatonghop',[TonghopController::class, 'khoaview'])->name('khoatonghop');

    Route::get('/khoaxuatfilePDF',[TonghopController::class, 'kexportPDF'])->name('khoaxuatfilePDF');

    Route::get('/khoaxuatfileEX',[TonghopController::class, 'kexportEX'])->name('khoaxuatfileEX');
});





Route::get('/logoutd',[LoginController::class, 'logoutd'])->name('logoutd');

Route::get('/logind',[LoginController::class, 'indexd'])->name('logind');

Route::post('/logind',[LoginController::class, 'logind'])->name('postlogind');

Route::middleware('doan.login')->prefix('doan')->name('doan.')->group(function () {

    Route::get('/',[DoanController::class, 'index'])->name('doandslop');

    Route::get('/xemdssv',[DoanController::class, 'getdssv'])->name('doandssv');

    Route::get('/doancham',[DoanController::class, 'doancham'])->name('doancham');

    Route::post('/doancham',[DoanController::class, 'addDiem'])->name('postdoancham');

    Route::get('/diemdslop',[DoanController::class, 'dslop'])->name('dslop');

    Route::get('/dssv',[DoanController::class, 'listSV'])->name('dssv');

    Route::get('/doanxemdiem',[DoanController::class, 'xemDiemsv'])->name('doanxemdiem');

    Route::get('/chucvulop',[DoanController::class, 'cvdslop'])->name('chucvulop');

    Route::get('/chucvudssv',[DoanController::class, 'cvlistSV'])->name('chucvudssv');

    Route::get('/cnchucvudssv',[DoanController::class, 'upcvlistSV'])->name('cnchucvudssv');

    Route::post('/chucvudssv',[DoanController::class, 'upchucvu'])->name('postchucvu');

    Route::get('/phanhoisv',[DoanController::class, 'getlistsvph'])->name('svph');

    Route::get('/guiph',[DoanController::class, 'addPH'])->name('guiph');

    Route::post('/guiph',[DoanController::class, 'postaddPH'])->name('postguiph');

    Route::get('/doantonghop',[TonghopController::class, 'doanview'])->name('doantonghop');

    Route::get('/doanxuatfilePDF',[TonghopController::class, 'dexportPDF'])->name('doanxuatfilePDF');

    Route::get('/doanxuatfileEX',[TonghopController::class, 'dexportEX'])->name('doanxuatfileEX');
});








Route::get('/logoutadmin',[LoginController::class, 'logoutadmin'])->name('logoutadmin');

Route::get('/loginadmin',[LoginController::class, 'indexadmin'])->name('loginadmin');

Route::post('/loginadmin',[LoginController::class, 'loginadmin'])->name('postloginadmin');

Route::middleware('admin.login')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/',[DashboardController::class, 'index'])->name('homead');

    Route::get('/form',[FormController::class, 'index'])->name('formad');

    Route::get('/formmuc',[FormController::class, 'addmuc'])->name('formmuc');

    Route::post('/formmuc',[FormController::class, 'postaddmuc'])->name('addmucform');

    Route::get('/addform',[FormController::class, 'add'])->name('addform');

    Route::post('/addform',[FormController::class, 'postAdd'])->name('postaddform');

    Route::get('/edit/{idform}',[FormController::class, 'getEdit'])->name('editform');

    Route::post('/editform',[FormController::class, 'postEdit'])->name('posteditform');

    Route::get('/deletef/{idform}',[FormController::class, 'getDelete'])->name('deleteform');



    Route::get('/viewphieu',[PhieuChamController::class, 'index'])->name('viewpc');

    Route::get('/addpc',[PhieuChamController::class, 'add'])->name('addpc');

    Route::post('/addpc',[PhieuChamController::class, 'postAdd'])->name('postaddpc');

    Route::post('/deletepc',[PhieuChamController::class, 'postDelete'])->name('postdeletepc');



    Route::get('/viewnam',[HockyController::class, 'index'])->name('viewnam');

    Route::get('/addnam',[HockyController::class, 'addNam'])->name('addnam');

    Route::post('/addnam',[HockyController::class, 'postAdd'])->name('postaddnam');

    Route::get('/editnam/{idhknh}',[HockyController::class, 'getEdit'])->name('editnam');

    Route::post('/editnam',[HockyController::class, 'postEdit'])->name('posteditnam');

    Route::get('/deletehknh/{idhknh}',[HockyController::class, 'getDelete'])->name('deletenam');



    Route::get('/listnam',[HockyController::class, 'listNam'])->name('listnam');

    Route::get('/themnam',[HockyController::class, 'addNamhoc'])->name('themnam');

    Route::post('/themnam',[HockyController::class, 'postAddnam'])->name('postthemnam');

    Route::get('/editnamhoc/{idnh}',[HockyController::class, 'getEditnh'])->name('editnamhoc');

    Route::post('/editnamhoc',[HockyController::class, 'postEditnh'])->name('posteditnamhoc');

    Route::get('/deletenam/{idnh}',[HockyController::class, 'getDeletenamhoc'])->name('deletenamhoc');



    Route::get('/listhk',[HockyController::class, 'listhk'])->name('listhk');

    Route::get('/themhk',[HockyController::class, 'addhk'])->name('themhk');

    Route::post('/themhk',[HockyController::class, 'postAddhk'])->name('postthemhk');

    Route::get('/edithk/{idhk}',[HockyController::class, 'getEdithk'])->name('edithk');

    Route::post('/edithk',[HockyController::class, 'postEdithk'])->name('postedithk');

    Route::get('/deletehk/{idhk}',[HockyController::class, 'getDeletehk'])->name('deletehk');





    Route::get('/dskhoa',[TruongController::class, 'index'])->name('dskhoa');

    Route::get('/dsgv/{idkhoa}',[TruongController::class, 'getdsgv'])->name('dsgv');

    Route::get('/dslop/{idgv}',[TruongController::class, 'getlop'])->name('dslop');

    Route::get('/dssv/{idloph}',[TruongController::class, 'getdssv'])->name('dssv');

    Route::get('/chamdiem',[TruongController::class, 'pctsvcham'])->name('chamdiem');

    Route::post('/chamdiem',[TruongController::class, 'addDiem'])->name('postchamdiem');



    Route::get('/diemdskhoa',[TruongController::class, 'dskhoa'])->name('diemdskhoa');

    Route::get('/diemdsgv/{idkhoa}',[TruongController::class, 'getdsgvd'])->name('diemdsgv');

    Route::get('/diemdslop/{idgv}',[TruongController::class, 'getlopd'])->name('diemdslop');

    Route::get('/diemdssv/{idloph}',[TruongController::class, 'getdssvd'])->name('diemdssv');

    Route::get('/xemdiemsv',[TruongController::class, 'xemDiemsv'])->name('xemdiemsv');



    Route::get('/thoigian',[ThoigianController::class, 'index'])->name('thoigian');

    Route::get('/addtime',[ThoigianController::class, 'add'])->name('addtime');

    Route::post('/addtime',[ThoigianController::class, 'postAdd'])->name('postaddtime');

    Route::get('/edittime/{idt}',[ThoigianController::class, 'getEdit'])->name('edittime');

    Route::post('/edittime',[ThoigianController::class, 'postEdit'])->name('postedittime');

    Route::get('/deletet/{idt}',[ThoigianController::class, 'getDelete'])->name('deletetime');



    Route::get('/phanhoisv',[PhanhoiController::class, 'getlistsvph'])->name('svph');

    Route::get('/guiph',[PhanhoiController::class, 'addPH'])->name('guiph');

    Route::post('/guiph',[PhanhoiController::class, 'postaddPH'])->name('postguiph');



    Route::get('/thongbao',[ThongbaoController::class, 'getalltintuc'])->name('thongbao');

    Route::get('/addtb',[ThongbaoController::class, 'add'])->name('addtb');

    Route::post('/addtb',[ThongbaoController::class, 'postAdd'])->name('postaddtb');

    Route::get('/edittb/{idtb}',[ThongbaoController::class, 'getEdit'])->name('edittb');

    Route::post('/edittb',[ThongbaoController::class, 'postEdit'])->name('postedittb');

    Route::get('/deletet/{idtb}',[ThongbaoController::class, 'getDelete'])->name('deletetb');



    Route::get('/tonghop',[TonghopController::class, 'index'])->name('tonghop');

    Route::get('/xuatfilePDF',[TonghopController::class, 'exportPDF'])->name('xuatfilePDF');

    Route::get('/xuatfileEX',[TonghopController::class, 'exportEX'])->name('xuatfileEX');

    Route::get('/taikhoan',[TaikhoanController::class, 'index'])->name('taikhoan');

    Route::get('/addtaikhoan',[TaikhoanController::class, 'add'])->name('addtaikhoan');

    Route::post('/addtaikhoan',[TaikhoanController::class, 'postadd'])->name('postaddtaikhoan');

    Route::get('/deletetaikhoan/{idtk}',[TaikhoanController::class, 'getDelete'])->name('deletetk');
});

