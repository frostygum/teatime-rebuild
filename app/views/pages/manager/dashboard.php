<div class="container-fluid">

    <?php
    require_once VIEW_PATH . "templates/header.php";
    ?>

    <!--<?= isset($user_information) ? $user_information['username'] : '' ?>-->
    <div class="container mt-4">
        <div class="card shadow display-flex" style="min-height: 80vh">
            <!-- KIRI -->
            <div class="side-navbar">
                <div class="p-2 side-navbar-tab-active" style="border-radius: var(--border-radius) 0 0 0" >
                    <h6>Dashboard</h6>
                </div>
                <div class="p-2 side-navbar-tab" onclick="window.location = './manager?page=data'">
                    <h6>Data</h6>
                </div>
                <div class="p-2 side-navbar-tab" onclick="window.location = './manager?page=ranking'">
                    <h6>Ranking</h6>
                </div>
            </div>

            <!-- KANAN -->
            <div class="p-2" style="width: 100%;">
                <div class="display-grid grid-col-3 grid-g-4 m-2 p-2">
                    <div class="card bg-red shadow p-2 text-center text-light panel">
                        <h4>
                            <?= $totalCup["count(pesanan.idMenu)"]; ?>
                        </h4>
                        <h6 class="p-1 ket-panel">Total Cups</h6>
                    </div>
                    <div class="card bg-red shadow p-2 text-center text-light panel">
                        <h4>
                            <?= $totalTransaksi["count(id)"]; ?>
                        </h4>
                        <h6 class="p-1 ket-panel">Total Order</h6>
                    </div>
                    <div class="card bg-red shadow p-2 text-center text-light panel">
                        <h4>
                            <?= $totalPemasukan["sum(total)"]; ?>
                        </h4>
                        <h6 class="p-1 ket-panel">Total Income</h6>
                    </div>
                </div>

                <div class="display-flex justify-content-center ">
                    <div class="card shadow">
                        <div class="card-header">
                            <h6 class="m-0">Penjualan Tahun ini</h6>
                        </div>
                        <div class="card-content">
                            <canvas id="sample_chart" class="chartjs-render-monitor"></canvas>
                        </div>
                    </div>
                    <div class="card shadow ml-2">
                        <div class="card-header">
                            <h6 class="m-0">Pemasukan Tahun ini</h6>
                        </div>
                        <div class="card-content">
                            <canvas id="sample_chart" class="chartjs-render-monitor"></canvas>
                        </div>
                    </div>
                </div>

                <div class="display-grid grid-col-3 grid-g-2 m-3">
                    <div class="card bg-blue shadow p-2 text-center text-light" style="width: 16rem">
                        <h6>Most Popular Menu</h6>
                        <p><?php echo $topMenu['nama_minuman'];?></p>
                    </div>
                    <div class="card bg-blue shadow p-2 text-center text-light" style="width: 16rem">
                        <h6>Most Popular Topping</h6>
                        <p><?php echo $topToping['nama_toping'];?></p>
                    </div>
                    <div class="card bg-blue shadow p-2 text-center text-light" style="width: 16rem">
                        <h6>Best Cashier</h6>
                        <p><?php echo $topKasir['nama_pengguna'];?></p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>