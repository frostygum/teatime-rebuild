<div class="container-fluid">
    <?php 
        require_once VIEW_PATH . "templates/header.php"; 
    ?>

    <div class="container mt-4">
        <div class="card shadow display-grid grid-col-2" style="height: 80vh; overflow: hidden;">
            <!-- LEFT AREA / SIDE NAVIGATION BAR -->
            <div class="sidebar" style="width: 10rem">
                <div class="sidebar-active p-2 cursor-pointer" onclick="window.location = './admin?page=user'">
                    <h6>User</h6>
                </div>
                <div class="p-2 cursor-pointer" onclick="window.location = './admin?page=menu'">
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
                        <table class="main-table" id="table-menu">
                            <thead>
                                <tr class="main-table-header-row">
                                    <th class="p-1">No</th>
                                    <th class="p-1" style="min-width: 10rem">Username</th>
                                    <th class="p-1" style="min-width: 10rem">Nama</th>
                                    <th class="p-1">Tipe</th>
                                    <th class="p-1">last_login</th>
                                    <th class="p-1" style="min-width: 10rem">action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <!-- FILTER AREA -->
                    <div class="display-flex p-2" style="width: 12rem; flex-direction: column">
                        <!-- SEARCH USER -->
                        <input type="text" id="search-inpt" class="input bg-teal text-light border-0" placeholder="Search name" onkeyup="searchUser(event)" />
                        <!-- DROPDOWN FILTER -->
                        <div class="fltr-dropdown dropdown pt-1">
                            <button onclick="toggleDropdown('select_filter')" class="fltr-dropdown-btn dropdown-btn block py-1" style="font-size: 1rem">
                                Filter <span class="fa fa-caret-down ml-1"></span>
                            </button>
                            <div id="select_filter" class="dropdown-content fltr-dropdown-content">
                                <a onclick="searchFilterUser('admin')">Admin</a>
                                <a onclick="searchFilterUser('manager')">Manajer</a>
                                <a onclick="searchFilterUser('kasir')">Kasir</a>
                            </div>
                        </div>
                        <br>
                        <button class="search-btn mt-3" onclick="clearSearch()">clear</button>
                        <button class="manage-btn p-1 mt-4">Add</button>
                    </div>
                </div>
            </div>
        </div> 
    </div>
</div>

<?= $this::add_template('footer') ?>

<script type="text/javascript" defer>
    let userList = [];
    let tableUser = document.getElementById('table-menu');

    <?php
        foreach ($all_user as $key => $user) {
            echo '
                userList.push({
                    id: '. $user->get_id() .',
                    name: "'. $user->get_nama() .'",
                    username: "'. $user->get_username() .'",
                    tipe: "'. $user->get_tipe() .'",
                    last_login: "'. $user->get_last_login() .'"
                });
            ';
        }
    ?>

    for(let i = userList.length - 1; i >= 0; i--) {
        let user = userList[i];

        let row = tableUser.insertRow(1);
        row.id = `user-${user.id}`;
        row.className = "main-table-data-row";

        let number = row.insertCell(0)
        let username = row.insertCell(1);
        let name = row.insertCell(2);
        let tipe = row.insertCell(3);
        let last_login = row.insertCell(4);
        let action = row.insertCell(5);

        number.textContent = i + 1;
        number.className = "text-center text-dark p-1";
        username.textContent = user.username;
        username.className = "text-dark p-1";
        name.textContent = user.name;
        name.className = "text-dark p-1";
        tipe.textContent = user.tipe;
        tipe.className = "text-dark p-1";
        last_login.textContent = user.last_login;
        last_login.className = "text-dark p-1";
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

    function searchUser(e) {
        let searchVal = e.target.value;
        for(let i = 0; i < userList.length; i++) {
            let curr = userList[i];
            let currItem = document.getElementById(`user-${curr.id}`);
            
            if(curr.name.toLowerCase().indexOf(searchVal) > -1) {
                currItem.style.display = ''; 
            }
            else {
                currItem.style.display = 'none';
            }
        }
    }

    function searchFilterUser(value) {
        let searchVal = value;
        for(let i = 0; i < userList.length; i++) {
            let curr = userList[i];
            let currItem = document.getElementById(`user-${curr.id}`);
            
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
        searchFilterUser('');
    }
</script>