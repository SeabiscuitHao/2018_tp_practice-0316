<?php
namespace app\admin\model;
use think\Model;
class Admin extends model
{
  public function addadmin($data)
  {
    if (empty($data) || !is_array($data)) {
      return false;
    }
    if ($this -> save($data)) {
      return true;
    }else {
      return false;
    }
  }

  public function getadmin()
  {
    return $this :: paginate(5);
  }

  public function saveadmin($data,$admins)
  {
    if (!$data['username']) {
      return 2;
    }elseif (!$data['password']) {
      $data['password'] = $admins['password'] ;
    }else {
      $data['password'] = md5($data['password']);
    }
    return $this::update(['username' => $data['username'],'password' => $data['password']],['id' => $data['id']]);
  }

  public function deladmin($id)
  {
    if ($this::destroy($id)) {
      return 1;
    }else {
      return 2;
    }
  }

  public function login($data)
  {
    $admin = Admin::getByName($data['username']);
    if (!$admin) {
      return 1;//用户不存在
    }else {
      if ($admin['password'] == $data['password']) {
        return 2;//登陆成功
      }else {
        return 3;//密码不正确
      }
    }
  }
}
