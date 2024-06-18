<?php

namespace App\Http\Controllers\Ticket;

use App\Http\Requests\ReserveFormRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReserveController extends Controller
{
    /**
     * 予約フォーム画面を表示
     */ 
    public function showReserveForm() {
        return view( 'users.reserve.reserve_form' );
    }
}
