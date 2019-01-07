<?php

namespace CodeEduBook\Models;

use Bootstrapper\Interfaces\TableInterface;
use CodeEduBook\Models\Category;
use Collective\Html\Eloquent\FormAccessible;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Book extends Model implements TableInterface
{
    use FormAccessible;

    use SoftDeletes;
    
    use BookStorageTrait;
    
    use BookThumbnailTrait;

    use SluggableScopeHelpers;

    use Searchable;

    protected $dates = ['deleted_at'];

    use Sluggable;


    protected $fillable = [
        'title', 
        'subtitle', 
        'price', 
        'user_id',
        'dedication',
        'description',
        'website',
        'percent_complete',
        'published'
    ];

    public function user()
    {
        return $this->belongsTo('CodeEduUser\Models\User');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class)->withTrashed();
    }

    public function chapters()
    {
        return $this->hasMany(Chapter::class);
    }

    public function formCategoriesAttribute()
    {
        return $this->categories->pluck('id')->all();
    }

    public function sluggable() {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    /**
     * A list of headers to be used when a table is displayed
     *
     * @return array
     */
    public function getTableHeaders()
    {
        return ['#', 'Título', 'Autor', 'Preço'];
    }

    /**
     * Get the value for a given header. Note that this will be the value
     * passed to any callback functions that are being used.
     *
     * @param string $header
     * @return mixed
     */
    public function getValueForHeader($header)
    {
        switch ($header) {
            case '#':
                return $this->id;
            case 'Autor':
                return $this->user->name;
            case 'Título':
                if(file_exists($this->zip_file)) {
                    $route = route('books.download', ['id' => $this->id]);
                    return "<a href=\"$route\" target=\"_blank\">{$this->title}</a>";
                } else {
                    return $this->title;
                }
            default:
                return $this->$header;
        }
    }

}
