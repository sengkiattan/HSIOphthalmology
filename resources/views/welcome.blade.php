@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Search Your Queue Number') }}</div>

                <div class="card-body">
                    <form method="post" action="{{ route('searchQueue') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="search_queue" class="col-md-4 col-form-label text-md-right">{{ __('Queue Number') }}</label>

                            <div class="col-md-6">
                                <input id="search_queue" type="search_queue" class="form-control{{ $errors->has('search_queue') ? ' is-invalid' : '' }}" name="search_queue" value="{{ old('search_queue') }}" required autofocus>
                                <input id="device_token" type="hidden" name="device_token"/>
                                @if ($errors->has('search_queue'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('search_queue') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-5">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Search') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


<script
src="https://code.jquery.com/jquery-3.4.1.min.js"
integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
crossorigin="anonymous"></script>
<script src="https://www.gstatic.com/firebasejs/6.3.4/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/6.3.4/firebase-messaging.js"></script>
<script>
  if ('serviceWorker' in navigator) {
    window.addEventListener('load', () => {
      navigator.serviceWorker.register('/js/firebase-messaging-sw.js');
    });
  }
</script>
<script>
    $(document).ready(function(){
        const config = {
            apiKey: "AIzaSyDJXcfxyBvl1CGK9ArAPKkGpwu2rcNjf3I",
            authDomain: "hsi-ophthalmology.firebaseapp.com",
            databaseURL: "https://hsi-ophthalmology.firebaseio.com",
            projectId: "hsi-ophthalmology",
            storageBucket: "hsi-ophthalmology.appspot.com",
            messagingSenderId: "892523160631",
            appId: "1:892523160631:web:657db2ca63df242a3a8bb2",
            measurementId: "G-4NXRESMTJY"
        };
        firebase.initializeApp(config);
        const messaging = firebase.messaging();
        
        messaging
            .requestPermission()
            .then(function () {
                return messaging.getToken()
            })
            .then(function(token) {
                $('input#device_token').val(token);
            })
            .catch(function (err) {
                console.log("Unable to get permission to notify.", err);
            });
    
        messaging.onMessage(function(payload) {
            const noteTitle = payload.notification.title;
            const noteOptions = {
                body: payload.notification.body,
                icon: payload.notification.icon,
            };
            new Notification(noteTitle, noteOptions);
        });
    });
</script>