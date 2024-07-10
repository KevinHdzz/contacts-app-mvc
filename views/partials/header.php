
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300..900&display=swap" rel="stylesheet">
    <!-- normalize -->
    <link rel="stylesheet" href="/static/css/normalize.css">
    <!-- my styles -->
    <link rel="stylesheet" href="/static/css/styles.css">

    <!-- scripts -->
    <?php
    load_scripts([
        // "/register" => ["<script defer src='/static/js/register.js'></script>"]
    ]);
    ?>

    <title>ContactsApp | <?= $title ?? "" ?></title>
</head>

<body>
    <header class="header">
        <div class="navbar large-container">
            <div class="navbar-logo">
                <a class="logo" href="/">ContactsApp</a>
            </div>
            <nav class="navbar-nav">
                <a href="#"><?= $user["email"] ?? "" ?></a>
                <a href="/logout">Logout</a>
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-filled" width="35" height="35" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M12 2a5 5 0 1 1 -5 5l.005 -.217a5 5 0 0 1 4.995 -4.783z" stroke-width="0" fill="currentColor" />
                    <path d="M14 14a5 5 0 0 1 5 5v1a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-1a5 5 0 0 1 5 -5h4z" stroke-width="0" fill="currentColor" />
                </svg>
            </nav>
        </div>
    </header>
