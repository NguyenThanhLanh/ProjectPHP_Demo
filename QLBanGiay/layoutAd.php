<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>Quản lý bán giày</title>
    <link rel="stylesheet" href="./Ass/Css/SideBar.css">
    <link rel="stylesheet" href="./Ass/Css/BodyPage.css">
    <link rel="stylesheet" href="./Ass/Css/ListProduct.css">
    <link rel="stylesheet" href="./Ass/Css/main.css">
</head>

<body>
    <?php
        require_once './Config/ConnectDB.php';
    ?>
    <div class="wrapper">
        <!-- Banner -->
            <?php require_once './Modun/Banner.php'?>
        <!-- End Banner -->

        <!-- Nav -->
            <?php require_once './Modun/NavBar.php'?>
        <!-- End Nav -->

        <!-- Body -->
        <div id="Body_Page" style="padding: 0;">
            <!-- SideBar -->
                <?php include './Modun/SideBar.php'?>
            <!-- End SideBar -->

            <!-- Content -->
            <div id="Content_Custom" class="Body_Page__Item">
                <?php 
                    if (isset($_GET['page_layout'])) {
                        switch ($_GET['page_layout']) {
                            case 'DanhSach':
                                require_once './Function/ListProduct.php';
                                break;
                            case 'Them':
                                require_once './Function/AddNewProduct.php';
                                break;
                            case 'Xoa':
                                require_once './Function/Delete.php';
                                break;
                            case 'Sua':
                                require_once './Function/EditProduct.php';
                                break;
                            case 'TimKiem':
                                require_once './Function/TimKiemSP.php';
                                break;
                            default:
                                require_once './Function/ListProduct.php';
                                break;
                        }
                    }
                    else {
                        require_once './Function/ListProduct.php';
                    }
                ?>
            </div>
        </div>
        <!-- Footer -->
        <?php require_once './Modun/Footer.php'?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>

</html>