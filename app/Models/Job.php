<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Job extends Model
{
    use HasFactory;

    protected $with = ['tags','employer'];

    /**
     * Job belongs to employer
     *
     * @return BelongsTo
     */
    public function employer(): BelongsTo
    {
        return $this->belongsTo(Employer::class);
    }

    /**
     * Find or create tag to a job tags pivot table
     *
     * @param string $title
     * @return void
     */
    public function tag(string $title): void
    {
        $tag = Tag::firstOrCreate(['title' => $title]);

        $this->tags()->attach($tag);
    }

    /**
     * @return BelongsToMany
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class,'jobs_has_tags');
    }
}
