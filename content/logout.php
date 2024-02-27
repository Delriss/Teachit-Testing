<?

if(!isset($_SESSION)) {
    die('<p class="lead">User is not logged in.</p>');
}
else{
    session_destroy();
    header("Location: /");
    die();
}