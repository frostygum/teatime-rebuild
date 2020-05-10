<div class="container-fluid">
    <?php 
        require_once VIEW_PATH . "templates/header.php"; 
    ?>

    <div class="container mt-4">
        <div class="card shadow display-grid grid-col-2" style="height: 80vh; overflow: hidden;">
            <!-- LEFT AREA / SIDE NAVIGATION BAR -->
            <div class="sidebar" style="width: 15rem">
                <div class="p-2 cursor-pointer" onclick="window.location = './admin?page=user'">
                    <h6>User</h6>
                </div>
                <div class="sidebar-active p-2 cursor-pointer" onclick="window.location = './admin?page=menu'">
                    <h6>Menu</h6>
                </div>
                <div class="p-2 cursor-pointer" onclick="window.location = './admin?page=toping'">
                    <h6>Toping</h6>
                </div>
            </div>
            <!-- RIGHT AREA -->
            <div class="display-grid my-4 mx-2">
                <div class="display-grid grid-col-1 align-content-start">
                    <!-- MAIN AREA -->
                    <div class="display-grid p-2 grid-col-2 justify-content-space-between">
                        <div>
                            <!-- SEARCH USER -->
                            <input type="text" id="search-inpt" class="input bg-teal text-light border-0" placeholder="Search name" onkeyup="searchMenu(event)" />
                            <!-- DROPDOWN FILTER -->
                            <div class="fltr-dropdown dropdown">
                                <button onclick="toggleDropdown('select_filter')" class="fltr-dropdown-btn dropdown-btn block py-1" style="font-size: 1rem">
                                    Filter <span class="fa fa-caret-down ml-1"></span>
                                </button>
                                <div id="select_filter" class="dropdown-content fltr-dropdown-content">
                                    <a onclick="searchFilterMenu('milk tea')">Milk Tea</a>
                                    <a onclick="searchFilterMenu('coffee')">Coffee</a>
                                    <a onclick="searchFilterMenu('Tea')">Tea</a>
                                </div>
                            </div>
                            <button class="search-btn" onclick="clearSearch()">clear</button>
                        </div>
                        <button class="manage-btn" onclick="toggleModal('modal-add')">
                            Add
                        </button>
                    </div>
                    <div class="display-flex justify-content-start p-2" style="max-width: 55rem; overflow: auto">
                        <!-- TABLE -->
                        <Table class="main-table" id="table-menu" style="width: 54rem">
                            <thead>
                                <tr class="main-table-header-row">
                                    <th class="p-1">No</th>
                                    <th class="p-1" style="min-width: 17rem">Menu</th>
                                    <th class="p-1" style="min-width: 6rem">Harga Reguler</th>
                                    <th class="p-1" style="min-width: 6rem">Harga Large</th>
                                    <th class="p-1" style="min-width: 10rem">action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </Table>
                    </div>
                </div>
            </div>
        </div> 
    </div>
</div>

<!-- MODAL EDIT -->
<div id="modal-edit" class="modal">
    <div class="modal-wrapper align-items-space-evenly">
        <div class="modal-body">
            <span class="fa fa-times custom-close" onclick="toggleModal('modal-edit')"></span>
            
            <h5 class="text-center">Edit Menu</h5>
            
            <form method="POST" action="./admin?page=menu" id="form-edit">
                <input type="hidden" name="command" value="edit-menu">
                <input type="hidden" name="id" value="">
                <div class="display-grid grid-g-2 mt-4">
                    <div>
                        <p class="text-bold m-0">Nama Menu</p>
                        <input class="input block" type="text" name="name" placeholder="nama lengkap">
                    </div>
                    <div class="display-grid grid-col-2 grid-g-2">
                        <div>
                            <p class="text-bold m-0">Harga Reguler</p>
                            <input class="input block" type="text" name="harga_r" placeholder="harga ukuran reguler">
                        </div>
                        <div>
                            <p class="text-bold m-0">Harga Large</p>
                            <input class="input block" type="text" name="harga_l" placeholder="harga ukuran large">
                        </div>
                    </div>
                    <div class="mt-3">
                        <button type="submit" name="button" class="btn btn-primary block bg-primary shadow py-1 text-bold">
                            Edit
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL ADD -->
<div id="modal-add" class="modal">
    <div class="modal-wrapper align-items-space-evenly">
        <div class="modal-body">
            <span class="fa fa-times custom-close" onclick="toggleModal('modal-add')"></span>
            
            <h5 class="text-center">Add Menu</h5>
            
            <form method="POST" action="./admin?page=menu">
                <input type="hidden" name="command" value="add-menu">
                <div class="display-grid grid-g-2 mt-4">
                    <div>
                        <p class="text-bold m-0">Nama Menu</p>
                        <input class="input block" type="text" name="name" placeholder="nama lengkap">
                    </div>
                    <div class="display-grid grid-col-2 grid-g-2">
                        <div>
                            <p class="text-bold m-0">Harga Reguler</p>
                            <input class="input block" type="text" name="harga_r" placeholder="harga ukuran reguler">
                        </div>
                        <div>
                            <p class="text-bold m-0">Harga Large</p>
                            <input class="input block" type="text" name="harga_l" placeholder="harga ukuran large">
                        </div>
                    </div>
                    <div class="mt-3">
                        <button type="submit" name="button" class="btn btn-primary block bg-primary shadow py-1 text-bold">
                            Add
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL -->
<div id="modal-delete" class="modal">
    <div class="modal-wrapper align-items-space-evenly">
        <div class="modal-body">
            <span class="fa fa-times custom-close" onclick="toggleModal('modal-delete')"></span>
            
            <h5 class="text-center">Delete Menu ?</h5>
            
            <form method="POST" action="./admin?page=menu" id="form-delete">
                <input type="hidden" name="command" value="delete-menu">
                <input type="hidden" name="id" value="">
                <div class="display-grid grid-col-2 grid-g-2 mt-4">
                    <button type="submit" name="button" class="btn btn-danger block shadow py-1 text-bold">
                        Yes
                    </button>
                    <button type="button" name="button" class="btn btn-primary block shadow py-1 text-bold" onclick="toggleModal('modal-delete')">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php 
    if(isset($status)) {
        echo "
        <div class='alert'>
            <div id='alert' class='alert-content bg-success'>
                <div class='alert-icon text-light'>  
                    <span class='fa fa-check'></span>
                </div>
                <div class='alert-text text-light'>
                    $status
                </div>
                <button class='alert-close text-light' onclick='toggleAlert(`alert`)'>
                    <span class='fa fa-times-circle'></span>
                </button>
            </div>
        </div>
        <script type='text/javascript' defer>
            window.addEventListener('load', function () {
                toggleAlert('alert');
            });
        </script>
        ";
    }
    else if(isset($error)){
        echo "
        <div class='alert'>
            <div id='alert' class='alert-content'>
                <div class='alert-icon'>  
                    <span class='fa fa-exclamation-triangle'></span>
                </div>
                <div class='alert-text'>
                    $error
                </div>
                <button class='alert-close' onclick='toggleAlert(`alert`)'>
                    <span class='fa fa-times-circle'></span>
                </button>
            </div>
        </div>
        <script type='text/javascript' defer>
            window.addEventListener('load', function () {
                toggleAlert('alert');
            });
        </script>
        ";
    }
?>

<?= $this::add_template('footer') ?>

<script type="text/javascript" defer>
    let menuList = [];
    let tableUser = document.getElementById('table-menu');
    let formatter = new Intl.NumberFormat('en-IN', {
        style: 'currency',
        currency: 'IDR',
        maximumSignificantDigits: 3
    });
    
    <?php
        foreach ($all_menu as $key => $menu) {
            echo '
                menuList.push({
                    id: '. $menu->get_id() .',
                    name: "'. $menu->get_nama() .'",
                    price_r: "'. $menu->get_hargaR() .'",
                    price_l: "'. $menu->get_hargaL() .'"
                });
            ';
        }
    ?>

    for(let i = menuList.length - 1; i >= 0; i--) {
        let menu = menuList[i];

        let row = tableUser.insertRow(1);
        row.id = `menu-${menu.id}`;
        row.className = "main-table-data-row";

        let number = row.insertCell(0)
        let name = row.insertCell(1);
        let price_r = row.insertCell(2);
        let price_l = row.insertCell(3);
        let action = row.insertCell(4);

        number.textContent = i + 1;
        number.className = "text-center text-dark p-1";
        name.textContent = menu.name;
        name.className = "text-dark p-1";
        price_r.textContent = formatter.format(menu.price_r);
        price_r.className = "text-center text-dark p-1";
        price_l.textContent = formatter.format(menu.price_l);
        price_l.className = "text-center text-dark p-1";
        action.className = "text-center";
        action.innerHTML = `
            <button class="btn btn-warning" onclick="toggleModalEdit(${menu.id})">
                <span class="fa fa-pen"></span>
            </button>
            <button class="btn btn-danger" onclick="toggleModalDelete(${menu.id})">
                <span class="fa fa-trash"></span>
            </button>
        `;
    }

    function searchMenu(e) {
        let searchVal = e.target.value;
        for(let i = 0; i < menuList.length; i++) {
            let curr = menuList[i];
            let currItem = document.getElementById(`menu-${curr.id}`);
            
            if(curr.name.toLowerCase().indexOf(searchVal) > -1) {
                currItem.style.display = ''; 
            }
            else {
                currItem.style.display = 'none';
            }
        }
    }

    function searchFilterMenu(value) {
        let searchVal = value;
        for(let i = 0; i < menuList.length; i++) {
            let curr = menuList[i];
            let currItem = document.getElementById(`menu-${curr.id}`);
            
            if(curr.name.toLowerCase().indexOf(searchVal) > -1) {
                currItem.style.display = ''; 
            }
            else {
                currItem.style.display = 'none';
            }
        }
    }

    function clearSearch() {
        document.getElementById('search-inpt').value = '';
        searchFilterMenu('');
    }

    function searchMenuById(id) {
        for(let i = 0; i < menuList.length; i++) {
            if(menuList[i].id == id) {
                return menuList[i];
            }
        }
    }

    function toggleModalEdit(menuId) {
        let menu = searchMenuById(menuId);
        let form = document.getElementById('form-edit');
        let formElements = form.elements;

        form.id.value = menu.id;
        form.name.value = menu.name;
        form.harga_r.value = menu.price_r;
        form.harga_l.value = menu.price_l;

        toggleModal('modal-edit');
    }

    function toggleModalDelete(menuId) {
        let menu = searchMenuById(menuId);
        let form = document.getElementById('form-delete');
        let formElements = form.elements;

        form.id.value = menu.id;

        toggleModal('modal-delete');
    }
</script>