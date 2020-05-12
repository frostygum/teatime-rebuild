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
                    <h5 class="ml-2">Checkout</h5>
                </div>
            </div>

            <!-- MENU LIST -->
            <div class="display-grid grid-gc-4 mt-3" style="height: 70vh; overflow-y: auto; grid-template-columns: repeat(auto-fit, minmax(25rem, 1fr));">
                <!-- TRANSACTION CARD -->
                <div class="card bg-dark text-light p-2">
                    <h5 class="text-center mb-3">Transaction</h5>

                    <div class="display-grid grid-col-3 justify-content-center" style="max-height: 35rem; overflow-y: auto">
                        <table id="transaction" class="table block text-center text-bold">
                            <thead>
                                <tr>
                                    <th>Qty</th>
                                    <th>Items</th>
                                    <th>price</th>
                                </tr>
                            </thead>

                            <tbody>

                            </tbody>
                        </table>
                    </div>

                </div>
                <!-- TOTAL CARD -->
                <div id="total" class="card bg-dark text-light p-2">
                    <div>
                        <h5 class="text-center">Total Payment</h5>
                        <div class="card bg-orange p-2 text-bold mt-2" style="width: 20rem; margin: auto">
                            <h6 id="total-price" class="text-center text-light"></h6>
                        </div>
                    </div>
                    <div class="mt-4">
                        <h5 class="text-center">Payment Method</h5>
                        <button id="btn-cash" class="btn bg-purple mt-2 px-3 py-1" style="width: 20rem; margin: auto; display: block">
                            <h6 class="text-center text-light">Confirm Payment</h6>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- MODAL -->
    <div id="modal-confirm" class="modal">
        <div class="modal-wrapper align-items-space-evenly">
            <div class="modal-body">
                <span class="fa fa-times custom-close" onclick="toggleModal('modal-confirm')"></span>
                
                <h5 class="text-center">Confirm Payment ? </h5>
                <div class="display-grid grid-col-2 grid-g-2 mt-4">
                    <button class="btn btn-danger"onclick="submitCheckout()">
                        <h6>Yes</h6>
                    </button>
                    <button class="btn btn-primary"onclick="toggleModal('modal-confirm')">
                        <h6>Cancel</h6>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- FORM CHECKOUT DONE -->
    <form id="trigger_checkout_done" action="./kasir" method="POST">
        <input type="hidden" name="checkout_done" value="true">
    </form>

</div>

<script type="text/javascript" defer>
    let selectedMenu = [];
    let totalPrice = 0;

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
    ?>

    let transactionWrapper = document.getElementById('transaction');
    let totalWrapper = document.getElementById('total');

    if(selectedMenu.length != 0) {
        for(let i = selectedMenu.length - 1; i >= 0; i--) {
            let currMenu = selectedMenu[i];

            let row = transactionWrapper.insertRow(1);

            let quantity = row.insertCell(0);
            let itemName = row.insertCell(1);
            let price = row.insertCell(2);

            quantity.textContent = "1";
            itemName.textContent = `(${currMenu.size.substring(0,1).toUpperCase()}) ${currMenu.name}`;
            itemName.classList.add("text-left");
            price.classList.add("text-left");

            if(currMenu.size.toLowerCase() == 'large') {
                totalPrice += parseInt(currMenu.price_l);
                price.textContent = formatter.format(currMenu.price_l)
            }
            else {
                totalPrice += parseInt(currMenu.price_r);
                price.textContent = formatter.format(currMenu.price_r)
            }

            if(currMenu.sugar) {
                let subRow = transactionWrapper.insertRow(2);

                let space = subRow.insertCell(0);
                let sugar = subRow.insertCell(1);
                let price = subRow.insertCell(2).textContent = "-";
                sugar.innerHTML = `${currMenu.sugar} sugar`;
                sugar.classList.add("text-left")
                sugar.classList.add("pl-4")
            }

            if(currMenu.ice) {
                let subRow = transactionWrapper.insertRow(3);

                let space = subRow.insertCell(0);
                let ice = subRow.insertCell(1);
                let price = subRow.insertCell(2).textContent = "-";
                ice.innerHTML = `${currMenu.ice} ice`;
                ice.classList.add("text-left")
                ice.classList.add("pl-4")
            }

            if(currMenu.topping) {
                for(let t = 0; t < currMenu.topping.length; t++) {
                    let subRow = transactionWrapper.insertRow(4);

                    let space = subRow.insertCell(0);
                    let topping = subRow.insertCell(1);
                    let price = subRow.insertCell(2);
                    topping.innerHTML = `<span class="fa fa-plus"></span> ${currMenu.topping[t].name}`;
                    totalPrice += parseInt(currMenu.topping[t].price);
                    price.textContent = formatter.format(currMenu.topping[t].price);
                    price.classList.add("text-left");
                    topping.classList.add("text-left")
                    topping.classList.add("pl-4")
                }
            }
        }

        document.getElementById('total-price').textContent = formatter.format(totalPrice);  

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
                // console.log(res);
                let result = JSON.parse(res);
                // console.log(result);
                if(result && result.text === "success") {
                    resolve(true);
                }
            })
            .catch(function(err) {
                reject(err);
            });
        });
    }

    function submitCheckout() {
        post({checkout: {
            total: totalPrice,
            order: selectedMenu
        }})
        .then(function(res) {
            toggleModal('modal-confirm');
            document.getElementById('trigger_checkout_done').submit();
        })
        .catch(function(err) {
            console.log(err);
        });
    }

    document.getElementById('btn-cash').addEventListener('click', function() {
        toggleModal('modal-confirm');
    });

</script>