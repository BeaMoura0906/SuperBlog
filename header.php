<header>
    <nav class="navbar navbar-expand-lg bg-dark border-bottom border-body" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Super Blog</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav" data-bs-theme="dark">
            <?php
                $isConnect = false;
                if( isset( $_SESSION['login'] ) && !$_GET['error'] ) {
                    $isConnect = true;
                }
            ?>
            <?php
            if( $isConnect ) {
            ?>
            <li class="nav-item">
                <a class="nav-link" href="logout.php">Se déconnecter</a>
            </li>
            <?php
            } else {
            ?>
            <li class="nav-item">
                <a class="nav-link" href="login.php">Se connecter</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="createUserStep1.php">M'inscrire</a>
            </li>
            <?php
            }
            ?>
        </ul>
        </div>
    </div>
    </nav>

</header>