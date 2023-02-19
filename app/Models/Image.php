<?php

namespace App\Models;

use App\Enums\Role;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\HtmlString;
use SebastianBergmann\Type\NullType;

class Image extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'file', 'dimension', 'user_id', 'slug'];

    public function favorites():BelongsToMany
    {
        return $this->belongsToMany(User::class, 'favorites', 'image_id', 'user_id')->withTimestamps();
    }
    public function likes():BelongsToMany
    {
        return $this->belongsToMany(User::class, 'likes', 'image_id', 'user_id')->withTimestamps();
    }

    public function tags() :BelongsToMany
    {
        return $this->belongsToMany(Tag::class);//->withPivot('approved', 'priority')->withTimestamps()->as('sub');
    }

    public function comments() :HasMany
    {
        return $this->hasMany(Comment::class);
    }
    public function user() :BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function tagLinks() :HtmlString
    {
        $items = $this
                ->tags()
                ->pluck('name', 'slug')
                ->map(function($name, $slug){
                    return "<li><a href=". route('images.tag', $slug) .">{$name}</a></li>";
                })->join("");
        return new HtmlString("<ul>{$items}</ul>");
    }

    public function syncTags($tagString)
    {
        if(!$tagString) return;

        $tagsId = collect(explode(",", $tagString))  // sea,fire => collect(['sea', 'fire'])
        ->filter()
        ->map(function($tag){
            $tagsObj = Tag::firstOrCreate([
                'name' => trim($tag),
                'slug' => str($tag)->slug(),
            ]);
            return $tagsObj->id;
        }); // => [1,7]
        $this->tags()->sync($tagsId);
    }

    public function tagsString():string
    {

        return $this->tags()->pluck('name')->join(",");
    }

    public function relatedImages($limit = 3):mixed
    {
        $tagsIds = $this->load('tags')->tags->pluck('id'); // tagsIds = [1,3,4,6]

        return Image::where('id', '!=', $this->id)
                    ->whereHas('tags', function($query) use($tagsIds){
                        $query->whereIn('tag_id', $tagsIds);
                    })
                    ->inRandomOrder()
                    ->take($limit)
                    ->get();
    }

    public function hasBeenLiked() {
        $userId = auth()->id();
        $imageId = $this->id;
        return Image::whereHas('likes', function($query) use ($userId, $imageId){
            $query->where('user_id', $userId)->where('image_id', $imageId);
        })->count();
    }

    public function hasBeenFavored()
    {
        $userId = auth()->id();
        $imageId = $this->id;
        return Image::whereHas('favorites', function($query) use ($userId, $imageId){
            $query->where('user_id', $userId)->where('image_id', $imageId);
        })->count();
    }
    public static function makeDirectory(){
        $subFolder = 'images/' . date('Y/m/d');

        Storage::makeDirectory($subFolder);

        return $subFolder;
    }

    public static function getDimension($image){
       [$width, $height] = getimagesize(Storage::path($image));
       return $width . "x" . $height; // 1920x1280
    }

    public function scopePublished($query){
        return $query->where('is_published', true);
    }

    public function scopeVisibleFor($query, User $user){
        if($user->role === Role::Admin || $user->role === Role::Editor){
            return ;
        }
        $query->where('user_id', $user->id);
    }

    public function fileUrl(){
        return Storage::url($this->file);
    }
    public function permaLink(){
        return $this->slug ? route('images.show', $this->slug) : '#';
    }

    public function route($method, $key = 'id'){
        return route("images.{$method}", $this->$key);
    }


    public function getSlug(){
        $slug = str($this->title)->slug();
        $numSlugsFound = Image::where('slug', 'regexp', "^".$slug."(-[0-9])?")->count();

        if($numSlugsFound > 0){
            return $slug . "-" . $numSlugsFound + 1; // my-beautiful-car-3
        }

        return $slug;
    }



    // public function uploadDate(){
    //     return $this->created_at->diffForHumans();
    // }

    protected function uploadDate(): Attribute{
        return Attribute::make(
            get: fn() => $this->created_at->diffForHumans(),
        );
    }

    protected static function booted(){

        static::creating(function($image){
            if($image->title){
                $image->slug = $image->getSlug();
                $image->is_published = true;
            }
        });

        static::updating(function ($image) {
            if ($image->title && !$image->slug) {
                $image->slug = $image->getSlug();
                $image->is_published = true;
            }
        });

        static::deleted(function($image){
            Storage::delete($image->file);
        });

        static::deleting(function($image){
            //1) do nothing
            // 2) if there is no linked image to a tag delete tag
            $image->tags->each(function($tag){
                $imageCount = $tag->images()->wherePivot('image_id', '!=', $tag->pivot->image_id)->count();
                if(!$imageCount){
                    $tag->delete();
                }
            });
        });
    }
}
