<?php

namespace App\Http\Controllers;

use App\Album;
use App\ArtistSongDetail;
use App\Genres;
use App\Http\Requests\EditGenres;
use App\Http\Requests\GenresRequest;
use App\Song;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

class GenresController extends Controller
{

    public function index(\Illuminate\Http\Request $request)
    {
        $search = $request->get('search');
        $show_more = $request->get('show_more');
        if (!$request->has('search') && !$request->has('show_more') || empty($search) && empty($show_more)) {
            $genres = Genres::paginate(20);
        } else if ($request->has('search') && !$request->has('show_more') || !empty($search) && empty($show_more)) {
            $genres = Genres::where('name', 'like', "%$search%")
                ->paginate(20);
            // thêm tham số đường dẫn keyword khi người dùng
            // có tìm kiếm để tránh lỗi phân trang
            $genres->withPath(\Illuminate\Support\Facades\URL::current() . "?search=$search");
        } else if (!$request->has('search') && $request->has('show_more') || empty($search) && !empty($show_more)) {
            $genres = Genres::paginate($show_more);
            // thêm tham số đường dẫn keyword khi người dùng
            // có tìm kiếm để tránh lỗi phân trang
            $genres->withPath(\Illuminate\Support\Facades\URL::current() . "?show-more=$show_more");
        } else {
            $genres = Genres::where('name', 'like', "%$search%")
                ->paginate($show_more);
            // thêm tham số đường dẫn keyword khi người dùng
            // có tìm kiếm để tránh lỗi phân trang
            $genres->withPath(\Illuminate\Support\Facades\URL::current() . "?search=$search&&show-more=$show_more");
        }
        return view('admin2.kinds.index', compact('genres'));
    }

    public function getData(\Illuminate\Http\Request $request)
    {
        $columns = ['genres.id', 'genres.name'];

        $limit = $request->input('length');
        $start = $request->input('start');
        $orders = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('searchs');
        $args = [];
        $args[] = ['genres.name', 'like', "%$search%"];


        $total = Genres::count();

        $data = Genres::where($args)->select('genres.*')
            ->offset($start)
            ->limit($limit)
            ->orderBy($orders, $dir)
            ->get();



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

    public function add()
    {
        return view('admin2.kinds.add');
    }

    public function update($genres_id)
    {
        $genres = Genres::find($genres_id);
        return view('admin2.kinds.edit', compact('genres'));
    }

    public function actionDelete($id)
    {
        $model = Genres::find($id);
        $model_song = Song::where('genres_id', $id);
        if ($model_song !== null) {
            foreach ($model_song->get() as $key => $value) {
                $model_details = ArtistSongDetail::where('song_id', $value['id']);
                $model_details->delete();
            }
        }
        if ($model !== null) {
            $model->delete();
            $model_song->delete();
            return redirect()->route('kinds.home')->with('status', 'Xóa thể loại thành công');
        } else {
            return redirect()->route('kinds.home')->with('status', 'Xóa thể loại thành công');
        }
    }

    public function actionUpdate(EditGenres $request, $genres_id)
    {
        $model = Genres::find($genres_id);
        $model->fill($request->all());

        if ($request->hasFile('image')) {
            // lấy tên gốc của ảnh
            $filename = $request->image->getClientOriginalName();
            // thay thế ký tự khoảng trắng bằng ký tự '-'
            $filename = str_replace(' ', '-', $filename);
            // thêm đoạn chuỗi không bị trùng đằng trước tên ảnh
            $filename = uniqid() . '-' . $filename;
            // lưu ảnh và trả về đường dẫn
            $path = $request->file('image')->storeAs('upload/image', $filename);
            $request->file('image')->move('upload/image', $filename);
            $model->image = "$path";
        }
        $model->save();

        return redirect()->route('kinds.home')->with('status', 'Chỉnh sửa thể loại thành công');
    }

    public function actionAdd(GenresRequest $request)
    {
        $model = new Genres();
        $model->fill($request->all());
        if ($request->hasFile('image')) {
            // lấy tên gốc của ảnh
            $filename = $request->image->getClientOriginalName();
            // thay thế ký tự khoảng trắng bằng ký tự '-'
            $filename = str_replace(' ', '-', $filename);
            // thêm đoạn chuỗi không bị trùng đằng trước tên ảnh
            $filename = uniqid() . '-' . $filename;
            // lưu ảnh và trả về đường dẫn
            $path = $request->file('image')->storeAs('upload/image', $filename);
            $request->file('image')->move('upload/image', $filename);
            $model->image = "$path";
        }
        DB::beginTransaction();
        try {
            $model->save();
            DB::commit();

            return redirect()->route('kinds.home')->with('status', 'Thêm thể loại thành công');
        } catch (Exception $ex) {
            // ghi log lỗi lại
            DB::rollback();
        }
    }
}
