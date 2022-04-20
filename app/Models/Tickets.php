<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tickets extends Model
{
    use HasFactory;
    
    protected $fillable = ['fillable '];
    
    function owner(){
        return $this->belongsTo(User::class, 'user_id');
    }
    
    function getStatusAttribute($value){
        switch($value){
            case 1:
                return 'In progress';
            case 2:
                return 'Answered';
            case 3:
                return 'Not answered';
                
            case 4:
                return 'Spam';
                
                default:
                return 'In progress';
            }
        }
    
    function statusBadge(){
        switch($this->status){
            case 'In progress':
                return 'badge bg-primary';
            case 'Answered':
                return 'badge bg-info';
            case 'Not answered':
                return 'badge bg-danger';

                
            case 'Spam':
                return 'badge bg-dark';
                
            default:
                return 'badge bg-primary';
        }
    }

}