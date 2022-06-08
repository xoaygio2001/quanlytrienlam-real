<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/Chitiet.css') }}">
</head>

<body>

    <div id='container'>
        <header>

            <!-- Header -->
            <nav class="navbar navbar-expand-lg bt-dark" style="margin-left: 60%;">
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
                <button class="btn btn-dark" style="margin-left: 4%;">Đăng Xuất</button>
            </nav>
            <!-- Header -->

        </header>
        <div id="main-container">
            <!-- Main -->

            <div id="img-container">
                <img id="anhdaidien"
                    style="width: 100%;" />
                <div id="subimg-container">
                    
                    {{-- <img src="https://luxuo.vn/wp-content/uploads/2019/10/UU_1403.jpg"
                        style="width: 80px; height: 60px; margin-left: 5%; margin-top: 5%;" /> --}}
                        
                </div>
            </div>
            <div id="content-container">
                {{-- <h2>Tên Triển Lãm: Triển Lãm Tranh Đông Hồ</h2>
                <h4>Mã Triễn Lãm: 01</h4>
                <h4>Tên Danh Mục: Triển Lãm Tranh</h4>
                <h4>Địa Điểm: 19 Lý Tự Trọng</h4>
                <h4>Thời Gian Bất Đầu: 11h30</h4>
                <h4>Thời Gian Kết Thúc: 11h31</h4>
                <h4>Tiêu Đề: Triển lãm ở đây rất hay</h4>
                <h4>Nội dùng:</h4>
                <textarea readonly name="" id="" cols="60" rows="9"></textarea>
                <br>
                <br>
                <button class="btn btn-outline-light">Quay Lại</button> --}}

            </div>

            <!-- Main -->

        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>

    <script>
        $(document).ready(function(e) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var anhdaidien = document.querySelector('#anhdaidien')
            var subimg = document.querySelector('#subimg-container')       
            var content = document.querySelector('#content-container')
            address = location.href

            //content
            $.ajax({
                type: 'POST',
                url: address,
                // data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: (response) => {
                    var data = JSON.parse(response).trienlam
                    var str = `
                <h2>Tên Triển Lãm: ${data.ten_trienlam}</h2>
                <h4>Mã Triễn Lãm: ${data.ma_trienlam}</h4>
                <h4>Tên Danh Mục: ${data.ten_danhmuc}</h4>
                <h4>Địa Điểm: ${data.diachi_trienlam}</h4>
                <h4>Thời Gian Bất Đầu: ${data.thoigianbatdau}</h4>
                <h4>Thời Gian Kết Thúc: ${data.thoigianketthuc}</h4>
                <h4>Tiêu Đề: ${data.mota_trienlam}</h4>
                <h4>Nội dùng:</h4>
                <textarea readonly name="" id="" cols="75" rows="8">${data.noidung_trienlam}</textarea>
                <br>
                <br>
                <a href="{{route('quanlytrienlam')}}" class="btn btn-outline-light">Quay Lại</a>
                `
                
                content.innerHTML = str
                
                anhdaidien.src = `${data.anhdaidien}`
                }
            })

            console.log(location)

            // IMG
            $.ajax({
                type: 'POST',
                url: address,
                // data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: (response) => {
                    var data = JSON.parse(response).anh
                    var str = data.map((item, index) => {
                        return `
                        <img src="${item.duongdan}"
                        style="width: 80px; height: 50px; margin-left: 5%; margin-top: 5%;" />
                        `
                    })

                    str = str.join('')

                    subimg.innerHTML = str

                }
            })

            




        });

        function Them() {

            var tendanhmuc = document.querySelector('#tendanhmuc').value
            var motadanhmuc = document.querySelector('#motadanhmuc').value

            if (tendanhmuc.length != 0 && motadanhmuc.length != 0) {
                var formData = new FormData()

                formData.append('tendanhmuc', tendanhmuc)
                formData.append('motadanhmuc', motadanhmuc)

                var address = location.href
                $.ajax({
                    type: 'POST',
                    url: address,
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: (response) => {
                        var data = JSON.parse(response)
                        if (data.result) {
                            alert("Thêm Danh Mục Thành Công")
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
