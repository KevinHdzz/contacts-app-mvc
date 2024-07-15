<?php include_once __DIR__ . "/partials/header.php" ?>

<main class="small-container main">
    <div class="new-contact">
        <a href="/contacts/create" class="btn new-contact-btn">New Contact</a>
    </div>
    <div class="contacts">
        <?php foreach ($contacts as $contact) : ?>
            <div class="contact">
                <div class="name">
                    <p class="contact-field"><?= $contact->name ?></p>
                </div>
                <div class="remaining-fields">
                    <p class="contact-field email <?= !$contact->email ? "no-email" : "" ?>">
                        <?= $contact->email ?? "Not email address" ?>
                    </p>
                    <p class="contact-field phone flex align-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-phone" width="38" height="32" viewBox="0 0 24 24" stroke-width="2" stroke="#04b445" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2" />
                        </svg>
                        <?= $contact->phone ?>
                    </p>
                    <div class="options">
                        <svg xmlns="http://www.w3.org/2000/svg" class="options-icon icon icon-tabler icon-tabler-dots" width="30" height="35" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M5 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                            <path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                            <path d="M19 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                        </svg>
                        <div class="options-list hidden">
                            <a class="option" href="/contacts/edit?id=<?= $contact->id ?>">Edit</a>
                            <form action="/contacts/delete" method="post">
                                <input type="hidden" name="id" value="<?= $contact->id ?>">
                                <input class="option" type="submit" value="Delete">
                            </form>
                        </div>
                    </div>
                </div>
            </div> <!-- end contact -->
        <?php endforeach ?>
    </div>
</main>

<?php include __DIR__ . "/partials/footer.php"; ?>
