<div class="container-fluid">

    <?php
    require_once VIEW_PATH . "templates/header.php";
    ?>

    <!--<?= isset($user_information) ? $user_information['username'] : '' ?>-->
    <div class="container mt-4">
        <div class="card shadow display-flex" style="min-height: 80vh">
            <!-- KIRI -->
            <div class="side-navbar">
                <div class="p-2 side-navbar-tab-active" style="border-radius: var(--border-radius) 0 0 0">
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
                            <?= $totalCup["count(Pesanan.idMenu)"]; ?>
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
                        <h4 id="total-pemasukan">
                            <?= $totalPemasukan["sum(total)"]; ?>
                        </h4>
                        <h6 class="p-1 ket-panel">Total Income</h6>
                    </div>
                </div>

                <div class="display-grid grid-col-1 grid-g-2 justify-content-center">
                    <div class="card shadow" style="width: 40rem">
                        <div class="card-header">
                            <h6 class="m-0">Penjualan Bulan ini</h6>
                        </div>
                        <div class="card-content">
                            <canvas id="penjualan" class="chartjs-render-monitor"></canvas>
                        </div>
                    </div>
                    <div class="card shadow" style="width: 40rem">
                        <div class="card-header">
                            <h6 class="m-0">Pemasukan Bulan ini</h6>
                        </div>
                        <div class="card-content">
                            <canvas id="pemasukan" class="chartjs-render-monitor"></canvas>
                        </div>
                    </div>
                </div>

                <div class="display-grid grid-col-3 grid-g-2 m-3">
                    <div class="card bg-blue shadow p-2 text-center text-light" style="width: 16rem">
                        <h6>Most Popular Menu</h6>
                        <p><?php echo $topMenu['nama_minuman']; ?></p>
                    </div>
                    <div class="card bg-blue shadow p-2 text-center text-light" style="width: 16rem">
                        <h6>Most Popular Topping</h6>
                        <p><?php echo $topToping['nama_toping']; ?></p>
                    </div>
                    <div class="card bg-blue shadow p-2 text-center text-light" style="width: 16rem">
                        <h6>Best Cashier</h6>
                        <p><?php echo $topKasir['nama_pengguna']; ?></p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script defer>
    let formatter = new Intl.NumberFormat(['ban', 'id'], {
        style: 'currency',
        currency: 'IDR',
        maximumSignificantDigits: 2
    });

    var chart = document.getElementById('penjualan').getContext('2d');

    let salePerThisMonth = <?= $salePerThisMonth?>;
    let labels2 = [];
    let dayData2 = [];

    if(salePerThisMonth != '') {
        salePerThisMonth.map((data, i) => {
            labels2.push(data.day);
            dayData2.push(data.total);
        });
    }

    var chart = new Chart(chart, {
        // The type of chart we want to create
        type: 'line',

        // The data for our dataset
        data: {
            labels: labels2,
            datasets: [{
                label: 'Banyak penjualan ',
                backgroundColor: '#3498db',
                borderColor: '#2980b9',
                data: dayData2
            }]
        },

        // Configuration options go here
        options: {}
    });

    var ctx = document.getElementById('pemasukan').getContext('2d');

    let dataPerThisMonth = <?= $dataPerThisMonth ?>;
    let labels = [];
    let dayData = [];

    if(dataPerThisMonth != '') {
        dataPerThisMonth.map((data, i) => {
            labels.push(data.day);
            dayData.push(data.total);
        });
    }

    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'line',

        // The data for our dataset
        data: {
            labels: labels,
            datasets: [{
                label: 'Banyak pemasukan ',
                backgroundColor: '#2ecc71',
                borderColor: '#27ae60',
                data: dayData
            }]
        },

        // Configuration options go here
        options: {}
    });

    let totalPemasukan = document.getElementById('total-pemasukan')
    totalPemasukan.textContent = formatter.format(parseInt(totalPemasukan.textContent));
</script>