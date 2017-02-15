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
        <header>
            <nav>
                <div>
                    <i class="fa fa-paragraph" aria-hidden="true"></i>
                </div>
                <div>
                    <ul>
                        <li><a href="/">Accueil</a></li>
                        <li><a href="/articles">Articles</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                    <?php if (empty($request->getSession())): ?>
                        <ul>
                            <li><a href="/inscription">Inscription</a></li>
                            <li><a href="#">Connexion</a></li>
                        </ul>
                    <?php else: ?>
                        <ul>
                            <li><a href="#">Salut</a></li>
                        </ul>
                    <?php endif; ?>
                </div>
            </nav>
        </header>

