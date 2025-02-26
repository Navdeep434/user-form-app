<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Form</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .container {
            margin-top: 20px;
        }
        .form-container, .table-container {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .table img {
            border-radius: 50%;
        }
        .btn-delete {
            background-color: red;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
        }
        .btn-delete:hover {
            background-color: darkred;
        }
        .form-label {
            font-weight: bold;
        }
        .form-control, .form-select {
            border-radius: 4px;
        }
        .btn-primary, .btn-warning, .btn-success {
            border-radius: 4px;
        }
        .alert {
            border-radius: 4px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="form-container">
                <h2 class="text-center mb-3">User Form</h2>

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="/store" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Profile Image (JPG)</label>
                        <input type="file" class="form-control" name="profile_image" required>
                    </div>
                
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" maxlength="25" required>
                    </div>
                
                    <div class="mb-3">
                        <label class="form-label">Phone</label>
                        <div class="d-flex">
                            <input type="text" class="form-control me-1" name="phone_country" value="+1" readonly style="width: 60px;">
                            <input type="text" class="form-control me-1" name="phone_area" placeholder="XXX" maxlength="3" required style="width: 80px;">
                            <input type="text" class="form-control me-1" name="phone_prefix" placeholder="XXX" maxlength="3" required style="width: 80px;">
                            <input type="text" class="form-control" name="phone_line" placeholder="XXXX" maxlength="4" required style="width: 100px;">
                        </div>
                    </div>
                
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>
                
                    <div class="mb-3">
                        <label class="form-label">Street Address</label>
                        <input type="text" class="form-control" name="street_address" required>
                    </div>
                
                    <div class="mb-3">
                        <label class="form-label">City</label>
                        <input type="text" class="form-control" name="city" required>
                    </div>
                
                    <div class="mb-3">
                        <label class="form-label">State</label>
                        <select class="form-select" name="state">
                            <option value="CA">CA</option>
                            <option value="NY">NY</option>
                            <option value="AT">AT</option>
                        </select>
                    </div>
                
                    <div class="mb-3">
                        <label class="form-label">Country</label>
                        <select class="form-select" name="country">
                            <option value="IN">IN</option>
                            <option value="US">US</option>
                            <option value="EU">EU</option>
                        </select>
                    </div>
                
                    <button type="submit" name="save" class="btn btn-primary">Save</button>
                    <button type="submit" name="export_current" class="btn btn-warning">Save & Export Current</button>
                    <a href="/export-all" class="btn btn-success">Export All</a>
                </form>
            </div>
        </div>
        <div class="col-md-8">
            <div class="table-container">
                <h2 class="text-center mb-3">Stored Records</h2>
                
                <div class="table-responsive">
                    <table class="table">
                        <thead class="table-dark">
                            <tr>
                                <th>Profile Image</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Street Address</th>
                                <th>City</th>
                                <th>State</th>
                                <th>Country</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td><img src="{{ asset('storage/'.$user->profile_image) }}" width="50" height="50"></td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->phone }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->street_address }}</td>
                                    <td>{{ $user->city }}</td>
                                    <td>{{ $user->state }}</td>
                                    <td>{{ $user->country }}</td>
                                    <td>
                                        <form action="/delete/{{ $user->id }}" method="POST" style="display:inline;">
                                            @csrf
                                                                                        <button type="submit" class="btn btn-delete" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
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

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>