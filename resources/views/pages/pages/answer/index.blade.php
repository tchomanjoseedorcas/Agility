@extends('pages.template')
@section('content')
    <div class="pagetitle">
        <h1>Réponses des Questionnaires</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('reponse.index') }}">Réponses</a></li>
                <li class="breadcrumb-item active">Accueil</li>
            </ol>
        </nav>
    </div>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="card-title">Réponses <span>/Liste des Réponses</span></h5>
                            <a href="{{ route('reponse.create') }}" class="btn btn-primary">Créer</a>
                        </div>
                        <div class="table-responsive">
                            <table id="reponses" class="table table-borderless" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Label</th>
                                        <th>Quiz ID</th>
                                        <th>Action(s)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($reponse as $index => $rep)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ substr($rep->label, 0, 30) . '...' }}</td>
                                            <td>{{ substr($rep->question->label, 0, 30) . '...' }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="{{ route('reponse.edit', $rep->id) }}"
                                                        type="button" class="btn btn-sm btn-primary dt-button mr-1"
                                                        style="margin-right: 10%;">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </a>
                                                    <a href="{{ route('reponse.show', $rep->id) }}"
                                                        type="button" class="btn btn-sm btn-warning dt-button mr-1"
                                                        style="margin-right: 10%;">
                                                        <i class="bi bi-eye-fill"></i>
                                                    </a>
                                                    <a href="{{ route('reponse.destroy', $rep->id) }}"
                                                        type="button" class="btn btn-sm btn-danger dt-button">
                                                        <i class="bi bi-archive-fill"></i>
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
            </div>
        </div>
    </section>
@endsection
