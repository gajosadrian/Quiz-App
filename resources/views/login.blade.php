@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <noscript>
                    <div class="alert alert-danger alert-dismissable" role="alert">
                        <h3 class="alert-heading font-size-h4 font-w400">Błąd</h3>
                        <p class="mb-0">Do działania strony wymagany jest włączony JavaScript!</p>
                    </div>
                </noscript>
            </div>
            <div class="col-md-6">
                <b-block title="QUIZ HISTORYCZNY" theme="czerwonetlo" noround full>
                    <template slot="content">
                        <h4 class="text-white"><em>„Póty żyć będzie, póki tylko stanie Jednego męża, jednego pałasza – To Polska! … Polska!... To Ojczyzna nasza.”</em></h4>
                        <p>
                            Zakres tematyczny obejmuje całość dziejów Polski ze szczególnym uwzględnieniem dróg do
                            odzyskania niepodległości w XIX i XX wieku oraz zagadnień dotyczących literatury i sztuki
                            polskiej w okresie dwudziestolecia międzywojennego.
                        </p>
                        <p>
                            <ul>
                                {{-- <li>Kategoria: szkoła podstawowa i gimnazjum</li> --}}
                                <li>Ilość pytań: 45</li>
                                <li>Limit czasu: 60 minut</li>
                                <li>Pytania tekstowe i obrazkowe</li>
                                <li>Pytania zamknięte - zwykle 4 odpowiedzi do wyboru (wybór jednokrotny)</li>
                            </ul>
                        </p>
                        <p>
                            O zajętym miejscu decyduje, w pierwszej kolejności, liczba uzyskanych punktów. Po zalogowaniu najpierw masz możliwość rozwiązania testu kontrolnego. Sprawdź dostępne funkcje bez straty czasu! Czas upływa dopiero po wciśnięciu <em>„Rozpocznij quiz”</em>.<br>
                        </p>
                    </template>
                </b-block>
            </div>
            <div class="col-md-6 col-lg-4">
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissable" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <h3 class="alert-heading font-size-h4 font-w400">Błąd</h3>
                        <p class="mb-0">{!! $errors->first() !!}</p>
                    </div>
                @endif
                <b-block title="Logowanie" theme="obramowka" noround>
                    <template slot="content">
                        <form action="{{ route('user.tryLogin') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="email">E-mail opiekuna</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="login">Kod dostępowy</label>
                                <input type="password" class="form-control" id="login" name="login" required>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-noborder">Zaloguj</button>
                            </div>
                        </form>
                    </template>
                </b-block>
            </div>
        </div>
    </div>
@endsection
