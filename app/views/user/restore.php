<div id="content">
    <div class="shadow-sm mt-3 mx-3 border rounded-4 bg-light">
        <div class="border-bottom">
            <h5 class="fw-bold p-4 m-0 w-100">Accounts Restore</h5>
        </div>
        <div class="p-4">

            <div class="col-6">
                <?php Flasher::flash(); ?>
            </div>

            <div class="mb-3 d-flex flex-column gap-3">
                <div class="w-50">
                    <form action="<?= BASEURL; ?>/user/indexRestore" method="post" class="d-flex">
                        <input type="text" name="keyword" class="form-control rounded-end-0 bg-light" placeholder="Search...">
                        <button type="submit" class="btn btn-primary rounded-start-0">
                            <i class="bi bi-search fs-6"></i>
                        </button>
                    </form>
                </div>
            </div>
            <div class="d-flex flex-column">
                <table class="table table-light">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">No</th>
                            <th scope="col">Email</th>
                            <th scope="col">Full Name</th>
                            <th scope="col">Instance</th>
                            <th scope="col">Position</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $totalData = count($data['user']);
                        $totalPages = ceil($totalData / 10);

                        $currentPage = 1;
                        if (isset($_GET['url'])) {
                            $url = rtrim($_GET['url'], '/');
                            $url = filter_var($url, FILTER_SANITIZE_URL);
                            $url = explode('/', $url);
                            $currentPage = isset($url[2]) ? (int) $url[2] : 1;
                        }

                        $startIndex = ($currentPage - 1) * 10;
                        $endIndex = min($startIndex + 10, $totalData);

                        $userToShow = array_slice($data['user'], $startIndex, 10);

                        $i = $startIndex + 1;
                        foreach ($userToShow as $user) : ?>
                            <tr class="text-center">
                                <th scope="row"><?= $i++; ?></th>
                                <td class="align-middle"><?= htmlspecialchars($user['email']); ?></td>
                                <td class="align-middle"><?= htmlspecialchars($user['full_name']); ?></td>
                                <?php
                                if ($user['instance_id'] == 1) {
                                    echo '<td class="align-middle">PT SELARAS MAKMUR SEJAHTERA</td>';
                                } else {
                                    echo '<td class="align-middle">PT DIGITAL INOVASI ASIA</td>';
                                }
                                ?>
                                <td class="align-middle"><?= htmlspecialchars($user['position']); ?></td>
                                <td class="align-middle">
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownUserMenuButton<?= $user['id']; ?>"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bi bi-lightning-charge-fill"></i>
                                            <span>
                                                Actions
                                            </span>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownUserMenuButton<?= $user['id']; ?>">
                                            <li>
                                                <button type="button" class="dropdown-item text-primary"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#DetailUserModal<?= $user['id']; ?>">
                                                    <i class="bi bi-info-circle-fill"></i>
                                                    <span>
                                                        Detail
                                                    </span>
                                                </button>
                                            </li>
                                            <li>
                                                <a class="dropdown-item text-warning"
                                                    href="<?= BASEURL; ?>/user/restore/<?= $user['id']; ?>"
                                                    onclick="return confirm('Are you sure?')">
                                                    <i class="bi bi-recycle"></i>
                                                    <span>
                                                        Restore
                                                    </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item text-danger"
                                                    href="<?= BASEURL; ?>/user/destroy/<?= $user['id']; ?>"
                                                    onclick="return confirm('Are you sure?')">
                                                    <i class="bi bi-trash2-fill"></i>
                                                    <span>
                                                        Destroy
                                                    </span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>

                            </tr>

                            <div class="modal fade" id="DetailUserModal<?= $user['id']; ?>" tabindex="-1" aria-labelledby="DetailUserModalLabel<?= $user['id']; ?>" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="DetailUserModalLabel<?= $user['id']; ?>">Detail Account</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="Email" class="form-label">Email</label>
                                                <input disabled type="text" class="form-control" id="Email" name="email" value="<?= htmlspecialchars($user['email']); ?>" />
                                            </div>
                                            <div class="mb-3">
                                                <label for="Password" class="form-label">Password</label>
                                                <input disabled type="password" class="form-control" id="Password" name="password" placeholder="Enter new password" />
                                            </div>
                                            <div class="mb-3">
                                                <label for="FullName" class="form-label">Full Name</label>
                                                <input disabled type="text" class="form-control" id="FullName" name="full_name" value="<?= htmlspecialchars($user['full_name']); ?>" />
                                            </div>
                                            <div class="mb-3">
                                                <label for="Telephone" class="form-label">Telephone</label>
                                                <input disabled type="text" class="form-control" id="Telephone" name="telephone" value="<?= htmlspecialchars($user['telephone']); ?>" />
                                            </div>
                                            <div class="mb-3">
                                                <label for="Address" class="form-label">Address</label>
                                                <input disabled type="text" class="form-control" id="Address" name="address" value="<?= htmlspecialchars($user['address']); ?>" />
                                            </div>
                                            <div class="mb-3">
                                                <label for="Instance" class="form-label">Instance</label>
                                                <select disabled class="form-select" id="Instance" name="instance_id">
                                                    <?php
                                                    if ($user['instance_id'] == '1') {
                                                        echo '<option value=1 selected>PT SELARAS MAKMUR SEJAHTERA</option>';
                                                        echo '<option value=2>PT DIGITAL INOVASI ASIA</option>';
                                                    } else {
                                                        echo '<option value=1>PT SELARAS MAKMUR SEJAHTERA</option>';
                                                        echo '<option value=2 selected>PT DIGITAL INOVASI ASIA</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="Position" class="form-label">Position</label>
                                                <input disabled type="text" class="form-control" id="Position" name="position" value="<?= htmlspecialchars($user['position']); ?>" />
                                            </div>
                                            <div class="mb-3">
                                                <label for="Role" class="form-label">Role</label>
                                                <select disabled class="form-select" id="Role" name="role_id">
                                                    <?php
                                                    if ($user['role_id'] == '1') {
                                                        echo '<option value=1 selected>Admin</option>';
                                                        echo '<option value=2>Employee</option>';
                                                    } else {
                                                        echo '<option value=1>Admin</option>';
                                                        echo '<option value=2 selected>Employee</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="mb-3 d-none">
                                                <input disabled type="id" class="form-control" id="Id" name="id" value="<?= htmlspecialchars($user['id']); ?>" />
                                            </div>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                <i class="bi bi-x-lg"></i>
                                                <span>
                                                    Close
                                                </span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>

                    </tbody>
                </table>

                <nav aria-label="...">
                    <ul class="pagination">
                        <li class="page-item <?= $currentPage <= 1 ? 'disabled' : '' ?>">
                            <a class="page-link" href="<?= BASEURL; ?>/user/indexRestore/<?= max(1, $currentPage - 1); ?>">Previous</a>
                        </li>

                        <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                            <li class="page-item <?= $i == $currentPage ? 'active' : '' ?>">
                                <a class="page-link" href="<?= BASEURL; ?>/user/indexRestore/<?= $i; ?>"><?= $i; ?></a>
                            </li>
                        <?php endfor; ?>

                        <li class="page-item <?= $currentPage >= $totalPages ? 'disabled' : '' ?>">
                            <a class="page-link" href="<?= BASEURL; ?>/user/indexRestore/<?= min($currentPage + 1, $totalPages); ?>">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>

    </div>
</div>