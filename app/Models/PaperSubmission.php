<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaperSubmission extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'user_id',
        'paper_no',
        'prefix',
        'title',
        'sub_title',
        'abstract',
        'keywords',
        'comment_for_editor',
        'in_draft',
        'start_date',
        'send_date',
        'active',
        'revision',
        'created_at',
    ];

    public const PAPER_STATUS = ['Pending', 'Under Review', 'Reviewed', 'Pending on Author', 'Pending on Editor'];
    public const PENDING_STATUS = 0;
    public const UNDER_REVIEW_STATUS = 1;
    public const REVIEWED_STATUS = 2;
    public const PENDING_FROM_AUTHOR_STATUS = 3;
    public const PENDING_FROM_EDITOR_STATUS = 4;

    /**
     * Get the user that owns the PaperSubmission
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
