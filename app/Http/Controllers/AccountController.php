<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class AccountController extends Controller
{
    public function index() {
        $accountList = User::getAccountList();

        $this->data['accountList'] = $accountList;

        return view('account.index', $this->data);
    }
}
