<div class="container-fluid">
    <?php 
        require_once VIEW_PATH . "templates/header.php"; 
    ?>

    <div class="card px-2 py-2 bg-teal text-light shadow">
        <div class="display-flex" display:>
            <div class="left">
                <ul class="side-bar">
                    <li>User</li>
                    <li>Menu</li>
                    <li>Toping</li>
                </ul>
            </div>
            <div class="main">
                <Table class="table">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Tipe</th>
                        <th>username</th>
                    </tr>
                    <?php
                        $i = 1;
                        foreach ($all_user as $key => $row) {
                            echo "<tr>";
                            echo "<th>".$i."</th>";
                            echo "<th>".$row->get_nama()."</th>";
                            echo "<th>".$row->get_tipe()."</th>";
                            echo "<th>".$row->get_username()."</th>";
                            echo "</tr>";

                            $i++;
                        }
                    ?>
                </Table>
            </div>
    </div>

    <?= $this::add_template('footer') ?>
</div>