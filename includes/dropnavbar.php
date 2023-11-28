<nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top shadow-lg">
    <div class="container-fluid">
        <a class="navbar-brand" href="./index.php">Group_22</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <?php if($isLogin) { ?>

                <?php if($isPatient) { ?>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#patientData_section">Personal</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#testOrder_section">Test Order</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#testResult_section">Result</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#bill_section">Bill</a>
                    </li>
                <?php } ?>
            
                <?php if($isLabStaff) { ?>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#labTest_section">Lab Test</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#sampling_section">Sampling Type</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#patientsResult_section">Result</a>
                    </li>
                <?php } ?>

                <?php if($isSecretaries) { ?>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#appointment_section">Appointment</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#test_section">Test</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#order_section">Order</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#patientsResult_section">Result</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#billing_section">Billing</a>
                    </li>
                <?php } ?>

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