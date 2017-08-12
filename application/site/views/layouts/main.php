<?php

\site\assets\SiteAsset::register($this);
?>

<?= $this->beginPage() ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <?= $this->head() ?>
</head>

<body>
    <?= $this->beginBody() ?>

    <?= $this->chunk('header') ?>

    <main>
        <?= $content ?>
    </main>

    <?= $this->chunk('footer') ?>

    <?= $this->endBody() ?>
</body>
</html>
<?= $this->endPage() ?>