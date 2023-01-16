<?php

//INI CONTROLLER CRUD UNTUK TABEL M_IKS

namespace App\Http\Controllers;

use App\Models\M_iks;
use App\Models\M_iks_gkomponen;
use App\Models\M_iks_gkomponen_detail;
use App\Models\T_komponen_iks;
use App\Models\T_komponen_iks_d;
use App\Models\T_komponen_ikss_d;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TrxdController extends Controller
{
    public function index(){
        $icon = 'ni ni-dashlite';
        $subtitle = 'Detail Transaksi Komponen IKS';
        $table_id = 't_komponen_ikss_d';
        return view('trx2',compact('subtitle','table_id','icon'));
    }

    public function listData(Request $request){
        $data = T_komponen_iks_d::select(['id','komponen_ikss_id','komponen_iks_detail'])
        ->with(['tkomponen']);
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
        if(T_komponen_iks_d::destroy($request->id)){
            $response = array('success'=>1,'msg'=>'Berhasil hapus data');
        }else{
            $response = array('success'=>2,'msg'=>'Gagal menghapus data');
        }
        return $response;
    }

    public function create(Request $request){
        $data = T_komponen_iks::find($request->id);
        $icon = 'ni ni-dashlite';
        $subtitle = 'Tambah Detail Transaksi Komponen IKS ';
        $tkomponen = T_komponen_iks::all();
        $gkomponen_d = M_iks_gkomponen_detail::all();
        return view('createDtrx2',compact('subtitle','icon','data' , 'tkomponen', 'gkomponen_d'));
    }

     public function store(Request $request)
    {


        if(T_komponen_iks_d::create($request->all())){
            $response = array('success'=>1,'msg'=>'Data berhasil ditambahkan!');
        }else{
            $response = array('success'=>2,'msg'=>'Gagal menambahkan data!');
        }
        return $response;
             

    }  

    public function edit(Request $request){
        $data = T_komponen_iks_d::find($request->id);
        $icon = 'ni ni-dashlite';
        $subtitle = 'Edit Data Transaksi Komponen';
        $tkomponen = T_komponen_iks::all();
        $gkomponen_d = M_iks_gkomponen_detail::all();
        // $dkomponen_detail = M_iks_gkomponen_detail::where('gkomponen_id', $data->iks_gkomponen_id)->get();
        return view('editTrxd2',compact('subtitle','icon','data', 'tkomponen', 'gkomponen_d'));
    }

    public function update(Request $request,  $id)
    {
        $data = T_komponen_iks_d::find($id);
        if($data->fill($request->all())->save()) {
            $response = array('success'=>1,'msg'=>'Data berhasil ditambahkan!');
        } else {
            $response = array('success'=>2,'msg'=>'Gagal menambahkan data!');
        }
        return $response;
        // return redirect('crud')->with('success',"Data berhasil diedit!");

        // $tkomponen  = T_komponen_iks::with('dkomponen')->find($id);
        // $data=$request->all();
        
        // $tkomponen->update([
        //     'iks_id' => $data['iks_id'],
        //     'iks_gkomponen_id' => $data['iks_gkomponen_id'],
        //     'group' => $data['group'],
        // ]);

        // $dkomponen = T_komponen_iks_d::find($tkomponen->dkomponen->id);
        // $dkomponen->komponen_iks_detail = $data['komponen_iks_detail'];

        // if($dkomponen->save()){
        //     $response = array('success'=>1,'msg'=>'Data berhasil ditambahkan!');
        // }else{
        //     $response = array('success'=>2,'msg'=>'Gagal menambahkan data!');
        // }
        // return $response;
        // $dkomponen = new T_komponen_iks_d();
        // $dkomponen->komponen_ikss_id=$tkomponen->id;
        // $dkomponen->komponen_iks_detail = $data['komponen_iks_detail'];
        // $dkomponen->save();
    


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
