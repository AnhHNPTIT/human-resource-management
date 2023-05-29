<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostCategory extends Model
{
	protected $table = 'post_categories';
	protected $fillable  = [
		'name', 'sort_id', 'slug'
	];

	public function posts(){
		return $this->hasMany('App\Post');
	}

	public function countPost(){
		return $this->hasMany('App\Post', 'post_category_id')->get()->count();
	}
}
