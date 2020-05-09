<div class="container-fluid">

    <?php
    require_once VIEW_PATH . "templates/header.php";
    ?>

    <?= isset($user_information) ? $user_information['username'] : '' ?>
    <div class="container mt-4">

        <div class="card shadow display-flex" style="height: 70vh">
            <!-- KIRI -->
            <div class="bg-dark text-light p-2 side-navbar" style="width: 20rem; border-radius: var(--border-radius) 0 0 var(--border-radius)">
                <div class="p-2 side-navbar-tab ">
                    <h6>Dashboard</h6>
                </div>
                <div class="p-2 side-navbar-tab">
                    <h6>Data</h6>
                </div>
                <div class="p-2 side-navbar-tab">
                    <h6>Ranking</h6>
                </div>
            </div>

            <!-- KANAN -->
            <div class="p-2" style="width: 100%;">
                <div class="display-grid grid-col-3 grid-g-2">

                    <div class="card bg-red shadow p-2 text-center text-light">
                        <h4>100</h4>
                        <p>Total Cups</p>
                    </div>
                    <div class="card bg-red shadow p-2 text-center text-light">
                        <h4>100</h4>
                        <p>Total Cups</p>
                    </div>
                    <div class="card bg-red shadow p-2 text-center text-light">
                        <h4>100</h4>
                        <p>Total Cups</p>
                    </div>
                </div>

                <div>
                    ceritanya grafik
                </div>

                <div class="display-grid grid-col-3 grid-g-2">
                    <div class="card bg-purple shadow p-2 text-center text-light">
                        <h6>Most Popular Menu</h6>
                        <p>Brown sugar</p>
                    </div>
                    <div class="card bg-purple shadow p-2 text-center text-light">
                        <h6>Most Popular Topping</h6>
                        <p>Brown sugar</p>
                    </div>
                    <div class="card bg-purple shadow p-2 text-center text-light">
                        <h6>Best Cashier</h6>
                        <p>Brown sugar</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>