<?php

use Cake\Core\Configure;

if (!$this->fetch('html')) {
    $this->start('html');
    printf('<html lang="%s" class="no-js">', Configure::read('App.language'));
    $this->end();
}

if (!$this->fetch('title')) {
    $this->start('title');
    echo Configure::read('App.title');
    $this->end();
}

if (!$this->fetch('tb_footer')) {
    $this->start('tb_footer');
    printf('&copy;%s %s', date('Y'), Configure::read('App.title'));
    $this->end();
}

$this->prepend('tb_body_attrs', ' class="' . implode(' ', [$this->request->getParam('controller'), $this->request->getParam('action')]) . '" ');
if (!$this->fetch('tb_body_start')) {
    $this->start('tb_body_start');
    echo '<body' . $this->fetch('tb_body_attrs') . '>';
    $this->end();
}

if (!$this->fetch('tb_flash')) {
    $this->start('tb_flash');
    if (isset($this->Flash)) {
        echo $this->Flash->render();
    }
    $this->end();
}

if (!$this->fetch('tb_body_end')) {
    $this->start('tb_body_end');
    echo '</body>';
    $this->end();
}

$this->prepend('tb_body_attrs', ' class="' . implode(' ', [$this->request->getParam('controller'), $this->request->getParam('action')]) . '" ');

?>

<?php 
if (!$this->fetch('navbar')) {
    $this->start('navbar');
    $this->assign('navbar-status', "");
    $this->assign('navbar-link', $this->Html->nestedList([
        $this->Html->link('menu1', ['controller' => '','action' => '']),
        $this->Html->link('menu2', ['controller' => '','action' => '']),
        $this->Html->link('menu3', ['controller' => '','action' => '']),
    ], ["class" => ["nav", "navbar-nav", "navbar-right"]]));
?>
    <!-- ナビゲーションバー -->
    <div class="row">
        <div class="col-xs-12 navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="navbar-header">
                <span class="navbar-status"><?= Configure::read('App.title') ?></span>
                <span class="navbar-status visible-lg visible-md"  style="font-size:100%;">
                    <?= $this->fetch('navbar-status') ?>
                </span>
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navi">
                    <span class="sr-only">メニュー</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div id="navi" class="collapse navbar-collapse">
                <?= $this->fetch('navbar-link'); ?>
            </div>
        </div>
    </div>

<?php
    $this->end();
}

if (!$this->fetch('content_prefix')) {
    $this->start('content_prefix');
    echo '<div class="container-fluid">';
    echo $this->fetch('navbar');
    echo '<div class="row" style="padding-top:15px;">';
    $this->end();
}

if (!$this->fetch('content_suffix')) {
    $this->start('content_suffix');
    echo '</div></div>';
    $this->end();
}

/**
 * Prepend `meta` block with `author` and `favicon`.
 */
$this->prepend('meta', $this->Html->meta('author', null, ['name' => 'author', 'content' => Configure::read('App.author')]));
$this->prepend('meta', $this->Html->meta('favicon.ico', '/favicon.ico', ['type' => 'icon']));

/**
 * Prepend `css` block with Bootstrap stylesheets and append
 * the `$html5Shim`.
 */
$html5Shim =
<<<HTML

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
HTML;
$this->prepend('css', $this->Html->css(['bootstrap/bootstrap']));
$this->prepend('css', $this->Html->css(Configure::read('App.projectName')));

$this->append('css', $html5Shim);

/**
 * Prepend `script` block with jQuery and Bootstrap scripts
 */
$this->prepend('script', $this->Html->script(['jquery/jquery', 'bootstrap/bootstrap']));
$this->prepend('script', $this->Html->script('https://code.jquery.com/jquery-3.3.1.slim.min.js', [
    'integrity' => "sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo",
    'crossorigin' => "anonymous"]));
$this->prepend('script', $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js', [
    'integrity' => "sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49",
    'crossorigin' => "anonymous"]));
$this->prepend('script', $this->Html->script('https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js', [
    'integrity' => "sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em",
    'crossorigin' => "anonymous"]));
$this->Html->scriptStart(['block' => true]);
echo "$('table').addClass('table');";
$this->Html->scriptEnd();
?>

<!DOCTYPE html>

<?= $this->fetch('html') ?>

    <head>

        <?= $this->Html->charset() ?>
        <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1">

        <title><?= $this->fetch('title') ?></title>

        <?= $this->fetch('meta') ?>
        <?= $this->fetch('css') ?>

    </head>

    <?php
    echo $this->fetch('tb_body_start');
    echo $this->fetch('tb_flash');
    echo $this->fetch('content_prefix');
    echo $this->fetch('content');
    echo $this->fetch('content_suffix');
    echo $this->fetch('tb_footer');
    echo $this->fetch('script');
    echo $this->fetch('tb_body_end');
    ?>
</html>
