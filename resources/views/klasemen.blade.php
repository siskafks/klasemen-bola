<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Klasemen</title>
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
                <a class="nav-link text-dark" href="/matches">Match Result</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-primary active" aria-current="true" href="/klasemen">View Klasemen</a>
            </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="p-4">
                <h4>Klasemen</h4>
                @if($klasemen->isEmpty())
                    <p class="text-center mt-5">Tidak ada data klasemen yang tersedia.</p>
                @else
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Klub</th>
                            <th class="text-center">Ma</th>
                            <th class="text-center">Me</th>
                            <th class="text-center">S</th>
                            <th class="text-center">K</th>
                            <th class="text-center">GM</th>
                            <th class="text-center">GK</th>
                            <th class="text-center">Point</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $no = 1;
                        @endphp
                        @foreach($klasemen as $club)
                            <tr>
                                <td class="text-center">{{ $no }}</td>
                                <td class="text-center">{{ $club->club_name }}</td>
                                <td class="text-center">{{ $club->total_matches }}</td>
                                <td class="text-center">{{ $club->win }}</td>
                                <td class="text-center">{{ $club->draw }}</td>
                                <td class="text-center">{{ $club->lose }}</td>
                                <td class="text-center">{{ $club->win_goal }}</td>
                                <td class="text-center">{{ $club->lose_goal }}</td>
                                <td class="text-center">{{ $club->point }}</td>
                            </tr>
                        @php
                        $no++;
                        @endphp
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