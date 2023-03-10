<!-- INI HALAMAN UTAMA UNTUK EDIT DATA TABEL M_IKS_GKOMPONEN_DETAIL -->

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
            <a href="{{ route('crud4.list') }}" class="btn btn-sm btn-primary" onclick="buttondisable(this)"><em class="icon fas fa-arrow-left"></em> <span>Kembali</span></a>
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
                Form Edit Data Detail Group Komponen IKS "{{ $data->gkomponen_detail }}"
            </div>
        </div>
    </div>
<!-- </div> -->

<form method="POST" action="/crud5/update5/{{ $data->id }}" enctype="multipart/form-data">
    @csrf   
        <div class="mb-3">
        <input type="hidden" value="{{ $data->id }}" id="id">
            <label for="gkomponen_id" class="form-label">ID Group Komponen</label>
            <select class="custom-select" id="gkomponen_id" name="gkomponen_id" aria-describedby="gkomponen_id" required>
                <option value="0" disabled>Pilih Group Komponen</option>
                @foreach ($gkomponen as $komponen)
                  <option value="{{ $komponen->id }}" @if($data->gkomponen_id===$komponen->id) SELECTED @endif >{{ $komponen->group }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="gkomponen_detail" class="form-label">Detail Group Komponen</label>
            <input name="gkomponen_detail" type="text" value="{{ $data['gkomponen_detail'] }}"class="form-control" id="gkomponen_detail" aria-describedby="gkomponen_detail">
        </div>
        <!-- <button type="submit" class="btn btn-primary">Simpan</button> -->
        <button type="reset" class="btn btn-danger">Kosongkan</button> 
        <a title='Tambah Data' href='javascript:void(0)' onclick='update(<?=$data->id ?>)' class='btn btn-primary'>Simpan</a>
</form>

@endsection

@push('script')
<script>
    
function update(id){
    // buttonsmdisable(elm);
    CustomSwal.fire({
        icon:'question',
        text: 'Edit data '+$("#gkomponen_detail").val()+' ?',
        showCancelButton: true,
        confirmButtonText: 'Simpan',
        cancelButtonText: 'Batal',
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            $.ajax({
                url:"{{url('crud5/update5')}}/"+id,
                data:{
                    _method:"POST",
                    _token:"{{csrf_token()}}",
                    id:$("#id").val(),
                    gkomponen_id:$("#gkomponen_id").val(),
                    gkomponen_detail:$("#gkomponen_detail").val()
                },
                type:"POST",
                dataType:"JSON",
                success:function(data){
                    if(data.success == 1){
                        CustomSwal.fire('Sukses', data.msg, 'success').then(function() {
                            window.location.replace("{{ url('crud4') }}");
                        });
                        // CustomSwal.fire('Sukses', data.msg, 'success');
                        // window.location.replace("{{ url('crud4') }}");
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
        }
    });
}
</script>
@endpush

<!-- coment  -->