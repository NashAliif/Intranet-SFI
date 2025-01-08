<div id="sidebar" class="vh-100 d-flex flex-column justify-content-between sticky-top">
    <div class="bg-light border h-100 pt-5 p-4 d-flex flex-column gap-5 shadow-sm">
        <h2 class="text-center">
            <a href="<?= BASEURL; ?>/" class="">
                <img src="<?= PUBLIC_PATH; ?>/img/logo-sfi3.png" id="logo-navbar" alt="logo-sfi" style="width: 11rem;">
            </a>
        </h2>
        <div>
            <ul class="m-0 p-0 d-flex flex-column gap-1">
                <li class="d-flex">
                    <a href="<?= BASEURL; ?>" id="nav-link1" class="btn btn-light w-100 d-flex justify-content-start align-items-center gap-3" title="Dashboard">
                        <i class="bi bi-grid-1x2-fill fs-5"></i>
                        <span class="fs-5 fw-bold text-dark">Dashboard</span>
                    </a>
                </li>
                <li class="d-flex">
                    <a href="<?= BASEURL; ?>/user/index" id="nav-link2" class="btn btn-light w-100 d-flex justify-content-start align-items-center gap-3" title="Accounts">
                        <i class="bi bi-people-fill fs-5"></i>
                        <span class="fs-5 fw-bold text-dark">Accounts</span>
                    </a>
                </li>
                <li class="d-flex">
                    <a href="<?= BASEURL; ?>/asset/index" id="nav-link3" class="btn btn-light w-100 d-flex justify-content-start align-items-center gap-3" title="Assets">
                        <i class="bi bi-archive-fill fs-5"></i>
                        <span class="fs-5 fw-bold text-dark">Assets</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>