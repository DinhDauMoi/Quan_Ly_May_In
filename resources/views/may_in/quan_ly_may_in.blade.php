<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý máy in</title>
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
    <div>
        <form action="{{route('them_may_in')}}" method="post" class="d-flex justify-content-around m-3 p-3 border border-primary rounded">
            @csrf
            <div>
                <input required placeholder="ID Máy in" name="id_may_in" type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div>
                <select name="kho" class="form-select" aria-label="Default select example">
                    <option selected disabled>Chọn kho</option>
                    @foreach($kho as $key => $k)
                    <option value="{{$k->id}}">{{$k->ten_kho}}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <input name="ghi_chu" placeholder="Ghi chú (Không bắt buộc)" type="text" class="form-control" id="exampleInputPassword1">
            </div>
            <div>
                <button type="submit" class="btn btn-primary">Thêm</button>
            </div>
        </form>
        <div>
            <h5 class="text-center text-success">DANH SÁCH MÁY IN</h5>
            @foreach($kho_groups as $kho => $may_in_list)
            <h6 class="text-center border border-success rounded bg-success bg-opacity-25"><?php
                                                                                            switch ($kho) {
                                                                                                case 1:
                                                                                                    echo "Kho 1";
                                                                                                    break;
                                                                                                case 2:
                                                                                                    echo "Kho 2";
                                                                                                    break;
                                                                                                case 3:
                                                                                                    echo "Kho 3";
                                                                                                    break;
                                                                                                case 4:
                                                                                                    echo "Văn phòng";
                                                                                                    break;
                                                                                                case 5:
                                                                                                    echo "Điều vận";
                                                                                                    break;
                                                                                                case 6:
                                                                                                    echo "Vacxin";
                                                                                                    break;
                                                                                                case 7:
                                                                                                    echo "Nhập";
                                                                                                    break;
                                                                                                default:
                                                                                                    echo "Không xác định";
                                                                                                    break;
                                                                                            }
                                                                                            ?></h6>
            <table class="table table-striped text-center">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tên máy</th>
                        <th scope="col">Kho</th>
                        <th scope="col">Ghi chú</th>
                        <th scope="col">#</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($may_in_list as $key => $i)
                    <tr>
                        <th scope="row">{{ $key + 1 }}</th>
                        <td>{{ $i->id_may_in < 10 ? "00" : "0" }}{{ $i->id_may_in }}</td>
                        <td>{{ $i->may_in->ten_kho }}</td>
                        <td>{{ $i->ghi_chu }}</td>
                        <td>
                            <div class="d-flex justify-content-center">
                                <form class="me-2" action="{{ route('them_may_in_sua', ['id' => $i->id_may_in]) }}" method="post">
                                    @csrf
                                    <input style="display: none;" type="number" name="id_may_in_sua" value="{{ $i->id_may_in }}">
                                    <input style="display: none;" type="number" name="kho" value="{{ $i->kho }}">
                                    <button {{ $i->trang_thai == 1 ? "disabled" : "" }} type="submit" class="btn btn-success">
                                        <i class="fa-solid fa-plus text-black"></i>
                                    </button>
                                </form>
                                <form class="me-2" action="{{ route('trang_thai_may_in', ['id' => $i->id_may_in]) }}" method="post">
                                    @csrf
                                    <input style="display: none;" type="number" name="trang_thai" value="{{ $i->trang_thai }}">
                                    <input style="display: none;" type="number" name="kho" value="{{$i->kho}}">
                                    <button class="btn btn-warning" type="submit">
                                        {!! $i->trang_thai ? '<i class="fa-solid fa-x"></i>' : '<i class="fa-solid fa-check"></i>' !!}
                                    </button>
                                </form>
                                <div class="me-2">
                                    <a class="btn btn-info" href="{{ route('lich_su_chi_tiet_may_in', ['id' => $i->id_may_in, 'kho' => $i->kho]) }}">
                                        <i class="fa-solid fa-circle-info text-black"></i>
                                    </a>
                                </div>
                                <div>
                                    <a class="btn btn-danger" href="{{ route('xoa_may_in', ['id' => $i->id_may_in, 'kho' => $i->kho]) }}">
                                        <i class="fa-solid fa-x text-black"></i>
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endforeach

        </div>
        <hr>
        <div>


            <h5 class="text-center text-danger">DANH SÁCH MÁY IN HỎNG</h5>
            @foreach($kho_groups_hu as $kho => $may_in_list)
            <h6 class="text-center border border-danger rounded bg-danger bg-opacity-25"><?php
                                                                                            switch ($kho) {
                                                                                                case 1:
                                                                                                    echo "Kho 1";
                                                                                                    break;
                                                                                                case 2:
                                                                                                    echo "Kho 2";
                                                                                                    break;
                                                                                                case 3:
                                                                                                    echo "Kho 3";
                                                                                                    break;
                                                                                                case 4:
                                                                                                    echo "Văn phòng";
                                                                                                    break;
                                                                                                case 5:
                                                                                                    echo "Điều vận";
                                                                                                    break;
                                                                                                case 6:
                                                                                                    echo "Vacxin";
                                                                                                    break;
                                                                                                case 7:
                                                                                                    echo "Nhập";
                                                                                                    break;
                                                                                                default:
                                                                                                    echo "Không xác định";
                                                                                                    break;
                                                                                            }
                                                                                            ?></h6>
            <table class="table table-striped text-center">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tên máy</th>
                        <th scope="col">Kho</th>
                        <th scope="col">Ghi chú</th>
                        <th scope="col">#</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($may_in_list as $key => $i)
                    <tr>
                        <th scope="row">{{ $key + 1 }}</th>
                        <td>{{ $i->id_may_in < 10 ? "00" : "0" }}{{ $i->id_may_in }}</td>
                        <td>{{ $i->may_in->ten_kho }}</td>
                        <td>{{ $i->ghi_chu }}</td>
                        <td>
                            <div class="d-flex justify-content-center">
                                <form class="me-2" action="{{ route('them_may_in_sua', ['id' => $i->id_may_in]) }}" method="post">
                                    @csrf
                                    <input style="display: none;" type="number" name="id_may_in_sua" value="{{ $i->id_may_in }}">
                                    <input style="display: none;" type="number" name="kho" value="{{ $i->kho }}">
                                    <button {{ $i->trang_thai == 1 ? "disabled" : "" }} type="submit" class="btn btn-success">
                                        <i class="fa-solid fa-plus text-black"></i>
                                    </button>
                                </form>
                                <form class="me-2" action="{{ route('trang_thai_may_in', ['id' => $i->id_may_in]) }}" method="post">
                                    @csrf
                                    <input style="display: none;" type="number" name="trang_thai" value="{{ $i->trang_thai }}">
                                    <input style="display: none;" type="number" name="kho" value="{{$i->kho}}">
                                    <button class="btn btn-warning" type="submit">
                                        {!! $i->trang_thai ? '<i class="fa-solid fa-x"></i>' : '<i class="fa-solid fa-check"></i>' !!}
                                    </button>
                                </form>
                                <div class="me-2">
                                    <a class="btn btn-info" href="{{ route('lich_su_chi_tiet_may_in', ['id' => $i->id_may_in, 'kho' => $i->kho]) }}">
                                        <i class="fa-solid fa-circle-info text-black"></i>
                                    </a>
                                </div>
                                <div>
                                    <a class="btn btn-danger" href="{{ route('xoa_may_in', ['id' => $i->id_may_in, 'kho' => $i->kho]) }}">
                                        <i class="fa-solid fa-x text-black"></i>
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endforeach
        </div>
    </div>
</body>

</html>