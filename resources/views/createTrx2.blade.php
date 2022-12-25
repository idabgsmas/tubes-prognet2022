<!-- INI HALAMAN UTAMA UNTUK CREATE DATA TABEL M_IKS -->

{{-- https://www.positronx.io/laravel-datatables-example/ --}}

@extends('layouts.app')
@section('action')

@endsection
@section('content')

<div class="nk-fmg-body-head d-none d-lg-flex">
    <div class="nk-fmg-search">
        <!-- <em class="icon ni ni-search"></em> -->
        <!-- <input type="text" class="form-control border-transparent form-focus-none" placeholder="Search files, folders"> -->
        <h4 class="card-title text-primary"><i class='{{$icon}}' data-toggle='tooltip' data-placement='bottom' title='{{$subtitle}}'></i>  {{strtoupper($subtitle)}}</h4>
    </div>
    <div class="nk-fmg-actions">
        <div class="btn-group">
            <!-- <a href="#" target="_blank" class="btn btn-sm btn-success"><em class="icon ti-files"></em> <span>Export Data</span></a> -->
            <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalDefault">Modal Default</button> -->
            <!-- <a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modalDefault"><em class="icon ti-file"></em> <span>Filter Data</span></a> -->
            <!-- <a href="javascript:void(0)" class="btn btn-sm btn-success" onclick="filtershow()"><em class="icon ti-file"></em> <span>Filter Data</span></a> -->
            <a href="{{ route('trx2.list') }}" class="btn btn-sm btn-primary" onclick="buttondisable(this)"><em class="icon fas fa-arrow-left"></em> <span>Kembali</span></a>
        </div>
    </div>
</div>
<div class="row gy-3 d-none" id="loaderspin">
    <div class="col-md-12">
        <div class="col-md-12" align="center">
            &nbsp;
        </div>
        <div class="d-flex align-items-center">
          <div class="col-md-12" align="center">
            <div class="spinner-border ms-auto" role="status" aria-hidden="true"></div>
          </div>
        </div>
        <div class="col-md-12" align="center">
            <strong>Loading...</strong>
        </div>
    </div>
</div>
<div class="card d-none" id="filterrow">
    <div class="card-body" style="background:#f7f9fd">
        <div class="row gy-3" >
            
        </div>
    </div>
    <!-- <div class="card-footer" style="background:#fff" align="right"> -->
    <div class="card-footer" style="background:#f7f9fd; padding-top:0px !important;">
        <div class="btn-group">
            <!-- <a href="javascript:void(0)" class="btn btn-sm btn-dark" onclick="filterclear()"><em class="icon ti-eraser"></em> <span>Clear Filter</span></a> -->
            <a href="javascript:void(0)" class="btn btn-sm btn-primary" onclick="filterdata()"><em class="icon ti-reload"></em> <span>Submit Filter</span></a>
        </div>
    </div>
</div>

<!-- <div class="nk-fmg-body-content"> -->
    <div class="nk-fmg-quick-list nk-block">
        <div class="card">
            <div class="card-body">
                Form Input Transaksi Komponen IKS
            </div>
        </div>
    </div>
<!-- </div> -->
<form method="POST" action="/trx2/store7" enctype="multipart/form-data">
    @csrf


        <div class="mb-3">
            <label for="iks_id" class="form-label">IKS</label>
            <select class="custom-select" id="iks_id" name="iks_id" aria-describedby="iks_id" required>
                <option selected disabled>Pilih IKS</option>
                @foreach ($iks as $i)
                  <option value="{{ $i->id }}">{{ $i->nama }}</option>
                @endforeach
              </select>
        </div>
        <div class="mb-3">
            <label for="provider_id" class="form-label">Provider</label>
            <select class="custom-select" id="provider_id" name="provider_id" aria-describedby="provider_id" required>
                <option selected disabled>Pilih Provider IKS</option>
                @foreach ($provider as $p)
                  <option value="{{ $p->id }}">{{ $p->provider }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="iks_gkomponen_id" class="form-label">id Group Komponen IKS</label>
            <select class="custom-select" id="iks_gkomponen_id" name="iks_gkomponen_id" aria-describedby="iks_gkomponen_id" required>
                <option selected disabled>Pilih id Group Komponen IKS</option>
                @foreach ($gkomponen as $g)
                  <option value="{{ $g->id }}">{{ $g->id }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="group" class="form-label">Group</label>
            <select class="custom-select" id="group" name="group" aria-describedby="group" required>
                <option selected disabled>Pilih Group Komponen IKS</option>
                @foreach ($gkomponen as $g)
                  <option value="{{ $g->id }}">{{ $g->group }}</option>
                @endforeach
            </select>
        </div>
        <!-- <button type="submit" class="btn btn-primary">Simpan</button> -->
        <button type="reset" class="btn btn-danger">Kosongkan</button> 
        <a title='Tambah Data' href='javascript:void(0)' onclick='store("","")' class='btn btn-success'>Simpan</a>
</form>
@endsection
@push('script')
<script>

function store(){
    // buttonsmdisable(elm);
    CustomSwal.fire({
        icon:'question',
        text: 'Data Sudah Benar?' ,
        showCancelButton: true,
        confirmButtonText: 'Submit',
        cancelButtonText: 'Batal',
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            $.ajax({
                url:"{{url('/trx2/store7')}}/",
                data:{
                    _method:"POST",
                    _token:"{{csrf_token()}}",
                    iks_id:$("#iks_id").val(),
                    provider_id:$("#provider_id").val(),
                    iks_gkomponen_id:$("#iks_gkomponen_id").val(),
                    group:$("#group").val(),
                },
                type:"POST",
                dataType:"JSON",
                success:function(data){
                    if(data.success == 1){
                        CustomSwal.fire('Sukses', data.msg, 'success');
                        window.location.replace("{{ url('trx2') }}");
                    }else{
                        CustomSwal.fire('Gagal', data.msg, 'error');
                    }
                },
                error:function(error){
                    CustomSwal.fire('Gagal', 'terjadi kesalahan sistem', 'error');
                    console.log(error.XMLHttpRequest);
                }
            });
        }else{
            CustomSwal.fire('Gagal', 'terjadi kesalahan sistem', 'error');
            console.log(error.XMLHttpRequest);
        }
    });
}
</script>
@endpush

