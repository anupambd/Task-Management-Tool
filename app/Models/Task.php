<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable = [
        'task_detail', 'status_id',
    ];

    public function Status() {
        return $this->hasone(Status::class, 'status_id', 'id');
    }
}
