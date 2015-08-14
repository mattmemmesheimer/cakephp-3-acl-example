<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Widget'), ['action' => 'edit', $widget->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Widget'), ['action' => 'delete', $widget->id], ['confirm' => __('Are you sure you want to delete # {0}?', $widget->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Widgets'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Widget'), ['action' => 'add']) ?> </li>
    </ul>
</div>
<div class="widgets view large-10 medium-9 columns">
    <h2><?= h($widget->name) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Name') ?></h6>
            <p><?= h($widget->name) ?></p>
            <h6 class="subheader"><?= __('Part No') ?></h6>
            <p><?= h($widget->part_no) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($widget->id) ?></p>
            <h6 class="subheader"><?= __('Quantity') ?></h6>
            <p><?= $this->Number->format($widget->quantity) ?></p>
        </div>
    </div>
</div>
