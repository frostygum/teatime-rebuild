<div class="container-fluid">

    <?php
    require_once VIEW_PATH . "templates/header.php";
    ?>

    <div class="container mt-4">

        <div class="card shadow display-flex" style="min-height: 70vh">
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
                <div class="display-grid grid-col-2 grid-g-2  mt-2">
                    <!--kanan kiri-->
                    <div class="p-1 tableArea">
                        <!--ini menu-->
                        <table class="table tabelManager">
                            <thead>
                                <tr class="tableHeader">
                                    <th>Rank</th>
                                    <th style="min-width:10rem">Nama</th>
                                    <th>Total Penjualan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                //var_dump($listMenu);
                                $i = 1;
                                foreach ($listMenu as $key => $value) {
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
                        <table class="table tabelManager">
                            <tr class="tableHeader">
                                <th>Rank</th>
                                <th style="min-width:10rem">Nama</th>
                                <th>Total Penjualan</th>
                            </tr>
                            <?php
                            $i = 1;
                            foreach ($listToping as $key => $value) {
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
                        <table class="table tabelManager">
                            <tr class="tableHeader">
                                <th>Rank</th>
                                <th style="min-width:10rem">Nama</th>
                                <th>Total transaksi</th>
                            </tr>
                            <?php
                            $i = 1;
                            foreach ($listKasir as $key => $value) {
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
                    <div style="width: 80%; margin-top: 1rem">
                        <div class="dropdown">
                            <button onclick="toggleDropdown('type')" class="dropdown-btn btn-manager">
                                Type
                                <span class="fa fa-caret-down ml-1"></span>
                            </button>
                            <div id="type" class="dropdown-content content-manager">
                                <a href="">Menu</a>
                                <a href="">Toping</a>
                                <a href="">Kasir</a>
                            </div>
                        </div>
                        <br>

                        <button class="btn mt-2 btn-manager">
                            Sort
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>