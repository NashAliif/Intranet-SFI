<div id="content">
    <div class="shadow-sm mt-3 mx-3 border rounded-4 bg-light">
        <div class="border-bottom">
            <h5 class="p-4 m-0 w-100">Profile Management</h5>
        </div>
        <div class="p-4">

            <div class="col-6">
                <?php Flasher::flash(); ?>
            </div>
            <?php $user = $data['user']; ?>
            <form action="<?= BASEURL; ?>/user/updateProfile" method="post">
                <div class="mb-3">
                    <label for="Email" class="form-label">Email</label>
                    <input type="text" class="form-control" id="Email" name="email" value="<?= htmlspecialchars($user['email']); ?>" />
                </div>
                <div class="mb-3">
                    <label for="Password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="Password" name="password" placeholder="Enter new password" />
                </div>
                <div class="mb-3">
                    <label for="FullName" class="form-label">Full Name</label>
                    <input type="text" class="form-control" id="FullName" name="full_name" 
                           value="<?= htmlspecialchars($user['full_name'] ?? ''); ?>" />
                </div>
                <div class="mb-3">
                    <label for="Telephone" class="form-label">Telephone</label>
                    <input type="text" class="form-control" id="Telephone" name="telephone" 
                           value="<?= htmlspecialchars($user['telephone'] ?? ''); ?>" />
                </div>
                <div class="mb-3">
                    <label for="Address" class="form-label">Address</label>
                    <input type="text" class="form-control" id="Address" name="address" 
                           value="<?= htmlspecialchars($user['address'] ?? ''); ?>" />
                </div>
                <div class="mb-3">
                    <label for="Instance" class="form-label">Instance</label>
                    <select class="form-select" id="Instance" name="instance_id">
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
                    <input type="text" class="form-control" id="Position" name="position" value="<?= htmlspecialchars($user['position']); ?>" />
                </div>
                <div class="mb-3">
                    <label for="Role" class="form-label">Role</label>
                    <select class="form-select" id="Role" name="role_id">
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
                    <input type="id" class="form-control" id="Id" name="id" value="<?= htmlspecialchars($user['id']); ?>" />
                </div>
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </form>
        </div>

    </div>
</div>