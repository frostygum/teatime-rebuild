<div class="container-fluid">
    <?php 
        require_once VIEW_PATH . "templates/header.php"; 
    ?>

    <div class="container mt-4">
        <div class="card shadow display-grid grid-col-2" style="height: 80vh; overflow: hidden;">
            <!-- LEFT AREA / SIDE NAVIGATION BAR -->
            <div class="sidebar" style="width: 15rem">
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
            <div class="display-grid my-4 mx-2">
                <div class="display-grid grid-col-1 align-content-start">
                    <!-- MAIN AREA -->
                    <div class="display-grid p-2 grid-col-2 justify-content-space-between">
                        <div>
                            <!-- SEARCH USER -->
                            <input type="text" id="search-inpt" class="input bg-teal text-light border-0" placeholder="Search name" onkeyup="searchUser(event)" />
                            <!-- DROPDOWN FILTER -->
                            <div class="fltr-dropdown dropdown">
                                <button onclick="toggleDropdown('select_filter')" class="fltr-dropdown-btn dropdown-btn block py-1" style="font-size: 1rem">
                                    Filter <span class="fa fa-caret-down ml-1"></span>
                                </button>
                                <div id="select_filter" class="dropdown-content fltr-dropdown-content">
                                    <a onclick="searchFilterUser('admin')">Admin</a>
                                    <a onclick="searchFilterUser('manager')">Manajer</a>
                                    <a onclick="searchFilterUser('kasir')">Kasir</a>
                                </div>
                            </div>
                            <button class="search-btn" onclick="clearSearch()">clear</button>
                        </div>
                        <div>
                            <button class="manage-btn" onclick="toggleModal('modal-add')">
                                Add
                            </button>
                        </div>
                    </div>
                    <div class="display-flex justify-content-start p-2" style="max-width: 55rem; overflow: auto;">
                        <!-- TABLE -->
                        <table class="main-table" id="table-menu">
                            <thead>
                                <tr class="main-table-header-row">
                                    <th class="p-1">No</th>
                                    <th class="p-1" style="min-width: 10rem">Username</th>
                                    <th class="p-1" style="min-width: 10rem">Nama</th>
                                    <th class="p-1">Tipe</th>
                                    <th class="p-1">last login</th>
                                    <th class="p-1">status</th>
                                    <th class="p-1" style="min-width: 10rem">action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
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
            
            <h5 class="text-center">Edit User</h5>
            
            <form method="POST" action="./admin?page=user" id="form-edit">
                <input type="hidden" name="command" value="edit-user">
                <input type="hidden" name="id" value="">
                <div class="display-grid grid-g-2 mt-4">
                    <div>
                        <p class="text-bold m-0">Nama Pengguna</p>
                        <input class="input block" type="text" name="name" placeholder="nama lengkap">
                    </div>
                    <div>
                        <p class="text-bold m-0">Username</p>
                        <input class="input block" type="text" name="username" placeholder="username">
                    </div>
                    <div>
                        <p class="text-bold m-0">Pilih Role</p>
                        <div class="custom-select text-bold" style="border: 2px solid var(--light-darker); border-radius: var(--border-radius)">
                            <select name="role">
                                <option value="">--select role--</option>
                                <option value="kasir">Kasir</option>
                                <option value="admin">Admin</option>
                                <option value="manager">Manager</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <p class="text-bold mt-0">Password</p>
                        <input class="input block" type="password" name="password" placeholder="password">
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
            
            <h5 class="text-center">Add User</h5>
            
            <form method="POST" action="./admin?page=user">
                <input type="hidden" name="command" value="add-user">
                <div class="display-grid grid-g-2 mt-4">
                    <div>
                        <p class="text-bold m-0">Nama Pengguna</p>
                        <input class="input block" type="text" name="name" placeholder="nama lengkap">
                    </div>
                    <div>
                        <p class="text-bold m-0">Username</p>
                        <input class="input block" type="text" name="username" placeholder="username">
                    </div>
                    <div>
                        <p class="text-bold m-0">Pilih Role</p>
                        <div class="custom-select text-bold" style="border: 2px solid var(--light-darker); border-radius: var(--border-radius)">
                            <select name="role">
                                <option value="">--select role--</option>
                                <option value="kasir">Kasir</option>
                                <option value="admin">Admin</option>
                                <option value="manager">Manager</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <p class="text-bold mt-0">Password</p>
                        <input class="input block" type="password" name="password" placeholder="password">
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
            
            <h5 class="text-center">Delete User ?</h5>
            
            <form method="POST" action="./admin?page=user" id="form-delete">
                <input type="hidden" name="command" value="delete-user">
                <input type="hidden" name="id" value="">
                <input type="hidden" name="username" value="">
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
        let status = row.insertCell(5);
        let action = row.insertCell(6);

        number.textContent = i + 1;
        number.className = "text-center text-dark p-1";
        username.textContent = user.username;
        username.className = "text-dark p-1";
        name.textContent = user.name;
        name.className = "text-dark p-1";
        tipe.textContent = user.tipe;
        tipe.className = "text-dark p-1";
        if(user.last_login == "") {
            last_login.textContent = "-";
            last_login.className = "text-dark text-center p-1";
            status.textContent = "inActive";
            status.className = "bg-danger text-light"
            status.style
        }
        else {
            last_login.textContent = user.last_login;
            last_login.className = "text-dark p-1";
            status.textContent = "active";
            status.className = "bg-success text-light"
        }
        action.className = "text-center";
        action.innerHTML = `
            <button class="btn btn-warning" onclick="toggleModalEdit(${user.id})">
                <span class="fa fa-pen"></span>
            </button>
            <button class="btn btn-danger" onclick="toggleModalDelete(${user.id})">
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
            
            if(curr.tipe.toLowerCase().indexOf(searchVal) > -1) {
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

    function searchUserById(id) {
        for(let i = 0; i < userList.length; i++) {
            if(userList[i].id == id) {
                return userList[i];
            }
        }
    }

    function toggleModalEdit(userId) {
        let user = searchUserById(userId);
        let form = document.getElementById('form-edit');
        let formElements = form.elements;

        form.id.value = user.id;
        form.name.value = user.name;
        form.username.value = user.username;
        form.role.checked = user.tipe;

        toggleModal('modal-edit');
    }

    function toggleModalDelete(userId) {
        let user = searchUserById(userId);
        let form = document.getElementById('form-delete');
        let formElements = form.elements;

        form.id.value = user.id;
        form.username.value = user.username;

        toggleModal('modal-delete');
    }
</script>