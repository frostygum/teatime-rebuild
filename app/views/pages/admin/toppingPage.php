<div class="container-fluid">
    <?php 
        require_once VIEW_PATH . "templates/header.php"; 
    ?>

    <div class="container mt-4">
        <div class="card shadow display-grid" style="height: 80vh; overflow: hidden; grid-template-columns: 15rem auto">
            <!-- LEFT AREA / SIDE NAVIGATION BAR -->
            <div class="sidebar" style="width: 15rem">
                <div class="p-2 cursor-pointer" onclick="window.location = './admin?page=user'">
                    <h6>User</h6>
                </div>
                <div class="p-2 cursor-pointer" onclick="window.location = './admin?page=menu'">
                    <h6>Menu</h6>
                </div>
                <div class="sidebar-active p-2 cursor-pointer" onclick="window.location = './admin?page=toping'">
                    <h6>Toping</h6>
                </div>
            </div>
            <!-- RIGHT AREA -->
            <div class="display-grid my-4 mx-2">
                <div class="display-grid grid-col-1  grid-g-4 align-content-start">
                    <!-- MAIN AREA -->
                    <div class="display-grid grid-col-2 justify-content-space-between">
                        <div>
                            <!-- SEARCH USER -->
                            <input type="text" id="search-inpt" class="input bg-teal text-light border-0" placeholder="Search name" onkeyup="searchTopping(event)" />
                            <!-- DROPDOWN FILTER -->
                            <div class="fltr-dropdown dropdown">
                                <button onclick="toggleDropdown('select_filter')" class="fltr-dropdown-btn dropdown-btn block py-1" style="font-size: 1rem">
                                    Filter <span class="fa fa-caret-down ml-1"></span>
                                </button>
                                <div id="select_filter" class="dropdown-content fltr-dropdown-content">
                                    <a onclick="searchFilterTopping('jelly')">Jelly</a>
                                </div>
                            </div>
                            <button class="search-btn" onclick="clearSearch()">clear</button>
                        </div>
                        <button class="manage-btn" onclick="toggleModal('modal-add')">
                            Add
                        </button>
                    </div>   

                    <div class="display-flex justify-content-start" style="width: 100%; max-height: 30rem; overflow: auto">
                        <!-- TABLE -->
                        <Table class="main-table" id="table-topping" style="width: 100%; height: 70%">
                            <thead>
                                <tr class="main-table-header-row">
                                    <th class="p-1">No</th>
                                    <th class="p-1" style="min-width: 22rem">Topping</th>
                                    <th class="p-1" style="min-width: 6rem">Harga</th>
                                    <th class="p-1" style="min-width: 10rem">Action</th>
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
            
            <form method="POST" action="./admin?page=toping" id="form-edit">
                <input type="hidden" name="command" value="edit-topping">
                <input type="hidden" name="id" value="">
                <div class="display-grid grid-g-2 mt-4">
                    <div>
                        <p class="text-bold m-0">Nama Toping</p>
                        <input class="input block" type="text" name="name" placeholder="nama toping">
                    </div>
                    <div>
                        <p class="text-bold m-0">Harga</p>
                        <input class="input block" type="text" name="harga" placeholder="harga toping">
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
            
            <h5 class="text-center">Add Toping</h5>
            
            <form method="POST" action="./admin?page=toping">
                <input type="hidden" name="command" value="add-topping">
                <div class="display-grid grid-g-2 mt-4">
                    <div>
                        <p class="text-bold m-0">Nama Toping <span class="text-danger">*</span></p>
                        <input class="input block" type="text" name="name" placeholder="nama toping">
                    </div>
                    <div>
                        <p class="text-bold m-0">Harga <span class="text-danger">*</span></p>
                        <input class="input block" type="text" name="harga" placeholder="harga toping" onfocusout="handle_add_digit(event)">
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
            
            <h5 class="text-center">Delete Toping ?</h5>
            
            <form method="POST" action="./admin?page=toping" id="form-delete">
                <input type="hidden" name="command" value="delete-topping">
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
    let toppingList = [];
    let tableUser = document.getElementById('table-topping');
    let formatter = new Intl.NumberFormat('en-IN', {
        style: 'currency',
        currency: 'IDR',
        maximumSignificantDigits: 3
    });
    
    <?php
        foreach ($all_topping as $key => $topping) {
            echo '
                toppingList.push({
                    id: '. $topping->get_id() .',
                    name: "'. $topping->get_nama() .'",
                    price: "'. $topping->get_harga() .'"
                });
            ';
        }
    ?>

    for(let i = toppingList.length - 1; i >= 0; i--) {
        let topping = toppingList[i];

        let row = tableUser.insertRow(1);
        row.id = `topping-${topping.id}`;
        row.className = "main-table-data-row";

        let number = row.insertCell(0)
        let name = row.insertCell(1);
        let price = row.insertCell(2);
        let action = row.insertCell(3);

        number.textContent = i + 1;
        number.className = "text-center text-dark p-1";
        name.textContent = topping.name;
        name.className = "text-dark p-1";
        price.textContent = formatter.format(topping.price);
        price.className = "text-center text-dark p-1";
        action.className = "text-center";
        action.innerHTML = `
            <button class="btn btn-warning" onclick="toggleModalEdit(${topping.id})">
                <span class="fa fa-pen"></span>
            </button>
            <button class="btn btn-danger" onclick="toggleModalDelete(${topping.id})">
                <span class="fa fa-trash"></span>
            </button>
        `;
    }

    function searchTopping(e) {
        let searchVal = e.target.value;
        for(let i = 0; i < toppingList.length; i++) {
            let curr = toppingList[i];
            let currItem = document.getElementById(`topping-${curr.id}`);
            
            if(curr.name.toLowerCase().indexOf(searchVal) > -1) {
                currItem.style.display = ''; 
            }
            else {
                currItem.style.display = 'none';
            }
        }
    }

    function searchFilterTopping(value) {
        let searchVal = value;
        for(let i = 0; i < toppingList.length; i++) {
            let curr = toppingList[i];
            let currItem = document.getElementById(`topping-${curr.id}`);
            
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
        searchFilterTopping('');
    }

    function searchTopingById(id) {
        for(let i = 0; i < toppingList.length; i++) {
            if(toppingList[i].id == id) {
                return toppingList[i];
            }
        }
    }

    function toggleModalEdit(toppingId) {
        let topping = searchTopingById(toppingId);
        let form = document.getElementById('form-edit');
        let formElements = form.elements;

        form.id.value = topping.id;
        form.name.value = topping.name;
        form.harga.value = topping.price;

        toggleModal('modal-edit');
    }

    function toggleModalDelete(toppingId) {
        let topping = searchTopingById(toppingId);
        let form = document.getElementById('form-delete');
        let formElements = form.elements;

        form.id.value = topping.id;

        toggleModal('modal-delete');
    }

    function handle_add_digit(event) {
        if(event.target.value.length <= 2) {
            event.target.value *= 1000;
        }
    }
</script>