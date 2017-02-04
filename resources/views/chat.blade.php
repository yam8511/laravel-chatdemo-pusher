@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Chat Room</div>

                <div id="app" class="panel-body">
                    <chat-composer v-on:messagesend="addMessage" :user="{{ Auth::user() }}"></chat-composer>
                    <chat-log :messages="messages"></chat-log>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
