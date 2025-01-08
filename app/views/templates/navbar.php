<div id="navbar" class="d-flex justify-content-center align-items-start h-fit sticky-top">
    <div class="d-flex bg-light border justify-content-between h-100 w-100 shadow-sm">
        <button id="toggle-nav" class="btn btn-light rounded-4 ps-3">
            <i id="button-nav-icon" class="text-dark fs-2 bi bi-list"></i>
        </button>
        <div class="d-flex">
            <div class="btn-group">
                <button type="button" class="btn btn-light text-start dropdown-toggle rounded-end-4 d-flex align-items-center gap-3 p-4" data-bs-toggle="dropdown" aria-expanded="false">
                    <div>
                        <span>
                            <?= $_SESSION['full_name']; ?>
                        </span>
                    </div>
                </button>
                <ul class="dropdown-menu w-100">
                    <div class="d-flex flex-column px-3">
                        <span>
                            <?= $_SESSION['full_name']; ?>
                        </span>
                        <span class="opacity-50">
                            <?= $_SESSION['email']; ?>
                        </span>
                        <span class="opacity-50">
                            <?= $_SESSION['position']; ?>
                        </span>
                    </div>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center gap-2" href="<?= BASEURL; ?>/user/profile/<?= $_SESSION['user_id']; ?>">
                            <i class="bi bi-person-circle fs-5"></i>
                            <span>
                                Profile
                            </span>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item text-danger d-flex align-items-center gap-2" href="<?= BASEURL; ?>/auth/logout">
                            <i class="bi bi-box-arrow-left fs-5"></i>
                            <span>
                                Logout
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>