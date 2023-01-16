<?php

//INI CONTROLLER CRUD UNTUK TABEL M_IKS

namespace App\Http\Controllers;

use App\Models\M_iks;
use App\Models\M_iks_tipe;
use App\Models\M_penjamin;
use App\Models\M_Provider;
use App\Models\T_komponen_iks;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CrudController extends Controller
{
    public function index(){
        $icon = 'ni ni-dashlite';
        $iconn = 'ni clock';
        $subtitle = 'IKS';
        $table_id = 'm_ikss';
        return view('crud',compact('subtitle','table_id','icon'));
    }

    public function listData(Request $request){
        $data = M_iks::select(['id','kode','nama','penjamin_id','tipe_id','provider_id','status_aktif','masa_berlaku_awal','masa_berlaku_akhir'])
        ->with(['list_iks_tipe','list_penjamin', 'list_provider']);
        $datatables = DataTables::of($data);
        return $datatables
                ->addIndexColumn()
                ->addColumn('aksi', function($data){
                    $aksi = "";
                    $aksi .= "<a title='Transaksi Komponen IKS' href='/crud/".$data->id."/show1' class='btn btn-md btn-success' data-toggle='tooltip' data-placement='bottom' onclick='buttonsmdisable(this)'><i class='ti-shopping-cart-full' ></i></a>";
                    $aksi .= "<a title='Edit Data IKS' href='/crud/".$data->id."/edit' class='btn btn-md btn-primary' data-toggle='tooltip' data-placement='bottom' onclick='buttonsmdisable(this)'><i class='ti-pencil' ></i></a>";
                    $aksi .= "<a title='Delete Data IKS' href='javascript:void(0)' onclick='deleteData(\"{$data->id}\",\"{$data->kode}\",this)' class='btn btn-md btn-danger' data-id='{$data->id}' data-kode='{$data->kode}'><i class='ti-trash' data-toggle='tooltip' data-placement='bottom' ></i></a> ";
                    return $aksi;
                })
                ->editColumn('status_aktif',function($status)
                {
                    if($status->status_aktif == 0)
                    {
                        return '<button class="btn btn-danger btn-xs">Tidak Aktif</button>';
                    }elseif($status->status_aktif == 1)
                    {
                        return '<button class="btn btn-success btn-xs">Aktif</button>';
                    }
                })
                ->rawColumns(['aksi','status_aktif'])
                ->make(true);
    }

    public function deleteData(Request $request){
        if(M_iks::destroy($request->id)){
            $response = array('success'=>1,'msg'=>'Berhasil hapus data');
        }else{
            $response = array('success'=>2,'msg'=>'Gagal menghapus data');
        }
        return $response;
    }

    public function create(){
        $icon = 'ni ni-dashlite';
        $subtitle = 'Tambah Data IKS';
        $penjamin = M_penjamin::all();
        $tipe_iks = M_iks_tipe::all();
        $provider = M_Provider::all();
        return view('create',compact('subtitle','icon','penjamin','provider','tipe_iks'));
    }

    public function store(Request $request)
    {
        // dd($request->all());die;
        if(M_iks::create($request->all())){
            $response = array('success'=>1,'msg'=>'Data berhasil ditambahkan!');
        }else{
            $response = array('success'=>2,'msg'=>'Gagal menambahkan data!');
        }
        return $response;
    }  

    public function edit(Request $request){
        $data = M_iks::find($request->id);
        $icon = 'ni ni-dashlite';
        $subtitle = 'Edit Data IKS';
        $penjamin = M_penjamin::all();
        $tipe_iks = M_iks_tipe::all();
        $provider = M_Provider::all();
        return view('edit',compact('subtitle','icon','data', 'penjamin','provider', 'tipe_iks'));
    }

    public function update(Request $request, M_iks $data, $id)
    {
        $data = M_iks::find($id);
        
        if($data->fill($request->all())->save()) {
            $response = array('success'=>1,'msg'=>'Data berhasil ditambahkan!');
        } else {
            $response = array('success'=>2,'msg'=>'Gagal menambahkan data!');
        }
        return $response;
        // return redirect('crud')->with('success',"Data berhasil diedit!");
    }

    // DATA TRANSAKSI KOMPONEN IKS
    public function indexShow(Request $request){
        $data = M_iks::find($request->id);
        $icon = 'ni ni-dashlite';
        $jam = 'icon ni ni-clock';
        $subtitle = 'Transaksi Komponen IKS >> ';
        $subtitle2 = 'Valid Until: ';
        $table_id = 't_komponen_ikss';
        return view('showCrud1',compact('subtitle', 'subtitle2',  'data', 'jam' ,'table_id','icon'));
    }

    public function showList(Request $request){
        // $dkomponen  = T_komponen_iks_d::find($id);
        $data = T_komponen_iks::select(['id','iks_id', 'iks_gkomponen_id', 'group'])->where('iks_id', $request->id)
        ->with(['iks']);
        $datatables = DataTables::of($data);
        return $datatables
                ->addIndexColumn()
                ->addColumn('aksi', function($data){
                    $aksi = "";
                    $aksi .= "<a title='Add Data Transaksi IKS' href='/trx2/".$data->iks_id."/create7' class='btn btn-md btn-success' data-toggle='tooltip' data-placement='bottom' onclick='buttonsmdisable(this)'><i class='ti-plus' ></i></a>";
                    $aksi .= "<a title='Detail Data Transaksi' href='/trx2/".$data->id."/show7' class='btn btn-md btn-primary' data-toggle='tooltip' data-placement='bottom' onclick='buttonsmdisable(this)'><i class='ti-search' ></i></a>";
                    $aksi .= "<a title='Delete Data' href='javascript:void(0)' onclick='deleteData(\"{$data->id}\",this)' class='btn btn-md btn-danger' data-id='{$data->id}' ><i class='ti-trash' data-toggle='tooltip' data-placement='bottom' ></i></a> ";
                    return $aksi;
                })
                ->rawColumns(['aksi'])
                ->make(true);
    }
    
    // public function deleteDataDetail(Request $request){
    //     if(T_komponen_iks::destroy($request->id)){
    //         $response = array('success'=>1,'msg'=>'Berhasil hapus data');
    //     }else{
    //         $response = array('success'=>2,'msg'=>'Gagal menghapus data');
    //     }
    //     return $response;
    // }
}
