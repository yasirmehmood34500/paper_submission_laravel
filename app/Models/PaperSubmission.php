<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaperSubmission extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable=[
        'user_id',
        'paper_no',
        'prefix',
        'title',
        'sub_title',
        'abstract',
        'keywords',
        'in_draft',
        'start_date',
        'send_date',
        'active',
    ];
}
