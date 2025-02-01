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
    <h5 class="text-center m-2">BÁO CÁO</h5>
    <div class="text-end m-3">
        <button type="button" class="btn btn-primary m-3" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@getbootstrap">Xem báo cáo hôm nay</button>
        <a class="btn btn-success" href="{{route('export')}}">Xuất báo cáo</a>
    </div>
    <div>
        <h5 class="text-center">SỐ LƯỢNG MỰC BƠM HÔM NAY</h5>

        @if($bao_cao)
        <form action="{{route('cap_nhat_so_luong_muc')}}" method="post" class="d-flex justify-content-around m-3 p-3 border border-primary rounded">
            @csrf
            <div>
                <input required placeholder="Số lượng mực" value="{{$bao_cao->so_luong}}" name="so_luong" type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div>
                <button type="submit" class="btn btn-primary">Cập nhật</button>
            </div>
        </form>
        @else
        <form action="{{route('them_so_luong_binh_muc')}}" method="post" class="d-flex justify-content-around m-3 p-3 border border-primary rounded">
            @csrf
            <div>
                <input required placeholder="Số lượng mực" name="so_luong" type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div>
                <button type="submit" class="btn btn-primary">Thêm</button>
            </div>
        </form>
        @endif

        <div>

            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Báo cáo bơm mực ngày {{$get_day}} </h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <div>
                                @if ($bao_cao)
                                <div>*Số lượng mực: {{ $bao_cao->so_luong }}</div>
                                @else
                                <div>Không có dữ liệu báo cáo cho ngày {{ $get_day }}</div>
                                @endif
                            </div>
                            <div>*Các máy in sửa
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
                                        @foreach($sua_may_in as $key => $i)
                                        <tr>
                                            <th scope="row">{{$key+1}}</th>
                                            <td>{{$i->id_may_in_sua <10?"00":"0"}}{{$i->id_may_in_sua}}</td>
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
                            <div class="">Số lượng mực bơm ({{$sua_muc_in_het_count}})</div>
                            <div class="d-flex">

                                @foreach($sua_muc_in_het as $key=>$i)
                                <p class="{{$i->thay_drum?'text-danger':''}}">
                                    {{$i->id_muc_in_sua <10?"00":"0"}}{{$i->id_muc_in_sua}}->{{$i->sua_muc_in->ten_kho}},
                                </p>
                                @endforeach
                            </div>
                            <div>Số lượng mực báo bơm nhưng còn ({{$sua_muc_in_con_count}})</div>
                            <div class="d-flex">
                                @foreach($sua_muc_in_con as $key=>$i)
                                <p>
                                    {{$i->id_muc_in_sua <10?"00":"0"}}{{$i->id_muc_in_sua}}->{{$i->sua_muc_in->ten_kho}},
                                </p>
                                @endforeach
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <!-- <button type="button" class="btn btn-primary">Send message</button> -->
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <h5 class="text-center">CHỌN NGÀY XEM BÁO CÁO</h5>
                <form method="GET" action="{{ route('xem_bao_cao') }}" class="d-flex justify-content-around m-3 p-3 border border-primary rounded">
                    @csrf
                    <div class="m-3">
                        <input type="date" name="ngay_bao_cao" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <button type="submit" class="btn btn-primary m-3" data-bs-toggle="modal" data-bs-target="#exampleModal_mod" data-bs-whatever="@getbootstrap">Xem</button>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Xóa dữ liệu</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('xoa_du_lieu')}}" method="get">
                    @csrf
                    <div class="modal-footer">
                        <p class="text-center">
                            Nhập mật khẩu !!!
                        </p>
                        <input required class="form-control" type="password" name="mat_khau">
                        <button class="btn btn-danger" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal">Xóa</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <button class="btn btn-danger" data-bs-target="#exampleModalToggle" data-bs-toggle="modal">Xóa dữ liệu</button>
</body>

</html>