<?php namespace Training\Services\Models;

use Model;

class ContactMessage extends Model
{
    use \October\Rain\Database\Traits\Validation;

    public $table = 'training_services_contact_messages';

    protected $fillable = [
        'name',
        'email',
        'subject',
        'message',
        'status',
    ];

    public $rules = [
        'name' => 'required|max:255',
        'email' => 'required|email|max:255',
        'subject' => 'required|max:255',
        'message' => 'required|max:5000',
        'status' => 'required|in:new,read',
    ];
}