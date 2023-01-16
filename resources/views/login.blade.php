<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  <!-- Font Awesome -->
  <link
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
  <!-- Google Fonts -->
  <link
  href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
  <!-- MDB -->
  <link
  href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.1.0/mdb.min.css" rel="stylesheet" />

    <!-- <style>
        body {
            background: #6a70fc;
        }

        .btn-purple {
            background: #6a70fc;
            width: 100%;
            color: #fff;
        }


      </style> -->

      <title>Login</title>
    </head>

    <body>
      <!-- Pills navs -->
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-5">
            <h4 class="text-center text-black mb-0 mt-5"> LOGIN - RS BALI MED</h2>
              <div class="card mt-3">
                <div class="card-body">
                  <ul class="nav nav-pills nav-justified mb-3" id="ex1" role="tablist">
                    <li class="nav-item" role="presentation">
                      <a class="nav-link active" id="tab-login" data-mdb-toggle="pill" href="#pills-login" role="tab"
                      aria-controls="pills-login" aria-selected="true">Login</a>
                    </li>
                    <li class="nav-item" role="presentation">
                      <a class="nav-link" id="tab-register" data-mdb-toggle="pill" href="#pills-register" role="tab"
                      aria-controls="pills-register" aria-selected="false">Daftar</a>
                    </li>
                  </ul>
                  <!-- Pills navs -->

                  <!-- Pills content -->

                  <div class="tab-content">
                    <div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="tab-login">
                      <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <!-- Email input -->
                        <div class="form-outline mb-4">
                          <input type="email" id="email" name="email" class="form-control" />
                          <label class="form-label" for="email">Email</label>
                        </div>

                        <!-- Password input -->
                        <div class="form-outline mb-4">
                          <input type="password" id="password" name="password" class="form-control" />
                          <label class="form-label" for="password">Password</label>
                        </div>

                        <!-- 2 column grid layout -->
                        <!-- <div class="row mb-4">
                          <div class="col-md-6 d-flex justify-content-center"> -->
                            <!-- Checkbox -->
                            <!-- <div class="form-check mb-3 mb-md-0">
                              <input class="form-check-input" type="checkbox" value="" id="loginCheck" checked />
                              <label class="form-check-label" for="loginCheck"> Remember me </label>
                            </div>
                          </div> -->

                          <!-- <div class="col-md-6 d-flex justify-content-center"> -->
                            <!-- Simple link -->
                            <!-- <a href="#!">Forgot password?</a> -->
                          <!-- </div>
                        </div> -->

                        <!-- Submit button -->
                        <button type="submit" class="btn btn-primary btn-block mb-4">Login</button>

                      </form>
                    </div>
                    <div class="tab-pane fade" id="pills-register" role="tabpanel" aria-labelledby="tab-register">
                      <form>
                        <!-- Name input -->
                        <div class="form-outline mb-4">
                          <input type="text" id="registerName" class="form-control" />
                          <label class="form-label" for="registerName">Name</label>
                        </div>

                        <!-- Email input -->
                        <div class="form-outline mb-4">
                          <input type="email" id="registerEmail" class="form-control" />
                          <label class="form-label" for="registerEmail">Email</label>
                        </div>

                        <!-- Password input -->
                        <div class="form-outline mb-4">
                          <input type="password" id="registerPassword" class="form-control" />
                          <label class="form-label" for="registerPassword">Password</label>
                        </div>

                        <!-- Repeat Password input -->
                        <div class="form-outline mb-4">
                          <input type="password" id="registerRepeatPassword" class="form-control" />
                          <label class="form-label" for="registerRepeatPassword">Repeat password</label>
                        </div>

                        <!-- Submit button -->
                        <button type="submit" class="btn btn-primary btn-block mb-3">Daftar</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Pills content -->

        <!-- MDB -->
        <script
        type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.1.0/mdb.min.js"
        ></script>
      </body>

      </html>
