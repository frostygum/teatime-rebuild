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
                <div class="p-2 side-navbar-tab-active">
                    <h6>Data</h6>
                </div>
                <div class="p-2 side-navbar-tab" onclick="window.location = './manager?page=ranking'">
                    <h6>Ranking</h6>
                </div>
            </div>

            <!-- KANAN -->
            <div class="p-2" style="width: 100%;">
                <!--isi-->
                <div class="display-grid grid-col-2 grid-g-1 mt-1">
                    <!--kanan kiri-->
                    <div>
                        <!--button-->
                        <div class="m-2" style="float: right">
                            <div class="dropdown ml-2" style="float: right">
                                <button onclick="toggleDropdown('type')" class="dropdown-btn btn-manager">
                                    Type
                                    <span class="fa fa-caret-down ml-1"></span>
                                </button>
                                <div id="type" class="dropdown-content content-manager">
                                    <a class="cursor-pointer" onclick="handle_change_date_type('detail')">Detail Transaksi</a>
                                    <a class="cursor-pointer" onclick="handle_change_date_type('not-detail')">Transaksi</a>
                                </div>
                            </div>

                            <form method="POST" action="./manager?page=data" style="float: right" id="form-date">
                                <input type="date" class="input" id="tgl" name="tgl" placeholder="Tanggal" style="height:2rem" oninput="handle_date_input()">
                            </form>

                        </div>
                        <div class="p-1">
                            <table class="table tabelManager" id="table-detail">
                                <tr class="tableHeader">
                                    <th>Time</th>
                                    <th>Customer</th>
                                    <th style="min-width:10rem">Drink</th>
                                    <th>Topping</th>
                                    <th>Size</th>
                                    <th>Ice</th>
                                    <th>Sugar</th>
                                    <th>Total</th>
                                </tr>
                                <?php
                                if ($dataDetailTransaksi != false) {
                                    foreach ($dataDetailTransaksi as $key => $value) {
                                        echo '
                                            <tr class="tableData">
                                                <td >' . $value["waktu_transaksi"] . '</td>
                                                <td >' . $value["nama_pemesan"] . '</td>
                                                <td >' . $value["nama_minuman"] . '</td>
                                                <td >' . $value["nama_toping"] . '</td>
                                                <td >' . $value["ukuran_gelas"] . '</td>
                                                <td >' . $value["banyak_es"] . '</td>
                                                <td >' . $value["banyak_gula"] . '</td>
                                                <td >' . $value["total"] . '</td>
                                            </tr>
                                        ';
                                    }
                                }

                                ?>

                            </table>
                            <table class="table tabelManager" style="margin-left: auto; margin-right: auto; display: none" id="table-not-detail">
                                <tr class="tableHeader">
                                    <th style="min-width:5rem;">Time</th>
                                    <th style="min-width:10rem;">Customer</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                </tr>
                                <?php
                                // var_dump($dataTransaksi);
                                if ($dataTransaksi != false) {
                                    foreach ($dataTransaksi as $key => $value) {
                                        echo '
                                            <tr class="tableData">
                                                <td >' . $value["waktu_transaksi"] . '</td>
                                                <td >' . $value["nama_pemesan"] . '</td>
                                                <td style="text-align: center">' . $value["jumlah"] . '</td>
                                                <td >' . $value["total"] . '</td>
                                            </tr>
                                        ';
                                    }
                                }
                                ?>

                            </table>
                        </div>
                    </div>
                    <!--kanan kanan-->
                    <div>
                        <div class="p-2" style="width: 10rem">
                            <div class="card bg-red shadow p-1 text-center text-light panel-data">
                                <h6><?= $totalCup["count(pesanan.idMenu)"]; ?></h6>
                                <p class="p-1 ket-panel-data">Total Cups</p>
                            </div>
                            <div class="card bg-red shadow p-1 text-center text-light panel-data">
                                <h6><?= $totalTransaksi["count(id)"]; ?></h6>
                                <p class="p-1 ket-panel-data">Total Order</p>
                            </div>
                            <div class="card bg-red shadow p-1 text-center text-light panel-data">
                                <h6><?= $totalPemasukan["sum(total)"]; ?></h6>
                                <p class="p-1 ket-panel-data">Total Income</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script type="text/javascript" defer>
    function handle_date_input() {
        document.getElementById('form-date').submit();
    }

    function handle_change_date_type(tableType) {
        let tableDetail = document.getElementById('table-detail');
        let tableNotDetail = document.getElementById('table-not-detail');

        if(tableType == 'detail') {
            tableDetail.style.display = '';
            tableNotDetail.style.display = 'none';
        }
        else {
            tableDetail.style.display = 'none';
            tableNotDetail.style.display = '';
        }
    }
</script>