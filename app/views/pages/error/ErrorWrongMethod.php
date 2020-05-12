<div class="container display-grid align-content-center h-100v">
    <div class="mt-1 login-title display-grid justify-content-center cursor-pointer" onclick="window.location = '<?= BASE_PAGE ?>'">
        <div class="login-logo display-grid grid-col-2 align-items-center p-1">
            <img src="<?= $this::add_image('logo', 'svg') ?>" />
            <h3>Teatime</h3>
        </div>
        <div class="login-subtitle">
            <span>a place where tea flies your time</span>
        </div>
    </div>
    <div>
    </div>
    <div class="display-grid justify-content-center grid-col-1">
        <div class="card bg-teal shadow text-light login-card py-4 px-2">
            <h5 class="text-center mb-0">Hmmmmn.. seems like you are lost</h5>
            <p class="text-center mt-4">you are about to redirected in <span id="countdown">5</span>s.</p>
        </div>
    </div>
</div>

<script type="text/javascript" defer> 
    let countdown = document.getElementById('countdown');

    var timeLeft = 5;
    var timer = setInterval(function(){
    if(timeLeft <= 0){
        clearInterval(timer);
        window.location = '<?= BASE_PAGE ?>';
    } else {
        countdown.textContent = timeLeft;
    }
    timeLeft -= 1;
    }, 1000);
</script>