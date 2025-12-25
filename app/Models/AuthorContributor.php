<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class AuthorContributor extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'author_contributor_rule_id',
        'paper_submission_id',
        'name',
        'email',
        'oric_id',
        'affiliation',
        'bio_statement',
        'active',
    ];
    /**
     * Get the contributor_rule that owns the AuthorContributor
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function contributor_rule(): BelongsTo
    {
        return $this->belongsTo(AuthorContributorRule::class, 'author_contributor_rule_id');
    }
}
