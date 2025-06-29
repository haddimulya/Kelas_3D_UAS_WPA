<?php

namespace App\Controllers;
use App\Models\UserModel;

class User extends BaseController
{
    public function index()
    {
        if (session()->get('role') != 'admin') return redirect()->to('/dashboard');

        $userModel = new UserModel();
        $data['users'] = $userModel->findAll();
        return view('users/index', $data);
    }

    public function tambah()
    {
        return view('users/tambah');
    }

    public function simpan()
    {
        $userModel = new UserModel();
        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role' => $this->request->getPost('role')
        ];
        $userModel->insert($data);
        return redirect()->to('admin/users')->with('success', 'User berhasil ditambahkan');
    }

    public function edit($id)
    {
        $userModel = new UserModel();
        $data['user'] = $userModel->find($id);
        return view('users/edit', $data);
    }

    public function update($id)
    {
        $userModel = new UserModel();
        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'role' => $this->request->getPost('role')
        ];
        $password = $this->request->getPost('password');
        if ($password) {
            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        }
        $userModel->update($id, $data);
        return redirect()->to('admin/users')->with('success', 'User berhasil diupdate');
    }

    public function hapus($id)
    {
        $userModel = new UserModel();
        $userModel->delete($id);
        return redirect()->to('admin/users')->with('success', 'User berhasil dihapus');
    }
}
