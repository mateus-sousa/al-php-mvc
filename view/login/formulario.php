<?php include __DIR__ . '/../inicio-html.php'; ?>
<form action="/efetuar-login" method="POST">
    <div class="form-group">
        <label for="email">E-mail:</label>
        <input type="email" name="email" class="form-control">
    </div>
    <div class="form-group">
        <label for="senha">Senha:</label>
        <input type="password" name="senha" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Logar</button>
</form>
<?php include __DIR__ . '/../fim-html.php'; ?>
