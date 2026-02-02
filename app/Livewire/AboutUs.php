<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Inquiry;

class AboutUs extends Component
{
    public $name;
    public $email;
    public $phone;
    public $message;

    protected $rules = [
        'name' => 'required|min:3|max:255|regex:/^[a-zA-Z\s]+$/',
        'email' => 'required|email:rfc,dns',
        'phone' => 'required|numeric|digits:10', // Enforce 10 digits
        'message' => 'required|min:10|max:1000',
    ];

    protected $messages = [
        'phone.digits' => 'The phone number must be exactly 10 digits.',
        'name.regex' => 'The name may only contain letters and spaces.',
        'email.email' => 'Please enter a valid email address.',
        'message.max' => 'The message may not be greater than 1000 characters.',
    ];

    public function submit()
    {
        // Check if user is authenticated
        if (!auth()->check()) {
            session()->flash('error', 'Please login to send us a message.');
            return redirect()->route('login');
        }

        $this->validate();

        Inquiry::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'message' => $this->message,
        ]);

        session()->flash('success', 'Thank you! Your message has been sent successfully.');
        $this->reset();
    }

    public function render()
    {
        return view('livewire.about-us')->layout('layouts.guest');
    }
}
