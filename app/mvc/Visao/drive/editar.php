<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>WEB 3 | Sistema de Compartilhamento de Arquivos</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="../styles/styles.css">
  <link rel="stylesheet" href="../styles/pointer.css">

</head>

<body>

  <div class="navbar-fixed">
    <nav class="nav-extended white">
      <div class="nav-wrapper white">
        <ul>
          <li><a href="<?= URL_RAIZ . 'drive' ?>" class="title grey-text text-darken-1">PHP Drive</a></li>
          <li class="title grey-text text-darken-1">| <?= $usuario->getFullName() ?> </li>
        </ul>
        <ul class="right">
          <li><a href="#!"><img src="<?= $usuario->getProfilePhoto() ?>" class="circle"></a></li>
          <li><a href="./public/pages/login.php"><i class="material-icons grey-text text-darken-1 btn-logout">logout</i></a></li>
        </ul>
      </div>
    </nav>
  </div>

  <div class='container'>
    <div class='row valign-wrapper'>
      <div class='col s1'>
        <img class='circle responsive-img' src="<?= $usuario->getProfilePhoto() ?>" alt='profile-photo'>
      </div>
      <div class='col s11'>
        <form action='<?= URL_RAIZ . 'drive/' . $arquivo->getId() . '/comentarios'?>' method='POST'>
          <input type='hidden' name='_metodo' value='PATCH'>
          <input type='hidden' name='comment_id' value='<?= $comentario->getId()?>'>
          <div class='input-field'>
            <textarea name='text-comment' id='textarea1' class='materialize-textarea'> <?= $comentario->getText() ?> </textarea>
          </div>
          <button type='submit' class='grey btn col s2'>submit</button>
        </form>
      </div>
    </div>
  </div>


  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/4.1.3/socket.io.min.js" integrity="sha512-fB746S+jyTdN2LSWbYSGP2amFYId226wpOeV4ApumcDpIttPxvk1ZPOgnwqwQziRAtZkiFJVx9F64GLAtoIlCQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>

</html>