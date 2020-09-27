<?php foreach ($messages as $message) : ?>
    <p class="divider"><b><?= $message->pseudo; ?></b> <i><?= $message->created_at; ?></i></p>
    <p><?= $message->content; ?></p>
<?php endforeach; ?>
