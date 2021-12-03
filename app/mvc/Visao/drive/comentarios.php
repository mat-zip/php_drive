<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WEB 3 | Sistema de Compartilhamento de Arquivos</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="<?= URL_CSS . 'style.css' ?>">
    <link rel="stylesheet" href="<?= URL_CSS . 'pointer.css' ?>">
    <script src="<?= URL_JS . 'jquery-3.1.1.min.js'?>"></script>

</head>

<body>
    <div class='navbar-fixed'>
        <nav class='nav-extended white'>
            <div class='nav-wrapper white'>
                <ul>
                    <li><a href='<?= URL_RAIZ . 'drive' ?>' class='title grey-text text-darken-1'>PHP Drive</a></li>
                    <li class='title grey-text text-darken-1'>| <?= $usuario->getFullName() ?></li>
                    <li class='title grey-text'>&nbsp;<?= $arquivo->getName() ?>
                    <li>
                </ul>
                <ul class='right'>
                    <li><img src="<?= $usuario->getProfilePhoto() ?>" class='circle'></li>
                    <li>
                        <a href="#" onclick="$('#logout').submit()">
                            <i class="material-icons grey-text text-darken-1 btn-logout">logout</i>
                        </a>
                        <form id="logout" action="<?= URL_RAIZ . 'login' ?>" method="POST" class="hidden">
                            <input type="hidden" name="_metodo" value="DELETE">
                        </form>
                    </li>
                </ul>
            </div>
        </nav>
    </div>

    <div class='container'>
        <!-- Input Texto do Comentário -->
        <div class='row valign-wrapper'>
            <div class='col s1'>
                <img class='circle responsive-img' src="<?= $usuario->getProfilePhoto() ?>" alt='profile-photo'>
            </div>
            <div class='col s11'>
                <form action='<?= URL_RAIZ . 'drive/' . $arquivo->getId() . '/comentarios' ?>' method='POST'>
                    <div class='input-field'>
                        <textarea name='text' id='textarea1' class='materialize-textarea'></textarea>
                        <label for='textarea1'>Digite seu comentário</label>
                    </div>
                    <button type='submit' class='grey btn col s2'>submit</button>
                </form>
            </div>
        </div>

        <hr class='divider'>

        <?php

        use Modelo\Comentario;

        if (empty($comentarios)) : ?>
            <h4 class="center">No comments yet</h4>
        <?php endif ?>

        <?php foreach ($comentarios as $comentario) : ?>
            <div class='row valign-wrapper'>
                <div class='col s1'>
                    <img class='circle responsive-img' src="<?= $usuario->getProfilePhoto() ?>" alt='profile-photo'>
                </div>

                <div class='col s11'>
                    <div class='card-panel grey lighten-2'>
                        <?= $comentario->getText() ?>
                        <div class='row'>
                            <small class='col s8 comment-date'><?= $comentario->getUploadDate() ?></small>
                            <form class='col s1' action='edit-comment.php' method='POST'>
                                <input type='hidden' name='id' value='1'>
                                <button type='submit' class='btn-flat'><i class='material-icons comment-edit'>edit</i></button>
                            </form>

                            <form action="<?= URL_RAIZ . 'drive/' . $arquivo->getId() . '/comentarios' ?>" method="POST">
                                <input type="hidden" name="_metodo" value="DELETE">
                                <input type="hidden" name="comment_id" value="<?= $comentario->getId() ?>">
                                <button type="submit" class="btn-flat">
                                    <i class='col s1 material-icons comment-delete'>delete</i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/4.1.3/socket.io.min.js" integrity="sha512-fB746S+jyTdN2LSWbYSGP2amFYId226wpOeV4ApumcDpIttPxvk1ZPOgnwqwQziRAtZkiFJVx9F64GLAtoIlCQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>

</html>