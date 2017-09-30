<?php

namespace CodePub\Models;

use Bootstrapper\Interfaces\TableInterface;
use Illuminate\Database\Eloquent\Model;

class Book extends Model implements TableInterface
{
    protected $fillable = ['title', 'subtitle', 'price', 'user_id'];

    public function user()
    {
        return $this->belongsTo('CodePub\Models\User');
    }

    /**
     * A list of headers to be used when a table is displayed
     *
     * @return array
     */
    public function getTableHeaders()
    {
        return ['#', 'title', 'subtitle', 'price', 'author'];
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
            case 'author':
                return $this->user->name;
            default:
                return $this->$header;
        }
    }
}
