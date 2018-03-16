<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\model\Admin as AdminModel;
class Login extends Controller
{
  public function index()
  {
    $admin = new AdminModel();
    if (request() -> isPost()) {
      $num = $admin -> login(input('post.'));
      if ($num == 1) {
        $this -> error('该用户不存在！');
      }elseif ($num == 3) {
        $this -> error('用户密码不正确！');
      }elseif ($num == 2) {
        $this -> success('登陆成功！',url('index/index'));
      }
    }
    return $this -> fetch();
  }

}
