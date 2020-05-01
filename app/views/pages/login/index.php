<div class="container display-grid align-content-center h-100v">
    <div class="mt-1 login-title display-grid justify-content-center">
        <div class="login-logo display-grid grid-col-2 align-items-center p-1">
            <img src="<?= $this::add_image('logo', 'svg') ?>" />
            <h3>Teatime</h3>
        </div>
        <div class="login-subtitle">
            <span>a place where tea flies your time</span>
        </div>
    </div>
    <div>
        <?= isset($error) ? $error : 'tidak ada error' ?>
    </div>
    <div class="display-grid justify-content-center grid-col-1">
        <div class="card bg-teal shadow text-light login-card py-4 px-2">
            <h5 class="text-center">Welcome Back!</h5>

            <form id="login-form" method="post" action="./login" class="px-4 pt-3">
                <div class="py-1">
                    <p class="text-bold mt-0">username</p>
                    <input class="input block border-color-light" type="text" name="username" placeholder="username">
                </div>
                <div class="py-1">
                    <p class="text-bold mt-0">password</p>
                    <input class="input block border-color-light" type="password" name="password" placeholder="password">
                </div>
                <div class="py-1 mt-3">
                    <button type="submit" name="button" class="btn btn-primary block bg-primary shadow py-1 text-bold">
                        LOGIN
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

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
        name: 'username',
        minLength: 5
    }, {
        name: 'password',
        minLength: 8
    }]);
</script>