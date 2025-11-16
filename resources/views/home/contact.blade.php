@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-20 px-6">
    <h1 class="text-4xl font-bold mb-6">Contact Us</h1>

    <form class="space-y-6">
        <input type="text" placeholder="Your Name" class="w-full p-3 rounded border">
        <input type="email" placeholder="Your Email" class="w-full p-3 rounded border">
        <textarea placeholder="Message" class="w-full p-3 rounded border h-32"></textarea>
        <button class="bg-blue-600 text-white px-6 py-3 rounded">Send Message</button>
    </form>
</div>
@endsection
