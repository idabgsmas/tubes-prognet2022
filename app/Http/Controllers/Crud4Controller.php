<?php

//INI CONTROLLER CRUD UNTUK TABEL M_IKS_GKOMPONEN

namespace App\Http\Controllers;

use App\Models\M_iks_gkomponen;
use App\Models\M_iks_gkomponen_detail;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class Crud4Controller extends Controller
{
    public function index(){
        $icon = 'ni ni-dashlite';
        $subtitle = 'Group Komponen IKS';
        $table_id = 'm_iks_gkomponen';
        return view('crud4',compact('subtitle','table_id','icon'));
    }

    public function listData(Request $request){
        $data = M_iks_gkomponen::all();
        $datatables = DataTables::of($data);
        return $datatables
                ->addIndexColumn()
                ->addColumn('aksi', function($data){
                    $aksi = "";
                    $aksi .= "<a title='Detail Data' href='/crud4/".$data->id."/show4' class='btn btn-md btn-success' data-toggle='tooltip' data-placement='bottom' onclick='buttonsmdisable(this)'><i class='ti-search' ></i></a>";
                    $aksi .= "<a title='Edit Data' href='/crud4/".$data->id."/edit4' class='btn btn-md btn-primary' data-toggle='tooltip' data-placement='bottom' onclick='buttonsmdisable(this)'><i class='ti-pencil' ></i></a>";
                    $aksi .= "<a title='Delete Data' href='javascript:void(0)' onclick='deleteData(\"{$data->id}\",this)' class='btn btn-md btn-danger' data-id='{$data->id}'><i class='ti-trash' data-toggle='tooltip' data-placement='bottom' ></i></a> ";
                    return $aksi;
                })
                ->rawColumns(['aksi'])
                ->make(true);
    }

    public function deleteData(Request $request){
        if(M_iks_gkomponen::destroy($request->id)){
            $response = array('success'=>1,'msg'=>'Berhasil hapus data');
        }else{
            $response = array('success'=>2,'msg'=>'Gagal menghapus data');
        }
        return $response;
        dd($request->all());
    }

    public function deleteDataDetail(Request $request){
        if(M_iks_gkomponen_detail::destroy($request->id)){
            $response = array('success'=>1,'msg'=>'Berhasil hapus data');
        }else{
            $response = array('success'=>2,'msg'=>'Gagal menghapus data');
        }
        return $response;
    }

    public function create(){
        $icon = 'ni ni-dashlite';
        $subtitle = 'Tambah Data Group Komponen IKS';
        return view('create4',compact('subtitle','icon'));
    }

    public function store(Request $request)
    {
        // dd($request->all());die;
        if(M_iks_gkomponen::create($request->all())){
            $response = array('success'=>1,'msg'=>'Data berhasil ditambahkan!');
        }else{
            $response = array('success'=>2,'msg'=>'Gagal menambahkan data!');
        }
        return $response;
    }  

    public function edit(Request $request){
        $data = M_iks_gkomponen::find($request->id);
        $icon = 'ni ni-dashlite';
        $subtitle = 'Edit Data Group Komponen IKS';
        return view('edit4',compact('subtitle','icon','data'));
    }

    public function update(Request $request, M_iks_gkomponen $data, $id)
    {
        $data = M_iks_gkomponen::find($id);
        if($data->fill($request->all())->save()) {
            $response = array('success'=>1,'msg'=>'Data berhasil ditambahkan!');
        } else {
            $response = array('success'=>2,'msg'=>'Gagal menambahkan data!');
        }
        return $response;
        // return redirect('crud')->with('success',"Data berhasil diedit!");
    }

    public function indexShow(Request $request){
        $data = M_iks_gkomponen::find($request->id);
        $icon = 'ni ni-dashlite';
        $subtitle = 'Detail Group Komponen IKS';
        $table_id = 'm_iks_gkomponen_detail';
        return view('showCrud4',compact('subtitle', 'data', 'table_id','icon'));
    }

    public function showList(Request $request){
        // $dkomponen  = T_komponen_iks_d::find($id);
        $data = M_iks_gkomponen_detail::select(['id', 'gkomponen_id', 'gkomponen_detail'])->where('gkomponen_id', $request->id)
        ->with(['gkomponen']);
        $datatables = DataTables::of($data);
        return $datatables
                ->addIndexColumn()
                ->addColumn('aksi', function($data){
                    $aksi = "";
                    $aksi .= "<a title='Edit Data' href='/crud4/".$data->id."/edit5' class='btn btn-md btn-primary' data-toggle='tooltip' data-placement='bottom' onclick='buttonsmdisable(this)'><i class='ti-pencil' ></i></a>";
                    $aksi .= "<a title='Delete Data' href='javascript:void(0)' onclick='deleteDataDetail(\"{$data->id}\",this)' class='btn btn-md btn-danger' data-id='{$data->id}' ><i class='ti-trash' data-toggle='tooltip' data-placement='bottom' ></i></a> ";
                    return $aksi;
                })
                ->rawColumns(['aksi'])
                ->make(true);
    }
}
