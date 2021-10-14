<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        #customers {
          font-family: Arial, Helvetica, sans-serif;
          border-collapse: collapse;
          width: 100%;
        }
        @page {
            margin: 2cm 2cm 2cm 2cm;
        }
        #customers td, #customers th {
          border: 1px solid #ddd;
          padding: 8px;
        }
        
        #customers tr:nth-child(even){background-color: #f2f2f2;}
        
        #customers tr:hover {background-color: #ddd;}
        
        #customers th {
          padding-top: 12px;
          padding-bottom: 12px;
          text-align: left;
          background-color: #081e9b;
          color: white;
        }
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
</head>
<body>


      <img src="{{ public_path('assets/img/header.jpg') }}" width="652" height="107" >
    
                        <h1 style="text-align: center">Laporan Transaksi Logistik</h1>
                        {{--  form  --}}

                        <form id="form" style="color: black">
            
                            <div class="form-group" style="text-align: right">
                                <label style="color: black; " for="exampleFormControlInput1"> Transaksi dari: </label>
                                <label for="">{{Carbon\Carbon::parse($d1)->locale('ID')->settings(['formatFunction' => 'translatedFormat'])->format('jS F Y')}} - {{Carbon\Carbon::parse($d2)->locale('ID')->settings(['formatFunction' => 'translatedFormat'])->format('jS F Y')}}</label>
                            </div> <br>
    
                        </form>

    
                      <table class="table table-bordered" id="customers">
                        <thead>
                          <tr style="color: black; text-align: center"   >
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>NO Faktur</th>
                            {{--  <th>Uraian</th>  --}}
                            <th>Total</th>
                          </tr>
                          
                        </thead>
                        @php
                            $no = 1;
                        @endphp
                        <tbody id="gettable">
                          @foreach ($download as $item)
                          <tr style="color: black">
                            <td style="color: black; text-align: center">{{ $no++}}</td>
                            <td>{{Carbon\Carbon::parse($item->tanggal)->locale('ID')->settings(['formatFunction' => 'translatedFormat'])->format('jS F Y')}}</td>
                            <td>{{$item->faktur}}</td>
                            {{--  <td>
                             
                            </td>  --}}
                            <td style="color: black; text-align: left">Rp. {{ number_format($item->total)}}</td>
                          </tr>
                          @endforeach
                        </tbody>
                        <tfoot>
                            <tr style="color: black">
                                <th style="text-align: center" colspan="3">Total</th>
                                <th style="text-align: left" id='total'>Rp. {{number_format($sum)}}</th>
                              </tr>
                        </tfoot>
                      </table>
                      
                      <footer>
                        <img src="{{ public_path('assets/img/footer.jpg') }}" width="652" height="107" >
                      </footer>    
</body>
</html>