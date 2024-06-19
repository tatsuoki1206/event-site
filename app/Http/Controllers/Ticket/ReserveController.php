<?php

namespace App\Http\Controllers\Ticket;

use App\Http\Requests\ReserveFormRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reserve;


class ReserveController extends Controller
{
    public function __construct(Reserve $reserve){
        $this->reserve = $reserve;
    }
    /**
     * 予約フォーム画面を表示
     */ 
    public function showReserveForm() {
        return view( 'users.reserve.reserve_form' );
    }

    /**
     * 予約確認画面に遷移、表示
     * @param App\Http\Requests\ReserveFormRequest $request
     * @return \Illuminate\Http\Response
     */
    public function reserveConfirm(ReserveFormRequest $request) {
        $inputs = $request->all();

        // e-mail、電話番号から既に予約済みかをチェック？
        
        if (is_null($user)){
            // POSTされた値を取得し、確認画面を表示
            return view('user.reserve.reserve_confirm', [
                'inputs' => $inputs,
            ]);
        }

        return back()->withErrors( [
            'danger' => '入力されたお客さまは既に登録済みです。',
        ] )->withInput($inputs);
    }

    /**
     * 予約登録処理をする
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
    */
    public function reserveRegister(Request $request){

        $inputs = $request->all();
        
        // ボタン分岐
        if(!empty($inputs['back'])){
            return redirect()->route('reserve.show')->withInput($inputs);
        }
        
        // 入力内容を取得
        $inputs = $request->all();
        
        // DBに登録
        $return = $this->user->ticketReserve($inputs);
        
        // 予約完了メールを送信
        $to = [
            ['email' => $inputs['email'], ]
        ];
    
        Mail::to($to)->send(new ticketReserve($inputs['name']));
        
        // 登録完了
        return redirect()->route('signup_complete.show')->with( 'success', 'ユーザーの登録が完了しました！' );
    }
}
