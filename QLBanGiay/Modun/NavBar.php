<?php
    $id = '';
    if (isset($_REQUEST['Info_TimKiem'])) {
        $id = trim($_REQUEST['Info_TimKiem']);
        header("location: layoutAd.php?page_layout=TimKiem&id=$id");
    }
?>
<div class="row">
    <nav class="navbar navbar-expand-lg p-2 " style="background-color: #d5d5d5;">
        <div class="container-fluid">
            <a class="navbar-brand" href="layoutAd.php">Trang chủ</a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <!-- <li class="nav-item">
                                <a class="nav-link active" href="#">Bài tập thực hành</a>
                            </li> -->
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Giới thiệu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Tin Tức</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Liên hệ</a>
                    </li>
                </ul>
                <form class="d-flex" action="layoutAd.php?page_layout=TimKiem&id=<?=$id?>">
                    <input name="Info_TimKiem" class="form-control me-2" type="search" placeholder="Tìm kiếm sản phẩm" aria-label="Search">
                    <button class="btn btn-primary" type="submit" name="TimKiem">Search</button>
                </form>
            </div>
        </div>
    </nav>
</div>