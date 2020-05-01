<?= $this::add_template('header') ?>
<h1>Hello World</h1>
<p><?php echo $test?></p>
<?php
    foreach($all_user as $key => $value) {
        var_dump($value->get_id(), $value->get_nama(), $value->get_tipe(), $value->get_username());
    }
?>
<?= $this::add_template('footer') ?>