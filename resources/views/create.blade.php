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
            <a href="{{ route('crud.list') }}" class="btn btn-sm btn-primary" onclick="buttondisable(this)"><em class="icon fas fa-arrow-left"></em> <span>Kembali</span></a>
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
                Form Input Data IKS Baru
            </div>
        </div>
    </div>
<!-- </div> -->
<form method="POST" action="/crud/store" enctype="multipart/form-data">
    @csrf

        <div class="mb-3">
            <label for="kode" class="form-label">Kode IKS</label>
            <input name="kode" type="text" class="form-control" id="kode" aria-describedby="kode" required>
        </div>
        <div class="mb-3">
            <label for="nama" class="form-label">Nama IKS</label>
            <input name="nama" type="text" class="form-control" id="nama" aria-describedby="nama" required>
        </div>
        <div class="mb-3">
            <label for="provider_id" class="form-label">Provider</label>
            <select class="custom-select" id="provider_id" name="provider_id" aria-describedby="provider_id" required>
                <option selected disabled>Pilih Provider IKS</option>
                @foreach ($provider as $provider)
                  <option value="{{ $provider->id }}">{{ $provider->provider }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="penjamin_id" class="form-label">Jaminan</label>
            <select class="custom-select" id="penjamin_id" name="penjamin_id" aria-describedby="penjamin_id" required>
                <option selected disabled>Pilih Jaminan</option>
                @foreach ($penjamin as $jaminan)
                  <option value="{{ $jaminan->id }}">{{ $jaminan->nama }}</option>
                @endforeach
              </select>
        </div>
        <div class="mb-3">
            <label for="tipe_id" class="form-label">Tipe IKS</label>
            <select class="custom-select" id="tipe_id" name="tipe_id" aria-describedby="tipe_id" required>
                <option selected disabled>Pilih Tipe IKS</option>
                @foreach ($tipe_iks as $iks_tipe)
                  <option value="{{ $iks_tipe->id }}">{{ $iks_tipe->nama }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="status_aktif" class="form-label">Status Aktif</label>
            <select class="custom-select" id="status_aktif" name="status_aktif" aria-describedby="status_aktif" required>
                <option selected disabled>Status</option>
                <option value="0">Tidak Aktif</option>
                <option value="1">Aktif</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="masa_berlaku_awal" class="form-label">Masa Berlaku Awal</label>
            <input name="masa_berlaku_awal" type="date" class="form-control" id="masa_berlaku_awal" aria-describedby="masa_berlaku_awal" required>
        </div>
        <div class="mb-3">
            <label for="masa_berlaku_akhir" class="form-label">Masa Berlaku Akhir</label>
            <input name="masa_berlaku_akhir" type="date" class="form-control" id="masa_berlaku_akhir" aria-describedby="masa_berlaku_akhir" required>
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
                url:"{{url('/crud/store')}}/",
                data:{
                    _method:"POST",
                    _token:"{{csrf_token()}}",
                    kode:$("#kode").val(),
                    nama:$("#nama").val(),
                    penjamin_id:$("#penjamin_id").val(),
                    tipe_id:$("#tipe_id").val(),
                    provider_id:$("#provider_id").val(),
                    status_aktif:$("#status_aktif").val(),
                    masa_berlaku_awal:$("#masa_berlaku_awal").val(),
                    masa_berlaku_akhir:$("#masa_berlaku_akhir").val()
                },
                type:"POST",
                dataType:"JSON",
                success:function(data){
                    if(data.success == 1){
                        CustomSwal.fire('Sukses', data.msg, 'success').then(function() {
                            window.location.replace("{{ url('crud') }}");
                        });
                        // CustomSwal.fire('Sukses', data.msg, 'success');
                        // window.location.replace("{{ url('crud') }}");
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
            // CustomSwal.fire('Gagal', 'terjadi kesalahan sistem', 'error');
            console.log(error.XMLHttpRequest);
        }
    });
}
</script>
@endpush

