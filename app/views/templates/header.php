<div class="navbar bg-teal shadow display-grid grid-col-3 align-content-center justify-content-between px-2">
    <div class="navbar-left">
        <div class="logo display-grid grid-col-2 justify-content-between align-items-center">
            <img src="<?= IMG_PATH . 'logo.svg' ?>" />
            <h5 class="logo-title">Teatime</h5>
        </div>
    </div>
    <div class="navbar-content">
        <h5>59:00</h5>
    </div>
    <div class="navbar-right display-grid align-content-center justify-content-end">
        <div class="dropdown">
            <button onclick="toggleDropdown('dropdown')" class="dropdown-btn">
                <?= isset($user_information) ? $user_information['username'] : 'dropdown' ?>
            </button>
            <div id="dropdown" class="dropdown-content">
                <a href="./logout">logout</a>
            </div>
        </div>
    </div> 
</div>