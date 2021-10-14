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
                          <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Laporan</li>
                        </ol>
                        <h6 class="font-weight-bolder mb-0">Laporan Pembelian Barang</h6>
                    </nav>

                    {{--  form  --}}
                    <form id="form" style="color: black">
                        <div class="form-group" >
                          <label style="color: black" for="exampleFormControlInput1">Dari Tanggal</label>
                          <input type="date" class="form-control" id="dari" name="dari" value="{{Carbon\Carbon::now()->toDateString()}}">
                        </div>
                        <div class="form-group" >
                            <label style="color: black" for="exampleFormControlInput1">Sampai Tanggal</label>
                            <input type="date" class="form-control" id="sampai" name="sampai" value="{{Carbon\Carbon::now()->toDateString()}}">
                          </div>
                        <button type="button" id="btn" class="btn btn-secondary">Cari</button>
                      </form>
                </div>
                
            </div>

            <div class="card">
                <div class="table-responsive">
                  <table class="table align-items-center mb-0">
                    <thead>
                      <tr style="color: black">
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>No. Faktur</th>
                        <th>Total</th>
                        <th>Actions</th>
                      </tr>
                      
                    </thead>
                    <tbody id="tbody">
                      
                    </tbody>
                    <tfoot id ="tfoot">
                       
                    </tfoot>
                  </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="/js/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    
    $('#btn').on('click', function(){
        var tbody = " ";
        var tfoot = " ";
        var no = 1;
        var data = [];
    data[0] = document.getElementById('dari').value;
    data[1] = document.getElementById('sampai').value;
        $.ajax({
            type: 'get',
            url: '/gettanggaltransaksi',
            data: {'id': data},
            success: function(data){
                console.log(data)
                var formatter = new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                  
                    // These options are needed to round to whole numbers if that's what you want.
                    //minimumFractionDigits: 0, // (this suffices for whole numbers, but will print 2500.10 as $2,500.1)
                    //maximumFractionDigits: 0, // (causes 2500.99 to be printed as $2,501)
                  });
                  
                  formatter.format(2500);
                for(i=0; i < data.length; i++){
                    tbody+='<tr style="color: black;">';
                    tbody+='<th style="color: black; text-align:center;">'+ no++ +'</th>';
                    tbody+='<th>'+  data[i].tanggal+'</th>';
                    tbody+='<th>'+ data[i].faktur+'</th>';
                    tbody+='<th>'+ formatter.format(data[i].total)+'</th>';
                    tbody+='<th><a href="/transaksi/buka/'+data[i].faktur+'"><button type="button" id="btn" class="btn btn-success">Lihat</button></a> <a href="/cetak_pdf"><button class="btn btn-info "><i class="fas fa-file-pdf me-1"></i> PDF</button></a></th>';
                    tbody+='</tr>';
                }
                var date = [];
                date[0] = document.getElementById('dari').value;
                date[1] = document.getElementById('sampai').value;
                tfoot+='<tr><td colspan="5" style="text-align: center"><a href="/laporan/download/'+date[0]+'/'+date[1]+'"><button class="btn btn-primary">Download</button></a></td></tr>';
                
                $('#tbody').html(" ");
                $('#tbody').append(tbody);
                $('#tfoot').html(" ");
                $('#tfoot').append(tfoot);
            },
            error: function(){
                console.log('error')
            }
        })
    })
})
</script>
@endsection