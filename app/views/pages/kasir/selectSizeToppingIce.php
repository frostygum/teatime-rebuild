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
                    <h5 class="ml-2">Current Selection</h5>
                    <!-- SELECT FOR SELECTED MENU -->
                    <div class="custom-select text-bold ml-2" style="width: 22rem;" onclick="handleSelectedMenu()">
                        <select id="sel-menu" >
                        </select>
                    </div>

                </div>
                <div class="display-flex align-items-center">
                    <!-- BUTTON NEXT -->
                    <button id="btn_submit_menu" class="btn btn-warning py-2 shadow ml-2">
                        <span class="fa fa-arrow-right"></span>
                    </button>
                </div>
            </div>

            <!-- MENU LIST -->
            <div class="display-grid grid-g-2 align-content-start mt-3" style="height: 70vh; overflow-y: auto; grid-template-columns: repeat(auto-fit, minmax(30rem, 1fr));">
                <div class="display-grid grid-gr-2">
                    <div class="card bg-dark text-light m-0 p-2">
                        <h6 class="text-center">Select Size</h6>
                        <div class="display-grid grid-gc-2 mt-4 grid-col-2 justify-content-center">
                            <div class="custom-radio text-bold">
                                <input type="radio" id="radio-size-1" value="regular" name="radio-size">
                                <label for="radio-size-1">Regular</label>
                                <span id="price-r" class="card m-0 bg-purple px-1 text-light">(IDR 25000)</span>
                            </div>
                            <div class="custom-radio text-bold">
                                <input type="radio" id="radio-size-2" value="large" name="radio-size">
                                <label for="radio-size-2">large</label>
                                <span id="price-l" class="card m-0 bg-purple px-1 text-light">(IDR 25000)</span>
                            </div>
                        </div>
                    </div>
                    <div class="card bg-dark text-light m-0 p-2">
                        <h6 class="text-center">Select Ice</h6>
                        <div class="display-grid grid-gc-2 mt-4" style="grid-template-columns: repeat(auto-fill, minmax(8rem, 1fr));">
                            <div class="custom-radio text-bold">
                                <input type="radio" id="radio-ice-1" value="none" name="radio-ice">
                                <label for="radio-ice-1">None</label>
                            </div>
                            <div class="custom-radio text-bold">
                                <input type="radio" id="radio-ice-2" value="less" name="radio-ice">
                                <label for="radio-ice-2">Less</label>
                            </div>
                            <div class="custom-radio text-bold">
                                <input type="radio" id="radio-ice-3" value="normal" name="radio-ice">
                                <label for="radio-ice-3">Normal</label>
                            </div>
                            <div class="custom-radio text-bold">
                                <input type="radio" id="radio-ice-4" value="extra" name="radio-ice">
                                <label for="radio-ice-4">Extra</label>
                            </div>
                        </div>
                    </div>
                    <div class="card bg-dark text-light m-0 p-2">
                        <h6 class="text-center">Select Sugar</h6>
                        <div class="display-grid grid-g-2 mt-4" style="grid-template-columns: repeat(auto-fill, minmax(8rem, 1fr));">
                            <div class="custom-radio text-bold">
                                <input type="radio" id="radio-sugar-1" value="none" name="radio-sugar">
                                <label for="radio-sugar-1">None</label>
                            </div>
                            <div class="custom-radio text-bold">
                                <input type="radio" id="radio-sugar-2" value="10%" name="radio-sugar">
                                <label for="radio-sugar-2">10%</label>
                            </div>
                            <div class="custom-radio text-bold">
                                <input type="radio" id="radio-sugar-3" value="30%" name="radio-sugar">
                                <label for="radio-sugar-3">30%</label>
                            </div>
                            <div class="custom-radio text-bold">
                                <input type="radio" id="radio-sugar-4" value="normal" name="radio-sugar">
                                <label for="radio-sugar-4">Normal</label>
                            </div>
                            <div class="custom-radio text-bold">
                                <input type="radio" id="radio-sugar-5" value="80%" name="radio-sugar">
                                <label for="radio-sugar-5">80%</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card bg-dark text-light m-0 p-2">
                    <h6 class="text-center">Select Topping</h6>
                    <div class="display-grid grid-col-1 grid-g-1 mt-4">

                        <?php 
                            if(isset($topping)) {
                                foreach($topping as $key => $value) {
                                    echo '
                                        <div>
                                            <div id="topping-'. $value->get_id() .'" class="custom-checkbox text-bold">
                                                <input type="checkbox" value="'. $value->get_id() .'" id="checkbox-topping-'. $value->get_id() .'" name="checkbox-topping">
                                                <label for="checkbox-topping-'. $value->get_id() .'">'. $value->get_nama() .'</label>
                                            </div>
                                        </div>
                                    ';
                                }
                            }
                        ?>

                    </div>
                </div>
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
        <input type="hidden" name="set_page" value="3">
    </form>

</div>

<script defer>
    let selectedMenu = [];
    let dataTopping = [];

    let formatter = new Intl.NumberFormat('en-IN', {
        style: 'currency',
        currency: 'IDR',
        maximumSignificantDigits: 3
    });

    <?php 
        if(isset($selected_menu)) {
            echo '
                selectedMenu = '. $selected_menu .'
            ';
        }

        if(isset($topping)) {
            foreach($topping as $key => $value) {
                echo '
                    dataTopping.push({
                        id: '. $value->get_id() .',
                        name: "'. $value->get_nama() .'",
                        price: '. $value->get_harga() .',
                    })
                ';
            }
        }
    ?>

    for(let i = 0; i < dataTopping.length; i++) {
        let topping = dataTopping[i];
        let curr = document.getElementById(`topping-${topping.id}`);

        let span = document.createElement('span');
        span.textContent = `(${formatter.format(topping.price)})`;
        span.className = "card bg-warning m-0 px-1 ml-4 text-light";
        curr.appendChild(span);
    }

    let selectMenu = document.getElementById('sel-menu');
    
    if(selectedMenu.length != 0) {
        for(let i = 0; i < selectedMenu.length; i++) {
            let currSelected = selectedMenu[i];
            let opt = document.createElement('option');
            opt.value = `${currSelected.id}-${currSelected.pos}`;
            opt.textContent = currSelected.name + ` (${currSelected.pos})`;
            selectMenu.appendChild(opt);
        }
    }
    else {
        let opt = document.createElement('option');
        opt.textContent = 'no menu selected';
        selectMenu.appendChild(opt);
    }

    let currentMenu = 0;

    let btn = document.getElementById('btn_submit_menu');
    let menu = document.getElementById('sel-menu');
    
    let radiosId = [
        'radio-size',
        'radio-ice',
        'radio-sugar',
        'checkbox-topping'
    ];


    function fillOptions(obj) {
        let currSelected = selectedMenu[currentMenu];
    
        if(obj[0].name == 'radio-size') {
            for(let i = 0; i < obj.length; i++) {
                let curr = obj[i];

                document.getElementById('price-r').textContent = `(${formatter.format(currSelected.price_r)})`;
                document.getElementById('price-l').textContent = `(${formatter.format(currSelected.price_l)})`;

                if(curr.value == currSelected.size) {
                    curr.checked = true;
                }
                else {
                    curr.checked = false;
                }
            }
        }
        else if (obj[0].name == 'radio-ice') {
            for(let i = 0; i < obj.length; i++) {
                let curr = obj[i];
                if(curr.value == currSelected.ice) {
                    curr.checked = true;
                }
                else {
                    curr.checked = false;
                }
            }
        }
        else if (obj[0].name == 'radio-sugar') {
            for(let i = 0; i < obj.length; i++) {
                let curr = obj[i];
                if(curr.value == currSelected.sugar) {
                    curr.checked = true;
                }
                else {
                    curr.checked = false;
                }
            }
        }
        else if (obj[0].name == 'checkbox-topping') {
            for(let i = 0; i < obj.length; i++) {
                let curr = obj[i];
                if(currSelected.topping) {
                    for(let j = 0; j < currSelected.topping.length; j++) {
                        if(curr.value == currSelected.topping[j].id) {
                            curr.checked = true;
                            break;
                        }
                        else {
                            curr.checked = false;
                        }
                    }
                }   
                else {
                    curr.checked = false;
                }
            }
        }
       
    }

    function searchTopping(id) {
        for(let i = 0; i < dataTopping.length; i++) {
            if(dataTopping[i].id == id) {
                return i;
            }
        }
    }

    for(let i = 0; i < radiosId.length; i++) {
        let currRadio = document.getElementsByName(radiosId[i]);
        fillOptions(currRadio);

        for (let j = 0; j < currRadio.length; j++) {
            currRadio[j].addEventListener('change', function() {
                switch(radiosId[i]) {
                    case 'radio-size':
                        selectedMenu[currentMenu].size = this.value;
                    break;
                    case 'radio-ice':
                        selectedMenu[currentMenu].ice = this.value;
                    break;
                    case 'radio-sugar':
                        selectedMenu[currentMenu].sugar = this.value;
                    break;
                    case 'checkbox-topping':
                        let arr = [];
                        for (let i = 0; i < currRadio.length; i++) {
                            if (currRadio[i].checked) {
                                let id = searchTopping(currRadio[i].value);
                                arr.push(dataTopping[id]);
                            }
                        }
                        selectedMenu[currentMenu].topping = arr;
                    break;
                }
            });
        }
    }

    function handleSelectedMenu() {
        let found = false;
        let pos = 0;
        let arrDataLocMenu = menu.value.split("-")
        let menuId = arrDataLocMenu[0];
        let menuKe = arrDataLocMenu[1];

        for(let i = 0; i < selectedMenu.length; i++) {
            if (selectedMenu[i].id == menuId && selectedMenu[i].pos == menuKe) {
                found = true;
                pos = i;
                break;
            }
        }

        if(found) {
            currentMenu = pos;
        }

        for(let i = 0; i < radiosId.length; i++) {
            let currRadio = document.getElementsByName(radiosId[i]);
            fillOptions(currRadio);
        }
    }

    function validateInput() {
        let isValidated = true;
        for(let i = 0; i < selectedMenu.length; i++) {
            let currSel = selectedMenu[i];

            if(!currSel.size) {
                isValidated = false
            }

            if(!currSel.ice) {
                isValidated = false
            }

            if(!currSel.sugar) {
                isValidated = false
                break;
            }
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
        });
    }

    function toggleErrorAlert(alertId, alertMsg) {
        document.getElementById('alert-error-msg').textContent = alertMsg;
        toggleAlert(alertId);
    }

    btn.addEventListener('click', function() {
        if(validateInput()) {
            post({menu: selectedMenu});
            console.log("sent")
        }
        else {
            toggleErrorAlert('alert-error', 'size or ice or sugar input missing')
        }
    });

    
</script>