<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Song;
use Illuminate\Http\Request;

class CommentsController extends Controller
{

    //
    public function getData(Request $request)
    {
        $columns = ['comment.id', 'comment.content'];
        $limit = $request->input('length');
        $start = $request->input('start');
        $orders = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('searchs');
        $args = [];
        $args[] = ['comment.content', 'like', "%$search%"];


        $total = Comment::count();

        $data = Comment::where($args)->select('comment.*')
            ->offset($start)
            ->limit($limit)
            ->orderBy($orders, $dir)
            ->get();

        $data->load('user');


        foreach ($data as $key => $value) {
            $data[$key]['create'] = date('d-m-Y', strtotime($value['created_at']));

        }

        $json_data = [
            'draw' => intval($request->input('draw')),
            'recordsTotal' => intval($total),
            'recordsFiltered' => intval($total),
            'data' => $data,
        ];


        return response()->json($json_data, 200);
    }

    public function index()
    {
        return view('admin2.comments.index');
    }

    public function actionDelete($comment_id)
    {
        $model = Comment::find($comment_id);
        $model->delete();
        return redirect()->route('comments.home')->with('status', 'Xóa comment thành công');
#
    }
}
