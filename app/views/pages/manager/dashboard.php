<?= $this::add_template('header') ?>

<h1>Hello</h1>
<p>
    <?= $test ?>
</p>


<div class="container">
    
    <?= isset($user_information) ? $user_information['username'] : '' ?>
    <div class="card px-2 py-2 bg-teal text-light shadow" style="min-height: 10rem">
        <div class="card-body">
            isi
            <div class="side-navbar">
            <a href="" class="side-navbar-tab active">Dashboard</a>
            <a href="" class="side-navbar-tab">Data</a>
            <a href="" class="side-navbar-tab">Ranking</a>
            </div>
            <div class="card ">
            banyak transaksi harian 
            </div>
            <div class="card ">
            banyak pemasukan harian
            </div>
            <div class="card ">
            banyak cup terjual 
            </div>
        </div>
    </div>

</div>
<?= $this::add_template('footer') ?>