<div class="container-fluid">

    <?php 
        require_once VIEW_PATH . "templates/header.php";
    ?>

    <div class="card px-2 py-2 bg-teal text-light shadow mt-4">
        <div class="card-body px-2">
            <!-- CONTENT HEADER -->
            <div class="display-flex align-items-center justify-content-space-between">
                <div class="display-flex align-items-center">
                    <!-- BUTTON GO BACK -->
                    <form method="post" action="./kasir" class="m-0">
                        <input type="hidden" name="back" />
                        <button class="btn btn-warning py-2 shadow">
                            <span class="fa fa-arrow-left"></span>
                        </button>
                    </form>
                    <h5 class="ml-2">Drinks Selection</h5>
                </div>
                <div class="display-flex align-items-center">
                    <!-- DROPDOWN FILTER -->
                    <div class="dropdown">
                        <button onclick="toggleDropdown('select_filter')" class="dropdown-btn py-1" style="font-size: 1rem">
                            Filter <span class="fa fa-caret-down ml-1"></span>
                        </button>
                        <div id="select_filter" class="dropdown-content">
                            <a onclick="searchFilter('smoothies')">smoothies</a>
                            <a onclick="searchFilter('milk tea')">milk tea</a>
                            <a onclick="searchFilter('coffee')">coffee</a>
                        </div>
                    </div>
                    <input type="text" class="input text-bold border-0 ml-2" placeholder="search drinks" onkeyup="searchDrinks(event)" />
                    <!-- BUTTON NEXT -->
                    <button id="btn_submit_menu" class="btn btn-warning py-2 shadow ml-2">
                        <span class="fa fa-arrow-right"></span>
                    </button>
                </div>
            </div>

            <!-- MENU LIST -->
            <div id="menu-wrapper" class="display-grid grid-g-2 align-content-start mt-3" style="height: 70vh; overflow-y: auto; grid-template-columns: repeat(auto-fill, minmax(20rem, 1fr));">
                
            </div>
        </div>
    </div>
    
    <!-- MODAL -->
    <div id="modal-quantity" class="modal">
        <div class="modal-wrapper align-items-space-evenly">
            <div class="modal-body">
                <span class="fa fa-times custom-close" onclick="toggleModal('modal-quantity')"></span>
                <p class="text-bold">Signature Milk Tea</p>
                <div class="display-grid grid-col-3 align-items-center py-2 px-3">
                    <span class="text-bold">Qty :</span>
                    <h2 class="text-center">01</h2>
                    <div class="display-grid grid-col-1 justify-content-end">
                        <button class="btn btn-dark" style="border-radius: var(--border-radius) var(--border-radius) 0 0">
                            <span class="fa fa-angle-up"></span>
                        </button>
                        <button class="btn btn-dark" style="border-radius: 0 0 var(--border-radius) var(--border-radius)">
                            <span class="fa fa-angle-down"></span>
                        </button>
                    </div>
                </div>
                <button class="btn btn-dark block">ok</button>
            </div>
        </div>
    </div>

    <!-- ERROR ALERT -->
    <div class='alert'>
        <div id='alert-error' class='alert-content'>
            <div class='alert-icon'>  
                <span class='fa fa-exclamation-triangle'></span>
            </div>
            <div id="alert-error-msg" class='alert-text'>
                error
            </div>
            <button class='alert-close' onclick='toggleAlert(`alert`)'>
                <span class='fa fa-times-circle'></span>
            </button>
        </div>
    </div>

    <!-- FORM NEXT PAGE -->
    <form id="trigger_next_page" action="./kasir" method="POST">
        <input type="hidden" name="set_page" value="2">
    </form>
</div>

<script type="text/javascript" defer>

    let formatter = new Intl.NumberFormat('en-IN', {
        style: 'currency',
        currency: 'IDR',
        maximumSignificantDigits: 3
    });

    let allMenu = [];

    <?php 
        if(isset($menu)) {
            foreach($menu as $key => $value) {
                echo '
                    allMenu.push({
                        id: '. $value->get_id() .',
                        name: "'. $value->get_nama() .'",
                        price_r: '. $value->get_hargaR() .',
                        price_l: '. $value->get_hargaL() .',
                    });
                ';
            }
        }
    ?>

    function toggleModalMenu(menu, id, reg, lar) {
        let found = false;
        let pos = 0;
        for(var i = 0; i < selectedMenu.length; i++) {
            if (selectedMenu[i].name == menu) {
                found = true;
                pos = i;
                break;
            }
        }

        if(!found) {
            selectedMenu.push({
                id: id,
                name: menu,
                price_r: reg,
                price_l: lar
            });
        }
        else {
            selectedMenu.splice(pos, 1);
        }

        document.getElementById(`menu-${id}`).classList.toggle('selected');

        console.log(selectedMenu);
    }

    let menuWrapper = document.getElementById('menu-wrapper');

    function appendMenuItem(menuData) {
        let wrapper = document.createElement('div');
        wrapper.id = `menu-${menuData.id}`;
        wrapper.className = 'card menu py-1 px-2 m-0';
        wrapper.onclick = () => toggleModalMenu(menuData.name, menuData.id, menuData.price_r, menuData.price_l);

        let title = document.createElement('div');
        title.className = "menu-title";
        let p = document.createElement('p');
        p.textContent = menuData.name;
        title.appendChild(p);

            let menu = document.createElement('div');
            menu.className = "menu-content";

                let item = document.createElement('div');
                item.className = "py-2";
                
                let size = document.createElement('span');
                size.className = "badge bg-warning text-bold text-light";

                let price = document.createElement('span');
                price.className = "text-bold ml-1";

                size.textContent = 'R';
                price.textContent = formatter.format(menuData.price_r);

                item.appendChild(size);
                item.appendChild(price);
                menu.appendChild(item);

                item = document.createElement('div');
                item.className = "py-2";
                
                size = document.createElement('span');
                size.className = "badge bg-danger text-bold text-light";

                price = document.createElement('span');
                price.className = "text-bold ml-1";

                size.textContent = 'L';
                price.textContent = formatter.format(menuData.price_l);

                item.appendChild(size);
                item.appendChild(price);
                menu.appendChild(item);

        wrapper.appendChild(title);
        wrapper.appendChild(menu);

        menuWrapper.appendChild(wrapper);
    }

    for(let i = 0; i < allMenu.length; i++) {
        appendMenuItem(allMenu[i]);
    }

    let selectedMenu = [];

    <?php 
        if(isset($selected_menu)) {
            echo '
                selectedMenu = '. $selected_menu .'
            ';
        }
    ?>

    if(selectedMenu.length != 0) {
        for(let i = 0; i < selectedMenu.length; i++) {
            let currMenu = selectedMenu[i];
            document.getElementById(`menu-${currMenu.id}`).classList.toggle('selected');
        }
    }
    
    function validateInput() {
        let isValidated = true;
        
        if(selectedMenu.length == 0) {
            isValidated = false;
        }

        return isValidated;
    }

    function post(data) {
        return new Promise((resolve, reject) => {
            fetch('kasir', {
                method: 'post',
                headers: {
                    'content-type': 'application/x-www-form-urlencoded'
                },
                body: JSON.stringify(data)
            })
            .then(function(res) {
                return res.text();
            })
            .then(function(res) {
                let result = JSON.parse(res);
                if(result && result.text === "success") {
                    document.getElementById('trigger_next_page').submit();
                }
            })
            .catch(function(err) {
                reject(err);
            });
        })
    }

    function toggleErrorAlert(alertId, alertMsg) {
        document.getElementById('alert-error-msg').textContent = alertMsg;
        toggleAlert(alertId);
    }


    document.getElementById('btn_submit_menu').addEventListener('click', function() {
        if(validateInput()) {
            post({menu: selectedMenu});
            console.log("sent")
        }
        else {
            toggleErrorAlert('alert-error', 'please select min 1 menu')
        }
    });

    function searchDrinks(e) {
        let searchVal = e.target.value;
        for(let i = 0; i < allMenu.length; i++) {
            let curr = allMenu[i];
            let currItem = document.getElementById(`menu-${curr.id}`);
            
            if(curr.name.toLowerCase().indexOf(searchVal) > -1) {
                currItem.style.display = ''; 
            }
            else {
                currItem.style.display = 'none';
            }
        }
    }

    function searchFilter(value) {
        let searchVal = value;
        for(let i = 0; i < allMenu.length; i++) {
            let curr = allMenu[i];
            let currItem = document.getElementById(`menu-${curr.id}`);
            
            if(curr.name.toLowerCase().indexOf(searchVal) > -1) {
                currItem.style.display = ''; 
            }
            else {
                currItem.style.display = 'none';
            }
        }
    }

</script>