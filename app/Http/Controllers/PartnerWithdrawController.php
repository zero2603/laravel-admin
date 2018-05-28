<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PartnerWithdraw;
use App\PartnerTransaction;
use Illuminate\Support\Facades\Auth;

class PartnerWithdrawController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function create() {
    	$withdraw = PartnerWithdraw::where('partner_id', Auth::id())->first();
    	if(count($withdraw) != 0) {
    		return redirect('/withdraw/'.Auth::id());
    	}
    	return view('withdraw.create');
    }

    public function store(Request $request) {
    	$withdraw = new PartnerWithdraw([
    		'partner_id' => Auth::id(),
    		'method' => $request->input('method'),
    		'account_name' => $request->input('account_name'),
    		'account_number' => $request->input('account_number'),
    		'bank' => $request->input('bank'),
    		'phone' => $request->input('phone'),
     	]);
     	$withdraw->save();
     	return redirect('/withdraw/'.Auth::id());
    }

    public function show($partner_id) {
    	$withdraw = PartnerWithdraw::where('partner_id', $partner_id)->first();
    	return view('withdraw.show', ['withdraw' => $withdraw]);
    }    

    public function update($partner_id, Request $request) {
    	$withdraw = PartnerWithdraw::where('partner_id', $partner_id)->first();
    	$withdraw->update($request->all());
    	return redirect('/withdraw/'.$partner_id);
    }

    public function balanceDetail() {
        $all_transactions = PartnerTransaction::where('partner_id', Auth::id())->get();
        $available = 0; // current available in balance
        $paid = 0;  //  
        $pending = 0; 
        foreach($all_transactions as $transaction) {
            $available += $transaction->balance_change;
            if($transaction->content == 'withdraw' && $transaction->status == 'completed') {
                $paid += $transaction->balance_change;
            }
            if($transaction->content == 'withdraw' && $transaction->status == 'pending') {
                $pending += $transaction->balance_change;
            }
        }
        $transactions = PartnerTransaction::where('partner_id', Auth::id())->orderBy('id', 'desc')->paginate(10);
        $info = PartnerWithdraw::where('partner_id', Auth::id())->get();
        return view('withdraw.balance-detail', ['transactions' => $transactions, 'available' => $available, 'paid' => $paid, 'pending' => $pending, 'info' => $info]);
    }

    public function makeWithdraw(Request $request) {
        $available = $request->input('total');
        $info = PartnerWithdraw::where('partner_id', Auth::id())->first();
        $transaction = new PartnerTransaction([
            'partner_id' => Auth::id(),
            'balance_change' => (-1)*$available,
            'status' => 'pending',
            'content' => 'withdraw',
            'note' => 'Withdraw method: '.$info->method.'<br>Account Name: '.$info->account_name.'<br>Account Number: '.$info->account_number.'<br>Contact Phone: '.$info->phone,   
        ]);
        $transaction->save();
        return redirect('/balance-detail');
    }
}
