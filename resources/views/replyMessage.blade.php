@extends('layouts.app')

@section('content')
    <div class="container" style="margin-bottom: 150px">
        <div class="row">
            <div class="col-2">
                <div class="p-2" style="background-color: #d7d8da">
                    <button class="btn btn-primary form-control mb-5">Povezi FB profil</button>
                    <div style="padding: 10px; background-color: #bcbebf; margin-bottom: 2px">
                        <a href="{{ route('home') }}" style="text-decoration: none">Aktivni oglasi</a>
                    </div>
                    <div style="padding: 10px; background-color: #bcbebf; margin-bottom: 2px">
                        <a href="#" style="text-decoration: none">Neaktivni oglasi</a>
                    </div>
                    <div style="padding: 10px; background-color: #bcbebf; margin-bottom: 2px">
                        <a href="{{ route('home') }}" style="text-decoration: none">Moja vozila</a>
                    </div>
                    <div style="padding: 10px; background-color: #bcbebf; margin-bottom: 2px">
                        <a href="{{ route('showMessages') }}" style="text-decoration: none">Poruke <span>({{ auth()->user()->messages->count() }})</span></a>
                    </div>
                    <div style="padding: 10px; background-color: white; margin-bottom: 2px">
                        <p style="margin: 0">Korisnicka podrska</p>
                        <a href="#" style="text-decoration: none; font-weight: bold">E-mail kontakt</a>
                        <a href="#" style="text-decoration: none">021/1234567</a>
                    </div>
                </div>
            </div>
            <div class="col-8">
                <h4>Odgovor na poruku</h4>
                    @foreach($messages as $message)
                        <li class="list-group-item mb-2">
                            <p>Oglas: {{ $message->ad->brand }} {{ $message->ad->model }} {{ $message->ad->produced }}
                                <span class="float-end">{{ $message->created_at->format('l j. F Y. h:i:s A') }}</span>
                            </p>
                            <p>Vlasnik oglasa: {{ $message->ad->adOwner->name }} {{ $message->ad->adOwner->last_name }} - {{ $message->ad->adOwner->city }}</p>
                            <hr style="width: 30%">
                            <p>Od: {{ $message->sender->name }}</p>
                            <p><strong>{{ $message->text }}</strong></p>
                        </li>
                    @endforeach
                <li class="list-group-item mb-2">
                    <form action="{{ route('confirmReply') }}" method="post">
                        @csrf
                        <input type="hidden" name="sender_id" value="{{ $sender_id }}">
                        <input type="hidden" name="ad_owner_id" value="{{ $ad_owner_id }}">
                        <input type="hidden" name="ad_id" value="{{ $ad_id }}">
                        <textarea name="message" class="form-control" required></textarea>
                        <button type="submit" class="btn btn-primary form-control">Odgovori</button>
                    </form>
                </li>
            </div>
        </div>
    </div>
@endsection


