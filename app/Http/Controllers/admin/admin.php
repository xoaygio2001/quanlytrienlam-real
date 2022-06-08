<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mockery\Undefined;

class admin extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($name)
    {

        switch ($name) {

            case 'quanlytrienlam':
                $quer = "SELECT tl.*, dm.ten_danhmuc FROM trienlam tl,danhmuc dm"
                    . " WHERE tl.ma_danhmuc = dm.ma_danhmuc ORDER BY tl.ma_trienlam ASC";
                $data = DB::SELECT($quer);
                return json_encode($data);
                break;

            case 'quanlydanhmuc':
                $quer = "SELECT * FROM danhmuc ORDER BY ma_danhmuc ASC";
                $data = DB::SELECT($quer);
                return json_encode($data);
                break;

            case 'quanlynguoidung':
                $quer = "SELECT * FROM nguoidung ORDER BY ma_nguoidung ASC";
                $data = DB::SELECT($quer);
                return json_encode($data);
                break;

            case 'quanlybinhluan':
                $quer = "SELECT * FROM binhluan ORDER BY ma_binhluan ASC";
                $data = DB::SELECT($quer);
                return json_encode($data);
                break;

            case 'quanlyanhtrienlam':
                $quer = "SELECT anh.ma_trienlam,anh.duongdan,tl.anhdaidien,"
                ." COUNT(anh.ma_anh) as tongsoanh FROM anh, trienlam tl"
                ." WHERE anh.ma_trienlam = tl.ma_trienlam"
                ." GROUP BY anh.ma_trienlam"
                ." ORDER BY anh.ma_trienlam ASC";
                $data = DB::SELECT($quer);
                return json_encode($data);
                break;

            case 'quanlydangkytrienlam':
                $quer = "SELECT dk.*, dm.ten_danhmuc FROM dangkytrienlam dk,danhmuc dm"
                    . " WHERE dk.ma_danhmuc = dm.ma_danhmuc ORDER BY dk.ma_dangky ASC";
                $data = DB::SELECT($quer);
                return json_encode($data);
                break;

            case 'themtrienlam':
                $tentrienlam = $_POST['tentrienlam'];
                $danhmuc = $_POST['danhmuc'];
                $motatrienlam = $_POST['motatrienlam'];
                $noidungtrienlam = $_POST['noidungtrienlam'];
                $anhdaidien = $this->handleIMG_client($_FILES['anhdaidien']);
                $diadiem = $_POST['diadiem'];
                $thoigianbatdau = $this->change_form_datetime_html_to_php($_POST['thoigianbatdau']);
                $thoigianketthuc = $this->change_form_datetime_html_to_php($_POST['thoigianketthuc']);
                $success = true;
                $mss = '';

                if ($anhdaidien != false) {
                    $quer = "INSERT INTO trienlam"
                        . " (ten_trienlam,ma_danhmuc,mota_trienlam,"
                        . " noidung_trienlam,anhdaidien,diachi_trienlam,"
                        . " thoigianbatdau,thoigianketthuc)"
                        . " VALUES"
                        . " ('{$tentrienlam}', {$danhmuc}, '{$motatrienlam}',"
                        . " '{$noidungtrienlam}','{$anhdaidien}','{$diadiem}',"
                        . " '{$thoigianbatdau}','{$thoigianketthuc}')";
                    DB::INSERT($quer);
                } else {
                    $success = false;
                    $mss = 'File Ảnh Lỗi! Vui Lòng Chọn File Khác';
                }
                $data = [];
                $data['mss'] = $mss;
                $data['result'] = $success;
                return json_encode($data);
                break;

            case 'themdanhmuc':
                $tendanhmuc = $_POST['tendanhmuc'];
                $motadanhmuc = $_POST['motadanhmuc'];
                $success = true;
                $mss = '';
                $data = [];
                $quer = "INSERT INTO danhmuc(ten_danhmuc,mota_danhmuc)"
                    . " VALUES ('{$tendanhmuc}','{$motadanhmuc}')";
                DB::INSERT($quer);
                $data['mss'] = $mss;
                $data['result'] = $success;
                return json_encode($data);
                break;

            case 'themanhtrienlam':
                $matrienlam = $_POST['matrienlam'];
                $anh = $_FILES['anh'];
                $flag_ok = true;
                $success = true;
                $mss = '';
                $data = [];

                $anhReal = [];
                for ($i = 0; $i < count($anh['name']); $i++) {
                    $anhClone = [];
                    $anhClone['error'] = $anh['error'][$i];
                    $anhClone['full_path'] = $anh['full_path'][$i];
                    $anhClone['name'] = $anh['name'][$i];
                    $anhClone['size'] = $anh['size'][$i];
                    $anhClone['tmp_name'] = $anh['tmp_name'][$i];
                    $anhClone['type'] = $anh['type'][$i];
                    $anhReal[$i] = $this->handleIMG_client($anhClone);
                }

                foreach ($anhReal as $item) {

                    if (!$item) {
                        $flag_ok = false;
                        $mss = 'Ảnh Không Hợp Lệ! Vui Lòng Kiểm Tra Lại ';
                    }
                }

                $quer = "SELECT * FROM trienlam WHERE ma_trienlam = '{$matrienlam}'";

                if (DB::SELECT($quer) == []) {
                    $flag_ok = false;
                    $mss = 'Mã Triển Lãm Không Tồn Tại! Vui Lòng Kiểm Tra Lại';
                }

                if ($flag_ok) {
                    foreach ($anhReal as $item) {
                        $quer = "INSERT INTO anh (ma_trienlam,duongdan)"
                            . " VALUES ({$matrienlam},'{$item}')";
                        DB::INSERT($quer);
                    }
                } else {
                    $success = false;
                }

                $data['mss'] = $mss;
                $data['result'] = $success;
                return json_encode($data);
                break;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($name, $id)
    {
        switch ($name) {
            case 'trienlam':
                $quer1 = "SELECT anh.*,tl.anhdaidien FROM anh, trienlam tl"
                ." WHERE anh.ma_trienlam = tl.ma_trienlam"
                ." AND anh.ma_trienlam = {$id}";
                $data1 = DB::SELECT($quer1);

                $quer2 = "SELECT tl.*,dm.ten_danhmuc FROM trienlam tl, danhmuc dm"
                ." WHERE tl.ma_danhmuc = dm.ma_danhmuc AND tl.ma_trienlam = {$id}";
                $data2 = DB::SELECT($quer2)[0];
                return json_encode(['anh' => $data1,'trienlam' => $data2]);
                break;

            default:
                # code...
                break;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($name,$id)
    {
        switch ($name) {
            case 'trienlam':
                $quer = "SELECT tl.*, dm.ten_danhmuc FROM trienlam tl,danhmuc dm"
                ." WHERE tl.ma_danhmuc = dm.ma_danhmuc"
                ." AND tl.ma_trienlam = {$id}";
                $data = DB::select($quer)[0];
                $data->thoigianbatdau = $this->change_form_datetime_php_to_html($data->thoigianbatdau);
                $data->thoigianketthuc = $this->change_form_datetime_php_to_html($data->thoigianketthuc);
                return json_encode($data);
                break;
            
            default:
                # code...
                break;
        }
    }

    public function edit2($name,$id){
        switch ($name) {
            case 'trienlam':

                $tentrienlam = $_POST['tentrienlam'];
                $danhmuc = $_POST['danhmuc'];
                $motatrienlam = $_POST['motatrienlam'];
                $noidungtrienlam = $_POST['noidungtrienlam'];
                $diadiem = $_POST['diadiem'];
                $thoigianbatdau = $this->change_form_datetime_html_to_php($_POST['thoigianbatdau']);
                $thoigianketthuc = $this->change_form_datetime_html_to_php($_POST['thoigianketthuc']);
                $flag_ok = true;
                $mss = 'Cập Nhật Thành Công';
                $quer = '';
                if(!isset($_FILES['anhdaidien'])){

                    $quer = "UPDATE trienlam SET"
                    ." ten_trienlam = '{$tentrienlam}',"
                    ." ma_danhmuc = {$danhmuc},"
                    ." mota_trienlam = '{$motatrienlam}',"
                    ." noidung_trienlam = '{$noidungtrienlam}',"
                    ." diachi_trienlam = '{$diadiem}',"
                    ." thoigianbatdau = '{$thoigianbatdau}',"
                    ." thoigianketthuc = '{$thoigianketthuc}'"
                    ." WHERE ma_trienlam = {$id}";
                    
                }
                else{
                    $anhdaidien = $this->handleIMG_client($_FILES['anhdaidien']);
                    if(!$anhdaidien){
                        $mss = "Ảnh Không Hợp Lệ! Vui Lòng Chọn File Khác";
                        $flag_ok = false;
                        
                    }
                    else{
                        $quer = "UPDATE trienlam SET"
                        ." ten_trienlam = '{$tentrienlam}',"
                        ." ma_danhmuc = {$danhmuc},"
                        ." mota_trienlam = '{$motatrienlam}',"
                        ." noidung_trienlam = '{$noidungtrienlam}',"
                        ." diachi_trienlam = '{$diadiem}',"
                        ." anhdaidien = '{$anhdaidien}',"
                        ." thoigianbatdau = '{$thoigianbatdau}',"
                        ." thoigianketthuc = '{$thoigianketthuc}'"
                        ." WHERE ma_trienlam = {$id}";
                    }
                }

                if($flag_ok){
                    DB::update($quer);
                }
                return json_encode(["result"=> $flag_ok,"mss" => $mss]);

                break;
            
            default:
                # code...
                break;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($name, $id)
    {
        switch ($name) {
            case 'trienlam':
                $quer = "DELETE FROM trienlam"
                    . " WHERE ma_trienlam = {$id}";
                DB::DELETE($quer);
                $mss = "Xóa Thành Công";
                return json_encode($mss);
                break;
            case 'danhmuc':
                $quer = "DELETE FROM danhmuc"
                    . " WHERE ma_danhmuc = {$id}";
                DB::DELETE($quer);
                $mss = "Xóa Thành Công";
                return json_encode($mss);
                break;
            case 'dangkytrienlam':
                $quer = "DELETE FROM dangkytrienlam"
                    . " WHERE ma_dangky = {$id}";
                DB::DELETE($quer);
                $mss = "Từ Chối Thành Công";
                return json_encode($mss);
                break;
        }
    }

    public function accept($name, $id)
    {
        switch ($name) {
            case 'dangkytrienlam':
                $quer = "SELECT * FROM dangkytrienlam"
                    . " WHERE ma_dangky = {$id}";
                $data = DB::SELECT($quer)[0];
                // return $data;
                $ten_trienlam = $data->ten_trienlam;
                $ma_danhmuc = $data->ma_danhmuc;
                $mota_trienlam = $data->mota_trienlam;
                $anh_daidien = $data->anh_daidien;
                $noidung_trienlam = $data->noidung_trienlam;
                $diachi_trienlam = $data->diachi_trienlam;
                $thoigianbatdau = $data->thoigianbatdau;
                $thoigianketthuc = $data->thoigianketthuc;
                $quer1 = "INSERT INTO trienlam"
                    . " (ten_trienlam, ma_danhmuc,mota_trienlam,anhdaidien,"
                    . " noidung_trienlam,diachi_trienlam,thoigianbatdau,thoigianketthuc)"
                    . " VALUES ('{$ten_trienlam}', {$ma_danhmuc}, '{$mota_trienlam}','{$anh_daidien}',"
                    . " '{$noidung_trienlam}','{$diachi_trienlam}','{$thoigianbatdau}','{$thoigianketthuc}')";
                DB::INSERT($quer1);
                $quer2 = "DELETE FROM dangkytrienlam"
                    . " WHERE ma_dangky = {$id}";
                DB::DELETE($quer2);
                $mss = "Chấp Nhận Thành Công";
                return json_encode($mss);
                break;

            default:
                # code...
                break;
        }
    }

    private function change_form_datetime_html_to_php($data)
    {
        $time = strtotime($data);

        $result = date('Y-m-d H:i:s', $time);

        return $result;
    }

    private function change_form_datetime_php_to_html($data)
    {
        $time = strtotime($data);

        $result = date('Y-m-d\TH:i', $time);

        return $result;
    }
    private function handleIMG_client($data)
    {
        $flag_ok = true;
        $extension = array('png', 'jpg', 'jpeg');
        $extensionFile = strtolower(pathinfo($data['name'], PATHINFO_EXTENSION));

        if (getimagesize($data['tmp_name']) == false) {
            $flag_ok = false;
        }

        if (!in_array($extensionFile, $extension)) {
            $flag_ok = false;
        }

        if ($data['size'] > 10000000) {
            $flag_ok = false;
        }

        if ($flag_ok) {
            $extensionFile = '.' . $extensionFile;
            $name = uniqid();
            $filePath = public_path('assets/client/img/' . $name . $extensionFile);
            $existsFile = file_exists($filePath);
            while ($existsFile) {
                $name = uniqid();
                $filePath = public_path('assets/client/img/' . $name . $extensionFile);
                $existsFile = file_exists($filePath);
            }
            $filePath = public_path('assets/client/img/' . $name . $extensionFile);

            move_uploaded_file($data['tmp_name'], $filePath);

            $filePath = asset('assets/client/img/' . $name . $extensionFile);
            return $filePath;
        } else {
            return false;
        }
    }
}
