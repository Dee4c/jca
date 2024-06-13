<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Judge Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <style>

        @import url(https://fonts.googleapis.com/css?family=Roboto:400,500,300,700);
        body{
            background: rgb(0,0,0);
            background: linear-gradient(90deg, rgba(0,0,0,1) 17%, rgba(198,174,53,1) 75%);
            font-family: 'Roboto', sans-serif;
        }
        /* Google Font Link */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');
    
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }
    
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            height: 100%;
            background: rgb(168, 61, 61);
            background: linear-gradient(90deg, rgba(0, 0, 0, 1) 59%, rgba(198, 174, 53, 1) 99%);
            width: 250px;
            padding: 6px 14px;
            z-index: 99;
            transition: all 0.5s ease;
        }
    
        .sidebar .logo-details {
            height: 60px;
            display: flex;
            align-items: center;
            position: relative;
            padding-right: 50px;
        }
    
        .sidebar .logo-details .icon {
            position: absolute;
            top: 50%;
            right: -25px;
            transform: translateY(-50%);
            font-size: 22px;
            color: #fff;
            transition: all 0.5s ease;
        }
    
        .sidebar .logo-details .icon {
            right: 0;
        }
    
        .sidebar .logo-details .logo_name {
            color: #fff;
            font-size: 20px;
            font-weight: 600;
            margin-left: 40px;
            opacity: 1;
            transition: all 0.5s ease;
        }
    
        .sidebar .logo-details #btn {
            position: absolute;
            top: 50%;
            right: 0;
            transform: translateY(-50%);
            font-size: 22px;
            transition: all 0.4s ease;
            font-size: 23px;
            text-align: center;
            cursor: pointer;
            transition: all 0.5s ease;
        }
    
        .sidebar .logo-details #btn {
            text-align: right;
        }
    
        .sidebar i {
            color: #fff;
            height: 60px;
            min-width: 50px;
            font-size: 28px;
            text-align: center;
            line-height: 60px;
        }
    
        .sidebar .nav-list {
            margin-top: 20px;
            height: 100%;
        }
    
        .sidebar li {
            position: relative;
            margin: 8px 0;
            list-style: none;
        }
    
        .sidebar li .tooltip {
            position: absolute;
            top: -20px;
            left: calc(100% + 15px);
            z-index: 3;
            background: #fff;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.3);
            padding: 6px 12px;
            border-radius: 4px;
            font-size: 15px;
            font-weight: 400;
            opacity: 0;
            white-space: nowrap;
            pointer-events: none;
            transition: 0s;
        }
    
        .sidebar li:hover .tooltip {
            opacity: 1;
            pointer-events: auto;
            transition: all 0.4s ease;
            top: 50%;
            transform: translateY(-50%);
        }
    
        .sidebar li.open .tooltip {
            display: none;
        }
    
        .sidebar input {
            font-size: 15px;
            color: #fff;
            font-weight: 400;
            outline: none;
            height: 50px;
            width: 100%;
            width: 50px;
            border: none;
            border-radius: 12px;
            transition: all 0.5s ease;
            background: #1d1b31;
        }
    
        .sidebar li a {
            display: flex;
            height: 100%;
            width: 100%;
            border-radius: 12px;
            align-items: center;
            text-decoration: none;
            transition: all 0.4s ease;
            background: #11101D;
        }
    
        .sidebar li a:hover {
            background: #FFF;
        }
    
        .sidebar li a .links_name {
            color: #fff;
            font-size: 15px;
            font-weight: 400;
            white-space: nowrap;
            opacity: 1;
            pointer-events: auto;
            transition: 0.4s;
        }
    
        .sidebar li a:hover .links_name,
        .sidebar li a:hover i {
            transition: all 0.5s ease;
            color: #11101D;
        }
    
        .sidebar li i {
            height: 50px;
            line-height: 50px;
            font-size: 18px;
            border-radius: 12px;
        }
    
        .sidebar li.profile {
            position: fixed;
            height: 60px;
            width: 78px;
            left: 0;
            bottom: -8px;
            padding: 10px 14px;
            background: #1d1b31;
            transition: all 0.5s ease;
            overflow: hidden;
        }
    
        .sidebar li.profile .profile-details {
            display: flex;
            align-items: center;
            flex-wrap: nowrap;
        }
    
        .sidebar li img {
            height: 45px;
            width: 45px;
            object-fit: cover;
            border-radius: 6px;
            margin-right: 10px;
        }
    
        .sidebar li.profile .name,
        .sidebar li.profile .job {
            font-size: 15px;
            font-weight: 400;
            color: #fff;
            white-space: nowrap;
        }
    
        .sidebar li.profile .job {
            font-size: 12px;
        }
    
        .sidebar .profile #log_out {
            position: absolute;
            top: 50%;
            right: 0;
            transform: translateY(-50%);
            background: #1d1b31;
            width: 100%;
            height: 60px;
            line-height: 60px;
            border-radius: 0px;
            transition: all 0.5s ease;
        }
    
        .home-section {
            position: relative;
            background: #E4E9F7;
            min-height: 100vh;
            top: 0;
            left: 250px;
            width: calc(100% - 250px);
            transition: all 0.5s ease;
            z-index: 2;
        }
    
        .home-section .text {
            display: inline-block;
            color: #11101d;
            font-size: 25px;
            font-weight: 500;
            margin: 18px
        }
    
        @media (max-width: 420px) {
            .sidebar li .tooltip {
                display: none;
            }
        }
    
        /* Add custom styles here */
        .content {
            margin-left: 250px;
            padding: 20px;
        }
    
        /* Updated table styles */
        /* table {
            width: 100%;
            table-layout: fixed;
            background-color: #11101D;
            color: #fff;
        } */

        .tbl-header {
            background-color: rgba(255, 255, 255, 0.3);
        }

        .tbl-content {
    background-color: rgba(0, 0, 0, 0); /* Transparent background */
    height: 300px;
    overflow-x: auto;
    margin-top: 0px;
    border: 1px solid rgba(255, 255, 255, 0.3);
}

        th {
            padding: 15px; /* Adjusted padding for header */
            text-align: center; /* Center align header text */
            font-weight: 500;
            font-size: 14px; /* Increased font size */
            color: #fff;
            text-transform: uppercase;
        }

        td {
            padding: 15px; /* Adjusted padding for table cells */
            text-align: center; /* Center align cell text */
            vertical-align: middle;
            font-weight: 300;
            font-size: 14px; /* Increased font size */
            color: #fff;
            border-bottom: solid 1px rgba(255, 255, 255, 0.1);
        }

        /* Adjusted table responsive styles */
        .table-responsive {
            width: 80%; 
            margin:auto;
            overflow-x: auto;
            padding: 20px; 
            margin-left: 300px;
        }

        .title-id {
            color: white;
        }

        .form-select {
            width: 200px; /* Adjust the width as needed */
        }

        .category-table-gown{
            width: 1300px;
            margin-left: 317px;
        }

        .category-table {
            width: 1300px;
            margin-left: 300px;
            /* display: none;  */
        }
    </style>
</head>
<body>
<div class="sidebar">
    <div class="logo-details">
        <div class="logo_name">Miss Q</div>
    </div>
    <ul class="nav-list">
        <li>
            <a href="{{ route('judge.judge_dashboard') }}">
                <i class='bx bx-user'></i>
                <span class="links_name">PRELIMINARIES</span>
            </a>
            <span class="tooltip">PRELIMINARIES</span>
        </li>
        <li>
            <a href="{{route('judge.semi_finals_dash')}}">
                <i class='bx bxs-user-check'></i>
                <span class="links_name">SEMI-FINALS</span>
            </a>
            <span class="tooltip">SEMI-FINALS</span>
        </li>
        <li>
            <a href="#">
                <i class='bx bx-edit'></i>
                <span class="links_name">FINALS</span>
            </a>
            <span class="tooltip">FINALS</span>
        </li>
        <li class="profile">
            <div class="profile-details">
                <img src="profile.jpg" alt="profileImg">
                <div class="name_job">
                    <div class="name">Admin</div>
                </div>
            </div>
            <a href="{{ route('logout') }}" class="logout-link">
                <i class='bx bx-log-out' id="log_out"></i>
            </a>
        </li>
    </ul>
</div>

<div class="content">
    <div class="container">
        <h1 class="title-id">PRELIMINARY TABLE</h1>
        <div class="dropdown">
            <select class="form-select" id="categorySelect">
                <option value="">Select Category</option>
                <option value="pre_interview">Pre-Interview</option>
            </select>
        </div>        
        <br>

        <!-- Pre-Interview Form -->
        <div id="pre_interview_table" class="category-table-pre-interview" style="display: none;">
            <form id="pre_interview_form" action="{{ route('pre-interview-scores.store') }}" method="POST">
                @csrf
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Candidate Number</th>
                            <th>Composure (Score: 75-100)</th>
                            <th>Poise, Grace and Projection (Score: 75-100)</th>
                            <th>Judge Name</th>
                            <th>Total Score</th>
                            <th>Rank</th>
                        </tr>
                    </thead>
                    <tbody id="pre_interview_table_body">
                        <!-- Table content for pre-interview category will be dynamically populated here -->
                        @foreach($candidates as $candidate)
                        <tr>
                            <td>{{ $candidate->candidateNumber }}</td>
                            <td>
                                <!-- Input field for composure score -->
                                <input type="number" name="composure[{{ $candidate->id }}]" min="75" max="100" required onchange="calculateTotalScore({{ $candidate->id }})">
                            </td>
                            <td>
                                <!-- Input field for poise_grace_projection score -->
                                <input type="number" name="poise_grace_projection[{{ $candidate->id }}]" min="75" max="100" required onchange="calculateTotalScore({{ $candidate->id }})">
                            </td>
                            <td>
                                <!-- Input field for the judge's name -->
                                <input type="text" name="judge_name[]" required>
                            </td>
                            <!-- These are for displaying the total score and rank -->
                            <td id="totalScore_{{ $candidate->id }}"></td>
                            <td>
                                <!-- Display the rank -->
                                <input type="text" name="rank[]" id="rank_{{ $candidate->id }}" readonly>
                            </td>
                            <!-- Hidden input field to store the candidate ID -->
                            <input type="hidden" name="candidate_number[]" value="{{ $candidate->candidateNumber }}">
                            <!-- Hidden input field to store the candidate's rank -->
                            <input type="hidden" name="candidate_rank[]" id="candidate_rank_{{ $candidate->id }}">
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- Submit button -->
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        
        <script>
            // Function to calculate the total score and rank for pre-interview category
            function calculateTotalScore(candidateId) {
                var composureScore = parseInt(document.querySelector('input[name="composure[' + candidateId + ']"]').value) || 0;
                var poiseGraceProjectionScore = parseInt(document.querySelector('input[name="poise_grace_projection[' + candidateId + ']"]').value) || 0;
                var totalScore = (composureScore + poiseGraceProjectionScore) / 2; // Calculate the average
                document.getElementById("totalScore_" + candidateId).textContent = totalScore.toFixed(2); // Display total score
                updateRank();
            }
        
            // Function to update the rank for pre-interview category
            function updateRank() {
                var totalScores = [];
                document.querySelectorAll('td[id^="totalScore_"]').forEach(function(scoreElement) {
                    var score = parseFloat(scoreElement.textContent);
                    totalScores.push(score);
                });
                totalScores.sort(function(a, b) {
                    return b - a;
                });
                var rank = 1;
                var prevScore = null;
                totalScores.forEach(function(score) {
                    if (score !== prevScore) {
                        document.querySelectorAll('td[id^="totalScore_"]').forEach(function(scoreElement) {
                            if (parseFloat(scoreElement.textContent) === score) {
                                var candidateId = scoreElement.id.split("_")[1];
                                var rankInput = document.getElementById("rank_" + candidateId);
                                var candidateRankInput = document.getElementById("candidate_rank_" + candidateId);
                                rankInput.value = rank;
                                candidateRankInput.value = rank;
                            }
                        });
                    }
                    prevScore = score;
                    rank++;
                });
            }
        
            // Event listener for category selection change
            document.getElementById('categorySelect').addEventListener('change', function() {
                var selectedCategory = this.value;
                document.querySelectorAll('.category-table').forEach(function(table) {
                    table.style.display = 'none';
                });
                if (selectedCategory !== '') {
                    document.getElementById(selectedCategory + '_table').style.display = 'block';
                    if (selectedCategory === 'pre_interview') {
                        // Call calculateTotalScore for initial calculation in pre-interview category
                        document.querySelectorAll('input[name^="composure"], input[name^="poise_grace_projection"]').forEach(function(input) {
                            var candidateId = input.name.match(/\d+/)[0];
                            calculateTotalScore(candidateId);
                        });
                    }
                }
            });
        
            // Call calculateTotalScore for initial calculation in pre-interview category
            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('input[name^="composure"], input[name^="poise_grace_projection"]').forEach(function(input) {
                    var candidateId = input.name.match(/\d+/)[0];
                    calculateTotalScore(candidateId);
                });
            });
        </script>
        
      
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</html>
