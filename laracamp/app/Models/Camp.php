<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Checkout;
use Auth;

class Camp extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'price',
    ];

    //Atribut baru untuk validasi user yang sudah login tidak bisa checkout kelas yang sama
    public function getIsRegisteredAttribute(){
        //Kalo gaada yang login nilainya False
        if (!Auth::check()) {
             return false;
        }
        // Kalo ada yang login langsung check ke data id camp dengan user id muncul atau tidak
        return Checkout::whereCampId($this->id)->whereUserId(Auth::id())->exists();
    }
}
