<div class="container">
        <h3>Login to your account</h3>
        <h2>PHP Drive!</h2>

        <form action="<?= URL_RAIZ . 'login' ?>" method="POST">
            <div class="row">
                <div class="input-field col s12">
                    <input type="email" name="email" id="email" class="validate">
                    <label for="email">Email</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12">
                    <input type="password" name="password" id="password">
                    <label for="password">Password</label>
                </div>
            </div>

            <div class="row">
                <a href="<?= URL_RAIZ . 'usuarios/criar' ?>" class="col s6 expandable-link">Create Account</a>
                <button type="submit" class="btn blue waves-effect col s6">Login</button>
            </div>
        </form>
    </div>

    
