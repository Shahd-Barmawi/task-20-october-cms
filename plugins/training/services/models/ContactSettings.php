<?php namespace Training\Services\Models;

use Model;

class ContactSettings extends Model
{
    public $implement = [
        \System\Behaviors\SettingsModel::class,
    ];

    public $settingsCode = 'training_services_contact_settings';

    public $settingsFields = '$/training/services/models/contactsettings/fields.yaml';

    public $rules = [
        'contact_email' => 'required|email',
        'phone' => 'required|max:50',
        'address' => 'required|max:255',
        'help_text' => 'nullable|max:500',
    ];
}