<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
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
            background: rgb(0, 0, 0);
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
        table {
            width: 100%;
            table-layout: fixed;
            background-color: #11101D;
            color: #fff;
        }
    
        .tbl-header {
            background-color: rgba(255, 255, 255, 0.3);
        }
    
        .tbl-content {
            height: 300px;
            overflow-x: auto;
            margin-top: 0px;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
    
        th {
            padding: 20px 15px;
            text-align: left;
            font-weight: 500;
            font-size: 12px;
            color: black;
            text-transform: uppercase;
        }
    
        td {
            padding: 15px;
            text-align: left;
            vertical-align: middle;
            font-weight: 300;
            font-size: 12px;
            color: #fff;
            border-bottom: solid 1px rgba(255, 255, 255, 0.1);
        }
    
        /* Added button styles */
        .btn {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 5px 12px;
            text-align: center;
            text-decoration: none;
            font-size: 16px;
            cursor: pointer;
            border-radius: 4px;
        }
    
        .btn:hover {
            background-color: #45a049;
        }

        .add-judge-btn {
            margin-left: 500px;
            margin-bottom: 20px; /* Adjusted margin */
        }

        .title-id {
            color: white;
            margin: auto;
        }

        .btn.btn-danger {
            background-color: #ff6347; /* Red color */
        }

        .btn.btn-danger:hover {
            background-color: red;
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
            <a href="{{route('usermanage.dashboard')}}">
                <i class='bx bx-user'></i>
                <span class="links_name">User Management</span>
            </a>
            <span class="tooltip">User Management</span>
        </li>
        <li>
            <a href="{{ route('usermanage.candidate_dash')}}">
                <i class='bx bxs-user-check'></i>
                <span class="links_name">Candidates</span>
            </a>
            <span class="tooltip">Candidate Management</span>
        </li>
        <li>
            <a href="{{ route('usermanage.preliminary_dash') }}">
                <i class='bx bx-edit'></i>
                <span class="links_name">Preliminaries</span>
            </a>
            <span class="tooltip">Preliminaries</span>
        </li>
        <li>
            <a href="{{route('usermanage.semi_final_dash')}}">
                <i class='bx bx-line-chart'></i>
                <span class="links_name">Semi-Finals</span>
            </a>
            <span class="tooltip">Semi-Finals</span>
        </li>
        <li>
            <a href="#">
                <i class='bx bxs-crown'></i>
                <span class="links_name">Finals</span>
            </a>
            <span class="tooltip">Finals</span>
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
        <h1 class="title-id">USER MANAGEMENT</h1>
        <!-- Add Judge Button -->
        <div class="add-judge-btn">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addJudgeModal">Add Judge</button>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- Replace the code below with your user data retrieval and display logic -->
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->password }}</td>
                    <td>{{ $user->name }}</td>
                    <td>
                        <!-- Edit button -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal{{ $user->id }}">
                            Edit
                        </button>
                        <!-- Delete button -->
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $user->id }}">
                            Delete
                        </button>
                        <!-- Edit Account Modal -->
                        <div class="modal fade" id="editModal{{ $user->id }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel">Edit Account</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Edit form -->
                                        <form action="{{ route('user.update', $user->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group">
                                                <label for="edit_username">Username</label>
                                                <input type="text" class="form-control" id="edit_username" name="edit_username" value="{{ $user->username }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="edit_password">Password</label>
                                                <input type="password" class="form-control" id="edit_password" name="edit_password" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="edit_name">Name</label>
                                                <input type="text" class="form-control" id="edit_name" name="edit_name" value="{{ $user->name }}" required>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Delete Account Modal -->
                        <div class="modal fade" id="deleteModal{{ $user->id }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel">Delete Account</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to delete the account for {{ $user->username }}?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <form action="{{ route('user.delete', $user->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


<!-- Add Judge Modal -->
<div class="modal fade" id="addJudgeModal" tabindex="-1" aria-labelledby="addJudgeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addJudgeModalLabel">Add Judge</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="judgeFormsContainer">
                <!-- Initial Judge Form -->
                <form id="addJudgeForm" method="POST" action="{{ route('addJudge') }}">
                    @csrf
                    @if(Session::has('success'))
                        <div class="alert alert-success">{{ Session::get('success') }}</div>
                    @endif
                    @if(Session::has('fail'))
                        <div class="alert alert-danger">{{ Session::get('fail') }}</div>
                    @endif
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" name="username" required autocomplete="username" autofocus>
                        <div id="usernameError" class="invalid-feedback"></div>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" required autocomplete="new-password">
                        <div id="passwordError" class="invalid-feedback"></div>
                    </div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" required autocomplete="new-name">
                        <div id="nameError" class="invalid-feedback"></div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Add Judge</button>
            </div>
            </form>
        </div>
    </div>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
