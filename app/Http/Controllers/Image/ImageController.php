<?php

namespace App\Http\Controllers\Image;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImageFormRequest;
use Illuminate\Http\Request;
use App\Models\Image;


class ImageController extends Controller
{

    public function __construct(Image $image){
        $this->image = $image;
    }

    /**
     * 画像一覧画面を表示する
     * @return view
     */
    public function showImageList()
    {
        $images = Image::all();

        return view('admin.image.image_list',['images' => $images]);
    }

    /**
     * 画像アップロード画面を表示する
     * @return view
     */
    public function showImageForm()
    {
        return view( 'admin.image.upload.image_form' );
    }

    /**
     * 画像をアップロードする
     * @param  App\Http\Requests\ImageFormRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function imagePost(ImageFormRequest $request){
        
        $inputs = $request->all();
        $image = $request->file('image');
        $save_path = "";

        // ファイル名
        $file_name = $request->file('image')->getClientOriginalName();
        // 名称
        $description = $inputs['description'];

        // 画像ファイルの情報があればstorageに保存
        if(isset($image)){
            // パスを取得
            $save_path = $image->store('images','public');

        }else{
            $save_path = null;
        }
        
        // DBに登録
        // file_name save_path description
        $return = $this->image->dbPostImage($file_name, $save_path, $description);
                
        // 登録完了
        return redirect()->route('image')->with( 'success', '画像の登録が完了しました！' );
    }

    /**
     * 画像を削除する
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function deleteImage(Request $request){

        $data= $request->all();
        
        // DBから削除
        $return = $this->image->dbDeleteImage($data['id']);

        \Session::flash('success','画像の削除が完了しました。');
        return redirect(route('image_list.show'));
    }

}
