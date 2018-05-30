<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Corcel\Model\Post;
use App\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\PartnerTransaction;

class ChartController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

    public function getData(Request $request) {
    	$partner_id = Auth::id();

		// get current month and year
		$month = date('m');
		$year = date('Y');

		if($request->has('month') && $request->has('year')) {
			$month = $request->input('month');
			$year = $request->input('year');
		}

		$orders = PartnerTransaction::where([['partner_id', $partner_id], ['content', 'like', 'From order%'], [DB::raw('month(updated_at)'), $month], [DB::raw('year(updated_at)'), $year]])->select(DB::raw('count(id) as count'), DB::raw('day(updated_at) as day'))->groupBy('day')->get();
		
		return view('chart', ['orders' => $orders]);
    }
}
