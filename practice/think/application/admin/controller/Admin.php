<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use app\admin\model\Admin as AdminModel;
class Admin extends Controller
{
  public function lst()
  {
    $admin = new AdminModel();
    $res = $admin -> getadmin();
    $this -> assign('res',$res);
    // $this -> assign()
    return $this -> fetch('lst');
  }

  public function add()
  {
    // $data = input('post.');
    // if (request() -> isPost()) {
    //   $res = db('admin') -> insert($data);
    //   if ($res) {
    //     $this -> success('添加管理员成功！','admin/lst');
    //   }else{
    //     $this -> error('添加管理员失败');
    //   }
    //   return;
    // }
    if (request() -> isPost()) {
      $admin = new AdminModel();
      if ($admin -> addadmin(input('post.'))) {
        $this -> success('添加管理员成功！','lst');
      }else{
        $this -> error('添加管理员失败!');
      }
    }
    return $this -> fetch('add');
  }

  public function edit($id)
  {
    $admins = db('admin') -> find($id);
    $this -> assign('admin',$admins);
    if (request() -> isPost()) {
      $data = input('post.');

      // $res = db('admin') -> update($data);
      $admin    = new AdminModel();
      $savenum  = $admin -> saveadmin($data,$admins);
      if ($savenum !== '2') {
        $this -> success('修改管理员信息成功！','lst');
      }else {
        $this -> error('修改管理员信息失败！');
      }
    }
    return $this -> fetch('edit');
  }

  public function del($id)
  {
    $admin = new AdminModel();
    $delnum = $admin -> deladmin($data);
    if ($delnum == 1) {
      $this -> success('删除管理员成功！','lst');
    }else {
      $this -> error('删除管理员失败！');
    }
  }

}
