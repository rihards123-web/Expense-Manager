<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index() {
        // if the user is authenticed we can show the users transactions. 
            $authenticated_user = auth()->user(); 
            $user_transactions = $authenticated_user->transactions()->get();
            return view('user_transactions', compact('user_transactions'));
        }
             
}

