<div class="navbar bg-teal shadow display-grid grid-col-3 align-content-center justify-content-between px-2">
    <div class="navbar-left">
        <div class="logo display-grid grid-col-2 justify-content-between align-items-center cursor-pointer" onclick="window.location = '<?= BASE_PAGE ?>'">
            <img src="<?= $this::add_image('logo', 'svg') ?>" />
            <h5 class="logo-title">Teatime</h5>
        </div>
    </div>
    
    <div class="navbar-content">
        <span class="fab fa-facebook-f mx-2"></span>
        <span class="fab fa-twitter mx-2"></span>
    </div>

    <div class="navbar-right grid-col-2 display-grid align-content-center justify-content-end">
        <a style="text-decoration: none" class="mx-2 text-light text-bold" href="./about">About</a>
        <a style="text-decoration: none" class="mx-2 text-light text-bold" href="./login">Login</a>
    </div> 
</div>