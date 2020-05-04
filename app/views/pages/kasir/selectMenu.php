<div class="container-fluid">

    <?php 
        require_once VIEW_PATH . "templates/header.php";
    ?>
    
    <div class="card px-2 py-2 bg-teal text-light shadow">
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
                <div>
                    <!-- DROPDOWN FILTER -->
                    <div class="dropdown">
                        <button onclick="toggleDropdown('select_filter')" class="dropdown-btn py-1" style="font-size: 1rem">
                            Filter <span class="fa fa-caret-down ml-1"></span>
                        </button>
                        <div id="select_filter" class="dropdown-content">
                            <a href="">smoothies</a>
                            <a href="">milk tea</a>
                            <a href="">coffee</a>
                        </div>
                    </div>
                    <input type="text" class="input text-bold border-0" placeholder="search drinks" />
                </div>
            </div>

            <?= isset($customer_name) ? $customer_name : 'no customer' ?>
            <!-- MENU LIST -->
            <div class="display-grid grid-col-4 grid-g-2">
                
                <div class="card menu selected py-1 px-2" onclick="toggleModal('modal-quantity')">
                    <div class="menu-title">
                        <p>Brown Sugar Milk Tea</p>
                    </div>
                    <div class="menu-content">
                        <div class="py-2">
                            <span class="badge bg-warning text-bold text-light">R</span>
                            <span class="text-bold">Rp25,000</span>
                        </div>
                        <div class="py-2">
                            <span class="badge bg-danger text-bold text-light">L</span>
                            <span class="text-bold" >Rp35,000</span>
                        </div>
                    </div>
                </div>

                <div class="card menu py-1 px-2">
                    <div class="menu-title">
                        <p>Brown Sugar Milk Tea</p>
                    </div>
                    <div class="menu-content">
                        <div class="py-2">
                            <span class="badge bg-warning text-bold text-light">R</span>
                            <span class="text-bold">Rp25,000</span>
                        </div>
                        <div class="py-2">
                            <span class="badge bg-danger text-bold text-light">L</span>
                            <span class="text-bold" >Rp35,000</span>
                        </div>
                    </div>
                </div>

                <div class="card menu py-1 px-2">
                    <div class="menu-title">
                        <p>Brown Sugar Milk Tea</p>
                    </div>
                    <div class="menu-content">
                        <div class="py-2">
                            <span class="badge bg-warning text-bold text-light">R</span>
                            <span class="text-bold">Rp25,000</span>
                        </div>
                        <div class="py-2">
                            <span class="badge bg-danger text-bold text-light">L</span>
                            <span class="text-bold" >Rp35,000</span>
                        </div>
                    </div>
                </div>

                <div class="card menu py-1 px-2">
                    <div class="menu-title">
                        <p>Brown Sugar Milk Tea</p>
                    </div>
                    <div class="menu-content">
                        <div class="py-2">
                            <span class="badge bg-warning text-bold text-light">R</span>
                            <span class="text-bold">Rp25,000</span>
                        </div>
                        <div class="py-2">
                            <span class="badge bg-danger text-bold text-light">L</span>
                            <span class="text-bold" >Rp35,000</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- MODAL -->
    <div id="modal-quantity" class="modal">
        <div class="modal-wrapper align-items-space-evenly">
            <div class="modal-body">
                <span class="fa fa-times custom-close" onclick="toggleModal('modal-quantity')"></span>
                <p class="text-bold">Signature Milk Tea</p>
                <div class="display-grid grid-col-3 align-items-center py-2 px-2">
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

</div>

<script type="text/javascript" defer>


</script>