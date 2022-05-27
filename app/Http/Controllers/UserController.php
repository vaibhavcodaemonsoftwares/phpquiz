<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    function customerList()
    {
        $data =  DB::select('select * from users where role_as = 1');
        return view('customers-list',['customers'=>$data]);
    }

    function editCustomers($id)
    {
        $customer =  DB::select('select * from users where id = ?', [$id]);
        return view('customers-edit', compact('customer'));
    }

    function updateCustomers(Request $req , $id)
    {
        $customer =  DB::select('select * from users where id = ?', [$id]);
        $name = $req->input('name');
        $email = $req->input('email');
        $status = $req->input('inspector_status');
        DB::update('update users set name= ?, email= ?, user_status= ? where id = ?',[$name,$email,$status,$id]);
        return redirect()->back()->with('result','Customer details Updated Successfully');
    }

    function deleteCustomers($id)
    {
        DB::delete('delete from users where id = ?',[$id]);
        return redirect()->back()->with('result','Customer deleted Successfully');
    }

    function inspectorList()
    {
        $data =  DB::select('select * from users where role_as = 3');
        return view('inspector-list',['inspectors'=>$data]);
    }


}
