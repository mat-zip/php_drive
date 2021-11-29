<div class="container">
  <h3>Create your account at</h3>
  <h2>PHP Drive!</h2>

  <?php if ($mensagem) : ?>

    <div class="col s12 m6">
      <div class="card green lighten-2 darken-1">
        <div class="card-content white-text">
          <p><?= $mensagem ?></p>
        </div>
      </div>
    </div>

  <?php endif ?>
  <?php if ($mensagem_erro) : ?>

    <div class="col s12 m6">
      <div class="card red lighten-2 darken-1">
        <div class="card-content white-text">
          <p><?= $mensagem_erro ?></p>
        </div>
      </div>
    </div>

  <?php endif ?>

  <form action="<?= URL_RAIZ . 'usuarios' ?>" method="post">
    <div class="row">
      <div class="input-field col s6">
        <input type="text" name="name" id="name" class="validate" required>
        <label for="name">Name</label>
      </div>
      <div class="input-field col s6">
        <input type="text" name="surname" id="surname" class="validate" required>
        <label for="surname">Surname</label>
      </div>
    </div>

    <div class="row">
      <div class="input-field col s12">
        <input type="email" name="email" id="email" class="validate" required>
        <label for="email">Email</label>
      </div>
    </div>

    <div class="row">
      <div class="input-field col s12">
        <input type="url" name="profile-photo" id="profile-photo" class="validate" required>
        <label for="profile-photo">Profile Photo (url)</label>
      </div>
    </div>

    <div class="row">
      <div class="input-field col s6">
        <input type="password" name="password" id="password" required>
        <label for="password">Password</label>
      </div>

      <div class="input-field col s6">
        <input type="password" name="confirm-password" id="confirm-password" required>
        <label for="confirm-password">Confirm Password</label>
      </div>
    </div>

    <div class="row">
      <a href="<?= URL_RAIZ ?>" class="col s6 expandable-link">I already have an account</a>
      <button type="submit" class="btn blue waves-effect col s6">Sign Up</button>
    </div>
  </form>
</div>