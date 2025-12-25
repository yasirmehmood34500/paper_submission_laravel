<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdminDecision extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'paper_submission_id',
        'review_type_id',
        'comment',
        'file',
    ];
    /**
     * Get the review_type that owns the AdminDecision
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function review_type(): BelongsTo
    {
        return $this->belongsTo(ReviewType::class);
    }
}
