<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Bootstrap Test</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr"
      crossorigin="anonymous"
    />
</head>
<body class="p-5">

    <div class="card shadow-sm mb-4">
        <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white">
            <h5 class="mb-0">
                System Alerts 
                <span class="badge bg-light text-primary ms-2">3</span>
            </h5>
            <a href="#" class="btn btn-light btn-sm">View All Alerts</a>
        </div>
        <div class="card-body">
            <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <strong>Alert Title 1</strong>
                        <p class="mb-0 text-muted small">This is a sample alert message.</p>
                    </div>
                    <span class="badge bg-danger">New</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <strong>Alert Title 2</strong>
                        <p class="mb-0 text-muted small">Another alert message example here.</p>
                    </div>
                    <span class="badge bg-secondary">Read</span>
                </li>
            </ul>
            <div class="mt-3 text-center">
                <a href="#" class="btn btn-outline-primary btn-sm">See All Alerts</a>
            </div>
        </div>
    </div>

</body>
</html>
