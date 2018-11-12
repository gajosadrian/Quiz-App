@extends('layouts.app')

@section('content')
<div class="content">
    <h2 class="content-heading pt-5">
        <a href="{{ URL::previous() }}" class="btn btn-primary btn-noborder">Wróć</a>
    </h2>

    <div class="row">
        <div class="col-12">
            <p>Wyszukiwanie: <span class="text-primary font-w600">Ctrl + F</span></p>
            <table class="table table-striped table-vcenter">
                <thead class="thead-light">
                    <tr>
                        <th class="text-center">#</th>
                        <th>E-mail</th>
                        <th>Kod dostępowy</th>
                        <th>Poprawne odp.</th>
                        <th>Czas wykonania</th>
                        <th class="text-center">Akcje</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($uczestnicy as $index => $uczestnik)
                        <tr class="{{ !$uczestnik->data_rozpoczecia_testu ? 'table-danger text-danger font-w600' : '' }}">
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>{{ $uczestnik->email }}</td>
                            <td>{{ $uczestnik->nazwa }}</td>
                            <td>{{ sizeof($uczestnik->correctQuestionIds) }}</td>
                            <td>{{ gmdate('i', $uczestnik->czas) }} min {{ gmdate('s', $uczestnik->czas) }} s</td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="#!" class="btn btn-sm btn-secondary js-tooltip" data-toggle="tooltip" title="Zobacz">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
