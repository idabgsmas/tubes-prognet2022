<?php

//INI CONTROLLER CRUD UNTUK TABEL M_IKS_GKOMPONEN_DETAIL

namespace App\Http\Controllers;

use App\Models\M_iks_gkomponen_detail;
use App\Models\M_iks_gkomponen;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class Crud5Controller extends Controller
{
    public function index(){
        $icon = 'ni ni-dashlite';
        $subtitle = 'Detail Group Komponen IKS';
        $table_id = 'm_iks_gkomponen_detail';
        return view('crud5',compact('subtitle','table_id','icon'));
    }

    public function listData(Request $request){
        $data = M_iks_gkomponen_detail::select(['id','gkomponen_id','gkomponen_detail'])
        ->with(['gkomponen']);
        $datatables = DataTables::of($data);
        return $datatables
                ->addIndexColumn()
                ->addColumn('aksi', function($data){
                    $aksi = "";
                    $aksi .= "<a title='Edit Data' href='/crud5/".$data->id."/edit5' class='btn btn-md btn-primary' data-toggle='tooltip' data-placement='bottom' onclick='buttonsmdisable(this)'><i class='ti-pencil' ></i></a>";
                    $aksi .= "<a title='Delete Data' href='javascript:void(0)' onclick='deleteData(\"{$data->id}\",this)' class='btn btn-md btn-danger' data-id='{$data->id}'><i class='ti-trash' data-toggle='tooltip' data-placement='bottom' ></i></a> ";
                    return $aksi;
                })
                ->rawColumns(['aksi'])
                ->make(true);
    }

    public function deleteData(Request $request){
        if(M_iks_gkomponen_detail::destroy($request->id)){
            $response = array('success'=>1,'msg'=>'Berhasil hapus data');
        }else{
            $response = array('success'=>2,'msg'=>'Gagal menghapus data');
        }
        return $response;
    }

    public function create(){
        $icon = 'ni ni-dashlite';
        $subtitle = 'Tambah Data Detail Group Komponen IKS';
        $gkomponen = M_iks_gkomponen::all();
        return view('create5',compact('subtitle','icon','gkomponen'));
    }

    public function store(Request $request)
    {
        // dd($request->all());die;
        if(M_iks_gkomponen_detail::create($request->all())){
            $response = array('success'=>1,'msg'=>'Data berhasil ditambahkan!');
        }else{
            $response = array('success'=>2,'msg'=>'Gagal menambahkan data!');
        }
        return $response;
    }  

    public function edit(Request $request){
        $data = M_iks_gkomponen_detail::find($request->id);
        $icon = 'ni ni-dashlite';
        $subtitle = 'Edit Data Detail Group Komponen IKS';
        $gkomponen = M_iks_gkomponen::all();
        return view('edit5',compact('subtitle','icon','data','gkomponen'));
    }

    public function update(Request $request, M_iks_gkomponen_detail $data, $id)
    {
        $data = M_iks_gkomponen_detail::find($id);
        if($data->fill($request->all())->save()) {
            $response = array('success'=>1,'msg'=>'Data berhasil ditambahkan!');
        } else {
            $response = array('success'=>2,'msg'=>'Gagal menambahkan data!');
        }
        return $response;
        // return redirect('crud')->with('success',"Data berhasil diedit!");
    }
}
