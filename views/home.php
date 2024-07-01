<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/static/css/normalize.css">
    <link rel="stylesheet" href="/static/css/styles.css">
    <title>ContactsApp</title>
</head>

<body>
    <header class="header">
        <div class="navbar large-container">
            <div class="navbar-logo">
                <a class="logo" href="/">ContactsApp</a>
            </div>
            <nav class="navbar-nav">
                <a href="#">user@gmail.com</a>
                <a href="#">Logout</a>
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-filled" width="35" height="35" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M12 2a5 5 0 1 1 -5 5l.005 -.217a5 5 0 0 1 4.995 -4.783z" stroke-width="0" fill="currentColor" />
                    <path d="M14 14a5 5 0 0 1 5 5v1a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-1a5 5 0 0 1 5 -5h4z" stroke-width="0" fill="currentColor" />
                </svg>
            </nav>
        </div>
    </header>

    <main class="small-container main">
        <div class="new-contact">
            <a href="#" class="btn new-contact-btn">New Contact</a>
        </div>
        <div class="contacts">
            <?php foreach ($contacts as $contact) : ?>
                <div class="contact">
                    <div class="name">
                        <p><?= $contact->name ?></p>
                    </div>
                    <div class="remaining-fields">
                        <p class="email <?= !$contact->email ? "no-email" : "" ?>">
                            <?= $contact->email ?? "Not email address" ?>
                        </p>
                        <p class="phone flex align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-phone" width="38" height="32" viewBox="0 0 24 24" stroke-width="2" stroke="#04b445" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2" />
                            </svg>
                            <?= $contact->phone ?>
                        </p>
                        <!-- <a href="#" class="call-btn btn">Call</a> -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="options-icon icon icon-tabler icon-tabler-dots" width="30" height="40" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M5 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                            <path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                            <path d="M19 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                        </svg>
                    </div>
                </div> <!-- end contact -->
            <?php endforeach ?>
        </div>
    </main>
</body>

</html>
