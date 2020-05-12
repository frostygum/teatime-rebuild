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
                        <table class="table tableManager mb-2" id="table-menu" style="display: block; width: 100%; max-height: 20rem; overflow: auto">
                            <thead>
                                <tr class="tableHeader">
                                    <th>Rank</th>
                                    <th style="min-width:22rem">Nama</th>
                                    <th style="min-width:10rem">Total Penjualan</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>

                        <!--ini toping-->
                        <table class="table tableManager mb-2" id="table-topping" style="display: block; width: 100%; max-height: 20rem; overflow: auto">
                            <thead>
                                <tr class="tableHeader">
                                    <th>Rank</th>
                                    <th style="min-width:22rem">Nama</th>
                                    <th style="min-width:10rem">Total Penjualan</th>
                                </tr>
                            </thead>

                            <tbody>
                            </tbody>
                        </table>

                        <!--ini kasir-->
                        <table class="table tableManager" id="table-kasir" style="display: block; width: 100%; max-height: 20rem; overflow: auto">
                            <thead>
                                <tr class="tableHeader">
                                    <th>Rank</th>
                                    <th style="min-width:22rem">Nama</th>
                                    <th style="min-width:10rem">Total transaksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
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

let listMenuASC = [];
let listMenuDESC = [];
let listToppingASC = [];
let listToppingDESC = [];
let listKasirASC = [];
let listKasirDESC = [];

<?php
    foreach ($listMenuASC as $key => $value) {
        echo '
            listMenuASC.push({
                name: "'. $value["nama"] .'",
                value: "'. $value['terjual'] .'"
            })
        ';
    }
?>

<?php
    foreach ($listMenuDESC as $key => $value) {
        echo '
            listMenuDESC.push({
                name: "'. $value["nama"] .'",
                value: "'. $value['terjual'] .'"
            })
        ';
    }
?>

<?php
    foreach ($listTopingDESC as $key => $value) {
        echo '
            listToppingDESC.push({
                name: "'. $value["nama"] .'",
                value: "'. $value['terjual'] .'"
            })
        ';
    }
?>

<?php
    foreach ($listTopingASC as $key => $value) {
        echo '
            listToppingASC.push({
                name: "'. $value["nama"] .'",
                value: "'. $value['terjual'] .'"
            })
        ';
    }
?>

<?php
    foreach ($listKasirASC as $key => $value) {
        echo '
            listKasirASC.push({
                name: "'. $value["nama"] .'",
                value: "'. $value['transaksi'] .'"
            })
        ';
    }
?>

<?php
    foreach ($listKasirDESC as $key => $value) {
        echo '
            listKasirDESC.push({
                name: "'. $value["nama"] .'",
                value: "'. $value['transaksi'] .'"
            })
        ';
    }
?>

function renderTable(tableId, data) {
    let selTable = document.getElementById(tableId);

    if(selTable.rows.length > 1) {
        for(let i = data.length - 1; i >= 0; i--) {
            selTable.deleteRow(1);
        }
    }

    for(let i = data.length - 1; i >= 0; i--) {
        let menu = data[i];
        let row = selTable.insertRow(1);

        let rank = row.insertCell(0);
        let name = row.insertCell(1);
        let total = row.insertCell(2);

        rank.textContent = i + 1;
        name.textContent = menu.name;
        total.textContent = menu.value;

        rank.className = "text-dark p-1 text-center";
        name.className = "text-dark p-1";
        total.className = "text-dark p-1 text-center";
    }
}

renderTable('table-menu', listMenuDESC);
renderTable('table-topping', listMenuDESC);
renderTable('table-kasir', listMenuDESC);

function handle_change_sort(sortType) {
    if(sortType == "ascending") {
        renderTable('table-menu', listMenuASC);
        renderTable('table-topping', listToppingASC);
        renderTable('table-kasir', listKasirASC);
    }
    else {
        renderTable('table-menu', listMenuDESC);
        renderTable('table-topping', listToppingDESC);
        renderTable('table-kasir', listKasirDESC);
    }
}

function handle_change_type(type) {

    switch(type) {
        case 'all':
            document.getElementById('table-menu').style.display = 'block';
            document.getElementById('table-topping').style.display = 'block';
            document.getElementById('table-kasir').style.display = 'block';
        break;
        case 'menu':
            document.getElementById('table-menu').style.display = 'block';
            document.getElementById('table-topping').style.display = 'none';
            document.getElementById('table-kasir').style.display = 'none';
        break;
        case 'toping':
            document.getElementById('table-menu').style.display = 'none';
            document.getElementById('table-topping').style.display = 'block';
            document.getElementById('table-kasir').style.display = 'none';
        break;
        case 'kasir':
            document.getElementById('table-menu').style.display = 'none';
            document.getElementById('table-topping').style.display = 'none';
            document.getElementById('table-kasir').style.display = 'block';
        break;
    }
}

</script>