<?php

class User extends Controller
{

    public function __construct()
    {
        Middleware::Auth();
    }

    public function index()
    {
        $data['title'] = 'Manage User';
        $data['user'] = !empty(trim($_POST['keyword'] ?? '')) ? UserModel::search($_POST) : UserModel::getAllUser();

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $this->view('templates/header', $data);
        $this->view('templates/sidebar');
        $this->view('templates/navbar');
        $this->view('user/index', $data);
        $this->view('templates/footer');
    }

    public function create()
    {
        $registered = UserModel::createUser($_POST);
        if ($registered) {
            header('Location: ' . BASEURL . '/user');
            Flasher::setFlash('success', 'create', 'success');
        } else {
            header('Location: ' . BASEURL . '/user');
            Flasher::setFlash('failed', 'create', 'danger');
        }
    }

    public function update()
    {
        $updated = UserModel::updateUser($_POST);
        if ($updated) {
            header('Location: ' . BASEURL . '/user');
            Flasher::setFlash('success', 'update', 'success');
        } else {
            header('Location: ' . BASEURL . '/user');
            Flasher::setFlash('failed', 'update', 'danger');
        }
    }

    public function delete($id)
    {
        $deleted = UserModel::deleteUser($id);
        if ($deleted) {
            header('Location: ' . BASEURL . '/user');
            Flasher::setFlash('success', 'delete', 'success');
        } else {
            header('Location: ' . BASEURL . '/user');
            Flasher::setFlash('failed', 'delete', 'danger');
        }
    }

    public function indexRestore()
    {
        $data['title'] = 'Restore User';
        $data['user'] = !empty(trim($_POST['keyword'] ?? '')) ? UserModel::searchDeleted($_POST) : UserModel::getAllDeletedUser();
        $this->view('templates/header', $data);

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $this->view('templates/sidebar');
        $this->view('templates/navbar');
        $this->view('user/restore', $data);
        $this->view('templates/footer');
    }

    public function restore($id)
    {
        $restored = UserModel::restoreUser($id);
        if ($restored) {
            header('Location: ' . BASEURL . '/user/indexRestore');
            Flasher::setFlash('success', 'restore', 'success');
        } else {
            header('Location: ' . BASEURL . '/user/indexRestore');
            Flasher::setFlash('success', 'restore', 'danger');
        }
    }

    public function destroy($id)
    {
        $destroyed = UserModel::destroyUser($id);
        if ($destroyed) {
            header('Location: ' . BASEURL . '/user/indexRestore');
            Flasher::setFlash('success', 'destroy', 'success');
        } else {
            header('Location: ' . BASEURL . '/user/indexRestore');
            Flasher::setFlash('failed', 'destroy', 'danger');
        }
    }

    public function profile($id)
    {
        $data['title'] = 'Profile user';
        $data['user'] = UserModel::getUserById($id);

        $this->view('templates/header', $data);
        $this->view('templates/sidebar');
        $this->view('templates/navbar');
        $this->view('user/profile', $data);
        $this->view('templates/footer');
    }

    public function updateProfile()
    {
        $updated = UserModel::updateUser($_POST);
        if ($updated) {
            header('Location: ' . BASEURL . '/user/profile/' . $_POST['id']);
            Flasher::setFlash('success', 'update', 'success');
        } else {
            header('Location: ' . BASEURL . '/user/profile/' . $_POST['id']);
            Flasher::setFlash('failed', 'update', 'danger');
        }
    }
}
