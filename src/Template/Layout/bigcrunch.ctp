<?php
    use Cake\Core\Configure;
    $this->prepend('tb_body_attrs', ' class="' . implode(' ', [$this->request->getParam('controller'), $this->request->getParam('action')]) . '" ');
?>

<!-- プロジェクト共通の固有設定 -->
<?php
    $this->assign('navbar-status', "");
    $this->assign('navbar-link', $this->Html->nestedList([
        $this->Html->link('menu1', ['controller' => '','action' => '']),
        $this->Html->link('menu2', ['controller' => '','action' => '']),
        $this->Html->link('menu3', ['controller' => '','action' => '']),
    ], ["class" => ["nav", "navbar-nav", "navbar-right"]]));
?>

<!-- ナビゲーションバー -->
<?php $this->start('navbar'); ?>
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
                <?= $this->fetch('navbar-link') ?>
            </div>
        </div>
    </div>
<?php $this->end(); ?>


<div class="container-fluid">
    <?= $this->fetch('navbar') ?>
    <div class="row" style="padding-top:15px;">
        <?php echo $this->fetch('content'); ?>
    </div>
</div>

