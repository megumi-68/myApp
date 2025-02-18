<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class UserController extends Controller
{
    // プロフィール編集
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    // プロフィール更新
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ],
        [
            'name.required' => '名前は必須です。',
        ]);

        // 名前を更新
        $user->name = $request->name;

        // 画像アップロード
        if ($request->hasFile('avatar')) {
            // 古い画像削除
            if ($user->avatar) {
                Storage::delete(str_replace('storage/', 'public/', $user->avatar));
            }

            // 新しい画像を保存
            $image = $request->file('avatar');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('public/profile_images', $imageName);

            $user->avatar = str_replace('public/', 'storage/', $path);
            // dd($user->avatar); //debug
        } else {
            $user->avatar = $user->avatar ?? null;
        }

        $user->save();

        return redirect()->route('profile.edit')->with('success', 'プロフィールを更新しました');
    }
}
