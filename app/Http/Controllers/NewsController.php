<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class NewsController extends Controller
{
    //member
    public function newsindexmember()
    {
        $newss = News::orderByDesc('id')->paginate(20);

        return view('member.news', compact('newss'));
    }
    public function shownewsmember($id)
    {
        $newss = News::all()->find($id);

        return view('member.viewnews', compact('newss'));
    }

    //admin
    public function newsindexadmin()
    {
        $newss = News::orderByDesc('id')->paginate(20);

        return view('admin.news', compact('newss'));
    }
    public function shownewsadmin($id)
    {
        $newss = News::all()->find($id);

        return view('admin.viewnews', compact('newss'));
    }
    public function newsstoreindex()
    {
        return view('admin.addnews');
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'image' => 'required|mimes:png,jpg,jpeg',
            'banner' => 'required|mimes:png,jpg,jpeg',
            'title' => 'required',
            'description' => 'required',
            'detail' => 'required',
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator);
        }
        $imageFile = $request->file('image');
        $imageName = time().'.'.
        $imageFile->getClientOriginalExtension();
        Storage::putFileAs('public/newsimage', $imageFile,$imageName);

        $bannerFile = $request->file('banner');
        $bannerName = 'banner'.time().'.'.
        $bannerFile->getClientOriginalExtension();
        Storage::putFileAs('public/newsimage', $bannerFile,$bannerName);

        DB::table('news')->insert([
            'image' => $imageName,
            'banner' => $bannerName,
            'title' => $request->get('title'),
            'description' => $request->get('description'),
            'detail' => $request->get('detail'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Alert::success('Congrats', 'News Added!');

        return redirect('/admin/news/');
    }
    public function destroy($id)
    {
        News::all()->find($id)->delete();
        Alert::success('Congrats', 'News Deleted!');
        return redirect('/admin/news');
    }
    public function updatenewsindex($id)
    {
        $newss = News::find($id);
        return view('admin.updatenews', compact('newss'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'image' => 'mimes:png,jpg,jpeg',
            'banner' => 'mimes:png,jpg,jpeg',
            'title',
            'description',
            'detail'
        ]);

        $up = News::find($id);
        $up->title = $request['title'];
        $up->description = $request['description'];
        $up->detail = $request['detail'];
        if($request->hasFile('image'))
        {
            $located = 'storage/newsimage/'.$up->image;
            if(File::exists($located))
            {
                File::delete($located);
            }
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('storage/newsimage', $filename);
            $up->image = $filename;
        }
        if($request->hasFile('banner'))
        {
            $located = 'storage/newsimage/'.$up->banner;
            if(File::exists($located))
            {
                File::delete($located);
            }
            $banner = $request->file('banner');
            $bannerextension = $banner->getClientOriginalExtension();
            $bannername = 'banner'.time().'.'.$bannerextension;
            $banner->move('storage/newsimage', $bannername);
            $up->banner = $bannername;
        }
        $up->update();
        Alert::success('Congrats', 'News Edited!');
        return redirect('/admin/news/'.$id);
    }
}
