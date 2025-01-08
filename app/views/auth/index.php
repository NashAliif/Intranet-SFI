<div class="bg-light vw-100 vh-100 d-flex flex-column justify-content-center align-items-center gap-4">
    <img src="<?= PUBLIC_PATH; ?>/img/logo-sfi3.png" alt="logo-sfi" style="width: 15rem">
    <form action="<?= BASEURL; ?>/auth/login" method="post">
        <div class="d-flex flex-column gap-3 mb-4">
            <div>
                <label for="Email" class="form-label fs-6 fw-bold text-secondary">Email</label>
                <input type="email" class="form-control text-secondary" id="Email" name="email" style="width: 18rem" placeholder="Email" />
            </div>
            <div>
                <label for="Password" class="form-label fs-6 fw-bold text-secondary">Password</label>
                <input type="password" class="form-control text-secondary" id="Password" name="password" style="width: 18rem" placeholder="Password" />
            </div>
        </div>
        <button type="submit" class="btn btn-secondary w-100 fw-bold ">Login</button>
    </form>
</div>