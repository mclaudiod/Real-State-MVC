<main class="container section">
    <h1>Create Agent</h1>

    <a href="/admin" class="button green-button">Return</a>

    <?php foreach($errors as $error): ?>
        <div class="alert error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form class="form" method="POST">
        <?php include __DIR__ . "/form.php"; ?>
        <input type="submit" value="Create Agent" class="button green-button">
    </form>  
</main>