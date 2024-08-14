<?php
session_start();

if (isset($_SESSION["email"])) {
  header('location: dashboard.php');
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./libs/bootstrap.min.css">
  <link rel="stylesheet" href="./libs/icons-1.11.1/font/bootstrap-icons.css">
  <title>Purchasing | Login</title>
</head>
<body>
  <header></header>
  <main>
  <?php
    require_once './vendor/autoload.php';

    // init configuration
    

    // create Client Request to access Google API
    $client = new Google_Client();
    $client->setClientId($clientID);
    $client->setClientSecret($clientSecret);
    $client->setRedirectUri($redirectUri);
    $client->addScope("email");
    $client->addScope("profile");

    // authenticate code from Google OAuth Flow
    if (isset($_GET['code'])) {
      try {
        $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
        if (isset($token['error'])) {
          throw new Exception('Error fetching access token: ' . $token['error']);
        }
        $client->setAccessToken($token['access_token']);

        // get profile info
        $google_oauth = new Google_Service_Oauth2($client);
        $google_account_info = $google_oauth->userinfo->get();
        $email = $google_account_info->email;
        $name = $google_account_info->name;
        $picture = $google_account_info->picture; // Get the user's profile picture URL

        // Fetch Google Email and check if recorded in database in PURJO app

        $_SESSION['email'] = $email;
        $_SESSION['name'] = $name;
        $_SESSION['picture'] = $picture;
        header('location: dashboard.php');
      } catch (Exception $e) {
        echo '<p>Error: ' . htmlspecialchars($e->getMessage()) . '</p>';
      }
     } else { ?>
      <div class="container">
          <div class="row justify-content-center align-items-center" style="height:100vh;">
            <div class="col-12">
              <input type="hidden" id="loginErr" value="<?=$msg?>">
              <div class="card mx-auto rounded-0 border p-md-3 p-1 shadow bg-dark" style="max-width:400px;">
                <div class="card-body">
                  <h3 class="fw-bold text-center text-warning">Purchasing</h3>
                  <small class="text-center d-block mb-2 text-white">Login form</small>
                  <form id="login-form">
                    <div class="d-grid">
                      <!-- <button type="submit" id="google-login-btn" class="btn btn-white mt-3 rounded-0 border border-2"> -->
                        <a href="<?= htmlspecialchars($client->createAuthUrl()) ?>" class="btn mt-3 rounded-0 border border-2">
                          <img src="./assets/img/google-logo.png" style="width:30px;height:30px;" alt="">  
                          <span class="text-white">
                            Login with Google
                          </span>
                        </a>
                      <!-- </button> -->
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
    <?php } ?>
  </main>
  <footer>
  </footer>
  <script src="./libs/bootstrap.bundle.min.js"></script>
  <script src="./libs/jquery.min.js"></script>
  <script src="./libs/sweetalert2.all.min.js"></script>
  <script>
    $(document).ready(function() {
      // $('#google-login-btn').click(function(e) {
      //   $(this).attr('disabled', true)
      //   $(this).html(`
      //     <img src="./assets/img/google-logo.png" style="width:30px;height:30px;" alt="">
      //     Logging in... <span class="spinner-grow spinner-grow-sm" aria-hidden="true"></span>
      //   `)
       
      //   $.ajax({
      //     url: './assets/php/action.php',
      //     method: 'post',
      //     data: {
      //       action: 'google-login'
      //     },
      //     success: res => {
      //       console.log(res)
      //       $(this).attr('disabled', false)
      //       $(this).html(`
      //         <img src="./assets/img/google-logo.png" style="width:30px;height:30px;" alt="">
      //         Login with Google
      //       `)
      //     }
      //   })
      // })

    })
  </script>
</body>
</html>
