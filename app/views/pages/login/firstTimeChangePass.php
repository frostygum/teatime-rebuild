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
            <h5 class="text-center mb-0">FirstTime Change Password</h5>

            <form id="login-form" method="post" action="./login" class="px-4 pt-3">
                <div class="py-1">
                    <p class="text-bold mt-0">New Password</p>
                    <input class="input block border-color-light" type="password" name="new_password" placeholder="new password">
                </div>
                <div class="py-1">
                    <p class="text-bold mt-0">Retype New Password</p>
                    <input class="input block border-color-light" type="password" name="retype_new_password" placeholder="retype new password">
                </div>
                <div class="py-1 mt-3">
                    <button type="submit" name="button" class="btn btn-primary block bg-primary shadow py-1 text-bold">
                        Change Password
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php 
    if(isset($error)) {
        echo "
        <div class='alert'>
            <div id='alert' class='alert-content'>
                <div class='alert-icon'>  
                    <span class='fa fa-exclamation-triangle'></span>
                </div>
                <div class='alert-text'>
                    $error
                </div>
                <button class='alert-close' onclick='toggleAlert(`alert`)'>
                    <span class='fa fa-times-circle'></span>
                </button>
            </div>
        </div>
        <script type='text/javascript' defer>
            window.addEventListener('load', function () {
                toggleAlert('alert');
            });
        </script>
        ";
    }
?>

<script type="text/javascript" defer>
    class LoginForm {
        constructor(formId, inputSettings = []) {
            this.form = document.getElementById(formId);
            this.validateSubmit = this.validateSubmit.bind(this);
            this.input = inputSettings;

            if (this.input.length == 0) {
                this.form.addEventListener("submit", (event) => {
                    event.preventDefault();
                });
            } else {
                this.form.addEventListener("submit", (event) => {
                    event.preventDefault();
                    this.validateSubmit(event, this.input);
                });
            }

        }

        validateSubmit(event, inputs = []) {
            let formElements = event.currentTarget.elements;
            let btn = formElements.button;
            let data = '';
            let isValidated = true;

            if (inputs.length != 0) {
                inputs.map((input, i) => {
                    isValidated = this.checkInputLength(formElements[input.name], input.minLength) && isValidated;
                    data += `"${input.name}": "${formElements[input.name].value}"`;
                    if (i != inputs.length - 1) {
                        data += `, `;
                    }
                });
                data = `{${data}}`;
            }

            if (isValidated) {
                this.toggleSpinner(btn);
                this.form.submit();
                // this.post(JSON.parse(data))
                //     .then(this.toggleSpinner(btn))
                //     .then(function(res) {
                //         if(res.username && res.id) {
                //             window.location.reload();
                //         }
                //     });
            }
        }

        // post(data) {
        //     return new Promise((resolve, reject) => {
        //         fetch('api/auth', {
        //             method: 'post',
        //             headers: {
        //                 'content-type': 'application/x-www-form-urlencoded'
        //             },
        //             body: JSON.stringify(data)
        //         })
        //         .then(function(res) {
        //             return res.text();
        //         })
        //         .then(function(res) {
        //             let result = JSON.parse(res);
        //             resolve(result);
        //         })
        //         .catch(function(err) {
        //             reject(err);
        //         });
        //     })
        // }

        toggleSpinner(obj) {
            if (obj.childNodes[0].localName != 'span') {
                let spinner = document.createElement("span");
                spinner.className = 'text-dark fas fa-circle-notch fa-lg fast-spin';

                obj.disabled = true;
                obj.textContent = null;
                obj.appendChild(spinner);
            } else {
                setTimeout(function() {
                    let text = document.createTextNode('LOGIN');

                    obj.removeChild(obj.childNodes[0]);
                    obj.appendChild(text);
                    obj.disabled = false;
                }, 500);
            }
        }

        checkInputLength(obj, minLength) {
            if (obj.value.length < minLength) {
                obj.classList.add('error');
                return false;
            } else {
                obj.classList.remove('error');
                return true;
            }
        }
    }

    new LoginForm('login-form', [{
        name: 'new_password',
        minLength: 8
    }, {
        name: 'retype_new_password',
        minLength: 8
    }]);
</script>