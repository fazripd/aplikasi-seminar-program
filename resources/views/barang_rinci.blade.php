@extends('layouts.apps')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md">
            <div class="card p-4">
                

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                          <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="/home">Home</a></li>
                          <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Input</li>
                        </ol>
                        <h6 class="font-weight-bolder mb-0">Input Data Barang</h6>
                    </nav>

                    {{--  form  --}}
                    <form id="form" action="/barang/store" method="POST" style="color: black">
                        @csrf
                        <div class="form-group" >
                          <label style="color: black" for="exampleFormControlInput1">Nama Barang</label>
                          <input type="text" class="form-control" id="namabarang" name="namabarang" placeholder="Masukan Nama">
                        </div>
                        <div class="form-group" >
                            <label style="color: black" for="exampleFormControlInput1">Harga Satuan</label>
                            <input type="number" min="0" max="999999" class="form-control" id="harga" name="harga" placeholder="Masukan Harga">
                        </div>
                        <div class="form-group" >
                            <label style="color: black" for="exampleFormControlInput1">Description</label>
                            <textarea class="form-control" name="description" id="description" cols="30" rows="5"></textarea>
                        </div>
                        <button type="submit" id="btn" class="btn btn-secondary">Submit</button>
                        <button type="reset" id="btn" class="btn btn-danger">Reset</button>
                    </form>
                </div>
                
            </div>

            
        </div>
    </div>
</div>
@endsection