  <!DOCTYPE html>
  <html>
    <head>
      <meta charset="utf-8" />
      <meta name="viewport" content="initial-scale=1, width=device-width" />

      <link rel="stylesheet" href="./global.css" />
      <link rel="stylesheet" href="./index.css" />
      <link
        rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap"
      />
    </head>
    <body>
      <div class="auth">
        <section class="auth-inner">
          <form class="frame-parent" action="controlLogin.php" method="post">
            <div class="jilora-wrapper">
              <h3 class="jilora">JILORA</h3>
            </div>
            <button class="button">
              <img class="google-icon" alt="" src="./public/google.svg" />

              <div class="sign-up-with">Sign up with Google</div>
            </button>
            <div class="frame-group">
              <div class="rectangle-wrapper">
                <div class="frame-child"></div>
              </div>
              <div class="or-continue-with">or continue with</div>
              <div class="rectangle-container">
                <div class="frame-item"></div>
              </div>
            </div>
            <div class="field">
              <input class="label" placeholder="Entrer identifiant" type="text" id="identifiant" name="identifiant"/>
            </div>
            <div class="field1">
              <input class="label1" placeholder="Entrer mot de passe" type="text" id="mot_de_passe" name="mot_de_passe"/>
            </div>
            <button class="button1">
              <div class="continue">Continue</div>
            </button>
          </form>
        </section>
      </div>
    </body>
  </html>

