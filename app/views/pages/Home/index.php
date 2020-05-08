<div class="container-fluid">

    <?php 
        require_once VIEW_PATH . "templates/menu.php";
    ?>

    <div class="container">

        <div class="section display-grid align-items-start justify-content-center card bg-teal shadow text-light mt-4">
            <div class="display-grid justify-content-center p-2 mb-3">
                <img src="<?= $this::add_image('undraw_street_food', 'svg') ?>" style="width: 40rem; height: auto" />
            </div>
            <div>
                <h3 class="text-center p-2 mb-3">
                    MILKY, FRUITY, FROZEN, OR LIGHTLY SPARKLED WE’VE GOT YOU COVERED.
                </h3>
            </div>
            <div class="display-grid grid-col-3 grid-g-2 justify-content-center mb-3">
                <div class="bg-orange circle display-flex justify-content-center align-items-center shadow text-bold" style="width: 7rem; height: 7rem">
                    <h6>Milky</h6>
                </div>
                <div class="bg-purple circle display-flex justify-content-center align-items-center shadow text-bold" style="width: 7rem; height: 7rem">
                    <h6>Fruity</h6>
                </div>
                <div class="bg-warning circle display-flex justify-content-center align-items-center shadow text-bold" style="width: 7rem; height: 7rem">
                    <h6>Lightly</h6>
                </div>
            </div>
            <div class="px-4 text-bold">
                <p class="mt-4 px-4">
                    In 2018, Gerald founded the very first TeaTime in Bandung, with a commitment to quality ingredients and mix-ins 
                    and a flare for innovative flavour combinations, he set out to brew nothing but the most best iced teas.
                </p>

                <p class="mt-2 px-4">
                    Today, Teatime is the fastest growing iced tea franchise in Indonesia. There are over 120 Teatime T-Breweries – all 
                    in just 2 years. That means even more Indonesian get the chance to try our fabulous and flavour-some creations.
                </p>
            </div>
        </div>

        <div class="section display-flex align-items-center card bg-teal shadow text-light mt-4">
            <div class="p-2" style="width: 24rem">
                <img src="<?= $this::add_image('undraw_beverage', 'svg') ?>" style="width: 24rem; height: auto" />
            </div>
            <div class="p-2" style="width: 100%">
                <div class="card bg-dark text-light p-2">
                    <h4 class="text-center mb-2">Our Top 5 Menu</h4>
                    <div class="px-4 pb-3">
                        <ol>
                            <li><h6 class="m-0 p-0 text-warning">Brown Milk Tea</h6></li>
                            <li>Roasted Milk Tea</li>
                            <li>mango Green Tea</li>
                            <li>Black Tea Mousse</li>
                            <li>Hawaii Fruit Tea</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="section display-flex align-items-center card bg-teal shadow text-light mt-4">
            <div class="p-2" style="width: 100%">
                <div class="card bg-dark text-light p-2">
                    <h4 class="text-center mb-2">Our Top 5 Selected Topping</h4>
                    <div class="px-4 pb-3">
                        <ol>
                            <li><h6 class="m-0 p-0 text-warning">Pearl</h6></li>
                            <li>Coffee Jelly</li>
                            <li>Coconut Jelly</li>
                            <li>Red Beans</li>
                            <li>Pudding</li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="p-2" style="width: 24rem">
                <img src="<?= $this::add_image('undraw_topping', 'svg') ?>" style="width: 24rem; height: auto" />
            </div>
        </div>

        <div class="section display-flex align-items-center justify-content-center card bg-teal shadow text-light mt-4">
            <div class="display-grid justify-content-center">
                <div class="display-grid grid-col-2 align-items-center justify-content-center p-1">
                    <img src="<?= $this::add_image('logo', 'svg') ?>" style="width: 5rem; height: auto" />
                    <h1 class="ml-3">Teatime</h1>
                </div>
                <div class="login-subtitle">
                    <h5>a place where tea flies your time</h5>
                </div>
            </div>
        </div>

    </div>

    <?php 
        require_once VIEW_PATH . "templates/footer.php";
    ?>
</div>