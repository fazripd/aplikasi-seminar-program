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
                          <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Transaksi</li>
                        </ol>
                        <h6 class="font-weight-bolder mb-0">Laporan Pembelian Barang </h6>
                    </nav>

                    {{--  form  --}}
                    @foreach($buka as $item)
                    <form id="form" style="color: black">

                        <div class="form-group" >
                          <label style="color: black" for="exampleFormControlInput1">Tanggal pembelian</label>
                          <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{$item->tanggal}}">
                        </div>

                        <div class="form-group">
                            <label style="color: black" for="exampleFormControlInput1">No. Faktur</label>
                            <input type="text" class="form-control" id="faktur" name="faktur"  value="{{$item->faktur}}" >
                            {{--  <input type="text" class="form-control" id="faktur" name="faktur" value="AMS.LGS.{{Carbon\Carbon::now()->Format('ymd')}}-{{Carbon\Carbon::now()->Format('Hi')}}" hidden>  --}}
                        </div>
                        
                        <div class="form-group">
                          <a href="/cetak_pdf/{{$item->faktur}}" target="_blank"><button type="button" class="btn btn-info "><i class="fas fa-file-pdf me-1"></i> PDF</button></a>
                        </div>

                    </form>
                      @endforeach
                </div>
            </div>

            <div class="card">
                <div class="table-responsive">
                  <table class="table align-items-center mb-0">
                    <thead>
                      <tr style="color: black; text-align: center"   >
                        <th>No</th>
                        <th>Kurir</th>
                        <th>Toko</th>
                        <th>Alamat Toko</th>
                        <th>Nama Barang</th>
                        <th>Jumlah</th>
                        <th>Harga Satuan</th>
                        <th>Total</th>
                      </tr>
                      
                    </thead>
                    @php
                        $no = 1;
                    @endphp
                    <tbody id="gettable">
                      @foreach ($table as $item)
                      <tr style="color: black">
                        <th style="color: black; text-align: center"   >{{ $no++}}</th>
                        <th>{{ $item->kurir}}</th>
                        <th>{{ $item->toko}}</th>
                        <th>{{ $item->alamat}}</th>
                        <th>{{ $item->namabarang}}</th>
                        <th style="color: black; text-align: center">{{ $item->jumlah}}</th>
                        <th style="color: black; text-align: left">Rp. {{ number_format($item->harga)}}</th>
                        <th style="color: black; text-align: left">Rp. {{ number_format($item->total)}}</th>
                      </tr>
                      @endforeach
                    </tbody>
                    <tfoot>
                        <tr style="color: black">
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th style="color: black; text-align: center"   >Total</th>
                            <th style="color: black; text-align: left" id='total'>Rp. {{number_format($sum)}}</th>
                          </tr>
                    </tfoot>
                  </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection