@extends('pages.template')
@section('content')
    <div class="pagetitle">
        <h1>Création des Reponses</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('reponse.index') }}">Reponse</a></li>
                <li class="breadcrumb-item active">Création</li>
            </ol>
        </nav>
    </div>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Formulaire de Création de Réponses</h5>
                        <form method="POST" action="{{ route('reponse.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <label for="quizId" class="col-sm-2 col-form-label">Quizzes :</label>
                                <div class="col-sm-10">
                                    <select class="form-select" name="quizId" id="quizId" required>
                                        <option selected disabled required>Selectionnez la question:</option>
                                        @foreach ($quizQuestions as $quiz)
                                            <option value="{{ $quiz->id }}" required>{{ $quiz->label }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="label" class="col-sm-2 col-form-label">Label :</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="label" id="label" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputNumber" class="col-sm-2 col-form-label">Correcte :</label>
                                <div class="col-sm-10">
                                    <input type="checkbox" class="form-check-input" name="isCorrect" value="1">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10 d-flex justify-content-end">
                                    <!-- Utilize d-flex and justify-content-end to align the button to the right -->
                                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
