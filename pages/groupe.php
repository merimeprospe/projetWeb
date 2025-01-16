<link rel="icon" type="image/x-icon" href="/assets/favicon.ico">
<link rel="stylesheet" href="../css/accueil.css">
<link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.6/css/unicons.css">
<script src="scripts/script.js"></script>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Group Page</title>
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    </head>
    <body>
        <div class="container-fluid">
            <!-- Navigation Bar -->
            <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
                <div class="container">
                    <a class="navbar-brand" href="#">Group Hub</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Profile</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Settings</a></li>
                        </ul>
                    </div>
                </div>
            </nav>

            <div class="row gx-4">
                <!-- Left Sidebar -->
                <aside class="col-md-3 bg-light p-3">
                    <h4>Your Groups</h4>
                    <input type="text" class="form-control mb-3" placeholder="Search groups...">
                    <ul class="list-group">
                        <li class="list-group-item"><a href="#">Group 1</a></li>
                        <li class="list-group-item"><a href="#">Group 2</a></li>
                        <li class="list-group-item"><a href="#">Group 3</a></li>
                        <li class="list-group-item"><a href="#">Group 4</a></li>
                    </ul>
                </aside>

                <!-- Main Content -->
                <main class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Group Name</h5>
                            <p class="card-text">Description of the selected group goes here. This section updates dynamically when a group is clicked.</p>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-body">
                            <form>
                                <div class="mb-3">
                                    <textarea class="form-control" rows="3" placeholder="What's on your mind?"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Post</button>
                            </form>
                        </div>
                    </div>

                    <div id="posts">
                        <div class="card mb-3">
                            <div class="card-body">
                                <h6 class="card-subtitle mb-2 text-muted">User Name</h6>
                                <p class="card-text">Post content goes here...</p>
                            </div>
                        </div>
                        <!-- Additional posts can be appended here -->
                    </div>
                </main>

                <!-- Right Sidebar -->
                <aside class="col-md-3 bg-light p-3">
                    <h4>Group Messages</h4>
                    <div id="messages" class="mb-3">
                        <div class="alert alert-secondary" role="alert"><strong>User 1:</strong> Message content...</div>
                        <div class="alert alert-secondary" role="alert"><strong>User 2:</strong> Another message...</div>
                        <!-- Additional messages can be appended here -->
                    </div>
                    <form class="d-flex">
                        <input type="text" class="form-control me-2" placeholder="Type a message...">
                        <button class="btn btn-primary" type="submit">Send</button>
                    </form>
                </aside>
            </div>
        </div>

        <!-- Bootstrap JS Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
