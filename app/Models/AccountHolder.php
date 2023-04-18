<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountHolder extends Model
{
    use HasFactory;

    protected $table = 'account_holders'; // Replace 'account_holders' with the actual table name in your database

    protected $fillable = [
        'clientid',
        'msisdn',
        'firstName',
        'surName',
    ];

    // Add any other relationships or configurations as needed
}
