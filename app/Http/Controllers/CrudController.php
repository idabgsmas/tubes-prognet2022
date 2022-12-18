<?php

namespace App\Http\Controllers;

use App\Models\M_iks;
use App\Models\M_iks_tipe;
use App\Models\M_penjamin;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CrudController extends Controller
{
    public function index(){
        $icon = 'ni ni-dashlite';
        $subtitle = 'IKS';
        $table_id = 'm_iks';
        return view('crud',compact('subtitle','table_id','icon'));
    }

    public function listData(Request $request){
        $data = M_iks::all();
        $datatables = DataTables::of($data);
        return $datatables
                ->addIndexColumn()
                ->addColumn('aksi', function($data){
                    $aksi = "";
                    $aksi .= "<a title='Edit Data' href='/crud/".$data->id."/edit' class='btn btn-md btn-primary' data-toggle='tooltip' data-placement='bottom' onclick='buttonsmdisable(this)'><i class='ti-pencil' ></i></a>";
                    $aksi .= "<a title='Delete Data' href='javascript:void(0)' onclick='deleteData(\"{$data->id}\",\"{$data->kode}\",this)' class='btn btn-md btn-danger' data-id='{$data->id}' data-kode='{$data->kode}'><i class='ti-trash' data-toggle='tooltip' data-placement='bottom' ></i></a> ";
                    return $aksi;
                })
                ->rawColumns(['aksi'])
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
        return view('create',compact('subtitle','icon','penjamin','tipe_iks'));
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
        return view('edit',compact('subtitle','icon','data', 'penjamin', 'tipe_iks'));
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
}
