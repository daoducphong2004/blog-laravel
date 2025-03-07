<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use Symfony\Component\Mailer\Header\TagHeader;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    const PATH_VIEW = 'admin.tags.';
    public function index()
    {
        $data = Tag::query()->latest('id')->get();
        return view(self::PATH_VIEW . __FUNCTION__, compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(self::PATH_VIEW . __FUNCTION__);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        Tag::create([
            'name' => $request->input('name'),
        ]);

        // Redirect back with a success message
        return redirect()->route('admin.tags.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $tag = Tag::query()->findOrFail($id);
        return view(self::PATH_VIEW . __FUNCTION__, compact('tag'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $tag = Tag::query()->findOrFail($id);
        return view(self::PATH_VIEW . __FUNCTION__, compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Tìm Tag bằng ID
        $tag = Tag::findOrFail($id);

        // Cập nhật tên của Tag
        $tag->update([
            'name' => $request->input('name'),
        ]);

        // Redirect hoặc trả về response
        return redirect()->route('admin.tags.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tag = Tag::findOrFail($id);


        // Xóa đối tượng category
        $tag->delete();

        return back()->with('success', 'Xóa danh mục và cover thành công.');
    }
}