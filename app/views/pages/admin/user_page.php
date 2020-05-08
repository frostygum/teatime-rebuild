<div class="container-fluid">
    <?= $this::add_template('header') ?>

    <div class="card px-2 py-2 bg-teal text-light shadow">
        <Table>
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

    <?= $this::add_template('footer') ?>
</div>