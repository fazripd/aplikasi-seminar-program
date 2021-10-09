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
                          <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Barang</li>
                        </ol>
                        <h6 class="font-weight-bolder mb-0">Data Barang</h6>
                    </nav>
                </div>
            </div>

            <div class="card">
                <div class="table-responsive">
                  <table class="table align-items-center mb-0">
                    <thead>
                      <tr style="color: black; text-align: center">
                        <th>No</th>
                        <th>Nama Barang </th>
                        <th>Harga</th>
                      </tr>
                      
                    </thead>
                    @php
                        $no =1;
                    @endphp
                    <tbody id="tbody">
                        {{--  @foreach ($index as $item)                        
                        <tr style="color: black; text-align: center">
                            <th>{{ $no++}}</th>
                            <th>{{ $item->name}}</th>
                            <th>
                                <a href="/kurir/delete/{{$item->id}}"><button type="button" id="btn" class="btn btn-danger">Delete</button></a>
                            </th>
                        </tr>
                        @endforeach  --}}
                    </tbody>

                    <tfoot>
                        <tr style="color: black; text-align: center">
                            <th></th>
                            <th><a href="/kurir/create"><button type="button" id="btn" class="btn btn-success">Tambah</button></a></th>
                            <th></th>
                        </tr>
                        
                    </tfoot>
                  </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection