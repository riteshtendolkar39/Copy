
    <nav class="navbar navbar-expand-lg bg-info">
            <div class="container-fluid">
                <img src="./images/logo2.jpeg" alt="" class="logo">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse " id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item click">
                            <a class="nav-link"></a>
                        </li>
                        <li class="nav-item click">
                            <a class="nav-link" aria-current="page" href="index.php">Home</a>
                        </li>
                        <li class="nav-item click">
                            <a class="nav-link" aria-current="page" href="display_all.php">All Products</a>
                        </li>
                        <li class="nav-item click">
                            <a class="nav-link" aria-current="page" href="about.php">About</a>
                        </li>
                        <li class="nav-item click">
                            <a class="nav-link" href="contact.php" aria-current="page">Contact</a>
                        </li>
                        <?php
                        if (isset($_SESSION['user_email'])) {
                            echo "            <li class='nav-item click'>
                            <a class='nav-link' href='./user/Profile.php'>My Profile</a>
                          </li>";
                        } else {
                            echo "            <li class='nav-item click'>
                            <a class='nav-link' aria-current='page' href='./user/user_registration.php'>Register</a>
                          </li>";
                        }
                        ?>
                        <li class="nav-item click">
                            <a class="nav-link" href="cart.php"><i class="fa-solid fa-cart-shopping"></i><sup><?php cart_item(); ?></sup></a>
                        </li>
                        <li class="nav-item click">
                            <a class="nav-link" href="#">Total Price:<?php total_cart_price(); ?>/-</a>
                        </li>

                    </ul>
                    <form class="d-flex" action="search_product.php" method="get">
              <div class="autocomplete">
                <input type="text" id="search_data" name="search_data" class="mr-2" placeholder="Search products...">
                <ul id="search_data_list"></ul>
              </div>
              <button type="submit" class="btn btn-outline-light" name="search_data_product">
                <i class="fas fa-search"></i> <!-- Search icon -->
              </button>
            </form>
            <?php
            // $username = substr($_SESSION["user_email"], 0, strpos($_SESSION["user_email"], '@'));

            //username


            if (!isset($_SESSION['user_email'])) {
              echo "
                            </ul>
                        </div>
                    </div>
                </nav>
                            <nav class='navbar navbar-expand-lg navbar-dark bg-secondary'>
                            <ul class='navbar-nav me-auto d-flex'>
                              <li class='nav-item click1'>
                                <a href='#' class='nav-link'>Welcome Guest</a>
                                </li>
                                <li class='nav-item click1'>
                                <a class='nav-link' href='./user/user_login.php'>Login</a>
                              </li>
                            </ul>
                          </nav>";
            } else {
              $user_ip = getIPAddress();
              $select_query_name = "select * from `user_table` where user_ip='$user_ip'";
              $result_name = mysqli_query($con, $select_query_name);
              $row_name = mysqli_fetch_assoc($result_name);
              $username = $row_name['username'];
              echo "
                            </form>
                            </ul>
                        </div>
                    </div>
                </nav>
                            <nav class='navbar navbar-expand-lg navbar-dark bg-secondary'>
                            <ul class='navbar-nav me-auto'>
                              <li class='nav-item'>
                                <a href='#' class='nav-link'>Welcome " . $username . "</a>
                              </li>
                              <li class='nav-item ms-2'>
                                <a href='./user/logout.php' class='nav-link'>Logout</a>
                              </li>
                            </ul>
                          </nav>";
            }

            ?>
          </form>
                    </ul>
                </div>
            </div>
        </nav>
