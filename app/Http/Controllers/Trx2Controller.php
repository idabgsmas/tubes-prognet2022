<?php

//INI CONTROLLER CRUD UNTUK TABEL M_IKS

namespace App\Http\Controllers;

use App\Models\M_iks;
use App\Models\M_iks_gkomponen;
use App\Models\M_iks_gkomponen_detail;
use App\Models\M_Provider;
use App\Models\T_komponen_iks;
use App\Models\T_komponen_iks_d;
use App\Models\T_komponen_ikss_d;
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
                    $aksi .= "<a title='Detail Data' href='/trx2/".$data->id."/show7' class='btn btn-md btn-success' data-toggle='tooltip' data-placement='bottom' onclick='buttonsmdisable(this)'><i class='ti-search' ></i></a>";
                    $aksi .= "<a title='Edit Data' href='/trx2/".$data->id."/edit7' class='btn btn-md btn-primary' data-toggle='tooltip' data-placement='bottom' onclick='buttonsmdisable(this)'><i class='ti-pencil' ></i></a>";
                    $aksi .= "<a title='Delete Data' href='javascript:void(0)' onclick='deleteData(\"{$data->id}\",this)' class='btn btn-md btn-danger' data-id='{$data->id}' ><i class='ti-trash' data-toggle='tooltip' data-placement='bottom' ></i></a> ";
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
        $gkomponen_d = M_iks_gkomponen_detail::all();
        $provider = M_Provider::all();
        $dkomponen = T_komponen_iks_d::all();
        return view('createTrx2',compact('subtitle','icon','iks', 'gkomponen', 'gkomponen_d', 'provider', 'dkomponen'));
    }

    // public function getdetail (request $request){
    //     $gkomponen_id = $request->gkomponen_id;

    //     $gkomponen_detail = M_iks_gkomponen_detail::where('gkomponen_id', $gkomponen_id)->get();
    //     foreach ($gkomponen_detail as $gdetail){
    //         echo "<option value='$gdetail->gkomponen_detail'> $gdetail->gkomponen_detail </option>";
    //     }
    // }

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
        $data = T_komponen_iks::with('dkomponen')->find($request->id);
        $icon = 'ni ni-dashlite';
        $subtitle = 'Edit Data Transaksi Komponen';
        $iks = M_iks::all();
        $gkomponen = M_iks_gkomponen::all();
        $provider = M_Provider::all();
        $dkomponen = T_komponen_iks_d::all();
        $dkomponen_detail = M_iks_gkomponen_detail::where('gkomponen_id', $data->iks_gkomponen_id)->get();
        return view('editTrx2',compact('subtitle','icon','data', 'iks', 'gkomponen', 'provider', 'dkomponen', 'dkomponen_detail'));
    }

    public function update(Request $request,  $id)
    {

        $tkomponen  = T_komponen_iks::with('dkomponen')->find($id);
        // T_komponen_iks_d::where('komponen_ikss_id', $id)->delete();
        $data=$request->all();
        
        $tkomponen->update([
            'iks_id' => $data['iks_id'],
            'provider_id' => $data['provider_id'],
            'iks_gkomponen_id' => $data['iks_gkomponen_id'],
            'group' => $data['group'],
            // 'komponen_iks_detail' => $data['komponen_iks_detail']
        ]);

        $dkomponen = T_komponen_iks_d::find($tkomponen->dkomponen->id);
        $dkomponen->komponen_iks_detail = $data['komponen_iks_detail'];
        if($dkomponen->save()){
            $response = array('success'=>1,'msg'=>'Data berhasil ditambahkan!');
        }else{
            $response = array('success'=>2,'msg'=>'Gagal menambahkan data!');
        }
        return $response;
        // $dkomponen = new T_komponen_iks_d();
        // $dkomponen->komponen_ikss_id=$tkomponen->id;
        // $dkomponen->komponen_iks_detail = $data['komponen_iks_detail'];
        // $dkomponen->save();
    

        // $data = T_komponen_iks::find($id);
        // if($data->fill($request->all())->save()) {
        //     $response = array('success'=>1,'msg'=>'Data berhasil ditambahkan!');
        // } else {
        //     $response = array('success'=>2,'msg'=>'Gagal menambahkan data!');
        // }
        // return $response;
        // return redirect('crud')->with('success',"Data berhasil diedit!");
    }

    public function indexShow(Request $request){
        $data = T_komponen_iks::find($request->id);
        $icon = 'ni ni-dashlite';
        $subtitle = 'Detail Transaksi Komponen IKS';
        $table_id = 't_komponen_ikss_d';
        return view('showTrx2',compact('subtitle', 'data', 'table_id','icon'));
    }

    public function showList(Request $request){
        // $dkomponen  = T_komponen_iks_d::find($id);
        $data = T_komponen_iks_d::select(['id', 'komponen_ikss_id', 'komponen_iks_detail'])->where('komponen_ikss_id', $request->id);
        $datatables = DataTables::of($data);
        return $datatables
                ->addIndexColumn()
                // ->addColumn('aksi', function($data){
                //     $aksi = "";
                //     $aksi .= "<a title='Edit Data' href='/trx2/".$data->id."/edit7' class='btn btn-md btn-primary' data-toggle='tooltip' data-placement='bottom' onclick='buttonsmdisable(this)'><i class='ti-pencil' ></i></a>";
                //     $aksi .= "<a title='Delete Data' href='javascript:void(0)' onclick='deleteData(\"{$data->id}\",this)' class='btn btn-md btn-danger' data-id='{$data->id}' ><i class='ti-trash' data-toggle='tooltip' data-placement='bottom' ></i></a> ";
                //     return $aksi;
                // })
                // ->rawColumns(['aksi'])
                ->make(true);
            
    }

    public function getDetailIKS($id){
        $data = M_iks_gkomponen_detail::where('gkomponen_id', $id)->get();
        return json_encode($data);
    }
}
