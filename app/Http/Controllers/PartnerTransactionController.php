<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PartnerTransaction;

class PartnerTransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index() {
    	$transactions = PartnerTransaction::paginate(10);
    	return view('admin.transaction.index', ['transactions' => $transactions]);
    }

    public function show($id) {
    	$transaction = PartnerTransaction::find($id);
    	return view('admin.transaction.show', ['transaction' => $transaction]);
    }

    public function update($id, Request $request) {
    	$transaction = PartnerTransaction::find($id);
    	$transaction->status = $request->status;
    	$transaction->update();
    	return redirect()->back();
    }

    public function destroy($id) {
    	PartnerTransaction::find($id)->delete();
    	return redirect('/admin/transactions');
    }
}
