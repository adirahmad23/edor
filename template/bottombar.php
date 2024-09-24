<?php
// determine the current page
switch (basename($_SERVER['PHP_SELF'])) {
    case 'index.php':
        $currentPage = 'index';
        break;
    case 'captures.php':
        $currentPage = 'capture';
        break;
    case 'hasil.php':
        $currentPage = 'capture';
        break;
    case 'akun.php':
        $currentPage = 'account';
        break;
    case 'lokasi.php':
        $currentPage = 'klik-kulit';
        break;
    case 'artikel.php':
        $currentPage = 'artikel';
        break;
        // add more cases for other pages
}
?>

<header class="header" id="header">
    <nav class="nav-app container-fluid">
        <a href="index.php" class="nav__logo"><img src="assets/icon/logo.png" class="nav__img" style="width: 60px; height: 60px;  ">E-skin Detector</a>
        <!-- The toggle button -->
        <button class="dropdown-toggle" id="dropdownButton">
            <i class='bx bx-user-circle nav__icon' style="display: block;"></i>
        </button>

        <!-- The dropdown menu -->
        <div class="dropdown-menu" aria-labelledby="dropdownButton">
            <a class="dropdown-item" href="akun.php"><i class='bx bxs-user'></i> Account</a>
            <a class="dropdown-item" href="logout.php"><i class='bx bx-log-in'></i> Logout</a>
        </div>

        <style>
            /* Style the toggle button */
            .dropdown-toggle {
                /* Remove the background color and color from the button */
                background-color: transparent;
                color: inherit;
                padding: -3px -2px;
                font-size: 28;
                border: none;
                border-radius: 3px;
                cursor: pointer;
            }

            .dropdown-toggle img {
                /* Add the color to the icon */
                color: #4CAF50;
                vertical-align: middle;
            }

            .dropdown-toggle::after {
                content: none;
            }

            /* Style the dropdown menu */
            /* Style the dropdown menu */
            .dropdown-menu {
                position: absolute;
                top: 100%;
                right: 0;
                left: auto;
                background-color: #f9f9f9;
                border: none;
                /* Hapus border */
                width: 100px;
                /* Atur lebar dropdown */
                padding: 10px;
                display: none;
                white-space: nowrap;
                /* Mencegah teks membungkus */
            }



            /* Style the dropdown items */
            .dropdown-item {
                padding: 3px;
                text-decoration: none;
                color: #081b5e;
            }

            .dropdown-item:hover {
                background-color: #f0f0f0;
            }

            /* Show the dropdown menu when the 'show' class is added */
            .dropdown-menu.show {
                display: block;
            }
        </style>
        <script>
            // Add an event listener to the toggle button
            document.getElementById('dropdownButton').addEventListener('click', function() {
                // Toggle the 'show' class on the dropdown menu
                document.querySelector('.dropdown-menu').classList.toggle('show');
            });
        </script>


        <div class="nav__menu" id="nav-menu">
            <ul class="nav__list mt-3 px-3">
                <li class="nav__item">
                    <a href="index.php" class="nav__link <?php echo ($currentPage == 'index') ? 'active-link' : ''; ?>">
                        <i class='bx bx-home nav__icon'></i>
                        <span class="nav__name">Home</span>
                    </a>
                </li>

                <li class="nav__item">
                    <a href="lokasi.php" class="nav__link <?php echo ($currentPage == 'klik-kulit') ? 'active-link' : ''; ?>">
                        <i class='bx bxs-location-plus nav__icon'></i>
                        <span class="nav__name">Klinik</span>
                    </a>
                </li>

                <li class="nav__item">
                    <a href="captures.php" class="nav__link <?php echo ($currentPage == 'capture') ? 'active-link' : ''; ?>">
                        <div class="nav__icon-circle <?php echo ($currentPage == 'capture') ? 'active-icon-circle' : ''; ?>">
                            <i class='bx bx-camera nav__icon'></i>
                        </div>
                    </a>
                </li>

                <li class="nav__item">
                    <a href="artikel.php" class="nav__link <?php echo ($currentPage == 'artikel') ? 'active-link' : ''; ?>">
                        <i class='bx bx-book-reader nav__icon'></i>
                        <span class="nav__name">Artikel</span>
                    </a>
                </li>

                <li class="nav__item">
                    <a href="#" class="nav__link <?php echo ($currentPage == 'account') ? 'active-link' : ''; ?>">
                        <i class='bx bx-chat nav__icon'></i>
                        <span class="nav__name">Chat Dokter</span>
                    </a>
                </li>

            </ul>
        </div>
    </nav>
</header>

<style>
    .nav__icon-circle {
        width: 45px;
        height: 45px;
        border: 2px solid #081b5e;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        position: relative;
        /* add this */
    }

    .nav__icon-circle i {
        position: absolute;
        /* add this */
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .active-icon-circle {
        border-color: #FFE0B5;
        /* change the border color to white or any other color you want */
    }

    /* Style the dropdown container */
    .dropdown {
        position: relative;
        display: inline-block;
    }

    /* Hide the dropdown content initially */
    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        z-index: 1;
    }

    /* Dropdown links */
    .dropdown-content a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
    }

    /* Change color of links on hover */
    .dropdown-content a:hover {
        background-color: #f1f1f1;
    }
</style>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>