<div class="container-fluid">

    <?php 
        require_once VIEW_PATH . "templates/header.php";
    ?>


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
            </div>
        </div>

    </div>

</div>
