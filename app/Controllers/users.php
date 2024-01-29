<?php

namespace App\Controllers;

use App\Entities\User;
use App\Models\CommentModel;
use App\Models\otpModel;
use App\Models\PostModel;
use App\Models\Recovery;
use App\Models\UserModel;
use CodeIgniter\I18n\Time;
use Error;

class Users extends BaseController

{
    protected $helpers = ['usefull'];
    private $session;
    private $userModel;
    private $otpModel;
    private $recovery;
    private $postModel;
    private $commentModel;
    function __construct()
    {
        $this->userModel = new UserModel();
        $this->otpModel = new OtpModel();
        $this->recovery = new Recovery();
        $this->session =  \config\Services::session();
        $this->postModel = new PostModel();
        $this->commentModel = new CommentModel();
    }
    private function sentEmail($address, $code)
    {
        $email = \Config\Services::email();

        $email->setFrom('tamimsawonislam@gmail.com');
        $email->setTo($address);
        // $email->setCC('another@another-example.com');
        // $email->setBCC('them@their-example.com');

        $email->setSubject('Email Test');
        $email->setMessage('Wellcome our site youre otp code is ' . $code);

        if ($email->send()) {
            return true;
        } else {
            return false;
        }
    }
    public function usersRegistration()
    {
        $postData = $this->request->getPost();
        $time = Time::now('asia/Dhaka', 'en_US');
        $postData['created_at'] = $time;
        if ($this->userModel->insert($postData)) {
            $otpNumber =  rand(500000, 600000);
            $usfullData = [
                'userid' => $this->userModel->insertID(),
                'user_Name' => $postData['userName'],
                'otp' => $otpNumber
            ];

            if ($this->otpModel->insert($usfullData)) {

                if ($this->sentEmail($postData['email'], $usfullData['otp'])) {
                    $this->db->transCommit();
                    $data = $this->userModel->where('user_id', $usfullData['userid'])->find();
                    $this->session->set('user', $data);
                    return redirect()->to(base_url('verify/' . $data[0]['userName']));
                } else {
                    $this->db->transRollback();
                    $this->session->setFlashdata(['mass' => "Your Email Address Is In Vaild Please Inter A Valid Email"]);
                    return redirect()->to(base_url('registration'));
                }
            } else {
                $this->db->transRollback();
                $this->session->setFlashdata(['mass' => " Something is rong"]);
                return redirect()->to(base_url('registration'));
            };
        } else {
            $this->db->transRollback();
            $this->session->setFlashdata(['Errmass' => $this->userModel->errors()]);
            return redirect()->to(base_url('registration'));
        }
    }

    public function emailVerify($username)
    {

        $getPost = $this->request->getPost()["otp"];
        $requireOtp = $this->otpModel->getWhere(["user_Name" => $username]);
        $requireId = $requireOtp->getRow()->userid;

        if ($requireOtp->getRow()->otp == $getPost) {
            if ($this->userModel->update($requireId, ['position' => 'verify'])) {
                $this->otpModel->where('user_Name', $username)->delete();
                return redirect()->to(base_url('profile/' . $username));
            } else {
                return redirect()->to(base_url('verify/' . $username));
            }
        } else {
            return redirect()->to(base_url('verify/' . $username));
        }
    }

    public function login()
    {
        $getPost = $this->request->getPost();
        $userAddress = $getPost['userAddress'];
        $profile = $this->userModel->where("email ='$userAddress'  OR userName = '$userAddress'")
            ->find();

        if ($profile) {

            if (password_verify($getPost['password'], $profile[0]['password'])) {
                $this->session->set('user', $profile);

                if ($this->recovery->getWhere(['user_Name' => $profile[0]['userName']])->getRow()) {
                    $this->recovery->where('user_Name', $profile[0]['userName'])->delete();
                }
                $this->session->setFlashdata(['mass' => "Wellcome "]);
                return redirect()->to(base_url('profile/' . $profile[0]['userName']));
            } else {
                $this->session->setFlashdata(['Errmass' => "Your password is not match"]);
                return redirect()->to(base_url('login'));
            }
        } else {
            $this->session->setFlashdata(['Errmass' => "Your email or user-name and password is not match"]);

            return redirect()->to(base_url('login'));
        }
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to(base_url('login'));
    }

    public function codeResent($username)
    {
        $requireOtp = $this->otpModel->getWhere(["user_Name" => $username])->getRow();
        $requireEmail = $this->userModel->select('email')->getWhere(["userName" => $username])->getRow();
        if ($requireOtp) {
            $userid = $requireOtp->userid;
            $otpNumber =  rand(500000, 600000);

            if ($this->otpModel->update($userid, ['otp' => $otpNumber])) {

                if ($newOtp = $this->otpModel->getWhere(["user_Name" => $username])->getRow()) {
                    if ($this->sentEmail($requireEmail->email, $newOtp->otp)) {
                        return redirect()->to(base_url('verify/' . $username));
                    }
                }
            }
        }
    }

    public function fogetPassword()
    {
        $postEmail = $this->request->getPost()["email"];
        $otpNumber =  rand(500000, 600000);
        $findData = $this->userModel->getWhere(["email" => $postEmail])->getRow();

        if ($findData) {
            $verifyData = [
                "userid" => $findData->user_id,
                "user_Name" => $findData->userName,
                'otp' => $otpNumber
            ];
            if ($this->otpModel->getWhere(["user_Name" => $findData->userName])->getRow()) {

                if ($this->otpModel->update($findData->user_id, ['otp' => $otpNumber])) {

                    if ($newOtp = $this->otpModel->getWhere(["user_Name" => $findData->userName])->getRow()) {
                        if ($requireEmail = $this->userModel->select('email')->getWhere(["userName" => $findData->userName])->getRow()) {
                            if ($this->sentEmail($requireEmail->email, $newOtp->otp)) {
                                return redirect()->to(base_url('verifyEmail/' . $findData->userName));
                            } else {
                                return redirect()->to(base_url('forgetPassword'));
                            }
                        } else {
                            return redirect()->to(base_url('forgetPassword'));
                        }
                    } else {
                        return redirect()->to(base_url('forgetPassword'));
                    }
                } else {
                    var_dump($findData);
                    exit;
                    return redirect()->to(base_url('forgetPassword'));
                }
            } else {

                if ($this->otpModel->insert($verifyData)) {

                    if ($newOtp = $this->otpModel->getWhere(["user_Name" => $findData->userName])->getRow()) {
                        if ($requireEmail = $this->userModel->select('email')->getWhere(["userName" => $findData->userName])->getRow()) {
                            if ($this->sentEmail($requireEmail->email, $newOtp->otp)) {
                                return redirect()->to(base_url('verifyEmail/' . $findData->userName));
                            } else {
                                return redirect()->to(base_url('forgetPassword'));
                            }
                        } else {
                            return redirect()->to(base_url('forgetPassword'));
                        }
                    } else {
                        return redirect()->to(base_url('forgetPassword'));
                    }
                } else {
                    return redirect()->to(base_url('forgetPassword'));
                }
            }
        } else {
            return redirect()->to(base_url('forgetPassword'));
        }
    }

    public function verifyEmail_logic($username)
    {

        $getPost = $this->request->getPost()["otp"];
        $requireOtp = $this->otpModel->getWhere(["user_Name" => $username]);
        if ($otpData = $requireOtp->getRow()) {
            if (property_exists($otpData,  'userid')) {
                $requireId = $otpData->userid;
                if ($otpData->otp == $getPost) {

                    if ($this->userModel->update($requireId, ['position' => 'verify'])) {
                        $data = [
                            'userid' => $requireId,
                            'user_Name' => $otpData->user_Name,
                            'license' => true
                        ];
                        if ($this->recovery->insert($data)) {
                            $this->otpModel->where('user_Name', $username)->delete();
                            return redirect()->to(base_url('newPassword/' . $username));
                        } else {
                            return redirect()->to(base_url('verifyEmail/' . $username));
                        }
                    } else {
                        return redirect()->to(base_url('verifyEmail/' . $username));
                    }
                } else {
                    return redirect()->to(base_url('verifyEmail/' . $username));
                }
            } else {
                return redirect()->to(base_url('verifyEmail/' . $username));
            }
        } else {
            return redirect()->to(base_url('verifyEmail/' . $username));
        }
    }
    public function newPasswod($username)
    {
        $postData = $this->request->getPost();
        $userData = $this->userModel->getWhere(["userName" => $username])->getRow();
        if ($userData) {
            if ($this->userModel->update($userData->user_id, $postData)) {
                $this->recovery->where('user_Name', $username)->delete();
                return redirect()->to(base_url('login'));
            } else {
                return redirect()->to(base_url('newPassword/' . $username));
            }
        } else {
            return redirect()->to(base_url('newPassword/' . $username));
        }
    }

    public function changePassword()
    {
        $session = session();
        $sessionData = $session->get('user')[0]['userName'];
        $postData = $this->request->getPost();
        $data = $this->userModel->getWhere(['userName' => $sessionData])->getRow();

        if ($data) {
            $verify = password_verify($postData['oldPassword'], $data->password);
            if ($verify) {
                if ($this->userModel->whereIn('userName', [$sessionData])->set('password', $postData['password'])->update()) {
                    $session->setFlashdata(['mass' => "Password change successfully"]);
                    return redirect()->to('profile/' . $sessionData);
                } else {
                    $session->setFlashdata(['Errmass' => "Password is not changed please try agan"]);
                }
            } else {
                $session->setFlashdata(['Errmass' => "Old password is not match please try to write password"]);
                return redirect()->to('profile/' . $sessionData . "/setting");
            }
        } else {
            $session->setFlashdata(['Errmass' => "samthing is woring please refresh your browser and try again"]);
            return redirect()->to('profile/' . $sessionData . "/setting");
        }
    }

    public function post()
    {
        $session = session();
        $getPostData = $this->request->getPost();
        $file = $this->request->getFile('image');
        $sessionData = $session->get('user')[0];
        $userName = $sessionData['userName'];

        if ($file->getClientName()) {
            $postData = [
                'userName' => $sessionData['userName'],
                'title' => $getPostData['title'],
                'text' => $getPostData['text'],
                'image' => $file->getRandomName(),
                'created_at' => Time::now('asia/Dhaka', 'en_US')
            ];
            if ($file->getMimeType() === 'image/png' || $file->getMimeType() === 'image/webp' || $file->getMimeType() === 'image/jpeg' || $file->getMimeType() === 'image/jpg') {
                if ($file->getSizeByUnit('mb') < 2) {
                    if ($file->move("images/$userName/post", $postData['image'])) {
                        if ($this->postModel->insert($postData)) {
                            return redirect()->to(base_url('home'));
                        } else {
                            return redirect()->to(base_url('profile/' .  $userName));
                        }
                    } else {
                        return redirect()->to(base_url('profile/' .  $userName));
                    }
                } else {
                    return redirect()->to(base_url('profile/' .  $userName));
                }
            }
        } else {
            $postData = [
                'userName' => $sessionData['userName'],
                'title' => $getPostData['title'],
                'text' => $getPostData['text'],
                'created_at' => Time::now('asia/Dhaka', 'en_US')
            ];
            if (!$this->postModel->insert($postData)) {
                return redirect()->to(base_url('profile/' .  $userName));
            } else {
                return redirect()->to(base_url('home'));
            }
        }
    }

    public function comment($id)
    {
        $session = session()->get('user');
        $time = Time::now('asia/Dhaka', 'en_US');
        if (loggedIn()) {
            $commentData = [
                'post' => $id,
                'fullName' => $session[0]['fast_name'] . $session[0]['Last_name'],
                'userName' => $session[0]['userName'],
                'comment' => $this->request->getPost('comment'),
                'created_at' =>  $time
            ];

            if ($this->commentModel->insert($commentData)) {
                $comment = $this->postModel->select('comment')->where('post_id', $id)->find();
                $this->postModel->update($id, ['comment' => $comment[0]->comment + 1]);
                return redirect()->to(base_url('postDetails/' . $id));
            }
            return redirect()->to(base_url('postDetails/' . $id));
        } else {
            return redirect()->to(base_url('postDetails/' . $id));
        }
    }
    public function profilePic($userName)
    {

        $session = session()->get('user');
        $file = $this->request->getFile('profilePicture');
        if (loggedIn()) {
            if ($session[0]["userName"] === $userName) {
                if ($file->getClientName()) {
                    $postData = [
                        'profilePicture' => $file->getRandomName(),
                    ];
                    if ($file->getMimeType() === 'image/png' || $file->getMimeType() === 'image/webp' || $file->getMimeType() === 'image/jpeg' || $file->getMimeType() === 'image/jpg') {
                        if ($file->getSizeByUnit('mb') < 2) {
                            if ($file->move("images/$userName/profile", $postData['profilePicture'])) {
                                if ($this->userModel->whereIn('userName', [$userName])->set('profilePicture', $postData['profilePicture'])->update()) {
                                    return redirect()->to(base_url('profile/' .  $userName));
                                } else {
                                    echo 'not inserted';
                                    exit;
                                    return redirect()->to(base_url('profile/' .  $userName));
                                }
                            } else {
                                return redirect()->to(base_url('profile/' .  $userName));
                            }
                        } else {
                            return redirect()->to(base_url('profile/' .  $userName));
                        }
                    }
                } else {
                    return redirect()->to(base_url('profile/' .  $userName));
                }
            } else {
                return redirect()->to(base_url('profile/' .  $userName));
            }
        } else {
            return redirect()->to(base_url('profile/' .  $userName));
        }
    }
}
