<div class="container-fluid">
    <?php 
        require_once VIEW_PATH . "templates/header.php"; 
    ?>

    <div class="container mt-4">
        <div class="card shadow display-grid grid-col-2" style="height: 80vh; overflow: hidden;">
            <!-- LEFT AREA / SIDE NAVIGATION BAR -->
            <div class="sidebar" style="width: 10rem">
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
            <div class="display-grid align-content-space-between my-4">
                <div class="display-grid grid-col-2">
                    <!-- MAIN AREA -->
                    <div class="display-flex justify-content-start p-2" style="max-width: 45rem; overflow: auto">
                        <!-- TABLE -->
                        <Table class="main-table" id="table-user">
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
                    <!-- FILTER AREA -->
                    <div class="display-flex p-2" style="width: 12rem; flex-direction: column">
                        <!-- SEARCH USER -->
                        <input type="text" id="search-inpt" class="input bg-teal text-light border-0" placeholder="Search name" onkeyup="searchMenu(event)" />
                        <!-- DROPDOWN FILTER -->
                        <div class="fltr-dropdown dropdown pt-1">
                            <button onclick="toggleDropdown('select_filter')" class="fltr-dropdown-btn dropdown-btn block py-1" style="font-size: 1rem">
                                Filter <span class="fa fa-caret-down ml-1"></span>
                            </button>
                            <div id="select_filter" class="dropdown-content fltr-dropdown-content">
                                <a onclick="searchFilterMenu('milk tea')">Milk Tea</a>
                                <a onclick="searchFilterMenu('coffee')">Coffee</a>
                                <a onclick="searchFilterMenu('Tea')">Tea</a>
                            </div>
                        </div>
                        <br>
                        <button class="search-btn mt-3" onclick="clearSearch()">clear</button>
                    </div>

                    
                </div>
                <!-- MANAGE BUTTON -->
                <div class="display-flex justify-content-center">
                    <div>
                        <button class="manage-btn">Add</button>
                    </div>
                    <div class="px-3">
                        <button class="manage-btn">Delete</button>
                    </div>
                    <div>
                        <button class="manage-btn">Edit</button>
                    </div>
                </div>
            </div>
        </div> 
    </div>
</div>

<?= $this::add_template('footer') ?>

<script type="text/javascript" defer>
    let menuList = [];
    let tableUser = document.getElementById('table-user');
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
            <button class="btn btn-warning">
                <span class="fa fa-pen"></span>
            </button>
            <button class="btn btn-danger">
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
</script>