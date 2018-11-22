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
                @for ($i = 1; $i <= 4; $i++)
                    <li><a href="{{ route('admin.responses', ['grupa' => 'pytania' . $i]) }}">Odpowiedzi uczestników: pytania{{ $i }}</a></li>
                    <li><a href="{{ route('admin.questions', ['grupa' => 'pytania' . $i]) }}">Baza pytań: pytania{{ $i }}</a></li>
                @endfor
                <li>Żywotność sesji: <span class="text-primary">{{ ini_get('session.gc_maxlifetime') }}</span>. Powinno być 7200</li>
                <li>Czas systemowy: <span class="text-primary">{{ $currentTime }}</span></li>
            </ul>
        </div>
    </div>
</div>
@endsection
