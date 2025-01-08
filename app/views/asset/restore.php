<div id="content">
    <div class="shadow-sm mt-3 mx-3 border rounded-4 bg-light">
        <div class="border-bottom">
            <h5 class="fw-bold p-4 m-0 w-100">Assets Restore</h5>
        </div>
        <div class="p-4">

            <div class="col-6">
                <?php Flasher::flash(); ?>
            </div>
            <div class="mb-3 d-flex flex-column gap-3">
                <div class="w-50">
                    <form action="<?= BASEURL; ?>/asset/indexRestore" method="post" class="d-flex">
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
                            <th scope="col">Name</th>
                            <th scope="col">PIC</th>
                            <th scope="col">Instance</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $totalData = count($data['asset']);
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

                        $assetToShow = array_slice($data['asset'], $startIndex, 10);

                        $i = $startIndex + 1;
                        foreach ($assetToShow as $asset) : ?>
                            <tr class="text-center">
                                <th scope="row"><?= $i++; ?></th>
                                <td class="align-middle"><?= htmlspecialchars($asset['name']); ?></td>
                                <td class="align-middle"><?= htmlspecialchars($asset['user_full_name']); ?></td>
                                <?php
                                if ($asset['instance_id'] == 1) {
                                    echo '<td class="align-middle">PT SELARAS MAKMUR SEJAHTERA</td>';
                                } else {
                                    echo '<td class="align-middle">PT DIGITAL INOVASI ASIA</td>';
                                }
                                ?>
                                <td class="align-middle">
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownAssetMenuButton<?= $asset['id']; ?>"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bi bi-lightning-charge-fill"></i>
                                            <span>
                                                Actions
                                            </span>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownAssetMenuButton<?= $asset['id']; ?>">
                                            <li>
                                                <button type="button" class="dropdown-item text-primary"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#DetailAssetModal<?= $asset['id']; ?>">
                                                    <i class="bi bi-info-circle-fill"></i>
                                                    <span>
                                                        Detail
                                                    </span>
                                                </button>
                                            </li>
                                            <li>
                                                <a class="dropdown-item text-warning"
                                                    href="<?= BASEURL; ?>/asset/restore/<?= $asset['id']; ?>">
                                                    <i class="bi bi-recycle"></i>
                                                    <span>
                                                        Restore
                                                    </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item text-danger"
                                                    href="<?= BASEURL; ?>/asset/destroy/<?= $asset['id']; ?>"
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

                            <div class="modal fade" id="DetailAssetModal<?= $asset['id']; ?>" tabindex="-1" aria-labelledby="DetailAssetModalLabel<?= $asset['id']; ?>" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="DetailAssetModalLabel<?= $asset['id']; ?>">Detail Asset</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="Name" class="form-label">Name</label>
                                                <input disabled type="text" class="form-control" id="Name" name="name" value="<?= htmlspecialchars($asset['name']); ?>" />
                                            </div>
                                            <div class="mb-3">
                                                <label for="PurchaseDate" class="form-label">Purchase Date</label>
                                                <input disabled type="date" class="form-control" id="PurchaseDate" name="purchase_date" value="<?= htmlspecialchars($asset['purchase_date']); ?>" />
                                            </div>
                                            <div class="mb-3">
                                                <label for="WarrantyExpiry" class="form-label">Warranty Expiry</label>
                                                <input disabled type="date" class="form-control" id="WarrantyExpiry" name="warranty_expiry" value="<?= htmlspecialchars($asset['warranty_expiry']); ?>" />
                                            </div>
                                            <div class="mb-3">
                                                <label for="Description" class="form-label">Description</label>
                                                <textarea disabled class="form-control" id="Description" name="description" rows="4"><?= htmlspecialchars($asset['description']); ?></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="PIC" class="form-label">PIC</label>
                                                <select disabled class="form-select" id="PIC" name="user_id">
                                                    <option><?= $asset['user_full_name']; ?></option>
                                                    <?php foreach ($data['user'] as $user) : ?>
                                                        <option value="<?= $user['id']; ?>"><?= $user['full_name']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
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
                            <a class="page-link" href="<?= BASEURL; ?>/asset/index/<?= max(1, $currentPage - 1); ?>">Previous</a>
                        </li>

                        <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                            <li class="page-item <?= $i == $currentPage ? 'active' : '' ?>">
                                <a class="page-link" href="<?= BASEURL; ?>/asset/index/<?= $i; ?>"><?= $i; ?></a>
                            </li>
                        <?php endfor; ?>

                        <li class="page-item <?= $currentPage >= $totalPages ? 'disabled' : '' ?>">
                            <a class="page-link" href="<?= BASEURL; ?>/asset/index/<?= min($currentPage + 1, $totalPages); ?>">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>

    </div>
</div>