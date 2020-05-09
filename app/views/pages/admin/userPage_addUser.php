<div class="container-fluid">
    <?php 
        require_once VIEW_PATH . "templates/header.php"; 
    ?>

    <div class="container mt-4">
        <div class="card shadow display-flex" style="height: 70vh; overflow: hidden;">
            <!-- LEFT AREA / SIDE NAVIGATION BAR -->
            <div class="sidebar">
                <div class="sidebar-active p-2">
                    <h6>User</h6>
                </div>
                <div class="p-2">
                    <h6>Menu</h6>
                </div>
                <div class="p-2">
                    <h6>Toping</h6>
                </div>
            </div>
            <!-- RIGHT AREA -->
            <div class="display-flex p-2" style="width:90%">
                <!-- MAIN -->
                <div class="display-flex" style="width:80%; height:100%; flex-direction: column;">
                    <!-- FORM CARD -->
                    <div class="card edit-card bg-teal display-flex p-2" style="min-height: 18rem;">
                        <!-- PICTURE -->
                        <div class="edit-image"></div>
                        <!-- INPUT -->
                        <div class="text-light">
                            <div>
                                <span class="ml-1">Nama</span><span class="edit-input">:</span><input type="text" class="input edit-input"></input>
                            </div>
                            <div class="mt-1">
                                <span class="ml-1">Tipe</span><span class="edit-input">:</span>
                                <span class="fltr-dropdown pt-1 ml-1">
                                    <button class="fltr-dropdown-btn bg-light text-dark" style="font-size: 1rem; padding-top: 0.4rem; padding-bottom: 0.4rem">
                                        Tipe <span class="fa fa-caret-down ml-1"></span>
                                    </button>
                                    <span id="select_filter" class="fltr-dropdown-content">
                                        <a href="">Admin</a>
                                        <a href="">Manajer</a>
                                        <a href="">Kasir</a>
                                    </span>
                                </span>
                            </div>
                            <div class="mt-1">
                                <span class="ml-1">Username</span><span class="edit-input">:</span><input type="text" class="input edit-input"></input>
                            </div>
                            <div class="mt-1">
                                <span class="ml-1">Password</span><span class="edit-input">:</span><input type="password" class="input edit-input"></input>
                            </div>
                        </div>
                    </div>
                    <!-- Edit Button -->
                    <div class="edit-btn-area display-flex">
                        <div style="margin-left: auto; margin-right: 0;">
                            <button class="submit-btn">Submit</button>
                        </div>
                        <div style="margin-left: 1rem; margin-right: 0;">
                            <button class="cancel-btn">Cancel</button>
                        </div>
                    </div>
                </div>
                
            </div>
    </div>

</div>
<?= $this::add_template('footer') ?>