@extends('pages.template')

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pzjw1Esk5L6F8aJOTAj+CldBknwSW9/1SdFeDvOrvDFFMlI5SksmWO5fa/zIbbVJ" crossorigin="anonymous">
    </script>

    <div class="pagetitle">
        <h1>Création et Modification des Ressources</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('resources.index') }}">Ressources</a></li>
                <li class="breadcrumb-item active">{{ isset($resource) ? 'Modification' : 'Création' }}</li>
            </ol>
        </nav>
    </div>
    <section class="section">
        <div class="row">

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ isset($resource) ? 'Modifier la Ressource' : 'Formulaire de Création des Ressources' }}</h5>
                        <form method="POST" action="{{ isset($resource) ? route('resources.update', $resource->id) : route('resources.store') }}">
                            @csrf
                            @if(isset($resource))
                                @method('PUT')
                            @endif

                            <!-- Fields for the resource model -->
                            <div class="row mb-3">
                                <label for="project_id" class="col-sm-4 col-form-label">Projet :</label>
                                <div class="col-sm-8">
                                    <!-- You might want to replace this with a dropdown to select the project -->
                                    <input type="text" name="project_id" id="project_id" class="form-control" value="{{ isset($resource) ? $resource->project_id : old('project_id') }}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="label" class="col-sm-4 col-form-label">Label :</label>
                                <div class="col-sm-8">
                                    <input type="text" name="label" id="label" class="form-control" value="{{ isset($resource) ? $resource->label : old('label') }}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="description" class="col-sm-4 col-form-label">Description :</label>
                                <div class="col-sm-8">
                                    <textarea class="form-control" id="description" name="description" rows="3">{{ isset($resource) ? $resource->description : old('description') }}</textarea>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="budget" class="col-sm-4 col-form-label">Budget :</label>
                                <div class="col-sm-8">
                                    <input type="number" name="budget" id="budget" class="form-control" value="{{ isset($resource) ? $resource->budget : old('budget') }}">
                                </div>
                            </div>

                            <!-- Submit button -->
                            <div class="row mb-3">
                                <div class="col-sm-12 text-end">
                                    <button type="submit" class="btn btn-primary">{{ isset($resource) ? 'Enregistrer les modifications' : 'Enregistrer' }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Liste des Ressources</h5>
                        @if ($resources->isEmpty())
                            <p>Aucune ressource trouvée.</p>
                        @else
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Projet</th>
                                        <th>Label</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($resources as $resource)
                                        <tr>
                                            <td>{{ $resource->id }}</td>
                                            <td>{{ $resource->project_id }}</td>
                                            <td>{{ $resource->label }}</td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#editModal{{ $resource->id }}">
                                                    Edit
                                                </button>
                                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                    data-bs-target="#deleteModal{{ $resource->id }}">
                                                    Delete
                                                </button>
                                            </td>
                                        </tr>

                                        <!-- Edit Modal -->
                                        <div class="modal fade" id="editModal{{ $resource->id }}" tabindex="-1"
                                            aria-labelledby="editModalLabel{{ $resource->id }}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editModalLabel{{ $resource->id }}">
                                                            Modifier la ressource</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <!-- Contenu du formulaire d'édition -->
                                                        <form
                                                            action="{{ route('resources.update', $resource->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <!-- Ajoutez ici les champs que vous souhaitez éditer -->
                                                            <div class="mb-3">
                                                                <label for="project_id" class="form-label">Projet :</label>
                                                                <input type="text" class="form-control" id="project_id"
                                                                    name="project_id"
                                                                    value="{{ $resource->project_id }}">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="label" class="form-label">Label :</label>
                                                                <input type="text" class="form-control" id="label"
                                                                    name="label"
                                                                    value="{{ $resource->label }}">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="description" class="form-label">Description
                                                                    :</label>
                                                                <textarea class="form-control" id="description"
                                                                    name="description"
                                                                    rows="3">{{ $resource->description }}</textarea>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="budget" class="form-label">Budget :</label>
                                                                <input type="number" class="form-control" id="budget"
                                                                    name="budget" value="{{ $resource->budget }}">
                                                            </div>

                                                            <!-- ... (ajoutez d'autres champs) ... -->

                                                            <button type="submit" class="btn btn-primary">Enregistrer les
                                                                modifications</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Delete Modal -->
                                        <div class="modal fade" id="deleteModal{{ $resource->id }}" tabindex="-1"
                                            aria-labelledby="deleteModalLabel{{ $resource->id }}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="deleteModalLabel{{ $resource->id }}">Supprimer
                                                            la ressource</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Êtes-vous sûr de vouloir supprimer la ressource avec le label
                                                        "{{ $resource->label }}" ?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form
                                                            action="{{ route('resources.destroy', $resource->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Annuler</button>
                                                            <button type="submit"
                                                                class="btn btn-danger">Supprimer</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>

                            <!-- Affichage de la pagination -->
                            {{ $resources->links() }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
