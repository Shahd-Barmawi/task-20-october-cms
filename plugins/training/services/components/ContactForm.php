<?php namespace Training\Services\Components;

use Cms\Classes\ComponentBase;
use Training\Services\Models\ContactMessage;
use ValidationException;
use Validator;

class ContactForm extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name' => 'Contact Form',
            'description' => 'Handles contact form submissions using October CMS AJAX.'
        ];
    }

    public function defineProperties()
    {
        return [];
    }

    public function onSubmit()
    {
        $data = [
            'name' => trim((string) post('name')),
            'email' => trim((string) post('email')),
            'subject' => trim((string) post('subject')),
            'message' => trim((string) post('message')),
        ];

        $validator = Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|max:255',
            'message' => 'required|max:5000',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $contactMessage = new ContactMessage();
        $contactMessage->name = $data['name'];
        $contactMessage->email = $data['email'];
        $contactMessage->subject = $data['subject'];
        $contactMessage->message = $data['message'];
        $contactMessage->status = 'new';
        $contactMessage->save();

        return [
            '#contact-form-result' =>
                '<div class="contact-success-message">Thank you! Your message has been sent successfully.</div>'
        ];
    }
}