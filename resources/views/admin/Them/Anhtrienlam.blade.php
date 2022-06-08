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
            <div id='main-container'>
                <!-- Main  -->

                <h2>Thêm Ảnh Triển Lãm</h2>

                <form style="width: 80%; margin-left: 5%;">
                    <div class="mb-3">
                        <label for="matrienlam" class="form-label">Mã Triển Lãm</label>
                        <input type="text" class="form-control" id="matrienlam">
                    </div>
                    <div class="mb-3">
                        <label for="anh" class="form-label">Ảnh Triển Lãm</label>
                        <input class="form-control" type="file" id="anh" multiple>
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

        });

        function Them() {

            var matrienlam = document.querySelector('#matrienlam').value
            var anh = document.querySelector('#anh').files

            if (matrienlam.length != 0 && anh.length != 0) {
                var formData = new FormData()
                formData.append('matrienlam', matrienlam)

                if (anh.length > 1) {
                    for (var i = 0; i < anh.length; i++) {
                        formData.append("anh[]", anh[i])
                    }
                } else {
                    formData.append('anh', anh[0])
                }

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
