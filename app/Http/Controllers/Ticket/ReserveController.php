<?php

namespace App\Http\Controllers\Ticket;

use App\Http\Requests\ReserveFormRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reserve;
use App\Mail\TicketReserve;
Use Mail;

class ReserveController extends Controller
{
    public function __construct(Reserve $reserve){
        $this->reserve = $reserve;
    }
    /**
     * 予約管理画面を表示
     */ 
    public function showReserveList() {
        $reserves = Reserve::all();
        
        return view( 'admin.reserve.reserve_list',['reserves' => $reserves]);
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
        
        // 入力データを取得
        $inputs = $request->all();
        
        // 電話番号
        $inputs['tel'] = $inputs['tel1'].$inputs['tel2'].$inputs['tel3'];

        // イベント名、e-mail、電話番号から既に予約済みかをチェック？
        $reserve = $this->reserve->getUserByInput($inputs['event_name'], $inputs['tel'], $inputs['email']);
        
        if (is_null($reserve)){
            // POSTされた値を取得し、確認画面を表示
            return view('users.reserve.reserve_confirm', [
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

        // 入力内容を取得
        $inputs = $request->all();
        
        // ボタン分岐
        if(!empty($inputs['back'])){
            return redirect()->route('reserve_form.show')->withInput($inputs);
        }
                
        // DBに登録、予約変更・取消URL用のidを取得
        $id = $this->reserve->ticketReserve($inputs);
        
        /**
         * 予約完了メールを送信
         */
        $to = [
            ['email' => $inputs['email'], ]
        ];
        // メール用の宛名（姓 名）
        $name = $inputs['last_name']." ".$inputs['first_name'];
        
        Mail::to($to)->send(new TicketReserve($id, $name));
        
        // 登録完了
        return redirect()->route('reserve_complete.show')->with( 'success', '予約が完了しました！' );
    }

    /**
     * 予約編集フォーム画面を表示
     */ 
    public function showEditReserveForm($id) {

        $inputs = $this->reserve->getReserveById($id);
        
        return view( 'users.reserve.edit.editReserve_form', ['inputs' => $inputs] );
    }

    /**
     * 予約編集確認画面に遷移、表示
     * @param App\Http\Requests\ReserveFormRequest $request
     * @return \Illuminate\Http\Response
     */
    public function editReserveConfirm(ReserveFormRequest $request) {
        
        // 入力データを取得
        $inputs = $request->all();
        
        // 電話番号
        $inputs['tel'] = $inputs['tel1'].$inputs['tel2'].$inputs['tel3'];

        //確認画面を表示
        return view('users.reserve.edit.editReserve_confirm', [
                'inputs' => $inputs,
            ]);
    }

    /**
     * 予約編集登録処理をする
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
    */
    public function editReserveRegister(Request $request){

        // 入力内容を取得
        $inputs = $request->all();
        
        // ボタン分岐
        if(!empty($inputs['back'])){
            return redirect()->route('editReserve_form.show')->withInput($inputs);
        }
                
        // 予約情報のテーブルを編集
        $return = $this->reserve->editTicketReserve($inputs);

        /**
         * 予約完了メールを送信
         */
        $to = [
            ['email' => $inputs['email'], ]
        ];
        // メール用の宛名（姓 名）
        $name = $inputs['last_name']." ".$inputs['first_name'];
        
        Mail::to($to)->send(new EditTicketReserve($id, $name));
        
        // 登録完了
        return redirect()->route('editReserve_complete.show')->with( 'success', '予約情報の変更が完了しました！' );
    }

    /**
     * 予約を削除する
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function deleteReserve(Request $request){

        $data= $request->all();
        
        // DBから削除
        $return = $this->reserve->dbDeleteReserve($data['id']);

        \Session::flash('success','予約の削除が完了しました。');
        return redirect(route('reserve_list.show'));
    }
}
