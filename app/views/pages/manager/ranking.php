<div class="container-fluid" onload="handle_change_sort_type('ascending')">

    <?php
    require_once VIEW_PATH . "templates/header.php";
    ?>

    <div class="container mt-4">

        <div class="card shadow display-flex" style="min-height: 80vh;">
            <!-- KIRI -->
            <div class="side-navbar">
                <div class="p-2 side-navbar-tab" style="border-radius: var(--border-radius) 0 0 0" onclick="window.location = './manager?page=dashboard'">
                    <h6>Dashboard</h6>
                </div>
                <div class="p-2 side-navbar-tab" onclick="window.location = './manager?page=data'">
                    <h6>Data</h6>
                </div>
                <div class="p-2 side-navbar-tab-active">
                    <h6>Ranking</h6>
                </div>
            </div>

            <!-- KANAN -->
            <div class="p-2" style="width: 100%;">
                <!--isi-->
                <div class="display-grid grid-col-2 grid-g-2 mt-2" style="width: 100%">
                    <!--kanan kiri-->
                    <div class="p-1 tableArea" style="width: 40rem">
                        <!--ini menu-->
                        <table class="table tableManager mb-2" id="menu-descending" style="display: block; width: 100%; max-height: 20rem; overflow: auto">
                            <thead>
                                <tr class="tableHeader">
                                    <th>Rank</th>
                                    <th style="min-width:22rem">Nama</th>
                                    <th style="min-width:10rem">Total Penjualan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                //var_dump($listMenu);
                                $i = 1;
                                foreach ($listMenuDESC as $key => $value) {
                                    echo "
                                        <tr class='tableData' style=' color: var(--dark-darker); background-color: var(--white)'>
                                            <td style='text-align: center;'>" . $i . "</td>
                                            <td >" . $value['nama'] . "</td>
                                            <td style='text-align: center'>" . $value['terjual'] . "</td>
                                        </tr>
                                    ";
                                    $i++;
                                }
                                ?>
                            </tbody>
                        </table>

                        <table class="table tableManager mb-2" id="menu-ascending" style="display: none; width: 100%; max-height: 20rem; overflow: auto">
                            <thead>
                                <tr class="tableHeader">
                                    <th>Rank</th>
                                    <th style="min-width:22rem">Nama</th>
                                    <th style="min-width:10rem">Total Penjualan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                //var_dump($listMenu);
                                $i = 1;
                                foreach ($listMenuASC as $key => $value) {
                                    echo "
                                        <tr class='tableData' style=' color: var(--dark-darker); background-color: var(--white)'>
                                            <td style='text-align: center;'>" . $i . "</td>
                                            <td >" . $value['nama'] . "</td>
                                            <td style='text-align: center'>" . $value['terjual'] . "</td>
                                        </tr>
                                    ";
                                    $i++;
                                }
                                ?>
                            </tbody>
                        </table>
                        <!--ini toping-->
                        <table class="table tableManager mb-2" id="toping-descending">
                            <tr class="tableHeader">
                                <th>Rank</th>
                                <th style="min-width:10rem">Nama</th>
                                <th>Total Penjualan</th>
                            </tr>
                            <?php
                            $i = 1;
                            foreach ($listTopingDESC as $key => $value) {
                                echo "
                                        <tr class='tableData' style=' color: var(--dark-darker); background-color: var(--white)'>
                                            <td style='text-align: center;'>" . $i . "</td>
                                            <td >" . $value['nama'] . "</td>
                                            <td style='text-align: center'>" . $value['terjual'] . "</td>
                                        </tr>
                                    ";
                                $i++;
                            }
                            ?>
                        </table>

                        <table class="table tableManager" id="toping-ascending"  style="display: none;">
                            <tr class="tableHeader">
                                <th>Rank</th>
                                <th style="min-width:10rem">Nama</th>
                                <th>Total Penjualan</th>
                            </tr>
                            <?php
                            $i = 1;
                            foreach ($listTopingASC as $key => $value) {
                                echo "
                                        <tr class='tableData' style=' color: var(--dark-darker); background-color: var(--white)'>
                                            <td style='text-align: center;'>" . $i . "</td>
                                            <td >" . $value['nama'] . "</td>
                                            <td style='text-align: center'>" . $value['terjual'] . "</td>
                                        </tr>
                                    ";
                                $i++;
                            }
                            ?>
                        </table>
                        <!--ini kasir-->
                        <table class="table tableManager" id="kasir-descending">
                            <tr class="tableHeader">
                                <th>Rank</th>
                                <th style="min-width:10rem">Nama</th>
                                <th>Total transaksi</th>
                            </tr>
                            <?php
                            $i = 1;
                            foreach ($listKasirDESC as $key => $value) {
                                echo "
                                        <tr class='tableData' style=' color: var(--dark-darker); background-color: var(--white)'>
                                            <td style='text-align: center;'>" . $i . "</td>
                                            <td >" . $value['nama'] . "</td>
                                            <td style='text-align: center'>" . $value['transaksi'] . "</td>
                                        </tr>
                                    ";
                                $i++;
                            }
                            ?>
                        </table>

                        <table class="table tableManager" id="kasir-ascending"  style="display: none;">
                            <tr class="tableHeader">
                                <th>Rank</th>
                                <th style="min-width:10rem">Nama</th>
                                <th>Total transaksi</th>
                            </tr>
                            <?php
                            $i = 1;
                            foreach ($listKasirASC as $key => $value) {
                                echo "
                                        <tr class='tableData' style=' color: var(--dark-darker); background-color: var(--white)'>
                                            <td style='text-align: center;'>" . $i . "</td>
                                            <td >" . $value['nama'] . "</td>
                                            <td style='text-align: center'>" . $value['transaksi'] . "</td>
                                        </tr>
                                    ";
                                $i++;
                            }
                            ?>
                        </table>
                    </div>
                    <!--kanan kanan-->
                    <div class="display-flex" style="flex-direction: column; margin-top: 1rem; width: 10rem">
                        <!-- TYPE -->
                        <div class="dropdown">
                            <button onclick="toggleDropdown('type')" class="dropdown-btn btn-manager">
                                Type
                                <span class="fa fa-caret-down ml-1"></span>
                            </button>
                            <div id="type" class="dropdown-content content-manager">
                                <a class="cursor-pointer" onclick="handle_change_type('all')">All</a>
                                <a class="cursor-pointer" onclick="handle_change_type('menu')">Menu</a>
                                <a class="cursor-pointer" onclick="handle_change_type('toping')">Toping</a>
                                <a class="cursor-pointer" onclick="handle_change_type('kasir')">Kasir</a>
                            </div>
                        </div>
                        
                        <!-- SORT -->
                        <div class="dropdown mt-1" style="float: right">
                            <button onclick="toggleDropdown('sort')" class="dropdown-btn btn-manager">
                                Sort
                                <span class="fa fa-caret-down ml-1"></span>
                            </button>
                            <div id="sort" class="dropdown-content content-manager">
                                <a class="cursor-pointer" onclick="handle_change_sort('descending')">Most</a>
                                <a class="cursor-pointer" onclick="handle_change_sort('ascending')">Least</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script type="text/javascript" defer>
    function handle_change_type(type) {
        let menuDescending = document.getElementById('menu-descending');
        let topingDescending = document.getElementById('toping-descending');
        let kasirDescending = document.getElementById('kasir-descending');

        let menuAscending = document.getElementById('menu-ascending');
        let topingAscending = document.getElementById('toping-ascending');
        let kasirAscending = document.getElementById('kasir-ascending');

        if (menuDescending.style.display == '' || topingDescending.style.display == '' || kasirDescending.style.display == '') {
            if (type == 'all') {
                menuDescending.style.display = '';
                topingDescending.style.display = '';
                kasirDescending.style.display = '';
                menuAscending.style.display = 'none';
                topingAscending.style.display = 'none';
                kasirAscending.style.display = 'none';
            } else if (type == 'menu') {
                menuDescending.style.display = '';
                topingDescending.style.display = 'none';
                kasirDescending.style.display = 'none';
            } else if (type == 'toping') {
                menuDescending.style.display = 'none';
                topingDescending.style.display = '';
                kasirDescending.style.display = 'none';
            } else if (type == 'kasir') {
                menuDescending.style.display = 'none';
                topingDescending.style.display = 'none';
                kasirDescending.style.display = '';
            }
        } else if (menuAscending.style.display == '' || topingAscending.style.display == '' || kasirAscending.style.display == '') {
            if (type == 'all') {
                menuAscending.style.display = '';
                topingAscending.style.display = '';
                kasirAscending.style.display = '';
                menuDescending.style.display = 'none';
                topingDescending.style.display = 'none';
                kasirDescending.style.display = 'none';
            } else if (type == 'menu') {
                menuAscending.style.display = '';
                topingAscending.style.display = 'none';
                kasirAscending.style.display = 'none';
            } else if (type == 'toping') {
                menuAscending.style.display = 'none';
                topingAscending.style.display = '';
                kasirAscending.style.display = 'none';
            } else if (type == 'kasir') {
                menuAscending.style.display = 'none';
                topingAscending.style.display = 'none';
                kasirAscending.style.display = '';
            }
        }
    }

    function handle_change_sort(sortType) {
        let menuDescending = document.getElementById('menu-descending');
        let topingDescending = document.getElementById('toping-descending');
        let kasirDescending = document.getElementById('kasir-descending');

        let menuAscending = document.getElementById('menu-ascending');
        let topingAscending = document.getElementById('toping-ascending');
        let kasirAscending = document.getElementById('kasir-ascending');

        if (sortType == 'ascending') {
            if ((menuAscending.style.display == '' || menuDescending.style.display == '') && (topingAscending.style.display == '' || topingDescending.style.display == '') && (kasirAscending.style.display == '' || kasirDescending.style.display == '')) {
                menuDescending.style.display = 'none';
                menuAscending.style.display = '';
                topingDescending.style.display = 'none';
                topingAscending.style.display = '';
                kasirDescending.style.display = 'none';
                kasirAscending.style.display = '';
            } else if (menuAscending.style.display == '' || menuDescending.style.display == '') {
                menuDescending.style.display = 'none';
                menuAscending.style.display = '';
                topingDescending.style.display = 'none';
                topingAscending.style.display = 'none';
                kasirDescending.style.display = 'none';
                kasirAscending.style.display = 'none';
            } else if (topingAscending.style.display == '' || topingDescending.style.display == '') {
                menuDescending.style.display = 'none';
                menuAscending.style.display = 'none';
                topingDescending.style.display = 'none';
                topingAscending.style.display = '';
                kasirDescending.style.display = 'none';
                kasirAscending.style.display = 'none';
            } else if (kasirAscending.style.display == '' || kasirDescending.style.display == '') {
                menuDescending.style.display = 'none';
                menuAscending.style.display = 'none';
                topingDescending.style.display = 'none';
                topingAscending.style.display = 'none';
                kasirDescending.style.display = 'none';
                kasirAscending.style.display = '';
            }
        }
        else {
            if ((menuAscending.style.display == '' || menuDescending.style.display == '') && (topingAscending.style.display == '' || topingDescending.style.display == '') && (kasirAscending.style.display == '' || kasirDescending.style.display == '')) {
                menuDescending.style.display = '';
                menuAscending.style.display = 'none';
                topingDescending.style.display = '';
                topingAscending.style.display = 'none';
                kasirDescending.style.display = '';
                kasirAscending.style.display = 'none';
            } else if (menuAscending.style.display == '' || menuDescending.style.display == '') {
                menuDescending.style.display = '';
                menuAscending.style.display = 'none';
                topingDescending.style.display = 'none';
                topingAscending.style.display = 'none';
                kasirDescending.style.display = 'none';
                kasirAscending.style.display = 'none';
            } else if (topingAscending.style.display == '' || topingDescending.style.display == '') {
                menuDescending.style.display = 'none';
                menuAscending.style.display = 'none';
                topingDescending.style.display = '';
                topingAscending.style.display = 'none';
                kasirDescending.style.display = 'none';
                kasirAscending.style.display = 'none';
            } else if (kasirAscending.style.display == '' || kasirDescending.style.display == '') {
                menuDescending.style.display = 'none';
                menuAscending.style.display = 'none';
                topingDescending.style.display = 'none';
                topingAscending.style.display = 'none';
                kasirDescending.style.display = '';
                kasirAscending.style.display = 'none';
            }
        }

        // if(sortType == 'ascending') {
        //     menuDescending.style.display = '';
        //     menuAscending.style.display = 'none';
        //     topingDescending.style.display = '';
        //     topingAscending.style.display = 'none';
        //     kasirDescending.style.display = '';
        //     kasirAscending.style.display = 'none';
        // }
        // else {
        //     menuDescending.style.display = 'none';
        //     menuAscending.style.display = '';
        //     topingDescending.style.display = 'none';
        //     topingAscending.style.display = '';
        //     kasirDescending.style.display = 'none';
        //     kasirAscending.style.display = '';
        // }
    }
</script>