<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model {
    protected $fillable = ['user_id', 'category_id', 'type', 'amount', 'date', 'description'];

    protected $casts = ['date' => 'date'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function scopeBetweenDates($query, $from = null, $to = null) {
        return $query
            ->when($from, fn ($q) => $q->whereDate('date', '>=', $from))
            ->when($to, fn ($q) => $q->whereDate('date', '<=', $to));
    }
}