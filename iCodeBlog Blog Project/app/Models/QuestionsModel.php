<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionsModel extends Model
{
    use HasFactory;
    protected $table = "post_questions";
    protected $primaryKey = "question_id";
}
