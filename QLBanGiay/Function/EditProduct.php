<?php
if (empty($_GET['id'])) {
    echo "<font color='red'>Vui lòng chọn sản phẩm cần xóa</font>";
    exit;
}
$id = $_GET['id'];

//Lấy sản phẩm
$sql_spEdit = "SELECT * FROM sanpham WHERE MaSP = '$id'";
$result_spEdit = mysqli_query($conn, $sql_spEdit);
$SanPhamEdit = mysqli_fetch_assoc($result_spEdit);
// print_r($SanPhamEdit);

//lấy list loại sp
$sql_ListLoaiSP = 'SELECT * FROM loaisanpham';
$result_LoaiSP = mysqli_query($conn, $sql_ListLoaiSP);

//lấy list nhà sản xuất
$sql_ListNSX = "SELECT * FROM nhasanxuat";
$result_NhaSanXuat = mysqli_query($conn, $sql_ListNSX);
//Xử lý
if (isset($_REQUEST['Sua'])=="Sửa sản phẩm") {
    $prd_Id = trim($_REQUEST['MaSP']);
    $prd_Name = trim($_REQUEST['TenSP']);
    $prd_Descr = trim($_REQUEST['MoTaSP']);
    $prd_DonGia = trim($_REQUEST['DonGiaSP']);
    $prd_MaLoai = trim($_REQUEST['LoaiSP']);
    $prd_NSX = trim($_REQUEST['NSX']);
    //Nếu up ảnh thì lấy ảnh mới, không thì lấy ảnh cũ
    if ($_FILES['AnhSP']['name'] == '') {
       
        $prd_Image = $SanPhamEdit['HinhSP'];
        $sql_SuaSP = "UPDATE sanpham SET TenSP = '$prd_Name',  MoTa = '$prd_Descr', DonGia = $prd_DonGia, HinhSP = '$prd_Image', MaLoai = '$prd_MaLoai', MaNSX = '$prd_NSX' WHERE MaSP ='$id';";
        $queryThemSP = mysqli_query($conn, $sql_SuaSP);
    } else {
        $prd_Image = $_FILES['AnhSP']['name'];
        $Image_tmp = $_FILES['AnhSP']['tmp_name'];

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
                $sql_SuaSP = "UPDATE sanpham SET MaSP = '$prd_Id', TenSP = '$prd_Name',  MoTa = '$prd_Descr', DonGia = $prd_DonGia, HinhSP = '$prd_Image', MaLoai = '$prd_MaLoai', MaNSX = '$prd_NSX');";
                $queryThemSP = mysqli_query($conn, $sql_SuaSP);
                if ($queryThemSP) {
                    move_uploaded_file($Image_tmp, $targetFile);
                } else {
                    echo "Truy vấn lỗi";
                }
            }
        }
    }
    header('location: layoutAd.php?page_layout=danhsach');
}
// End Xử lý
?>

<div class="container pt-3">
    <!-- <h3 class="bg-primary bg-gradient text-center rounded" style="height: 45px; color: #fff; line-height: 45px;">Thêm sản phẩm</h3> -->
    <div class="container">
        <div class="row justify-content-around">
            <form method="post" class="col-md-6 bg-light bg-gradient p-4" enctype="multipart/form-data">
                <h2 class="text-center text-uppercase mb-4 text-primary">Chỉnh sửa thông tin sản phẩm</h2>
                <div class="form-group mt-2">
                    <label class="fw-bold" for="MaSP">Mã sản phẩm: </label>
                    <input require value="<?= $SanPhamEdit['MaSP'] ?>" class="d-block" type="text" class="form-control" name="MaSP" style="width: 100%;" disabled>
                </div>
                <div class="form-group mt-2">
                    <label class="fw-bold" for="TenSP">Tên sản phẩm: </label>
                    <input require value="<?= $SanPhamEdit['TenSP'] ?>" style="width: 100%;" class="d-block" type="text" class="form-control" name="TenSP">
                </div>
                <div class="form-group mt-2">
                    <label class="fw-bold" for="MoTaSP">Mô tả: </label>
                    <textarea style="width: 100%;" class="d-block" type="text" class="form-control p-1" name="MoTaSP"><?= $SanPhamEdit['MoTa'] ?></textarea>
                </div>
                <div class="form-group mt-2">
                    <label class="fw-bold" for="DonGiaSP">Đơn giá: </label>
                    <input require value="<?= $SanPhamEdit['DonGia'] ?>" style="width: 100%;" class="d-block" type="text" class="form-control" name="DonGiaSP">
                </div>
                <div class="form-group mt-2">
                    <label class="fw-bold" for="AnhSP">Ảnh sản phẩm: </label>
                    <input class="form-control" type="file" id="formFile" name="AnhSP">
                </div>
                <div class="form-group mt-2">
                    <label class="fw-bold" for="LoaiSP">Loại sản phẩm: </label>
                    <select class="form-select" aria-label="Default select example" name="LoaiSP">
                        <?php while ($row = mysqli_fetch_assoc($result_LoaiSP)) : ?>
                            <?php if ($SanPhamEdit['MaLoai'] == $row['MaLoai']) : ?>
                                <option selected value="<?= $row['MaLoai'] ?>"><?= $row['TenLoai'] ?></option>
                            <?php else : ?>
                                <option value="<?= $row['MaLoai'] ?>"><?= $row['TenLoai'] ?></option>
                            <?php endif ?>
                        <?php endwhile ?>
                    </select>
                </div>
                <div class="form-group mt-2">
                    <label class="fw-bold" for="NSX">Nhà sản xuất: </label>
                    <select class="form-select" aria-label="Default select example" name="NSX">
                        <?php while ($row = mysqli_fetch_assoc($result_NhaSanXuat)) : ?>
                            <?php if ($SanPhamEdit['MaNSX'] == $row['MaNSX']) : ?>
                                <option selected value="<?= $row['MaNSX'] ?>"><?= $row['TenNSX'] ?></option>
                            <?php else : ?>
                                <option value="<?= $row['MaNSX'] ?>"><?= $row['TenNSX'] ?></option>
                            <?php endif ?>
                        <?php endwhile ?>
                    </select>
                </div>
                <input type="submit" value="Sửa sản phẩm" class="btn btn-primary mt-3 float-end" name="Sua">
            </form>
        </div>
    </div>
</div>