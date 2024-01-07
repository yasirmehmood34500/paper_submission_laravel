<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class AssignReview extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'user_id',
        'paper_submission_id',
        'revision',
        'review_type_id',
        'comment',
        'file',
        'assign_date',
    ];

    /**
     * Get the user that owns the AssignReview
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the paper_submission that owns the AssignReview
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function paper_submission(): BelongsTo
    {
        return $this->belongsTo(PaperSubmission::class);
    }

    /**
     * Get the review_type that owns the AssignReview
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function review_type(): BelongsTo
    {
        return $this->belongsTo(ReviewType::class);
    }
}
