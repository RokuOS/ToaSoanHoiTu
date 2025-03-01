<?php
namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\DocGia;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, $maBT)
    {
        $request->validate([
            'NoiDung' => 'required|string|max:255',
        ]);
        $comment = new Comment();
        $comment->MaBT_XB = $maBT;
        $comment->MaTK_DG = Auth::id();
        $comment->NoiDung = $request->NoiDung;
        $comment->TrangThai = 'Chờ Kiểm Duyệt';
        $comment->save();
    }
    public function choKD()
    {
        if (Auth::user()->Quyen === 'Độc Giả') {
            return redirect()->route('login')->withErrors(['msg' => 'Bạn không có quyền truy cập.']);
        }
        $comments = Comment::with('user')
            ->where('TrangThai', 'Chờ Kiểm Duyệt')
            ->paginate(15);
        return view('quanly.kdbinhluan.index', compact('comments'));
    }    
    public function pheDuyet($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->TrangThai = 'Đã Kiểm Duyệt';
        $comment->save();
        return redirect()->back()->with('success', 'Bình luận đã được phê duyệt.');
    }
    public function xoa($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->TrangThai = 'Đã Xóa';
        $comment->save();
        return redirect()->back()->with('success', 'Đã xóa bình luận');
    }
    public function lichSuComment(){
        if (Auth::user()->Quyen !== 'Độc Giả') {
            return redirect()->route('login')->withErrors(['msg' => 'Bạn không có quyền truy cập.']);
        }
        $docgia = Auth::user()->MaTK;
        $comments = DB::table('comments')
            ->join('bantinxuatban', 'comments.MaBT_XB', '=', 'bantinxuatban.MaBT_XB')
            ->select('comments.NoiDung', 'bantinxuatban.TieuDeBT_XB', 'comments.TrangThai', 'comments.created_at')
            ->where('comments.MaTK_DG', $docgia)
            ->orderBy('comments.created_at', 'desc')
            ->paginate(10);
        return view('lichsucomment', compact('docgia', 'comments'));
    }
}

