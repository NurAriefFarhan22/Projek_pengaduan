<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaduan Masyarakat</title>
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
</head>
<body>
    <h2 class="title-table">Laporan Keluhan</h2>
<div style="display: flex; justify-content: center; margin-bottom: 30px">
    <a href="/logout" style="text-align: center">Logout</a> 
    <div style="margin: 0 10px"> | </div>
    <a href="/" style="text-align: center">Home</a>
</div>
<div style="display: flex; justify-content: flex-end; align-items: center">
    <form action="" method="GET">
        {{-- menggunakan method GET karena route untuk masuk ke halaman data ini meenggunakan ::GET --}}
        @csrf
        <input type="text" name="search" placeholder="Cari Berdasarkan Nama...." style="margin-right: 10px; padding: 0 30px;">
        <button type="submit" class="btn-login" style="margin-top: -1px; margin-right: 10px;">Cari</button>
    </form>

    <button class="refresh-btn" style="margin-right: 10px; margin-top: -15px;"><a href="{{route('data')}}">Refresh</a></button>
</div>
<div style="padding: 0 30px">
    <table>
        <thead>
        <tr>
            <th width="5%">No</th>
            <th>NIK</th>
            <th>Nama</th>
            <th>Telp</th>
            <th>Pengaduan</th>
            <th>Gambar</th>
            <th>Status Response</th>
            <th>Pesan Response</th>
            <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
            @php
                $no = 1;
            @endphp
            
            @foreach ($reports as $report)
            <tr>
            <td>{{$no++ }}</td>
            <td>{{$report->nik}}</td>
            <td>{{$report->nama}}</td>
            <td>{{$report->no_telp}}</td>
            <td>{{$report->pengaduan}}</td>
            <td>
                <img src="{{asset('assets/image/' . $report->foto)}}"  width="120" alt="">
            </td>
            <td>
                {{-- cek apakah data report ini sudah memiliki relasi dengan data dr with ('response') --}}
                @if ($report->response)
                {{-- kalau ada hasil relasinya, tampilkan bagian status --}}
                    {{$report->response['status'] }}
                @else
                {{-- kalau gada tampilan tanda ini --}}
                    -
                @endif
            </td>
            <td>
                {{-- cek apakah data report ini sudah memiliki relasi dengan data dr with ('response') --}}
                @if ($report->response)
                 {{-- itu response nya disamain kayak di ReportControllernya Report::with('response') --}}
                {{-- kalau ada hasil relasinya, tampilkan bagian status --}}
                    {{$report->response['pesan'] }}
                @else
                {{-- kalau gada tampilan tanda ini --}}
                    -
                @endif
            </td>
            <td style="display: flex; justify_content: center; ">
                <a href="{{route('response.edit', $report->id)}}" class="login-btn">Send Response</a>
            </td>
            </tr>
            @endforeach
            <tr>
        </tbody>
    </table>
</div>
</body>
</html>