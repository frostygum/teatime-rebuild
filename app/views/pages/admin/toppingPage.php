<div class="container-fluid">
    <?php 
        require_once VIEW_PATH . "templates/header.php"; 
    ?>

    <div class="container mt-4">
        <div class="card shadow display-flex" style="height: 70vh; overflow: hidden;">
            <!-- LEFT AREA / SIDE NAVIGATION BAR -->
            <div class="sidebar">
                <div class="p-2">
                    <h6>User</h6>
                </div>
                <div class="p-2">
                    <h6>Menu</h6>
                </div>
                <div class="sidebar-active p-2">
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
                                <th style="min-width: 19rem">Toping</th>
                                <th>Harga</th>
                            </tr>
                            <?php
                                $i = 1;
                                foreach ($all_topping as $key => $row) {
                                    echo "<tr class='main-table-data-row'>";
                                    echo "<td class='justify-content-center align-items-center'>".$i."</td>";
                                    echo "<td>".$row->get_nama()."</td>";
                                    echo "<td>".$row->get_harga()."</td>";
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
                    <input type="text" class="input mt-1 bg-teal text-light border-0" style="min-width: 15rem;" placeholder="From price" />
                    <input type="text" class="input mt-1 bg-teal text-light border-0" style="min-width: 15rem;" placeholder="To price" />
                    <br>
                    <button class="search-btn mt-2">Search</button>
                </div>
                
            </div>
    </div>

</div>
<?= $this::add_template('footer') ?>