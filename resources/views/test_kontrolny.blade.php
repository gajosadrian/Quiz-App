@extends('layouts.app')

@section('content')
<div class="content">
    <div class="row justify-content-center">
        <div class="col-md-4 col-lg-4">
            <b-block title="Informacja" theme="czerwonetlo" noround full>
                <template slot="content">
                    <p>Celem testu kontrolnego jest opanowanie interfejsu i oswojenie się z nim, czyli parę przykładowych pytań z pokazaniem jak poprawnie uzupełnić test.</p>
                    <ul>
                        <li>Za każdą poprawną odpowiedź otrzymuje się 1 punkt, za błędną 0</li>
                        <li>Przycisk „Dalej” zatwierdza odpowiedź</li>
                        <li>Możliwość powrotu do niezatwierdzonych odpowiedzi</li>
                    </ul>
                    <p>Zwróć uwagę na różnicę między pytaniem z zaznaczoną odpowiedzią, a pytaniem bez odpowiedzi!</p>
                </template>
            </b-block>
        </div>
        <div class="col-md-8 col-lg-8">
            <test-quiz-app></test-quiz-app>
        </div>
    </div>
</div>
@endsection
