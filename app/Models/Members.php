<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Members extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'name',
        'email',
        'phone_number',
        'address',
        'join_date'
    ];

    public function loans(){
        return $this->hasMany(Loans::class);
    }

    public function getLoanCountAttribute()
    {
        return $this->loans()->count();
    }

    public static function generateCode()
    {
        $lastMember = self::orderBy('id', 'desc')->first();
        $lastCode = $lastMember ? $lastMember->code : null;

        if ($lastCode) {
            $number = (int) substr($lastCode, 1, 4);
            $number++;
        } else {
            $number = 1;
        }

        return 'M' . str_pad($number, 4, '0', STR_PAD_LEFT) . '-N';
    }

    public function updateCode()
    {
        $oneYearAgo = Carbon::now()->subYear();
        $loanCount = $this->loans()->count(); // Count loans dynamically

        if ($this->join_date <= $oneYearAgo || $loanCount > 10) {
            $this->code = str_replace('-N', '-O', $this->code);
            $this->save();
        }
    }
}
