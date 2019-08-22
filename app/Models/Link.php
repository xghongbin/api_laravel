<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Link extends Model
{
    protected $fillable = ['title','link'];

    public $cache_key = 'larabbs_links';

    protected $cache_expire_in_seconds = 1440 * 60;


    /**
     * 尝试从缓存中取出  cache_key  对应的数据。如果能取到，便直接返回数据
     *
     * 否则运行匿名函数中的代码取出 links 表中所有的数据，返回的同时做缓存
     */
    public function getAllCached()
    {
        return Cache::remember($this->cache_key, $this->cache_expire_in_seconds,function (){
             return $this->all();
        });
    }
}
