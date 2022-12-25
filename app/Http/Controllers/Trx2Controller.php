<?php

//INI CONTROLLER CRUD UNTUK TABEL M_IKS

namespace App\Http\Controllers;

use App\Models\M_iks;
use App\Models\M_iks_gkomponen;
use App\Models\M_Provider;
use App\Models\T_komponen_iks;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class Trx2Controller extends Controller
{
    public function index(){
        $icon = 'ni ni-dashlite';
        $subtitle = 'Transaksi Komponen IKS';
        $table_id = 't_komponen_ikss';
        return view('trx2',compact('subtitle','table_id','icon'));
    }

    public function listData(Request $request){
        $data = T_komponen_iks::select(['id','iks_id','iks_gkomponen_id', 'provider_id','group'])
        ->with(['iks','gkomponen', 'provider' ]);
        $datatables = DataTables::of($data);
        return $datatables
                ->addIndexColumn()
                ->addColumn('aksi', function($data){
                    $aksi = "";
                    $aksi .= "<a title='Edit Data' href='/trx2/".$data->id."/edit7' class='btn btn-md btn-primary' data-toggle='tooltip' data-placement='bottom' onclick='buttonsmdisable(this)'><i class='ti-pencil' ></i></a>";
                    $aksi .= "<a title='Delete Data' href='javascript:void(0)' onclick='deleteData(\"{$data->id}\",this)' class='btn btn-md btn-danger' data-id='{$data->id}' ><i class='ti-trash' data-toggle='tooltip' data-placement='bottom' ></i></a> ";
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
        if(T_komponen_iks::destroy($request->id)){
            $response = array('success'=>1,'msg'=>'Berhasil hapus data');
        }else{
            $response = array('success'=>2,'msg'=>'Gagal menghapus data');
        }
        return $response;
    }

    public function create(){
        $icon = 'ni ni-dashlite';
        $subtitle = 'Tambah Transaksi Komponen IKS ';
        $iks = M_iks::all();
        $gkomponen = M_iks_gkomponen::all();
        $provider = M_Provider::all();
        return view('createTrx2',compact('subtitle','icon','iks', 'gkomponen', 'provider'));
    }

    public function store(Request $request)
    {
        // dd($request->all());die;
        if(T_komponen_iks::create($request->all())){
            $response = array('success'=>1,'msg'=>'Data berhasil ditambahkan!');
        }else{
            $response = array('success'=>2,'msg'=>'Gagal menambahkan data!');
        }
        return $response;
    }  

    public function edit(Request $request){
        $data = T_komponen_iks::find($request->id);
        $icon = 'ni ni-dashlite';
        $subtitle = 'Edit Data Transaksi Komponen';
        $iks = M_iks::all();
        $gkomponen = M_iks_gkomponen::all();
        $provider = M_Provider::all();
        return view('editTrx2',compact('subtitle','icon','data', 'iks', 'gkomponen', 'provider'));
    }

    public function update(Request $request, T_komponen_iks $data, $id)
    {
        $data = T_komponen_iks::find($id);
        if($data->fill($request->all())->save()) {
            $response = array('success'=>1,'msg'=>'Data berhasil ditambahkan!');
        } else {
            $response = array('success'=>2,'msg'=>'Gagal menambahkan data!');
        }
        return $response;
        // return redirect('crud')->with('success',"Data berhasil diedit!");
    }
}
