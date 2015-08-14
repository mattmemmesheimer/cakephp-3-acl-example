<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Widget'), ['action' => 'add']) ?></li>
    </ul>
</div>
<div class="widgets index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('name') ?></th>
            <th><?= $this->Paginator->sort('part_no') ?></th>
            <th><?= $this->Paginator->sort('quantity') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($widgets as $widget): ?>
        <tr>
            <td><?= $this->Number->format($widget->id) ?></td>
            <td><?= h($widget->name) ?></td>
            <td><?= h($widget->part_no) ?></td>
            <td><?= $this->Number->format($widget->quantity) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $widget->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $widget->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $widget->id], ['confirm' => __('Are you sure you want to delete # {0}?', $widget->id)]) ?>
            </td>
        </tr>

    <?php endforeach; ?>
    </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
