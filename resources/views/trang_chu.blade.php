<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>
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
                        <a class="nav-link active fs-5" aria-current="page" href="/">Trang chủ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-5" aria-current="page" href="{{route('quan_ly_may_in')}}">Máy in</a>
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
    <h4 class="text-center mt-3">QUẢN LÝ MÁY IN - MỰC IN</h4>
    <!-- Menu -->
    <h5>* CÁC MÁY IN SỬA CHỮA HÔM NAY ({{$so_luong_may_in}})</h5>
    <div class="">
        @foreach ($kho_groups as $kho => $group)
        <!-- Hiển thị tên kho -->
        <h5 class="mt-4">{{ $kho == 1 ? 'Kho 1' : ($kho == 2 ? 'Kho 2' : ($kho == 3 ? 'Kho 3' : ($kho == 4 ? 'Văn Phòng' : ($kho == 5 ? 'Điều Vận' : ($kho == 6 ? 'Vacxin' : 'Nhập'))))) }}</h5>

        <!-- Lặp qua các máy trong nhóm -->
        <div class="grid gap-2">
            @foreach ($group as $key => $i)
            <div class="border border-primary rounded p-2 g-col-4">
                <div class="d-flex justify-content-between">
                    <div style="font-weight: bold;" class="fs-4">
                        Máy {{ $i->sua_may_in->ten_kho }} - {{ $i->id_may_in_sua < 10 ? '00' : '0' }}{{ $i->id_may_in_sua }}
                    </div>
                    <div>
                        <a class="btn btn-danger rounded-circle" href="{{ route('xoa_may_in_bao_sua', ['id' => $i->id_may_in_sua, 'kho' => $i->kho]) }}"><i class="fa-solid fa-trash"></i></a>
                    </div>
                </div>
                <form action="{{ route('bao_hong_thay_linh_kien_may_in', ['id' => $i->id_may_in_sua]) }}" method="post">
                    @csrf
                    <input type="number" name="kho" style="display: none;" value="{{$i->kho}}">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" name="thay_bao_lua" {{ $i->thay_bao_lua ? 'checked' : '' }}>
                        <label class="form-check-label">Thay bao lụa</label>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" name="thay_rulo" {{ $i->thay_rulo ? 'checked' : '' }}>
                        <label class="form-check-label">Thay Rulo</label>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" name="bao_tri" {{ $i->bao_tri ? 'checked' : '' }}>
                        <label class="form-check-label">Bảo trì - bôi mỡ</label>
                    </div>
                    <div class="mt-2 mb-2">
                        <input placeholder="Ghi chú" type="text" name="ghi_chu" value="{{ $i->ghi_chu }}" class="form-control">
                    </div>
                    <div class="d-flex">
                        <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i></button>
                        <a class="btn btn-info ms-2" href="{{ route('lich_su_chi_tiet_may_in', ['id' => $i->id_may_in_sua, 'kho' => $i->kho]) }}"><i class="fa-solid fa-circle-info text-white"></i></a>
                    </div>
                </form>
            </div>
            @endforeach
        </div>
        @endforeach
    </div>


    <!-- Mực in -->
    <h5 class="mt-3">* CÁC HỘP MỰC BƠM HÔM NAY ({{$so_luong_muc_in}})</h5>

    <div>
        @foreach ($kho_groups_muc as $kho => $group)
        <!-- Hiển thị tên kho -->
        <h5 class="mt-4">{{ $kho == 1 ? 'Kho 1' : ($kho == 2 ? 'Kho 2' : ($kho == 3 ? 'Kho 3' : ($kho == 4 ? 'Văn Phòng' : ($kho == 5 ? 'Điều Vận' : ($kho == 6 ? 'Vacxin' : 'Nhập'))))) }}</h5>
        <div class="grid gap-2 mt-3">
            <!-- Lặp qua các mục trong nhóm -->
            @foreach ($group as $key => $i)
            <div class="border border-primary rounded p-2 g-col-3">
                <div class="d-flex justify-content-between">
                    <div class="border rounded-circle">
                        <form action="{{ route('con_muc', ['id_muc_in_sua' => $i->id_muc_in_sua]) }}" method="post">
                            @csrf
                            <input style="display: none;" type="number" name="tinh_trang_muc" value="{{ $i->tinh_trang_muc }}">
                            <button class="{{ $i->tinh_trang_muc ? 'btn btn-success' : 'btn btn-danger' }} rounded-circle">
                                {!! $i->tinh_trang_muc ? '<i class="fa-solid fa-check"></i>' : '<i class="fa-solid fa-x"></i>' !!}
                            </button>
                        </form>
                    </div>
                    <div style="font-weight: bold;" class="fs-6">
                        Mực in {{ $i->sua_muc_in->ten_kho }} - {{ $i->id_muc_in_sua < 10 ? '00' : '0' }}{{ $i->id_muc_in_sua }}
                    </div>
                    <div>
                        <a href="{{ route('xoa_muc_in_bao_bom', ['id_muc_in_sua' => $i->id_muc_in_sua, 'kho' => $i->kho]) }}" class="btn btn-danger rounded-circle"><i class="fa-solid fa-trash"></i></a>
                    </div>
                </div>
                <div>
                    <form action="{{ route('bao_hong_thay_linh_kien_muc_in', ['id' => $i->id_muc_in_sua]) }}" method="post" class="mt-2">
                        @csrf
                        <input style="display: none;" type="number" name="kho" value="{{$i->kho}}">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" name="thay_drum" {{ $i->thay_drum ? 'checked' : '' }}>
                            <label class="form-check-label" for="flexSwitchCheckDefault">Thay Drum</label>
                        </div>
                        <div class="mt-2 mb-2">
                            <input placeholder="Ghi chú" type="text" name="ghi_chu" value="{{ $i->ghi_chu }}" class="form-control" id="exampleCheck1">
                        </div>
                        <div class="d-flex">
                            <button type="submit" class="btn btn-primary me-2"><i class="fa-solid fa-floppy-disk"></i></button>
                            <a class="btn btn-info" href="{{ route('lich_su_chi_tiet_muc_in', ['id' => $i->id_muc_in_sua, 'kho' => $i->kho]) }}"><i class="fa-solid fa-circle-info text-white"></i></a>
                        </div>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
        @endforeach
    </div>
</body>


</html>