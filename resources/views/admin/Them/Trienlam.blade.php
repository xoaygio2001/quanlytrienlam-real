<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/Chinh.css') }}">
</head>

<body>

    <div id='container'>
        <div id='sidebar'>
            <!-- <Sidebar /> -->


            <div style="margin-top: 5%; margin-left: 2%;">
                <a href="{{ route('trangchu') }}">Trang Chủ</a>
            </div>

            <hr />

            <div style="margin-top: 5%; margin-left: 2%;">
                <a href="{{ route('quanlytrienlam') }}">Quản Lý Triển Lãm</a>
            </div>
            <div style="margin-top: 5%; margin-left: 2%;">
                <a href="{{ route('quanlydanhmuc') }}">Quản Lý Danh Mục</a>
            </div>
            <div style="margin-top: 5%; margin-left: 2%;">
                <a href="{{ route('quanlynguoidung') }}">Quản Lý Người Dùng</a>
            </div>
            <div style="margin-top: 5%; margin-left: 2%;">
                <a href="{{ route('quanlybinhluan') }}">Quản Lý Bình Luận</a>
            </div>
            <div style="margin-top: 5%; margin-left: 2%;">
                <a href="{{ route('quanlyanhtrienlam') }}">Quản Lý Ảnh Triển Lãm</a>
            </div>
            <div style="margin-top: 5%; margin-left: 2%;">
                <a href="{{ route('quanlydangkytrienlam') }}">Quản Lý Đăng Ký Triển Lãm</a>
            </div>

            <hr />

            <div style="margin-top: 5%; margin-left: 2%;">
                <a href="{{ route('themtrienlam') }}">Thêm Triển Lãm</a>
            </div>
            <div style="margin-top: 5%; margin-left: 2%;">
                <a href="{{ route('themdanhmuc') }}">Thêm Danh Mục</a>
            </div>
            <div style="margin-top: 5%; margin-left: 2%;">
                <a href="{{ route('themanhtrienlam') }}">Thêm Ảnh Triển Lãm</a>
            </div>



            <!-- <Sidebar /> -->
        </div>
        <main>
            <header>
                <!-- <Header /> -->
                <nav class="navbar navbar-expand-lg bt-dark" style="margin-left: 60%;">
                    <form class="d-flex" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                    <button class="btn btn-dark" style="margin-left: 5%;">Đăng Xuất</button>
                </nav>

                <!-- <Header /> -->
            </header>
            <div id='main-container' style="height: 150%;">
                <!-- Main  -->

                <h2>Thêm Triển Lãm</h2>

                <form style="width: 80%; margin-left: 5%;">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Tên Triển Lãm</label>
                        <input type="text" class="form-control" id="tentrienlam" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Danh Mục</label>
                        <select class="form-select" aria-label="Default select example" id="danhmuc">
                            <option selected>Danh Mục</option>
                            <option value=1>One</option>
                            <option value=2>Two</option>
                            <option value=3>Three</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="diadiem" class="form-label">Địa Điểm</label>
                        <input type="text" class="form-control" id="diadiem">
                    </div>
                    <div class="mb-3">
                        <label for="thoigianbatdau" class="form-label">Thời Gian Bắt Đầu</label>
                        <input type="datetime-local" class="form-control" id="thoigianbatdau"
                            aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="thoigianketthuc" class="form-label">Thời Gian Kết Thúc</label>
                        <input type="datetime-local" class="form-control" id="thoigianketthuc">
                    </div>
                    <div class="mb-3">
                        <label for="anhdaidien" class="form-label">Ảnh Đại Diện</label>
                        <input class="form-control" type="file" id="anhdaidien">
                    </div>
                    <div class="mb-3">
                        <label for="motatrienlam" class="form-label">Mô Tả Triển Lãm</label>
                        <br>
                        <textarea name="" id="motatrienlam" cols="110" rows="4"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="noidungtrienlam" class="form-label">Nội Dung Triển Lãm</label>
                        <br>
                        <textarea name="" id="noidungtrienlam" cols="110" rows="12"></textarea>
                    </div>


                    <button onclick="(function(e){e.preventDefault(); Them() })(event)" type="submit"
                        class="btn btn-primary">
                        Thêm
                    </button>
                </form>


                <!-- Main  -->
            </div>
            <footer>
                <!-- <Footer /> -->
                <p>Email: contact@fullstack.edu.vn</p>
                <p>© 2018 - 2022 F8. All rights reserved.</p>
                <!-- <Footer /> -->
            </footer>
        </main>
    </div>


    <!-- JavaScript Bundle with Popper -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>

    <script type="text/javascript">
        $(document).ready(function(e) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var select = document.querySelector('select')
            var address = location.origin + '/admin/quanlydanhmuc'
            $.ajax({
                type: 'POST',
                url: address,
                cache: false,
                contentType: false,
                processData: false,
                success: (response) => {

                    var data = JSON.parse(response)
                    var str = data.map((item, index) => {
                        return `
                            <option value=${item.ma_danhmuc}>${item.ten_danhmuc}</option>
                        `
                    })
                    str = str.join('')

                    select.innerHTML = str


                }

            })


        });

        function Them() {

            var tentrienlam = document.querySelector('#tentrienlam').value
            var danhmuc = document.querySelector('#danhmuc').value
            var diadiem = document.querySelector('#diadiem').value
            var thoigianbatdau = document.querySelector('#thoigianbatdau').value
            var thoigianketthuc = document.querySelector('#thoigianketthuc').value
            var anhdaidien = document.querySelector('#anhdaidien').files[0]
            var motatrienlam = document.querySelector('#motatrienlam').value
            var noidungtrienlam = document.querySelector('#noidungtrienlam').value

            if (tentrienlam.length != 0 && danhmuc.length != 0 && diadiem.length != 0 &&
                thoigianbatdau.length != 0 && thoigianketthuc.length != 0 && anhdaidien.length != undefined &&
                motatrienlam.length != 0 && noidungtrienlam.length != 0
            ) {
                var formData = new FormData()

                formData.append('tentrienlam', tentrienlam)
                formData.append('danhmuc', danhmuc)
                formData.append('diadiem', diadiem)
                formData.append('thoigianbatdau', thoigianbatdau)
                formData.append('thoigianketthuc', thoigianketthuc)
                formData.append('anhdaidien', anhdaidien)
                formData.append('motatrienlam', motatrienlam)
                formData.append('noidungtrienlam', noidungtrienlam)

                var address = location.href
                $.ajax({
                    type: 'POST',
                    url: address,
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: (response) => {
                        $data = JSON.parse(response)
                        if ($data.result) {
                            alert("Thêm Triển Lãm Thành Công")
                            window.location = location.href
                        } else {
                            alert($data.mss)
                        }

                    },
                    error: function(response) {
                        console.log(response);

                    }
                })
            } else {
                alert('Vui Lòng Điền Đầy Đủ Thông Tin')
            }

        }
    </script>
</body>

</html>
