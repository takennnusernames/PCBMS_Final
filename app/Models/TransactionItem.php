<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionItem extends Model
{
    use HasFactory;

    public function transaction() {
        return $this->belongsTo(Transaction::class, 'transaction_id');
    }
}
