<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Post extends Model
{
    use HasFactory;

    // ☆☆投稿フォームの保存を許可するモデル設定
    protected $fillable=
    ['user_id','post',];


    // ☆☆投稿内容を表示する時のユーザーアイコン、名前を表示させるためのモデル設定↓
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
