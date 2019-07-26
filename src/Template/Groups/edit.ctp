<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Group $group
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $group->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $group->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Groups'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="groups form large-9 medium-8 columns content">
    <?= $this->Form->create($group) ?>
    <fieldset>
        <legend><?= __('Edit Group') ?></legend>
        <?php
            echo $this->Form->control('name');
        ?>
        <?php
            foreach ($EditablePerms as $Acos) :
                foreach ($Acos as $controllerPath => $actions) :
                    if (!empty($actions)) :
                        // AppController のアクセス権限は編集不能
                        if ($controllerPath != "App"):
                            echo $this->Html->tag('h4', $controllerPath);
                        endif;
                        foreach ($actions as $action) :
                            // AppController::isAutholizedには常にアクセス可能
                            if ($controllerPath == "App" && $action == "isAuthorized") :
                                $this->Form->hidden('App/'.$controllerPath.'/'.$action, ['value'=>1 ]) ;
                            else:
                                ($this->AclManager->checkGroup($group, 'App/'.$controllerPath.'/'.$action)) ? $val = 1 : $val = 0;
                                echo $this->Form->label('App/'.$controllerPath.'/'.$action, $action);
                                echo $this->Form->select('App/'.$controllerPath.'/'.$action, [0 => 'No', 1 => 'Yes'], ['value' => $val]) ;
                            endif ;
                        endforeach ;
                    endif;
                endforeach ;
            endforeach ;
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
