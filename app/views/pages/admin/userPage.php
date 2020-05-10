<div class="container-fluid">
    <?php 
        require_once VIEW_PATH . "templates/header.php"; 
    ?>

    <div class="container mt-4">
        <div class="card shadow display-flex" style="height: 70vh; overflow: hidden;">
            <!-- LEFT AREA / SIDE NAVIGATION BAR -->
            <div class="sidebar">
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
            <div class="display-flex p-2" style="width:90%">
                <!-- MAIN AREA -->
                <div class="display-flex justify-content-center" style="width:65%; height:100%; flex-direction: column;">
                    <!-- TABLE AREA -->
                    <div class="display-flex justify-content-center" style="height:75%;">
                        <!-- TABLE -->
                        <Table class="main-table ml-4">
                            <tr class="main-table-header-row">
                                <th>No</th>
                                <th style="min-width: 19rem">Nama</th>
                                <th>Tipe</th>
                            </tr>
                            <?php
                                $i = 1;
                                foreach ($all_user as $key => $row) {
                                    echo "<tr class='main-table-data-row'>";
                                    echo "<td>".$i."</td>";
                                    echo "<td>".$row->get_nama()."</td>";
                                    echo "<td>".$row->get_tipe()."</td>";
                                    echo "</tr>";

                                    $i++;
                                }
                            ?>
                        </Table>
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
                <!-- FILTER AREA -->
                <div class="ml-4 mt-4">
                    <!-- SEARCH USER -->
                    <input type="text" onclick="toggleDropdown('select_filter')" class="input bg-teal text-light border-0" style="min-width: 15rem;" placeholder="Search name" />
                    <!-- DROPDOWN TIPE -->
                    <div class="fltr-dropdown pt-1">
                        <button class="fltr-dropdown-btn py-1" style="font-size: 1rem">
                            Tipe <span class="fa fa-caret-down ml-1"></span>
                        </button>
                        <div id="select_filter" class="fltr-dropdown-content">
                            <a href="">Admin</a>
                            <a href="">Manajer</a>
                            <a href="">Kasir</a>
                        </div>
                    </div>
                    <br>
                    <button class="search-btn">Search</button>
                </div>
                
            </div>
    </div>

</div>
<?= $this::add_template('footer') ?>