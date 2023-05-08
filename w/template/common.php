        <div class="row p-0 m-0"> <!-- <- CONTIENE ENTRAMBI -->

                <!-- INIZIO NAV -->
                <div class="col-auto p-0 m-0">
                    <div class="sticky-top">
                        <div class="p-0 bg-dark affix">
                            <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                                <a href="store" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                                    <img src="../assets/store.webp" loading="lazy" alt="ico" width="30" height="30" class="rounded-circle"> &nbsp;&nbsp; <span class="fs-5 d-none d-sm-inline">Menu</span>
                                </a>


                                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                                    <li class="nav-item">
                                        <a href="store" class="nav-link align-middle px-0">
                                            <i class="fs-4 bi-house"></i>
                                            <span class="ms-1 d-none d-sm-inline">Store</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="cart" class="nav-link align-middle px-0">
                                            <i class="fs-4 bi-house"></i>
                                            <span class="ms-1 d-none d-sm-inline">Shopping Cart (<null id="cartItemsAmount">0</null>)</span>
                                        </a>
                                    </li>
                                    <li class="nav-item" style="display: none; visibility: hidden;" name="adminOnly">
                                        <a href="add" class="nav-link align-middle px-0">
                                            <i class="fs-4 bi-house"></i>
                                            <span class="ms-1 d-none d-sm-inline">Add to Store</span>
                                        </a>
                                    </li>
                                </ul>

                                <hr>

                                <div class="dropdown pb-4">
                                    <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                                        <img src="../assets/user.png" loading="lazy" alt="profile" width="30" height="30" class="rounded-circle"> &nbsp;&nbsp; <span class="d-none d-sm-inline mx-1" id="usernameTX">user</span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                                        <li>
                                            <a class="dropdown-item" onclick="logout();">Sign out</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
