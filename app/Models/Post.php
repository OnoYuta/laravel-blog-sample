<?php

namespace App\Models;

use cebe\markdown\Markdown;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'administrator_id',
        'title',
        'contents',
        'status',
        'published_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'published_at' => 'datetime',
    ];

    /**
     * Define an inverse one-to-one or many relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function administrator()
    {
        return $this->belongsTo(Administrator::class);
    }

    /**
     * Get parsed maekup contents.
     *
     * @return void
     */
    public function getHtmlAttribute()
    {
        $parsedHtml = (new Markdown())->parse($this->contents);

        return $parsedHtml;
    }
}
