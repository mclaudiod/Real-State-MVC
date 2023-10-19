<main class="container section centered-content">
    <h1>Login</h1>

    <?php foreach($errors as $error): ?>
        <div class="alert error">
            <?php echo $error; ?>
        </div>           
    <?php endforeach; ?>

    <form method="POST" class="form" action="/login">
        <fieldset>
            <legend>Email and Password</legend>
            <label for="email">E-mail:</label>
            <input type="email" name="email" placeholder="Your E-mail" id="email" required>
            <label for="password">Password:</label>
            <input type="password" name="password" placeholder="Your Password" id="password" required>
        </fieldset>

        <input type="submit" value="Log In" class="button green-button">
    </form>
</main>