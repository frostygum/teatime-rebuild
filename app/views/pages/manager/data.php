<div class="container-fluid">

    <?php
    require_once VIEW_PATH . "templates/header.php";
    ?>

    <?= isset($user_information) ? $user_information['username'] : '' ?>
    <div class="container mt-4">

        <div class="card shadow display-flex" style="height: 70vh">
            <!-- KIRI -->
            <div class="bg-dark text-light side-navbar" style="width: 20rem; border-radius: var(--border-radius) 0 0 var(--border-radius)">
                <div class="p-2 side-navbar-tab" style="border-radius: var(--border-radius) 0 0 0">
                    <h6>Dashboard</h6>
                </div>
                <div class="p-2 side-navbar-tab-active">
                    <h6>Data</h6>
                </div>
                <div class="p-2 side-navbar-tab">
                    <h6>Ranking</h6>
                </div>
            </div>

            <!-- KANAN -->
            <div class="p-2" style="width: 100%;">
                <div>
                    <button class="btn ">Tanggal</button>
                    <button class="btn">Sort</button>
                </div>
                <div class="p-2 display-grid grid-col-2 grid-g-2">
                    <div>
                        <table class="table">
                            <tr>
                                <th>id</th>
                                <th>Time</th>
                                <th>Customer Name</th>
                                <th>Drink</th>
                                <th>Topping</th>
                                <th>Size</th>
                                <th>Ice</th>
                                <th>Sugar</th>
                                <th>Total</th>
                            </tr>
                            <tr></tr>

                        </table>
                    </div>
                    <div >
                        <div class="p-2">
                            <div class="card bg-red shadow p-2 text-center text-light">
                                <h4>3</h4>
                                <h6 class="p-1 ket-panel">Total Cups</h6>
                            </div>
                            <div class="card bg-red shadow p-2 text-center text-light">
                                <h4>2</h4>
                                <h6 class="p-1 ket-panel">Total Order</h6>
                            </div>
                            <div class="card bg-red shadow p-2 text-center text-light">
                                <h4>60000 </h4>
                                <h6 class="p-1 ket-panel">Total Income</h6>
                            </div>
                        </div>
                    </div>
                </div>



            </div>
        </div>

    </div>
</div>