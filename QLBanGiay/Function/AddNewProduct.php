<?php
$sql_ListLoaiSP = 'SELECT * FROM `loaisanpham` WHERE 1';
$result_LoaiSP = mysqli_query($conn, $sql_ListLoaiSP);

$sql_ListNhaSanXuat = 'SELECT * FROM `nhasanxuat` WHERE 1';
$result_NhaSanXuat = mysqli_query($conn, $sql_ListNhaSanXuat);

if (isset($_REQUEST['Them'])) {
    $prd_Id = trim($_REQUEST['MaSP']);
    $prd_Name = trim($_REQUEST['TenSP']);
    $prd_Descr = trim($_REQUEST['MoTaSP']);
    $prd_DonGia = trim($_REQUEST['DonGiaSP']);
    $prd_Image = $_FILES['AnhSP']['name'];
    $Image_tmp = $_FILES['AnhSP']['tmp_name'];
    $prd_MaLoai = trim($_REQUEST['LoaiSP']);
    $prd_NSX = trim($_REQUEST['NSX']);

    //check file ( KT đuôi file?, có tồn tại chưa?)
    $targetDir = 'Ass/Image/SanPham/';
    $targetFile = $targetDir . basename($_FILES['AnhSP']['name']);
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    
    //Kiểm tra đuôi file
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Không đúng định dạng file";
    } else {
        //Kiểm tra tồn tại
        if (file_exists($targetFile)) {
            echo "Ảnh đã tồn tại";
        } else {

            $sql_ThemSP = "INSERT INTO sanpham
                values ('$prd_Id', '$prd_Name', '$prd_Descr', $prd_DonGia, '$prd_Image', '$prd_MaLoai', '$prd_NSX');";

            $queryThemSP = mysqli_query($conn, $sql_ThemSP);
            if ($queryThemSP) {
                move_uploaded_file($Image_tmp, $targetFile);
                header('location: layoutAd.php?page_layout=danhsach');
            } else {
                echo "Truy vấn lỗi";
            }
        }
    }


}
?>

<div class="container pt-3">
    <!-- <h3 class="bg-primary bg-gradient text-center rounded" style="height: 45px; color: #fff; line-height: 45px;">Thêm sản phẩm</h3> -->
    <div class="container">
        <div class="row justify-content-around">
            <form method="post" class="col-md-6 bg-light bg-gradient p-4" enctype="multipart/form-data">
                <h2 class="text-center text-uppercase mb-4 text-primary">Thêm sản phẩm mới</h2>
                <div class="form-group mt-2">
                    <label class="fw-bold" for="MaSP">Mã sản phẩm: </label>
                    <input require class="d-block" type="text" class="form-control" name="MaSP" style="width: 100%;">
                </div>
                <div class="form-group mt-2">
                    <label class="fw-bold" for="TenSP">Tên sản phẩm: </label>
                    <input require style="width: 100%;" class="d-block" type="text" class="form-control" name="TenSP">
                </div>
                <div class="form-group mt-2">
                    <label class="fw-bold" for="MoTaSP">Mô tả: </label>
                    <textarea style="width: 100%;" class="d-block" type="text" class="form-control" name="MoTaSP"></textarea>
                </div>
                <div class="form-group mt-2">
                    <label class="fw-bold" for="DonGiaSP">Đơn giá: </label>
                    <input require style="width: 100%;" class="d-block" type="text" class="form-control" name="DonGiaSP">
                </div>
                <div class="form-group mt-2">
                    <label class="fw-bold" for="AnhSP">Ảnh sản phẩm: </label>
                    <input require class="form-control" type="file" id="formFile" name="AnhSP">
                </div>
                <div class="form-group mt-2">
                    <label class="fw-bold" for="LoaiSP">Loại sản phẩm: </label>
                    <select class="form-select" aria-label="Default select example" name="LoaiSP">
                        <?php while ($row = mysqli_fetch_assoc($result_LoaiSP)) : ?>
                            <option value="<?= $row['MaLoai'] ?>"><?= $row['TenLoai'] ?></option>
                        <?php endwhile ?>
                    </select>
                </div>
                <div class="form-group mt-2">
                    <label class="fw-bold" for="NSX">Nhà sản xuất: </label>
                    <select class="form-select" aria-label="Default select example" name="NSX">
                        <?php while ($row = mysqli_fetch_assoc($result_NhaSanXuat)) : ?>
                            <option value="<?= $row['MaNSX'] ?>"><?= $row['TenNSX'] ?></option>
                        <?php endwhile ?>
                    </select>
                </div>
                <input type="submit" value="Thêm sản phẩm" class="btn btn-primary mt-3 float-end" name="Them">
            </form>
        </div>
    </div>
</div>