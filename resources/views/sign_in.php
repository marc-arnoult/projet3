<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <script src="https://use.fontawesome.com/84658dd2ae.js"></script>
    <link rel="stylesheet" href="/public/css/app.css">
</head>

<body>
    <div class="sign_in">
        <form id="form" action="/connexion" method="post">
            Pseudo :
            <input type="text" name="pseudo">
            Password :
            <input type="password" name="password">
            <input type="submit" value="Valider">
        </form>
    </div>

<?php include_once 'layout/footer.view.php'; ?>