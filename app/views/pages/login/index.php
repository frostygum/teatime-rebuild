<div class="container display-grid align-content-center h-block">
    <div class="mt-1 login-title display-grid justify-content-center">
        <div class="login-logo display-grid grid-col-2 align-items-center p-1">
            <img src="<?= $this::add_image('logo', 'svg') ?>" />
            <h3>Teatime</h3>
        </div>
        <div class="login-subtitle">
            <span>a place where tea flies your time</span>
        </div>
    </div>
    <div class="display-grid justify-content-center grid-col-1">
        <div class="card bg-teal shadow text-light login-card py-4 px-2">
            <h5 class="text-center">Welcome Back!</h5>
            
            <form action="" class="px-4 pt-3">
                <div class="py-1">
                    <p class="text-bold mt-0">username</p>
                    <input class="input w-block border-0" type="text" placeholder="username">
                </div>
                <div class="py-1">
                    <p class="text-bold mt-0">password</p>
                    <input class="input w-block border-0" type="text" placeholder="password">
                </div>
                <div class="py-1 mt-3">
                    <input type="submit" class="btn btn-primary block bg-primary shadow py-1 text-bold" value="LOGIN" />
                </div>
            </form>
        </div>
    </div>
</div>