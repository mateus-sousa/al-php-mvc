<?php include __DIR__ . '/../inicio-html.php'; ?>
<form action="/salvar-curso<?= isset($curso) ? '?id=' . $curso->getId() : '' ?>" method="POST">
    <div class="form-group">
        <label for="descricao">Descrição</label>
        <input type="text" class="form-control" name="descricao" value="<?= isset($curso) ? $curso->getDescricao() : '' ?>">
    </div>
</form>
<?php include __DIR__ . '/../fim-html.php'; ?>
