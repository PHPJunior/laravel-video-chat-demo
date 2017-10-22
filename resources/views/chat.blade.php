@extends('layouts.app')

@section('content')
    <div class="container">
        <chat-room :conversation="{{ $conversation }}" :current-user="{{ auth()->user() }}"></chat-room>
    </div>
@endsection