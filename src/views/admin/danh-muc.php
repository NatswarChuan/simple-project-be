<?php
include ROOT_DIR . '/src/views/admin/head.php';
?>

<body id="page-top">
    <div id="wrapper">
        <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0">
            <div class="container-fluid d-flex flex-column p-0"><a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
                    <div class="sidebar-brand-icon rotate-n-15"><i class="fas fa-laugh-wink"></i></div>
                    <div class="sidebar-brand-text mx-3"><span>Brand</span></div>
                </a>
                <hr class="sidebar-divider my-0">
                <ul class="navbar-nav text-light" id="accordionSidebar">
                    <li class="nav-item"><a class="nav-link" href="profile.html"><i class="fas fa-user"></i><span>Profile</span></a></li>
                    <li class="nav-item"><a class="nav-link active" href="san-pham.html"><i class="fas fa-table"></i><span>Sản phẩm</span></a></li>
                    <li class="nav-item"><a class="nav-link " href="danh-muc.html"><i class="fas fa-table"></i><span>Danh mục</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="login.html"><i class="far fa-user-circle"></i><span>Login</span></a></li>
                </ul>
                <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button></div>
            </div>
        </nav>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                    <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle mr-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
                        <ul class="navbar-nav flex-nowrap ml-auto">

                            <div class="d-none d-sm-block topbar-divider"></div>
                            <li class="nav-item dropdown no-arrow">
                                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-toggle="dropdown" href="#"><span class="d-none d-lg-inline mr-2 text-gray-600 small">Valerie Luna</span><img class="border rounded-circle img-profile" src="assets/img/avatars/avatar1.jpeg"></a>
                                    <div class="dropdown-menu shadow dropdown-menu-right animated--grow-in">
                                        <a class="dropdown-item" href="#"><i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Logout</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
                <div class="container-fluid">
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 text-nowrap">
                                    <p class="text-primary m-0 font-weight-bold">Danh mục</p>
                                </div>
                                <div class="col-md-6 text-md-right text-primary">
                                    <a type="button" class="btn btn-primary btn-lg"><i class="fas fa-plus-circle"></i></a>
                                </div>
                            </div>
                            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                <table class="table my-0" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>Danh mục</th>
                                            <th>Mô tả</th>
                                            <th>Trạng thái</th>
                                            <th>Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><img class="rounded-circle mr-2" width="30" height="30" src="assets/img/avatars/avatar1.jpeg">Airi Satou</td>
                                            <td>ABC ....</td>
                                            <td><i class="fas fa-ban text-danger"></i></td>
                                            <td>
                                                <div class="row">
                                                    <div class="col"><a href="#"><i class="fas fa-edit"></i></a></div>
                                                    <div class="col"><a href="#"><i class="fas fa-trash"></i></a></div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td><strong>Danh mục</strong></td>
                                            <td><strong>Mô tả</strong></td>
                                            <td><strong>Trạng thái</strong></td>
                                            <td><strong>Thao tác</strong></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <nav class="d-lg-flex justify-content-lg-end dataTables_paginate paging_simple_numbers">
                                <ul class="pagination">
                                    <li class="page-item disabled"><a class="page-link" href="#" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
                                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#" aria-label="Next"><span aria-hidden="true">»</span></a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</body>

<?php
include ROOT_DIR . '/src/views/admin/foot.php';
?>