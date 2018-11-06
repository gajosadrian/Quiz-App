@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <b-block title="QUIZ HISTORYCZNY" theme="czerwonetlo" noround full>
                    <template slot="content">
                        <p><em>„Póty żyć będzie, póki tylko stanie Jednego męża, jednego pałasza – To Polska! … Polska!... To Ojczyzna nasza.”</em><p>
                        <p>
                            Zakres tematyczny obejmuje całość dziejów Polski ze szczególnym uwzględnieniem dróg do
                            odzyskania niepodległości w XIX i XX wieku oraz zagadnień dotyczących literatury i sztuki
                            polskiej w okresie dwudziestolecia międzywojennego.
                        </p>
                        <p>
                            <ul>
                                <li>Poziom: podstawowy</li>
                                <li>Ilość pytań: 45</li>
                                <li>Limit czasu: 50 minut</li>
                                <li>Pytania tekstowe i obrazkowe</li>
                                <li>Pytania zamknięte - zwykle 4 odpowiedzi do wyboru (wybór jednokrotny)</li>
                                <li>Możliwość powrotu do niezaakceptowanych odpowiedzi</li>
                                <li>Za każdą poprawną odpowiedź otrzymuje 1 punkt, za błędną 0</li>
                            </ul>
                        </p>
                        {{ ini_get('session.gc_maxlifetime') }}<br>
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
                                <label for="email">E-mail</label>
                                <input type="text" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="login">Login</label>
                                <input type="text" class="form-control" id="login" name="login" required>
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
