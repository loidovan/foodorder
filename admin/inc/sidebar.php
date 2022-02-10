<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading"></div>
                <a class="nav-link" href="index.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Tổng quan
                </a>
                <div class="sb-sidenav-menu-heading">Quản lý</div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-hamburger"></i></div>
                    Món ăn
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="category.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Danh mục món
                        </a>
                        <a class="nav-link" href="food.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-utensils"></i></div>
                            Món ăn
                        </a>
                    </nav>
                </div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts2" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-dolly"></i></div>
                    Nhập hàng
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts2" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="material.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-shopping-basket"></i></div>
                            Nguyên liệu
                        </a>
                        <a class="nav-link" href="supplier.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-store"></i></div>
                            Nhà cung cấp
                        </a>
                    </nav>
                </div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts3" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-shopping-cart"></i></div>
                    Bán hàng
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts3" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="order.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-shopping-basket"></i></div>
                            Đơn đặt hàng
                        </a>
                        <a class="nav-link" href="book.php">
                            <div class="sb-nav-link-icon"><i style="width:16px" class="fas fa-file-invoice-dollar"></i></div>
                            Đơn đặt bàn
                        </a>
                        <a class="nav-link" href="comment.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-comments"></i></div>
                            Bình luận
                        </a>
                        <a class="nav-link" href="contact.php">
                            <div class="sb-nav-link-icon"><i style="font-size: 16px;" class="fas fa-headset"></i></div>
                            Liên hệ
                        </a>
                    </nav>
                </div>

                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts9" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-wrench"></i></div>
                    Cấu hình
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts9" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="info.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-info"></i></div>
                            Thông tin quán
                        </a>
                        <a class="nav-link" href="slider.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-images"></i></div>
                            Trình chiếu
                        </a>
                        <a class="nav-link" href="blog.php">
                            <div class="sb-nav-link-icon"><i style="font-size: 16px;" class="fas fa-blog"></i></div>
                            Tin tức
                        </a>
                    </nav>
                </div>
                
                <?php
                $check = Session::get('adminLogin');
                $adminId = Session::get('adminId');
                $role = Session::get('role');
                // echo $role;die();
                if (isset($check) == true && isset($adminId) && isset($role)) {

                    if (strcmp($role,'0') == 0) {
                ?>
                        <a class="nav-link" href="accounts.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                            Tài khoản
                        </a>
                <?php
                    }
                }
                ?>
                <!-- <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                            Authentication
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="login.php">Login</a>
                                <a class="nav-link" href="register.php">Register</a>
                                <a class="nav-link" href="password.php">Forgot Password</a>
                            </nav>
                        </div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                            Error
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                            <nav class="sb-sidenav-menu-nested nav">

                            </nav>
                        </div>
                    </nav>
                </div> -->

                <div class="sb-sidenav-menu-heading">Thống kê</div>
                <a class="nav-link" href="charts.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                    Biểu đồ
                </a>

            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Copyright &copy; 2021</div>
            Developed by <a style="color: lightblue;" rel="nofollow" href="https://www.facebook.com/doloi01/">Do Loi</a>
        </div>
    </nav>
</div>