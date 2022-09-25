<?php if (!empty($files)): ?>
    <ul><?php foreach ($files as $file): ?>
            <li>
                <a href="/Storage/<?= $folder['id'] . '.' . $file['name'] ?>" download> <?= $file['name'] ?></a>
                <a href="/file/delete/<?= $file['id'] ?>">x</a>
            </li>
        <?php endforeach ?>
    </ul>
<?php else: ?>
    <div>Пусто</div>
<?php endif; ?>