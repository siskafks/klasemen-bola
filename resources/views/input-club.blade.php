<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Data Club</title>
</head>
<body>
    <div class="card">
        <div class="card-header">
            <h2 class="text-center mt-4">Klasemen Sepak Bola</h2>
            <ul class="nav nav-tabs card-header-tabs">
            <li class="nav-item">
                <a class="nav-link text-primary active" aria-current="true" href="/">Data Klub</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link text-dark dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Skor
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="/one-match">One by One</a></li>
                    <li><a class="dropdown-item" href="/multiple-matches">Multiple Input</a></li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="/matches">Match Result</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="/klasemen">View Klasemen</a>
            </li>
            </ul>
        </div>
        <div class="card-body p-4">
            <div class="card border-primary mt-2 mb-3 w-50">
                <div class="card-header border-primary bg-transparent text-bold">Input Data Klub</div>
                    <div class="card-body">
                        <form action="/insert-club" method="POST">
                            @csrf
                            <div class="col mb-3">
                                <label for="club_name" class="form-label">Nama Klub</label>
                                <input type="text" class="form-control border-primary" id="club_name" name="club_name" placeholder="Masukkan nama klub" required>
                                @error('club_name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col mb-3">
                                <label for="club_city" class="form-label">Kota Klub</label>
                                <input type="text" class="form-control border-primary" id="club_city" name="club_city" placeholder="Masukkan kota klub" required>
                                @error('club_city')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="p-4">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <h4>Data Klub</h4>
                @if($clubs->isEmpty())
                    <p class="text-center mt-5">Tidak ada data klub yang tersedia.</p>
                @else
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Nama Klub</th>
                            <th>Kota Klub</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($clubs as $club)
                        <tr>
                            <td>{{ $club->club_name }}</td>
                            <td>{{ $club->club_city }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>