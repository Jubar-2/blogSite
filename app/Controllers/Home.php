<?php

namespace App\Controllers;

use App\Models\CommentModel;
use App\Models\PostModel;
use App\Models\UserModel;
use Config\Services;

class Home extends BaseController
{
    protected $helpers = ['usefull'];
    protected $postModel;
    protected $commentModel;
    protected $userModel;
    function __construct()
    {
        $this->postModel = new PostModel();
        $this->commentModel = new CommentModel();
        $this->userModel = new UserModel();
        $session = Services::session();
        if ($session->has('user')) {
            $this->userName = $session->get('user')[0]['userName'];
        } else {
            $this->userName;
        }
    }
    public function index()
    {
        $data = $this->postModel->select('post.userName ,post.title,text,post.created_at,fast_name,Last_name,image,comment,post_id')->join('users', 'post.userName=users.userName')->orderBy('post_id', 'DESC')->limit(5)->find();

        $userName = [
            'userName' => $this->userName,
            'data' => $data,
            'title' => 'Home'
        ];
        return view('home', $userName);
    }

    public function about()
    {
        $userName = ['userName' => $this->userName, 'title' => 'about us'];
        return view('about', $userName);
    }

    public function blogEntries()
    {

        $data = $this->postModel->select('post.userName ,post.title,text,post.created_at,fast_name,Last_name,image,post_id,comment')->join('users', 'post.userName=users.userName')->orderBy('post_id', 'DESC')->paginate();
        $userName = [
            'userName' => $this->userName,
            'data' => $data,
            'title' => 'Blog Entries'
        ];
        return view('blog_entries', $userName);
    }

    public function postDetails($id)
    {
        $data = $this->postModel->select('post.title,post.created_at,post_id')->join('users', 'post.userName=users.userName')->orderBy('post_id', 'DESC')->find();

        $singelData = $this->postModel->select('post.userName ,post.title,text,post.created_at,fast_name,Last_name,image,comment,post_id')->join('users', 'post.userName=users.userName')->orderBy('post_id', 'DESC')->where('post_id', $id)->find();

        $dataComment = $this->commentModel->select('comment.userName,comment.created_at,fullName,comment,profilePicture')->join('users', 'comment.userName=users.userName')->orderBy('comment_id', 'DESC')->where('post', $id)->find();

        $userName = [
            'userName' => $this->userName,
            'singelData' => $singelData,
            'data' => $data,
            'dataComment' => $dataComment,
            'title' => 'POST details'
        ];
        return view('post_details', $userName);
    }
    public function contactUs()
    {
        $userName = ['userName' => $this->userName, 'title' => 'contact Us'];
        return view('contact', $userName);
    }
    public function login()
    {
        $userName = ['userName' => $this->userName, 'title' => 'Login'];
        return view('login', $userName);
    }
    public function registration()
    {
        $userName = ['userName' => $this->userName, 'title' => 'registration'];
        return view('registration', $userName);
    }
    public function profile($userName)
    {
        $data = $this->userModel->select('post.userName ,post.title,text,post.created_at,fast_name,Last_name,image,profilePicture,comment,post_id')->where("users.userName", $userName)->join('post', 'post.userName=users.userName', 'left')->orderBy('post_id', 'DESC')->find();

        $userName = [
            'userName' => $userName,
            'data' => $data,
            'title' => 'profile'
        ];
        return view('profile', $userName);
    }
    public function profileOption($profilename, $optionName)
    {
        $data = $this->userModel->select('post.userName ,post.title,text,post.created_at,fast_name,Last_name,image,profilePicture,comment,gender,birthOfDate,district,division,country,email,post_id')->where("users.userName", $profilename)->join('post', 'post.userName=users.userName', 'left')->orderBy('post_id', 'DESC')->find();

        $optionName = [
            'optionName' => $optionName,
            'userName' => $profilename,
            'data' => $data,
            'title' => 'profile'
        ];
        return view('profile', $optionName);
    }
    public function verify($userName)
    {
        $userName = ['userName' => $userName, 'title' => 'Verify'];
        return view('verifyOtp', $userName);
    }
    public function forgetPassword()
    {
        $title = ['title' => 'Verify'];
        return view('forgetPassword', $title);
    }
    public function verifyEmail($userName)
    {
        $userName = ['userName' => $userName, 'title' => ''];
        return view('varifyEmail', $userName);
    }
    public function newPassword($userName)
    {
        $userName = ['userName' => $userName, 'title' => ''];
        return view('changePassword', $userName);
    }
}
