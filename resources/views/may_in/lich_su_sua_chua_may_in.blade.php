<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý mực in</title>
</head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
<link rel="icon" href="/img/favicon_fpt.png" type="image/png">

<body class="container">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="/"><img src="/img/favicon_fpt.png" alt="Logo" width="60" height="44" class="d-inline-block align-text-top"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link fs-5" aria-current="page" href="/">Trang chủ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active fs-5" aria-current="page" href="{{route('quan_ly_may_in')}}">Máy in</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-5" href="{{route('quan_ly_muc_in')}}">Mực in</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-5" href="{{route('bao_cao')}}">Báo cáo</a>
                    </li>
                </ul>
            </div>
            <div class="d-flex justify-content-end">
                <a class="nav-link fs-5" href="{{route('dang_xuat')}}">Hi {{ Auth::user()->ten_dang_nhap }} !</a>
            </div>
        </div>
    </nav>
    <h5 class="text-center mt-3">LỊCH SỬ MÁY IN</h5>
    <table class="table text-center">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Ngày báo hư</th>
                <th scope="col">Bao lụa</th>
                <th scope="col">Rulo</th>
                <th scope="col">Bảo trì - Bôi mỡ</th>
                <th scope="col">Ghi chú</th>
            </tr>
        </thead>
        <tbody>
            @foreach($lich_sua_sua_may as $key => $i)
            <tr>
                <th scope="row">{{$key+1}}</th>
                <td>{{$i->ngay_bao_hong}}</td>
                <td>{{$i->thay_bao_lua ==null?"Không":"Có"}}</td>
                <td>{{$i->thay_rulo ==null?"Không":"Có"}}</td>
                <td>{{$i->bao_tri ==null?"Không":"Có"}}</td>
                <td>{{$i->ghi_chu}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>