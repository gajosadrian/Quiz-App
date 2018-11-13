@extends('layouts.app')

@section('content')
<div class="content">
    <h2 class="content-heading pt-5">
        <a href="{{ route('logout') }}" class="btn btn-sm btn-primary float-right">
            <i class="fa fa-check mr-5"></i> Wyloguj
        </a>
        Zalogowany jako <span class="text-primary font-w700">{{ $user->name }}</span>
    </h2>

    <div class="row">
        <div class="col-12">
            <ul>
                <li><a href="{{ route('admin.responses', ['grupa' => 'pytania1']) }}">Odpowiedzi uczestników: pytania1</a></li>
                <li><a href="{{ route('admin.responses', ['grupa' => 'pytania2']) }}">Odpowiedzi uczestników: pytania2</a></li>
                <li><a href="{{ route('admin.questions') }}">Baza pytań: {{ getPytaniaId() }}</a></li>
                <li>Żywotność sesji: <span class="text-primary">{{ ini_get('session.gc_maxlifetime') }}</span>. Powinno być 7200</li>
                <li>Czas systemowy: <span class="text-primary">{{ $currentTime }}</span></li>
            </ul>
        </div>
    </div>
</div>
@endsection
