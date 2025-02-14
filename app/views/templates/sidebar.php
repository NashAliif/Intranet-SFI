<?php
$menuItems = [
    [
        "title" => "Dashboard",
        "url" => BASEURL . "/",
        "icon" => "bi bi-grid-1x2-fill",
        "id" => "nav-link1"
    ],
    [
        "title" => "Accounts",
        "url" => BASEURL . "/user/index",
        "icon" => "bi bi-people-fill",
        "id" => "nav-link2"
    ],
    [
        "title" => "Assets",
        "url" => BASEURL . "/asset/index",
        "icon" => "bi bi-archive-fill",
        "id" => "nav-link3"
    ]
];
?>

<div id="sidebar" class="vh-100 d-flex flex-column justify-content-between sticky-top">
    <div class="bg-light border h-100 pt-5 p-4 d-flex flex-column gap-5 shadow-sm">
        <div class="align-self-center">
            <a href="<?= BASEURL; ?>/" class="">
                <img src="<?= PUBLIC_PATH; ?>/img/logo-sfi3.png" id="logo-navbar" alt="logo-sfi" style="width: 11rem;">
            </a>
        </div>
        <div>
            <ul class="m-0 p-0 d-flex flex-column gap-1">
                <?php foreach ($menuItems as $item): ?>
                    <li class="d-flex">
                        <a href="<?= $item['url']; ?>" id="<?= $item['id']; ?>" class="btn btn-light w-100 d-flex justify-content-start align-items-center gap-3" title="<?= $item['title']; ?>">
                            <i class="<?= $item['icon']; ?> fs-6 text-dark"></i>
                            <span class="fs-6 text-dark"><?= $item['title']; ?></span>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>
