<?php

namespace App\Controllers\Http;

use App\Models\User;
use App\MVC\Controller;
use App\MVC\Model;

class UserController extends Controller
{

    public function register()
    {
        return view('user/register', [
            'title' => 'Register page'
        ]);
    }
    public function store()
    {
        $user = new User();
        dump($user->validate());
        dump($user->getErrors());
    }

    public function login()
    {
        return view('user/login', [
            'title' => 'Login page'
        ]);
    }

    public function index()
    {

       // return view('home',[]);
        /* $users = db()->query("select * from users")->get();
         dump($users);

         $users = db()->query("select * from users")->getAssoc();
         dump($users);*/

        /*  $users = db()->query("select * from users")->getOne();
          dump($users);*/
        /*$users = db()->query("select count(*) from users")->getColumn();
        dump($users);*/

        /* $users = db()->findAll('phones');
         dump($users);*/

        /* $user = db()->findOne('users', 3);
         dump($user);*/

        /*$user = db()->findOrFail('users', 7);
        dump($user);*/
        /* db()->query("insert into phones (phone_number,user_id) values (?,?)", ['8963555111', 2]);
         dump(db()->getInsertID());*/

        /*db()->query("delete from phones where id > ?", [3]);
        dump(db()->rowCount());*/
        /* try {
             db()->beginTransaction();
             db()->query("insert into users (name,em1ail) values (?,?)", ['asddsdaasd', 'asdasdasdads']);
             db()->query("insert into phones (phone_number,user_id) values (?,?)", ['8963555111', 5]);
             db()->commitTransaction();
         } catch (\PDOException $e){
             db()->rollbackTransaction();


         }*/


        //db()->create('users',['name'=>'fssdf','email'=>'asassas@asasas.ss']);

       // dump(User::query());

        /*$users = User::findAll();
        dump($users);*/

      /*  $user = new User();
        $user = $user->findOne('name','name');*/

    }
}