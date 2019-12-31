<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Corporation Logo</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse mt-4" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Dropdown
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#">Disabled</a>
                </li>
            </ul>
        </div>
    </nav>
    <nav class="navbar navbar-expand-lg navbar-light bg-light border-line">
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item dropdown ml-5 mr-5">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        About Us
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Our Mission</a>
                        <a class="dropdown-item" href="#">Our Story</a>
                        <a class="dropdown-item" href="#">Our Client</a>
                        <a class="dropdown-item" href="#">Job Opportunities</a>
                        <a class="dropdown-item" href="#">Contact</a>
                    </div>
                </li>
                <li class="nav-item dropdown ml-5 mr-5">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Product
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Smart Seeding Machine</a>
                        <a class="dropdown-item" href="#">Smart Green House</a>
                        <a class="dropdown-item" href="#">Growth Measurement Device</a>
                        <a class="dropdown-item" href="#">Smart IoT Platform</a>
                        <a class="dropdown-item" href="#">Smart Decision Support System</a>
                    </div>
                </li>
                <li class="nav-item dropdown ml-5 mr-5">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Service
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Smart farm Construction</a>
                        <a class="dropdown-item" href="#">Smart farm Monitoring</a>
                        <a class="dropdown-item" href="#">Smart farm Consulting</a>
                        <a class="dropdown-item" href="#">Smart farm Operation</a>
                    </div>
                </li>
                <li class="nav-item dropdown ml-5 mr-5">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Community
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Public Notice</a>
                        <a class="dropdown-item" href="#">Smart farm News</a>
                        <a class="dropdown-item" href="#">Q&A</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

        @yield('content')

    <footer class="border-line">
        <div class="row justify-content-center">
            <div class="logo-img col-lg-3">Corporation</div>
            <div class="copyright col-lg-9">
                <div class="row offset-lg-3">
                    <a class="more-info" href="#">About</a>
                    <a class="more-info" href="#">Newsroom</a>
                    <a class="more-info" href="#">Related Sites</a>
                </div>
                <div class="address offset-lg-1">Salta&b 301, S Tower, 14, innovalley-ro 36-gil, Dong-gu, Daegu, Korea</div>
                <div class="info-company offset-lg-1">COPYRIGHT @ Salta&b Co., Ltd. All Rights Reserved.</div>
            </div>
        </div>
      </footer>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>