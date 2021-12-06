<div class="navbar-fixed">
  <nav class="nav-extended white">
    <div class="nav-wrapper white">
      <ul>
        <li><a href="<?= URL_RAIZ . 'drive' ?>" class="title grey-text text-darken-1">PHP Drive</a></li>
        <li class="title grey-text text-darken-1">| <?= $fullName ?> </li>
      </ul>
      <ul class="right">
        <li><img src="<?= $profilePhoto ?>" class="circle"></li>
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

    <div class="nav-wrapper">
      <ul>
        <li>
          <form action="<?= URL_RAIZ . 'drive' ?>" id="upload-file" method="POST" enctype="multipart/form-data">
            <div class="file-field input-field valign-wrapper">
              <div class="btn blue">
                <span>New</span>
                <input type="file" name="file" id="file">
              </div>
              <div class="file-path-wrapper">
                <input class="file-path validate" type="text">
              </div>
            </div>
          </form>
        </li>
        <li>
          <button type="submit" class="btn blue" form="upload-file">Submit</button>
        </li>
      </ul>
    </div>
  </nav>
</div>

<ul class="side-nav fixed floating transparent z-depth-0">
  <li class="active"><a href="<?= URL_RAIZ . 'drive' ?>"><i class="material-icons blue-text text-darken-1">dashboard</i>My Drive</a>
  </li>
</ul>

<div class="main">
  <div class="container-fluid" id="drop-area">
    <table class="highlight bordered">
      <thead>
        <tr>
          <th>
            Name
            <form action="<?= URL_RAIZ . 'drive' ?>" method="GET">
              <input type="hidden" name="order_by" value="name">
              <button class="btn-flat waves-effect " type="submit">
                <i class="material-icons">arrow_upward</i>
              </button>
            </form>

          </th>

          <th>
            Owner
          </th>

          <th>
            Upload Date
            <form action="<?= URL_RAIZ . 'drive' ?>" method="GET">
              <input type="hidden" name="order_by" value="date">
              <button class="btn-flat waves-effect " type="submit">
                <i class="material-icons">arrow_upward</i>
              </button>
            </form>
          </th>

          <th>
            File Size
            <form action="<?= URL_RAIZ . 'drive' ?>" method="GET">
              <input type="hidden" name="order_by" value="size">
              <button class="btn-flat waves-effect" type="submit">
                <i class="material-icons">arrow_upward</i>
              </button>
            </form>
          </th>
        </tr>
      </thead>
      <?php if ($mensagem) : ?>
        <p class="green-text text-darken-3"><strong><?= $mensagem ?></strong></p>
      <?php endif ?>

      <?php if (empty($arquivos)) : ?>
        <tr>
          <td colspan="99" class="center-align">No files found in your database</td>
        </tr>
      <?php endif ?>

      <?php foreach ($arquivos as $arquivo) : ?>
        <tbody id="tbody">
          <tr>
            <td><i class="material-icons purple-text left"><?= $arquivo->getIconByType() ?></i><?= $arquivo->getName() ?></td>
            <td><?= $fullName ?></td>
            <td><?= $arquivo->getUploadDate() ?></td>
            <td><?= ceil($arquivo->getSize() / 1024) . ' KB' ?></td>

            <td>
              <a href="<?= URL_RAIZ . 'drive/' . $arquivo->getId() . '/comentarios' ?>">
                <i class="material-icons btn-comment btn-flat">comment</i>
              </a>
            </td>
            <td>
              <form action="<?= URL_RAIZ . 'drive/' . $arquivo->getId() ?>" method="POST">
                <input type="hidden" name="_metodo" value="DELETE">
                <button type="submit" class="btn-flat">
                  <i class="material-icons left">delete</i>
                </button>
              </form>
            </td>
          </tr>
        </tbody>
      <?php endforeach ?>
    </table>
  </div>
</div>