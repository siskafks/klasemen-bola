<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Match Result</title>
</head>
<body>
    <div class="card">
        <div class="card-header">
            <h2 class="text-center mt-4">Klasemen Sepak Bola</h2>
            <ul class="nav nav-tabs card-header-tabs">
            <li class="nav-item">
                <a class="nav-link text-dark" href="/">Data Klub</a>
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
                <a class="nav-link text-primary active" aria-current="true" href="/matches">Match Result</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="/klasemen">View Klasemen</a>
            </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="p-4">
                <h4>Match Result</h4>
                @if($matches->isEmpty())
                    <p class="text-center mt-5">Tidak ada data pertandingan yang tersedia.</p>
                @else
                <table class="table">
                    <tbody>
                        @foreach($matches as $match)
                            <tr>
                                <td class="text-end">{{ $match->club1_name }}</td>
                                <td class="text-center">{{ $match->score1 }} - {{ $match->score2 }}</td>
                                <td class="text-start">{{ $match->club2_name }}</td>
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