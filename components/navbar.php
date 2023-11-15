<nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="./index.php">Group_22</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <?php if(isset($_SESSION["user_id"])) { ?>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="./index.php">Home</a>
                </li>
            <?php } ?>
        </ul>

        <?php promptUsername(); ?>
        <?php if(isset($_SESSION["user_id"])) { ?>
            <!-- Logout button -->
            <form action="includes/logout.inc.php" method="post">
                <button class="btn btn-outline-primary">Logout</button>
            </form>
        <?php } ?>
        </div>
    </div>
</nav>