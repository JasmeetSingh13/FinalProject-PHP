<style>
form > * {
    display: block;
}
</style>
<form method="POST" action="/user/login">
    <input type="hidden" name="csrf" value="<?php echo($csrf) ?>">
    <label for="username">Email</label>
    <input id="username" name="username" required autocomplete="email">
    <label for="password">Password</label>
    <input type="password" id="password" name="password" required autocomplete="email">
    <input type="submit" value="Login">
</form>