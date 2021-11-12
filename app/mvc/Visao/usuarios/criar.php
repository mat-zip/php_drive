<div class="container">
  <h3>Create your account at</h3>
  <h2>PHP Drive!</h2>

  <form action="./login.php" method="post">
    <div class="row">
      <div class="input-field col s6">
        <input type="text" name="name" id="name" class="validate">
        <label for="name">Name</label>
      </div>
      <div class="input-field col s6">
        <input type="text" name="surname" id="surname" class="validate">
        <label for="surname">Surname</label>
      </div>
    </div>

    <div class="row">
      <div class="input-field col s12">
        <input type="email" name="email" id="email" class="validate">
        <label for="email">Email</label>
      </div>
    </div>

    <div class="row">
      <div class="input-field col s12">
        <input type="url" name="profile-photo" id="profile-photo" class="validate">
        <label for="profile-photo">Profile Photo (url)</label>
      </div>
    </div>

    <div class="row">
      <div class="input-field col s6">
        <input type="password" name="password" id="password">
        <label for="password">Password</label>
      </div>

      <div class="input-field col s6">
        <input type="password" name="confirm-password" id="confirm-password">
        <label for="confirm-password">Confirm Password</label>
      </div>
    </div>

    <div class="row">
      <a href="<?= URL_RAIZ ?>" class="col s6 expandable-link">I already have an account</a>
      <button type="submit" class="btn blue waves-effect col s6">Sign Up</button>
    </div>
  </form>
</div>