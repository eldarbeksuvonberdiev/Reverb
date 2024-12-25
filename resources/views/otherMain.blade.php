<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    @vite('resources/js/app.js')
</head>

<body>
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-10">
                <nav class="navbar navbar-expand-lg bg-body-tertiary shadow-sm">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="#">Navbar</a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Features</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Pricing</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link disabled" aria-disabled="true">Disabled</a>
                                </li>
                            </ul>
                        </div>
                        <div class="position-relative">
                            <button class="btn btn-link p-0" id="notificationButton">
                                <i class="bi bi-bell fs-4 text-dark"></i>
                                <span
                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                                    id="notificationCount">
                                    {{ $messages->count() }}
                                </span>
                            </button>


                            <div class="dropdown-menu dropdown-menu-end shadow" id="notificationDropdown"
                                style="display: none; min-width: 200px;">
                                <form action="/status" method="POST">
                                    @foreach ($messages as $message)
                                        @csrf
                                        <div class="d-flex align-items-center p-2">
                                            <img src="{{ $message->image }}" alt="" width="50px"
                                                class="rounded-circle">
                                            <div class="ms-3">
                                                <strong>{{ $message->text }}</strong><br>
                                                <input type="hidden" name="id" value="{{ $message->id }}">
                                                <input type="submit" name="ok" value="{{ $message->text }}"
                                                    class="btn btn-link mt-1" style="height: 35px">
                                            </div>
                                        </div>
                                        <hr class="my-1">
                                    @endforeach
                                </form>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-10 offset-1">
                <form action="/product-store" method="POST" enctype="multipart/form-data" class="mb-4">
                    @csrf
                    <div class="mb-3">
                        <label for="image" class="form-label">Choose image</label>
                        <input type="file" name="image" class="form-control" id="image" required>
                    </div>
                    <div class="mb-3">
                        <input type="text" name="name" class="form-control" placeholder="Enter the message.."
                            required>
                    </div>
                    <button type="submit" name="ok" class="btn btn-primary w-10">Send</button>
                </form>
                <ul id="messageList" class="mt-5 list-group">
                    @foreach ($messages as $message)
                        <li class="list-group-item d-flex align-items-center">
                            <strong>{{ $message->text }}</strong><br>
                            <img src="{{ asset($message->image) }}" class="img-fluid m-3"
                                style="max-width: 100px;">
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script>
        document.getElementById('notificationButton').addEventListener('click', function() {
            const dropdown = document.getElementById('notificationDropdown');
            dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
        });
    </script>
</body>

</html>
