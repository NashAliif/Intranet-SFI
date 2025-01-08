<?php

class Asset extends Controller
{

    public function __construct()
    {
        Middleware::Auth();
    }

    public function index()
    {
        $data['title'] = 'Manage Asset';
        $data['asset'] = !empty(trim($_POST['keyword'] ?? '')) ? AssetModel::search($_POST) : AssetModel::getAllAsset();
        $data['user'] = UserModel::getAllUser();

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $this->view('templates/header', $data);
        $this->view('templates/sidebar');
        $this->view('templates/navbar');
        $this->view('asset/index', $data);
        $this->view('templates/footer');
    }

    public function create()
    {
        $registered = AssetModel::createAsset($_POST);
        if ($registered) {
            header('Location: ' . BASEURL . '/asset');
            Flasher::setFlash('success', 'create', 'success');
        } else {
            header('Location: ' . BASEURL . '/asset');
            Flasher::setFlash('failed', 'create', 'danger');
        }
    }

    public function update()
    {
        $updated = AssetModel::updateAsset($_POST);
        if ($updated) {
            header('Location: ' . BASEURL . '/asset');
            Flasher::setFlash('success', 'update', 'success');
        } else {
            header('Location: ' . BASEURL . '/asset');
            Flasher::setFlash('failed', 'update', 'danger');
        }
    }

    public function delete($id)
    {
        $deleted = AssetModel::deleteAsset($id);
        if ($deleted) {
            header('Location: ' . BASEURL . '/asset');
            Flasher::setFlash('success', 'delete', 'success');
        } else {
            header('Location: ' . BASEURL . '/asset');
            Flasher::setFlash('failed', 'delete', 'danger');
        }
    }

    public function indexRestore()
    {
        $data['title'] = 'Restore Asset';
        $data['asset'] = !empty(trim($_POST['keyword'] ?? '')) ? AssetModel::searchDeleted($_POST) : AssetModel::getAllDeletedAsset();

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $this->view('templates/header', $data);
        $this->view('templates/sidebar');
        $this->view('templates/navbar');
        $this->view('asset/restore', $data);
        $this->view('templates/footer');
    }

    public function restore($id)
    {
        $restored = AssetModel::restoreAsset($id);
        if ($restored) {
            header('Location: ' . BASEURL . '/asset/indexRestore');
            Flasher::setFlash('success', 'restore', 'success');
        } else {
            header('Location: ' . BASEURL . '/asset/indexRestore');
            Flasher::setFlash('success', 'restore', 'danger');
        }
    }

    public function destroy($id)
    {
        $destroyed = AssetModel::destroyAsset($id);
        if ($destroyed) {
            header('Location: ' . BASEURL . '/asset/indexRestore');
            Flasher::setFlash('success', 'destroy', 'success');
        } else {
            header('Location: ' . BASEURL . '/asset/indexRestore');
            Flasher::setFlash('failed', 'destroy', 'danger');
        }
    }

    public function profile($id)
    {
        $data['title'] = 'Profile Asset';
        $data['asset'] = AssetModel::getAssetById($id);

        $this->view('templates/header', $data);
        $this->view('templates/sidebar');
        $this->view('templates/navbar');
        $this->view('asset/profile', $data);
        $this->view('templates/footer');
    }

    public function updateProfile()
    {
        $updated = AssetModel::updateAsset($_POST);
        if ($updated) {
            header('Location: ' . BASEURL . '/asset/profile/' . $_POST['id']);
            Flasher::setFlash('success', 'update', 'success');
        } else {
            header('Location: ' . BASEURL . '/asset/profile/' . $_POST['id']);
            Flasher::setFlash('failed', 'update', 'danger');
        }
    }
}
