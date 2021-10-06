<style type="text/css">
    table tr td,
    table tr th{
        font-size: 9pt;
    }
    @page {
      margin: 2cm 2cm;
  }

  /** Define now the real margins of every page in the PDF **/
  body {
      margin-top: 3cm;
      margin-left: 4cm;
      margin-right: 2cm;
      margin-bottom: 2cm;
  }

  /** Define the header rules **/
  header {
      position: fixed;
      top: 0cm;
      left: 0cm;
      right: 0cm;
      height: 3cm;
  }

  /** Define the footer rules **/
  footer {
      position: fixed; 
      bottom: 0cm; 
      left: 0cm; 
      right: 0cm;
      height: 2cm;
  }
</style>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>
  <img src="{{ ('img/header.jpg') }}" width="502" height="107" >

                    <h1 style="text-align: center">Laporan Perhari Logistik</h1>
                    {{--  form  --}}
                    @foreach($theader as $item)
                    <form id="form" style="color: black">
        
                        <div class="form-group" style="text-align: right">
                            <label style="color: black; " for="exampleFormControlInput1">Tanggal Transaksi: </label>
                            <label for="">{{Carbon\Carbon::parse($item->tanggal)->locale('ID')->settings(['formatFunction' => 'translatedFormat'])->format('jS F Y')}}</label>
                        </div>

                        <div class="form-group">
                            <label style="color: black" for="exampleFormControlInput1">No. Faktur</label>
                            <label for="">{{$item->faktur}}</label>
                        </div>
                    </form>
                      @endforeach

                  <table class="table table-bordered" >
                    <thead>
                      <tr style="color: black; text-align: center"   >
                        <th>No</th>
                        <th>Kurir</th>
                        <th>Toko</th>
                        <th>Alamat Toko</th>
                        <th>Nama Barang</th>
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
                        <th style="color: black; text-align: left">Rp. {{ number_format($item->total)}}</th>
                      </tr>
                      @endforeach
                    </tbody>
                    <tfoot>
                        <tr style="color: black">
                            <th style="color: black; text-align: center" colspan="5">Total</th>
                            <th style="color: black; text-align: left" id='total'>Rp. {{number_format($sum)}}</th>
                          </tr>
                    </tfoot>
                  </table>
        
                  <footer>
                    <img src="{{ ('img/footer.jpg') }}" width="502" height="107" >
                  </footer>