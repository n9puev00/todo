<?php
namespace App\Controllers;

const REGISTER_TITLE = 'Todo - Register';
const LOGIN_TITLE = 'Todo - Login';
use App\Models\LoginModel;

class Login extends BaseController
{
    public function __construct(){
        $session = \Config\Services::session();
        $session->start();
    }
    
    public function index()
    {
        $data['title'] = 'Todo - login';
        echo view('templates/header', $data);
        echo view('login/login', $data);
        echo view('templates/footer', $data);
    }

    public function register(){
        $data['title'] = REGISTER_TITLE;
        echo view('templates/header', $data);
        echo view('login/register', $data);
        echo view('templates/footer');
    }

    public function registration() {
        $model = new LoginModel();

        if (!$this->validate([
            'user' => 'required|min_length[8]|max_length[30]',
            'password' => 'required|min_length[8]|max_length[30]',
            'confirmpassword' => 'required|min_length[8]|max_length[30]|matches[password]',
        ])){
            echo view('templates/header' , ['title' => REGISTER_TITLE]);
            echo view('login/register');
            echo view('templates/footer');
        }
        else {
            $model->save([
                'username' => $this->request->getVar('user'),
                'password' => password_hash($this->request->getVar('password'),PASSWORD_DEFAULT),
                'firstname' => $this->request->getVar('firstname'),
                'lastname' => $this->request->getVar('lastname')
            ]);
            return redirect('login');
        }
    }

    public function check() {
        $model = new LoginModel();

        if (!$this->validate([
            'user' => 'required|min_length[8]|max_length[30]',
            'password' => 'required|min_length[8]|max_length[30]',
        ])){
            echo view('templates/header', ['title' => LOGIN_TITLE]);
            echo view('login/login');
            echo view('templates/footer');
        }
        else {
            $user = $model->check(
            $this->request->getVar('user'),
            $this->request->getVar('password')
        );

            if ($user) {
                $_SESSION['user'] = $user;
                return redirect('todo');
            }
            else {
                return redirect('login');
            }
        }
    }
}
?>