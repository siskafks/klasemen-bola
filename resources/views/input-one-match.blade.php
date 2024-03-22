<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Input Skor Pertandingan</title>
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
                <a class="nav-link text-primary active dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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
        <div class="card-body">
            <div class="p-4">
                <h4 class="mb-3">One by One Input Score</h4>
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <form action="/one-match" method="POST" id="scoreForm">
                    @csrf
                    <div id="matches">
                        <div class="match row g-3 mb-3">
                            <div class="col-auto">
                                <select class="selectClub1 form-select border-primary" name="club1_id" required onChange="getSelectValue(this.value,1)">
                                    <option selected disabled>Select Club</option>    
                                    @foreach ($clubs as $club)
                                        <option value="{{ $club->club_id }}">{{ $club->club_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-auto">
                                <span> - </span>
                            </div>
                            <div class="col-auto">
                                <select class="selectClub2 form-select border-primary" name="club2_id" required required onChange="getSelectValue(this.value,2)">
                                    <option selected disabled>Select Club</option>    
                                    @foreach ($clubs as $club)
                                        <option value="{{ $club->club_id }}">{{ $club->club_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-auto">
                                <input class="form-control border-primary" type="number" name="score1" placeholder="Score 1" required>
                            </div>
                            <div class="col-auto">
                                <span> - </span>
                            </div>
                            <div class="col-auto">
                                <input class="form-control border-primary" type="number" name="score2" placeholder="Score 2" required>
                            </div>
                        </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    function getSelectValue(selectedValue, selectIndex) {
        if (selectedValue !== '') {
            if(selectIndex==1){
                $(".selectClub" + (selectIndex+1) + " option[value='" + selectedValue + "']").hide();
                $(".selectClub" + (selectIndex+1) + " option[value!='" + selectedValue + "']").show();
            }
            else if(selectIndex==2){
                $(".selectClub" + (selectIndex-1) + " option[value='" + selectedValue + "']").hide();
                $(".selectClub" + (selectIndex-1) + " option[value!='" + selectedValue + "']").show();
            }
        }
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
