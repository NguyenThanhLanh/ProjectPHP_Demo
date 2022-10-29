<?php

$sql_ListSP = 'SELECT MaSP, TenSP, s.Mota, DonGia, HinhSP, TenLoai, TenNSX FROM `sanpham` AS s INNER JOIN loaisanpham as l on l.MaLoai = s.MaLoai
                    INNER JOIN nhasanxuat as nsx ON nsx.MaNSX = s.MaNSX;';
$resultListSP = mysqli_query($conn, $sql_ListSP);

$QuantityItemPage = isset($_GET['per_page']) ? $_GET['per_page'] : 4; // số sp trên 1 trang
$CurrentPage = isset($_GET['page']) ? $_GET['page'] : 1; //trang hiển thị
$offset = ($CurrentPage - 1) * $QuantityItemPage;

$totalPage = ceil(mysqli_num_rows($resultListSP) / $QuantityItemPage);

$sql_ListSPInPage = 'SELECT MaSP, TenSP, s.Mota, DonGia, HinhSP, TenLoai, TenNSX FROM `sanpham` AS s INNER JOIN loaisanpham as l on l.MaLoai = s.MaLoai
                INNER JOIN nhasanxuat as nsx ON nsx.MaNSX = s.MaNSX LIMIT ' . $offset . ', ' . $QuantityItemPage;

$result_ListSPInPage = mysqli_query($conn, $sql_ListSPInPage);

?>
<div class="container-fluid pt-2 text-end">
    <a href="?page_layout=Them" class="btn btn-info text-white">Thêm sản phẩm</a>
</div>
<div class="container-fluid pt-2" id="List_Product" style="width: 100%;">
    <h3 class="bg-primary bg-gradient text-center rounded" style="height: 45px; color: #fff; line-height: 45px;">Danh sách sản phẩm</h3>
    <table class="table border" style="width: 100%;">
        <thead class="table-primary">
            <th>Stt</th>
            <th style="width: 124px;">Mã sản phẩm</th>
            <th style="width: 125px;">Tên sản phẩm</th>
            <th>Mô tả</th>
            <th style="width: 84px;">Đơn giá</th>
            <th>Ảnh</th>
            <th style="width: 76px;">Tên loại</th>
            <th style="width: 128px;">Tên nhà sản xuất</th>
            <th colspan="2">Chức năng</th>
        </thead>
        <tbody>
            <?php
            $i = 0;
            while ($row = mysqli_fetch_assoc($result_ListSPInPage)) :
                $i++;
            ?>
                <tr>
                    <td><?= $i ?></td>
                    <td style="text-align: center;"><?= $row['MaSP'] ?></td>
                    <td style="text-align: center;"><?= $row['TenSP'] ?></td>
                    <td style="text-align: justify;"><?= $row['Mota'] ?></td>
                    <td style="text-align: center;"><?= $row['DonGia'] ?> (VND)</td>
                    <td style="text-align: center;">
                        <!-- <img src="../Access/Image/SanPham/<?= $row['HinhSP'] ?>" alt="Ảnh"> -->
                        <img src="./Ass/Image/SanPham/<?= $row['HinhSP'] ?>" alt="Ảnh" srcset="">
                    </td>
                    <td style="text-align: center;"><?= $row['TenLoai'] ?></td>
                    <td style="text-align: center;"><?= $row['TenNSX'] ?></td>
                    <td>
                        <a href="?page_layout=Sua&id=<?= $row['MaSP'] ?>" class="btn btn-warning">Sửa</a>
                    </td>
                    <td>
                        <a href="?page_layout=Xoa&id=<?= $row['MaSP'] ?>" class="btn btn-danger">Xóa</a>
                    </td>
                </tr>
            <?php endwhile ?>
        </tbody>
    </table>
</div>
<div class="container-fluid">
    <?php include './Function/NavPhanTrang.php' ?>
</div>