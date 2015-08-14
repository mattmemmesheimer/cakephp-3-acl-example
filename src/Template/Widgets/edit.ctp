<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $widget->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $widget->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Widgets'), ['action' => 'index']) ?></li>
    </ul>
</div>
<div class="widgets form large-10 medium-9 columns">
    <?= $this->Form->create($widget) ?>
    <fieldset>
        <legend><?= __('Edit Widget') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('part_no');
            echo $this->Form->input('quantity');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
