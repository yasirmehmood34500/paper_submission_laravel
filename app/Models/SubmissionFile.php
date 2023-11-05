<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubmissionFile extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'paper_submission_id',
        'submission_file_type_id',
        'file_name',
        'active',
    ];
    /**
     * Get the file_type that owns the SubmissionFile
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function file_type(): BelongsTo
    {
        return $this->belongsTo(SubmissionFileType::class, 'submission_file_type_id');
    }
}
