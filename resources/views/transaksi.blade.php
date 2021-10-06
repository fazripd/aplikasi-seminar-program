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
                        <h6 class="font-weight-bolder mb-0">Input Pembelian Barang</h6>
                    </nav>

                    {{--  form  --}}
                    <form id="form" style="color: black">
                        @csrf
                        <div class="form-group" >
                          <label style="color: black" for="exampleFormControlInput1">Tanggal pembelian</label>
                          <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{Carbon\Carbon::now()->toDateString()}}">
                        </div>

                        <div class="form-group">
                            <label style="color: black" for="exampleFormControlInput1">No. Faktur</label>
                            <input type="text" class="form-control" id="faktur" name="faktur"  value="AMS.LGS.{{Carbon\Carbon::now()->Format('ymd')}}-{{Carbon\Carbon::now()->Format('Hi')}}" >
                            {{--  <input type="text" class="form-control" id="faktur" name="faktur" value="AMS.LGS.{{Carbon\Carbon::now()->Format('ymd')}}-{{Carbon\Carbon::now()->Format('Hi')}}" hidden>  --}}
                        </div>
                        
                        <div class="form-group">
                          <label style="color: black" for="exampleFormControlSelect1">Kurir</label>
                          <select class="form-control" id="kurir" name="kurir">
                            <option selected disabled>Pilih Kurir</option>
                            @foreach ($kurir as $item)
                                <option value="{{$item->name}}">{{$item->name}}</option>  
                            @endforeach
                          </select>
                        </div>

                        <div class="form-group">
                            <label style="color: black" for="exampleFormControlInput1">Nama Toko</label>
                            <input type="text" class="form-control" id="toko" name="toko" placeholder="Masukan Nama Toko">
                        </div>
                        
                        <div class="form-group">
                            <label style="color: black" for="exampleFormControlInput1">Alamat</label>
                            <textarea name="alamat" id="alamat" rows="3" class="form-control" placeholder="Masukan Alamat"></textarea>
                        </div>

                        <div class="form-group">
                            <label style="color: black" for="exampleFormControlInput1">Nama Barang</label>
                            <input type="text" class="form-control" id="namabarang" name="namabarang" placeholder="Masukan Nama Barang">
                        </div>
                        
                        <div class="form-group">
                            <label style="color: black" for="exampleFormControlInput1">Jumlah Barang</label>
                            <input type="number" class="form-control" id="jumlah" min="0" name="jumlah" placeholder="Masukan Jumlah Barang">
                        </div>
                       
                        <div class="form-group">
                            <label style="color: black" for="exampleFormControlInput1">Harga Satuan</label>
                            <input type="number" class="form-control" id="harga" min="0" name="harga" placeholder="Masukan Harga Satuan">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-secondary">Submit</button>
                            <button type="reset" class="btn btn-info">Reset</button>
                        </div>
                        
                      </form>
                </div>
                
            </div>

            <div class="card">
                <div class="table-responsive">
                  <table class="table align-items-center mb-0">
                    <thead>
                      <tr style="color: black">
                        <th>No</th>
                        <th>No. Faktur</th>
                        <th>Kurir</th>
                        <th>Toko</th>
                        <th>Alamat Toko</th>
                        <th>Nama Barang</th>
                        <th>Jumlah</th>
                        <th>Harga Satuan</th>
                        <th>Total</th>
                      </tr>
                      
                    </thead>
                    <tbody id="gettable">
                      
                    </tbody>
                    <tfoot>
                        <tr style="color: black">
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th>Total</th>
                            <th id='total'>-</th>
                          </tr>
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
        $('#form').on('submit', function(e){
            e.preventDefault();
            $.ajax({
                type: 'post',
                url: '/transaksi/store',
                data: $('#form').serialize(),
                success: function(data){
                    console.log('terinput')
                    document.getElementById('namabarang').value ="";
                    document.getElementById('jumlah').value ="";
                    document.getElementById('harga').value ="";
                },
                error: function(){
                    console.log('error')
                }
            })

            $.ajax({
                type: 'get',
                url: '/gettabletransaksi',
                data: {'id': document.getElementById('faktur').value},
                success: function(data){
                    var gettable = " ";
                    var no = 1;
                    console.log('tabel munculll')

                    for(i=0; i< data.length;i++){
                        gettable+='<tr style="color: black">';
                            gettable+='<th style="text-align: center">'+ no++ +'</th>';
                            gettable+='<th>'+data[i].faktur+'</th>';
                            gettable+='<th>'+data[i].kurir+'</th>';
                            gettable+='<th>'+data[i].toko+'</th>';
                            gettable+='<th>'+data[i].alamat+'</th>';
                            gettable+='<th>'+data[i].namabarang+'</th>';
                            gettable+='<th style="text-align: center">'+data[i].jumlah+'</th>';
                            gettable+='<th style="text-align: center">'+data[i].harga+'</th>';
                            gettable+='<th style="text-align: center">'+ (data[i].jumlah*data[i].harga) +'</th>';
                          gettable+='</tr>';
                    }

                    $('#gettable').html(' ');
                    $('#gettable').append(gettable);
                },
                error: function(){
                    console.log('cupu')
                }
            })
            
            $.ajax({
                type: 'get',
                url: '/sumtable',
                dataType: 'json',
                data: {'id': document.getElementById('faktur').value},
                success: function(data){
                    var total = "";
                    
                    console.log(data)
                    
                    
                    total+='<th id="total">'+data+'</th>';
                    $('#total').html(' ');
                    $('#total').append(total);
                },
                error: function(){
                    console.log('error')
                }
            })
        })
    })
</script>
@endsection