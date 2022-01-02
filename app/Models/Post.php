<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'catagory_id',
        'status',
        'user_id'
    ];

    public function catagory()
    {
        /*  如果Post對Catagory的foreign key叫catagoryId，則需寫成
                return $this->belongsTo('App\Models\Catagory', catagoryId);
            因為Eloquent判斷的預設外鍵名稱參考於關聯模型的方法，並在方法名稱後面加上_id，如catagory_id
        */

        return $this->belongsTo('App\Models\Catagory');
    }
}
