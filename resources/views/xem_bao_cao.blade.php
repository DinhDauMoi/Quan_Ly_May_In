<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Báo cáo</title>
</head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
<link rel="icon" href="/img/favicon_fpt.png" type="image/png">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

@if (Session::has('error'))
<script>
    setTimeout(function() {
        Swal.fire({
            icon: 'error',
            title: 'Thất bại',
            text: `{{ Session::get('error') }}`,
            showConfirmButton: false,
            timer: 2000
        });
    }, 100);
</script>
@endif

@if (Session::has('success'))
<script>
    setTimeout(function() {
        Swal.fire({
            icon: 'success',
            title: 'Thành công',
            text: `{{ Session::get('success') }}`,
            showConfirmButton: false,
            timer: 2000
        });
    }, 100);
</script>
@endif

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
                        <a class="nav-link  fs-5" aria-current="page" href="{{route('quan_ly_may_in')}}">Máy in</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-5" href="{{route('quan_ly_muc_in')}}">Mực in</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active fs-5" href="{{route('bao_cao')}}">Báo cáo</a>
                    </li>
                </ul>
            </div>
            <div class="d-flex justify-content-end">
                <a class="nav-link fs-5" href="{{route('dang_xuat')}}">Hi {{ Auth::user()->ten_dang_nhap }} !</a>
            </div>
        </div>
    </nav>
    <h3 class="text-center p-3">Xem báo cáo {{$ngay_duoc_chon}}</h3>
    @if (isset($xem_bao_cao))
    <h5 class="border border-primary bg-primary rounded p-1 bg-opacity-25">
        Số lượng mực bơm: {{ $xem_bao_cao->so_luong }}
    </h5>
    @else
    <div class="border border-primary bg-primary rounded p-1 bg-opacity-25">
        Không có dữ liệu báo cáo
    </div>
    @endif
    <h5 class="border border-primary bg-primary rounded p-1 bg-opacity-25">Mực in hết</h5>
    @if (isset($xem_muc_in))
    <div>
        <table class="table text-center">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tên mực</th>
                    <th scope="col">Kho</th>
                    <th scope="col">Tình trạng</th>
                    <th scope="col">Drum</th>
                    <th scope="col">Ghi chú</th>
                </tr>
            </thead>
            <tbody>
                @foreach($xem_muc_in as $key => $i)
                <tr>
                    <th scope="row">{{$key+1}}</th>
                    <td>{{ $i->id_muc_in_sua < 10 ? '00' : '0' }}{{$i->id_muc_in_sua}}</td>
                    <td>{{$i->sua_muc_in->ten_kho}}</td>
                    <td class="{{$i->tinh_trang_muc==0?'text-danger':'text-success'}}">{{$i->tinh_trang_muc ==0?"Hết mực":"Còn mực"}}</td>
                    <td>{{$i->thay_drum?"Có":"Không"}}</td>
                    <td>{{$i->ghi_chu}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <div class="border border-primary bg-primary rounded p-1 bg-opacity-25">
        Không có dữ liệu mực in
    </div>
    @endif

    <h5 class="border border-primary bg-primary rounded p-1 bg-opacity-25">Mực in còn</h5>
    @if (isset($xem_muc_in_con))
    <div>
        <table class="table text-center">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tên mực</th>
                    <th scope="col">Kho</th>
                    <th scope="col">Tình trạng</th>
                    <th scope="col">Drum</th>
                    <th scope="col">Ghi chú</th>
                </tr>
            </thead>
            <tbody>
                @foreach($xem_muc_in_con as $key => $i)
                <tr>
                    <th scope="row">{{$key+1}}</th>
                    <td>{{ $i->id_muc_in_sua < 10 ? '00' : '0' }}{{$i->id_muc_in_sua}}</td>
                    <td>{{$i->sua_muc_in->ten_kho}}</td>
                    <td class="{{$i->tinh_trang_muc==0?'text-danger':'text-success'}}">{{$i->tinh_trang_muc ==0?"Hết mực":"Còn mực"}}</td>
                    <td>{{$i->thay_drum?"Có":"Không"}}</td>
                    <td>{{$i->ghi_chu}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <div class="border border-primary bg-primary rounded p-1 bg-opacity-25">
        Không có dữ liệu mực in
    </div>
    @endif

    <h5 class="border border-primary bg-primary rounded p-1 bg-opacity-25">Máy in</h5>

    @if (isset($xem_may_in))
    <div>
        <table class="table text-center">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tên máy</th>
                    <th scope="col">Kho</th>
                    <th scope="col">Bao lụa</th>
                    <th scope="col">Rulo</th>
                    <th scope="col">Bảo trì - Bôi mỡ</th>
                    <th scope="col">Ghi chú</th>
                </tr>
            </thead>
            <tbody>
                @foreach($xem_may_in as $key => $i)
                <tr>
                    <th scope="row">{{$key+1}}</th>
                    <td>{{ $i->id_may_in_sua < 10 ? '00' : '0' }}{{$i->id_may_in_sua}}</td>
                    <td>{{$i->sua_may_in->ten_kho}}</td>
                    <td>{{$i->thay_bao_lua ==null?"Không":"Có"}}</td>
                    <td>{{$i->thay_rulo ==null?"Không":"Có"}}</td>
                    <td>{{$i->bao_tri ==null?"Không":"Có"}}</td>
                    <td>{{$i->ghi_chu}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <div class="border border-primary bg-primary rounded p-1 bg-opacity-25">
        Không có dữ liệu máy in
    </div>
    @endif

</body>

</html>