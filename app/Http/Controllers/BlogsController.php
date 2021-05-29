<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Http\Requests\BlogRequest;
use Auth;

class BlogsController extends Controller
{
    // コンストラクタ
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * ログインユーザのブログ一覧
     * @param  void
     * @return view 
     */
    public function blogsList() {
        $blogs = Blog::where('user_id', Auth::user()->id)
                    ->orderBy('created_at', 'desc')
                    ->paginate(10);
        return view('blog.list', ['blogs' => $blogs]);
    }

    /**
     * ブログ投稿画面表示
     * @param  void
     * @return view
     */
    public function blogCreate() {
        return view('blog.create');
    }

    /**
     * ブログ投稿処理
     * @param  $request
     * @return
     */
    public function blogStore(BlogRequest $request) {
        $inputs = $request->all();
 
        \DB::beginTransaction();
        try {
            // ブログを登録
            Blog::create($inputs);
            \DB::commit();
        } catch(\Throwable $e) {
            \DB::rollback();
            abort(500);
        }

        return redirect(route('blogs'))->with('create_msg', 'ブログが投稿されました');
    }

    /**
     * ブログ編集画面を表示
     * @param  int $id
     * @return view
     */
    public function blogEdit($id) {
        $blog = Blog::find($id);

        if(is_null($blog)) {
            \Session::flash('err_msg', '該当するデータがありません');
            return redirect(route('blogs'));
        }
        return view('blog.edit', ['blog' => $blog]);
    }

    /**
     * ブログ編集処理
     * @param  $request
     * @return 
     */
    public function blogUpdate(BlogRequest $request) {
        $inputs = $request->all();
        // dd($inputs);
        \DB::beginTransaction();
        try{
            // ブログ編集
            $blog = Blog::find($inputs['id']);
            $blog->fill([
                'title' => $inputs['title'],
                'content' => $inputs['content'],
            ]);
            $blog->save();
            \DB::commit();
        } catch(\Throwable $e) {
            \DB::rollback();
            abort(500);
        }

        return redirect(route('blogs'))->with('create_msg', 'ブログの更新が完了しました');
    }

    /**
     * ブログ詳細画面表示
     * @param  int $id
     * @return view
     */
    public function blogDetail($id) {
        $blog = Blog::find($id);

        if(is_null($blog)) {
            \Session::flash('err_msg', '該当するデータがありません');
            return redirect(route('blogs'));
        }
        return view('blog.detail', ['blog' => $blog]);
    }

    /**
     * ブログ削除
     * @param  int $id
     * @return
     */
    public function blogDelete($id) {
        if(empty($id)) {
            \Session::flash('err_msg', '該当するデータがありません');
            return redirect(route('blogs'));
        }

        try {
            // ブログを削除
            $blog = Blog::destroy($id); 
        } catch(\Throwable $e) {
            abort(500);
        }

        \Session::flash('create_msg', 'ブログを削除しました');
        return redirect(route('blogs'));
    }
}
