<?php
if (empty($_GET['id'])) {
    echo "<font color='red'>Vui lòng chọn sản phẩm cần xóa</font>";
    exit;
}
$id = $_GET['id'];
$hinh='null';
$sql_SPDelete = "SELECT s.MaSP, s.TenSP, s.MoTa, s.DonGia, s.HinhSP, l.TenLoai,nsx.TenNSX
                    FROM sanpham AS s INNER JOIN loaisanpham as l ON s.MaLoai=l.MaLoai
                                        INNER JOIN nhasanxuat as nsx ON s.MaNSX=nsx.MaNSX
                    WHERE s.MaSP = '" . $id . "';";

$result_SPDelete = mysqli_query($conn, $sql_SPDelete);


//$sql = "DELETE FROM size WHERE MaSize like 'MX13'";
if (isset($_REQUEST['submit']) == "Xóa sản phẩm") {
    $id = $_GET['id'];
    $sql_DeleteSP = "DELETE FROM sanpham WHERE MaSP ='$id'";
    echo json_encode($sql_DeleteSP);
    $query = mysqli_query($conn, $sql_DeleteSP);
    // unlink("./Ass/Image/SanPham/$hinh");
    header('location: layoutAd.php?page_layout=danhsach');
}
?>

<div class="XoaSanPham">
    <?php while ($row = mysqli_fetch_assoc($result_SPDelete)) : ?>
        <?php $hinh = $row['HinhSP']; ?>
        <form action="" method="post">
            <div class="card mb-3 m-4" style="max-width: 840px;">
                <div class="row g-0">
                    <div class="col-md-5" style="display: flex;">
                        <img src="./Ass/Image/SanPham/<?= $row['HinhSP'] ?>" class="img-fluid rounded-start" alt="Ảnh sản phẩm">
                    </div>
                    <div class="col-md-7">
                        <div class="card-body">
                            <h3 class="card-title mb-2">Bạn có muốn xóa sản phẩm ?</h3>
                            <table class="table">
                                <tr>
                                    <td><strong>Mã sản phẩm: </strong></td>
                                    <td><?= $row['MaSP'] ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Tên sản phẩm: </strong></td>
                                    <td><?= $row['TenSP'] ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Giá sản phẩm: </strong></td>
                                    <td><?= $row['DonGia'] ?> (VND)</td>
                                </tr>
                                <tr>
                                    <td><strong>Mô tả: </strong></td>
                                    <td style="text-align: justify;"><?= $row['MoTa'] ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Loại sản phẩm: </strong></td>
                                    <td><?= $row['TenLoai'] ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 130px;"><strong>Hãng sản xuất: </strong></td>
                                    <td><?= $row['TenNSX'] ?></td>
                                </tr>
                            </table>
                            <input type="submit" value="Xóa sản phẩm" class="btn btn-danger float-end mb-2" name="submit">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    <?php endwhile ?>
</div>