<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public phoneNumber()
    {
        return $this->hasOne('App\PhoneNumber');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
	protected $fillable = ['name', 'slug'];

	public function posts(){
		return $this->belongsToMany('App\Post');
	}

	public function post_tags(){
		return $this->hasMany('App\PostTags');
	}
}

$manufactures = Manufacture::all();

$product = Product::findOrFail($id);

$posts = Post::select("posts.*", "post_categories.name")
->join("post_categories", "post_categories.id", "=", "posts.post_category_id")
->orderBy('created_at', 'desc')
->get();

$data = $request->all();
unset($data['_token']);
$data['slug'] = str_slug($data['name']);
$tag = Tag::create($data);

$data = $request->all();
$tag = Tag::find($data['id']);
unset($data['_token']);
unset($data['id']);
$data['slug'] = str_slug($data['name']);
$flag = $tag->update($data);

$post = Post::findOrFail($id)->delete();

<table id="list-products" class="table table-bordered table-striped" style="margin-top : 10px;">
	<thead>
		<tr>
			<th class="col-sm-2" style="text-align: center;">Tên thực phẩm chức năng</th>
			<th class="col-sm-1" style="text-align: center;">Mã</th>
			<th class="col-sm-1" style="text-align: center;">Phân loại</th>
			<th class="col-sm-1" style="text-align: center;">Ảnh</th>
			<th class="col-sm-1" style="text-align: center;">Giá nhập</th>
			<th class="col-sm-1" style="text-align: center;">Giá bán</th>
			<th class="col-sm-1" style="text-align: center;">Số lượng còn</th>
			<th class="col-sm-1" style="text-align: center;">Số lượng đã bán</th>
			<th class="col-sm-1" style="text-align: center;">Lượt xem</th>
			<th class="col-sm-3" style="text-align: center;">Hành động</th>
		</tr>
	</thead>
</table>
