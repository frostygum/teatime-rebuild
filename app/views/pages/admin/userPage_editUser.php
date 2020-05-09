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
                <div class="display-flex" style="width:60%; height:100%; flex-direction: column;">
                    <!-- FORM CARD -->
                    <div class="card edit-card bg-teal display-flex" style="min-height: 20rem;">
                        <!-- PICTURE -->
                        <div class="user-image"></div>
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