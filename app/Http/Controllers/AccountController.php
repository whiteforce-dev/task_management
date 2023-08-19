<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;

class AccountController extends Controller
{
    public function accountCreate(){
        return view('account.create');
    }
    Public function CreateAccount(Request $request){
        $account = New Account();
        $account->name = $request->account_name;
        $account->save();
        return view('account.create');
    }
    Public function accountList(){
        $accountlist = Account::get();
        return view('account.accountlist', compact('accountlist'));
    }
    Public function accountEditpage($id){
        $account = Account::find($id);
        return view('account.edit', compact('account'));
    }
    Public function editAccount(Request $request, $id){
        $account = Account::find($id);
        $account->name = $request->account_name;
        $account->save();  
        return redirect('account-list')->with(['success' => 'You are successfull updated.']);
    }
    Public function AccountDelete($id){
        $account = Account::find($id);
        $account->delete();  
        return redirect('account-list')->with(['success' => 'You are successfull updated.']);
    }
}
