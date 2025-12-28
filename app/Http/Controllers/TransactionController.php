<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class TransactionController extends Controller
{
    public function index() {
        // if the user is authenticed we can show the users transactions. 
            $authenticated_user = auth()->user(); 
            $user_transactions = $authenticated_user->transactions()->orderBy('occurred_on', 'desc')->paginate(10);
        
            // ->get(); retrieves all the rows, matching the condtion
            // ->paginate(number_of_items); retrieves the amount of items specified in the condition. same as get, but with a limit. 

            return view('user_transactions', compact('user_transactions'));
        }

    public function store(Request $request) {

        $validated_data = $request->validate([
            'type' => 'required|in:income,expense',
            'amount' => 'required|regex:/^\d+(\.\d{1,2})?$/|max:10',
            'category' => 'required|string|max:100',
            'occurred_on' => 'required|date',
            'note' => 'nullable|string|max:500'
        ]);

        $trim_amount = trim($validated_data['amount']); // getting rid of all accidental spaces
        $amount_parts = explode('.', $trim_amount, 2); // splitting string into an array where on the left we have euros, and on left we have cents, bvased on the the dot '.'
        $euro_part =  $amount_parts[0]; // euro part of the array
        $cent_part =  $amount_parts[1] ?? '00'; // cent part of the array, if not present we replace with 00

        if (strlen($cent_part) == 1) { // checking to see the length of the cents side, if only one number , for example 25.5 transform to 2550
            $cent_part .= '0';
        }

        $eurosInt = (int)$euro_part; // trasnforming string cents and euros to integers
        $centsInt = (int)$cent_part;
      
        $amount_cents = $eurosInt * 100 + $centsInt; // convertin the euros and cents into one amount and having a cent total to store in the database. 

        if ($amount_cents < 1){
              throw ValidationException::withMessages([
                'amount' => __('Ievadītā summa nevar būt 0!'),
            ]);
        }

        $authenticated_user = auth()->user(); 

        $authenticated_user->transactions()->create([
            'type' =>  $validated_data['type'],
            'amount_cents' => $amount_cents,
            'category' => $validated_data['category'],
            'occurred_on' => $validated_data['occurred_on'],
            'note' => $validated_data['note']
        ]);

            return redirect('/izdevumi');
    }
             
}

