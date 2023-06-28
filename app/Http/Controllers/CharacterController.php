<?php

namespace App\Http\Controllers;

use App\Models\Character;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class CharacterController extends Controller
{
    //member
    public function charaindexmember()
    {
        $chara = Character::orderBy('name')->paginate(10);

        return view('member.character', compact('chara'));
    }
    public function showcharamember($id)
    {
        $chara = Character::all()->find($id);

        return view('member.viewcharacter', compact('chara'));
    }
    public function tierlistmember()
    {
        $sptier = Character::where('tier', 'S+')->orderBy('name')->get();
        $stier = Character::where('tier', 'S')->orderBy('name')->get();
        $atier = Character::where('tier', 'A')->orderBy('name')->get();
        $btier = Character::where('tier', 'B')->orderBy('name')->get();
        $ctier = Character::where('tier', 'C')->orderBy('name')->get();

        return view('member.tierlist', compact('sptier', 'stier', 'atier', 'btier', 'ctier'));
    }
    public function searchformember(Request $request)
    {
        $query = $request->search;
        $chara = Character::where('name', 'like', '%'.$query.'%')
        ->orWhere('detail', 'like', '%'.$query.'%')
        ->orderBy('name')->paginate(10)->withQueryString();

        return view('member.character', compact('chara', 'query'));
    }

    //admin
    public function charaindexadmin()
    {
        $chara = Character::orderBy('name')->paginate(10);

        return view('admin.character', compact('chara'));
    }
    public function showcharaadmin($id)
    {
        $chara = Character::all()->find($id);

        return view('admin.viewcharacter', compact('chara'));
    }
    public function tierlistadmin()
    {
        $sptier = Character::where('tier', 'S+')->orderBy('name')->get();
        $stier = Character::where('tier', 'S')->orderBy('name')->get();
        $atier = Character::where('tier', 'A')->orderBy('name')->get();
        $btier = Character::where('tier', 'B')->orderBy('name')->get();
        $ctier = Character::where('tier', 'C')->orderBy('name')->get();

        return view('admin.tierlist', compact('sptier', 'stier', 'atier', 'btier', 'ctier'));
    }
    public function charastoreindex()
    {
        return view('admin.addcharacter');
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'image' => 'required|mimes:png,jpg,jpeg',
            'name' => 'required|unique:characters',
            'detail' => 'required',
            'rank' => 'required|in:S,A,B',
            'tier' => 'required|in:S+,S,A,B,C',
            'weapon' => 'required',
            'stigmata' => 'required',
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator);
        }
        $imageFile = $request->file('image');
        $imageName = time().'.'.
        $imageFile->getClientOriginalExtension();
        Storage::putFileAs('public/chara', $imageFile,$imageName);

        DB::table('characters')->insert([
            'image' => $imageName,
            'name' => $request->get('name'),
            'detail' => $request->get('detail'),
            'rank' => $request->get('rank'),
            'tier' => $request->get('tier'),
            'weapon' => $request->get('weapon'),
            'stigmata' => $request->get('stigmata')
        ]);
        Alert::success('Congrats', 'Character Added!');
        return redirect('/admin/character/');
    }
    public function destroy($id)
    {
        Character::all()->find($id)->delete();
        Alert::success('Congrats', 'Character Remove!');
        return redirect('/admin/character');
    }
    public function updatecharaindex($id)
    {
        $chara = Character::find($id);
        return view('admin.updatecharacter', compact('chara'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'image' => 'mimes:png,jpg,jpeg',
            'name',
            'detail',
            'rank' => 'in:S,A,B',
            'tier' => 'in:S+,S,A,B,C',
            'weapon',
            'stigmata'
        ]);

        $up = Character::find($id);
        $up->name = $request['name'];
        $up->detail = $request['detail'];
        $up->rank = $request['rank'];
        $up->tier = $request['tier'];
        $up->weapon = $request['weapon'];
        $up->stigmata = $request['stigmata'];
        if($request->hasFile('image'))
        {
            $located = 'storage/chara/'.$up->image;
            if(File::exists($located))
            {
                File::delete($located);
            }
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('storage/chara', $filename);
            $up->image = $filename;
        }
        $up->update();
        Alert::success('Congrats', 'Character Updated!');
        return redirect('/admin/character/'.$id);
    }
    public function searchforadmin(Request $request)
    {
        $query = $request->search;
        $chara = Character::where('name', 'like', '%'.$query.'%')
        ->orWhere('detail', 'like', '%'.$query.'%')
        ->orWhere('id', 'like', $query)
        ->orderBy('name')->paginate(10)->withQueryString();

        return view('admin.character', compact('chara', 'query'));
    }
}
