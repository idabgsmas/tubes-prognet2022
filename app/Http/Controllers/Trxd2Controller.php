<?php

//INI CONTROLLER CRUD UNTUK TABEL M_IKS

namespace App\Http\Controllers;

use App\Models\M_iks;
use App\Models\M_iks_gkomponen;
use App\Models\M_Provider;
use App\Models\T_komponen_iks;
use App\Models\T_komponen_iks_d;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class Trxd2Controller extends Controller
{
    public function index(){
        $icon = 'ni ni-dashlite';
        $subtitle = 'Transaksi Detail Komponen IKS';
        $table_id = 't_komponen_ikss_d';
        return view('trxd2',compact('subtitle','table_id','icon'));
    }



    public function transaksiDetail($id){
        $icon = 'ni ni-dashlite';
        $subtitle = 'Detail Transaksi Komponen IKS';
        $table_id = 't_komponen_ikss_d';
        $tkomponen = T_komponen_iks::find($id);
        $komponen_ikss_id = $id;
        return view('trxd2',compact('subtitle','table_id','icon', 'komponen_ikss_id', 'tkomponen'));
    }

    public function listData(Request $request, $komponen_ikss_id){
        $data = T_komponen_iks_d::select('id', 'komponen_ikss_id', 'komponen_iks_detail')->where('komponen_ikss_id', $komponen_ikss_id)->get();
        $datatables = DataTables::of($data);
        return $datatables
                ->addIndexColumn()
                ->addColumn('aksi', function($data){
                    $aksi = "";
                    // $aksi .= "<a title='Edit Data' href='/riwayatdiklat/".$data->id."/edit' class='btn btn-md btn-primary' data-toggle='tooltip' data-placement='bottom' onclick='buttonsmdisable(this)'><i class='ti-pencil' ></i></a>";
                    // $aksi .= "<a title='Delete Data' href='javascript:void(0)' onclick='deleteData(\"{$data->id_t_diklat}\",\"{$data->nama_kursus}\",this)' class='btn btn-md btn-danger' data-id_t_diklat='{$data->id_t_diklat}' data-nama_kursus='{$data->nama_kursus}'><i class='ti-trash' data-toggle='tooltip' data-placement='bottom' ></i></a> ";
                    return $aksi;
                })
                ->rawColumns(['aksi'])
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
        $dkomponen = T_komponen_iks_d::all();
        return view('createTrx2',compact('subtitle','icon','iks', 'gkomponen', 'provider', 'dkomponen'));
    }

    public function store(Request $request)
    {
        // dd($request->all());die;
             
        $data = $request->all();
        $tkomponen = new T_komponen_iks(); 
        $tkomponen->iks_id = $data['iks_id'];
        $tkomponen->provider_id = $data['provider_id'];
        $tkomponen->iks_gkomponen_id = $data['iks_gkomponen_id'];
        $tkomponen->group = $data['group'];
        $tkomponen->save();
        
        $dkomponen = new T_komponen_iks_d();
        $dkomponen->komponen_ikss_id=$tkomponen->id;
        $dkomponen->komponen_iks_detail = $data['komponen_iks_detail'];
        $dkomponen->save();

        if( ($request->all())){
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
        $dkomponen = T_komponen_iks_d::all();
        return view('editTrx2',compact('subtitle','icon','data', 'iks', 'gkomponen', 'provider', 'dkomponen'));
    }

    public function update(Request $request,  $id)
    {

        $tkomponen  = T_komponen_iks::with('dkomponen')->find($id);
        T_komponen_iks_d::where('komponen_ikss_id', $id)->delete();
        $data=$request->all();
        
        $tkomponen -> update([
            'iks_id' => $data['iks_id'],
            'provider_id' => $data['provider_id'],
            'iks_gkomponen_id' => $data['iks_gkomponen_id'],
            'group' => $data['iks_id'],
            // 'komponen_iks_detail' => $data['komponen_iks_detail']
        ]);

        $dkomponen = new T_komponen_iks_d();
        $dkomponen->komponen_ikss_id=$tkomponen->id;
        $dkomponen->komponen_iks_detail = $data['komponen_iks_detail'];
        $dkomponen->save();
    

        $data = T_komponen_iks::find($id);
        if($data->fill($request->all())->save()) {
            $response = array('success'=>1,'msg'=>'Data berhasil ditambahkan!');
        } else {
            $response = array('success'=>2,'msg'=>'Gagal menambahkan data!');
        }
        return $response;
        return redirect('crud')->with('success',"Data berhasil diedit!");
    }
}
