<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                <nav class="navbar navbar-expand-lg bt-dark" style="margin-left: 70%;">
                    <form class="d-flex" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </nav>

                <!-- <Header /> -->
            </header>
            <div id='main-container'>
                <!-- Main  -->

                <h2>Quản Lý Đăng Ký Triển Lãm</h2>
                <form class="d-flex" role="search" style="margin-left: 70%; margin-right: 5%;">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
                <div id="table-wrapper" style="width: 95%;margin-left: 2%;">
                    <div id="table-scroll">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Mã Đăng Ký</th>
                                    <th>Tên Triển Lãm</th>
                                    <th>Tên Danh Mục</th>
                                    <th>Ảnh Đại Diện</th>
                                    <th>Chức Năng</th>

                                </tr>
                            </thead>
                            <tbody>
                                {{-- <tr>
                                    <td>1</td>
                                    <td>1</td>
                                    <td>Triển Lãm Tranh Đông Hồ</td>
                                    <td>Triển Lãm Tranh</td>
                                    <td>
                                        <img style="height: 100px;width: 150px;"
                                            src="https://cdnmedia.baotintuc.vn/Upload/DMDnZyELa7xUDTdLsa19w/files/2021/01/050121/trien-lam-070121.jpg"
                                            alt="Ảnh lỗi">
                                    </td>
                                    <td>
                                        <Button class="btn btn-info">Xem Chi Tiết</Button>
                                        <Button class="btn btn-primary">Chấp Thuận</Button>
                                        <Button class="btn btn-danger">Từ Chối</Button>
                                    </td>
                                </tr> --}}


                            </tbody>
                        </table>

                    </div>
                </div>


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

    <script>
        var tbody = document.querySelector('tbody')

        const address = location.href
        $.ajax({
            url: address,
            type: 'POST',
            data: {
                "_token": "{{ csrf_token() }}"
            },
            success: function(response) {
                var data = JSON.parse(response);
                var str = data.map((item, index) => {
                    return `
                                <tr>
                                    <td>${index + 1}</td>
                                    <td>${item.ma_dangky}</td>
                                    <td>${item.ten_trienlam}</td>
                                    <td>${item.ten_danhmuc}</td>
                                    <td>
                                        <img style="height: 100px;width: 150px;"
                                            src= '${item.anh_daidien}'
                                            alt="Ảnh lỗi">
                                    </td>
                                    <td>
                                        <Button onClick="Xemchitiet(${item.ma_dangky})" class="btn btn-info">Xem Chi Tiết</Button>
                                        <Button onClick="Chapnhan(${item.ma_dangky})" class="btn btn-primary">Chấp Nhận</Button>
                                        <Button onClick="Tuchoi(${item.ma_dangky})" class="btn btn-danger">Từ Chối</Button>
                                    </td>
                                </tr>
                    `
                })

                str = str.join('')

                tbody.innerHTML = str
            }
        })

        function Xemchitiet(id) {

            location.href = location.origin + `/admin/xemchitiet/dangkytrienlam/${id}`

        }

        function Chapnhan(id) {

            var address = location.origin + `/admin/chapnhan/dangkytrienlam/${id}`
            $.ajax({
                url: address,
                type: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                success: function(response) {
                    var data = JSON.parse(response)
                    alert(data)
                    location.href = location.href

                }
            })

        }

        function Tuchoi(id) {

            var address = location.origin + `/admin/xoa/dangkytrienlam/${id}`
            $.ajax({
                url: address,
                type: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                success: function(response) {
                    var data = JSON.parse(response)
                    alert(data)
                    location.href = location.href

                }
            })

        }
    </script>
</body>

</html>
