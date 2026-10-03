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
        'downloaded',
        'process_status',
        'created_at',
    ];

    public const PAPER_STATUS = ['Pending', 'Under Review', 'Reviewed', 'Pending on Author', 'Pending on Editor'];
    public const PENDING_STATUS = 0;
    public const UNDER_REVIEW_STATUS = 1;
    public const REVIEWED_STATUS = 2;
    public const PENDING_FROM_AUTHOR_STATUS = 3;
    public const PENDING_FROM_EDITOR_STATUS = 4;

    public const PROCESS_STATUS = [
        1 => 'Submitted',
        2 => 'Initial Check',
        3 => 'Under Review',
        4 => 'Reviews Completed',
        5 => 'Editorial Assessment',
        6 => 'Revision Required',
        7 => 'Revision Submitted',
        8 => 'APC Payment Required',
        9 => 'Revision Processing',
        10 => 'Accepted',
        11 => 'Copyediting / Proofreading',
        12 => 'In Press',
        13 => 'Scheduled for Issue',
        14 => 'Published',
    ];

    public const PROCESS_STATUS_BADGES = [
        1 => 'badge-info',
        2 => 'badge-primary',
        3 => 'badge-warning',
        4 => 'badge-info',
        5 => 'badge-secondary',
        6 => 'badge-danger',
        7 => 'badge-primary',
        8 => 'badge-warning',
        9 => 'badge-info',
        10 => 'badge-success',
        11 => 'badge-secondary',
        12 => 'badge-dark',
        13 => 'badge-primary',
        14 => 'badge-success',
    ];

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
