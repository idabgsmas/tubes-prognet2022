<?php

namespace App\Http\Controllers;

use App\Models\M_iks_tipe;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class Crud2Controller extends Controller
{
    public function index(){
        $icon = 'ni ni-dashlite';
        $subtitle = 'Tipe IKS';
        $table_id = 'm_iks_tipe';
        return view('crud2',compact('subtitle','table_id','icon'));
    }

    public function listData(Request $request){
        $data = M_iks_tipe::all();
        $datatables = DataTables::of($data);
        return $datatables
                ->addIndexColumn()
                ->addColumn('aksi', function($data){
                    $aksi = "";
                    $aksi .= "<a title='Edit Data' href='/crud2/".$data->id."/edit2' class='btn btn-md btn-primary' data-toggle='tooltip' data-placement='bottom' onclick='buttonsmdisable(this)'><i class='ti-pencil' ></i></a>";
                    $aksi .= "<a title='Delete Data' href='javascript:void(0)' onclick='deleteData(\"{$data->id}\",\"{$data->kode}\",this)' class='btn btn-md btn-danger' data-id='{$data->id}' data-kode='{$data->kode}'><i class='ti-trash' data-toggle='tooltip' data-placement='bottom' ></i></a> ";
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
        if(M_iks_tipe::destroy($request->id)){
            $response = array('success'=>1,'msg'=>'Berhasil hapus data');
        }else{
            $response = array('success'=>2,'msg'=>'Gagal menghapus data');
        }
        return $response;
    }

    public function create(){
        $icon = 'ni ni-dashlite';
        $subtitle = 'Tambah Data Tipe IKS';
        return view('create2',compact('subtitle','icon'));
    }

    public function store(Request $request)
    {
        // dd($request->all());die;
        if(M_iks_tipe::create($request->all())){
            $response = array('success'=>1,'msg'=>'Data berhasil ditambahkan!');
        }else{
            $response = array('success'=>2,'msg'=>'Gagal menambahkan data!');
        }
        return $response;
    }  

    public function edit(Request $request){
        $data = M_iks_tipe::find($request->id);
        $icon = 'ni ni-dashlite';
        $subtitle = 'Edit Data Tipe IKS';
        return view('edit2',compact('subtitle','icon','data'));
    }

    public function update(Request $request, M_iks_tipe $data, $id)
    {
        $data = M_iks_tipe::find($id);
        if($data->fill($request->all())->save()) {
            $response = array('success'=>1,'msg'=>'Data berhasil ditambahkan!');
        } else {
            $response = array('success'=>2,'msg'=>'Gagal menambahkan data!');
        }
        return $response;
        // return redirect('crud')->with('success',"Data berhasil diedit!");
    }
}
