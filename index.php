<?php 
    require_once 'includes/config_session.inc.php';
    require_once 'includes/signup/signupV.inc.php';
    require_once 'includes/login/loginV.inc.php';
    require_once 'includes/patients/patientsV.inc.php';
    require_once 'includes/labStaff/lab_staffV.inc.php';
    require_once 'includes/secretaries/secretariesV.inc.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="/lib/js/bootstrap.bundle.min.js"></script>
    <script src="/lib/jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/lib/css/bootstrap.min.css" /> 
    <link rel="stylesheet" type="text/css" href="styles.css" /> 
    <title>Group_22</title>
</head>
<body>

    <?php require_once 'includes/navbar.php'?>

    <div class="container <?php if(!isset($_SESSION["user_id"])) { //user NOT Login ?>center-screen <?php } ?>">
        <script>
            var session = <?php echo json_encode($_SESSION) ?>;
            console.log(session); //delete this line before submit
        </script>

        <?php if(!isset($_SESSION["user_id"])) { //user NOT Login ?>

            <!-- Signup Form -->
            <div class="container col-sm-10 col-md-7 col-lg-4 mt-4 mb-4" id="signupForm">
                <div class="card">
                    <div class="card-body p-5">            
                        <form action="includes/signup/signup.inc.php" method="post">
                            <h1 class="row mb-4 justify-content-center">Signup</h1>
                            <?php signupInput(); ?>
                            <?php //checkSignupErrors(); ?>
                            <button class="btn btn-outline-primary w-100" id="signupBtn">Signup</button>
                        </form>
                        <span>
                            Already have an account?
                        </span>
                        <a class="card-link" id="toLogin">Sign in</a>
                    </div>
                </div>
            </div>


            <!-- Login Form -->
            <div class="container col-sm-10 col-md-7 col-lg-4 mt-4 mb-4" id="loginForm">
                <div class="card">
                    <div class="card-body p-5">            
                        <form action="includes/login/login.inc.php" method="post">
                            <h1 class="row mb-4 justify-content-center">Login</h1>
                            <div class="form-floating mb-2">
                                <input class="form-control" id="username" name="username" placeholder="Username">
                                <label for="username" class="form-label">Username</label>
                            </div>
                            <div class="form-floating mb-2">
                                <input class="form-control" id="password" name="password" placeholder="Password">
                                <label for="password" class="form-label">Password</label>
                            </div>
                            <div class="pb-2" >
                                <select class="form-select" id="role" name="role" style="height:3.5rem;">
                                    <option selected value="1">Patients</option>
                                    <option value="2">Staff</option>
                                </select>
                            </div>
                            <?php //checkLoginErrors(); ?>
                            <div class="d-flex justify-content-center">
                                <button class="btn btn-outline-primary w-100 mb-2" id="loginBtn">Login</button>
                            </div>
                        </form>
                        <span>
                            Don't have an account?
                        </span>
                        <a class="card-link" id="toSignup">Register now</a>
                    </div>
                </div>
            </div>

        <?php } else { //user Logged In ?>
            <!-- show required data depends on user_role-->
            <!-- Print there personal info -->

            <?php 
                if (isset($_SESSION["role"]) && $_SESSION["role"] === "patient") {
                    //For patient
                    patientPersonalInfo();
                    patientTestOrder();
                    patientTestResult();
                    patientBill();
                } else if (isset($_SESSION["role"]) && $_SESSION["role"] === "lab_staff") {
                    //For Lab staff
                    patientsSamplingType();
                    labTest();
                    patientsResults();
                } else if (isset($_SESSION["role"]) && $_SESSION["role"] === "secretaries") {
                    //For Secretaries
                    patientsAppointment();
                    patientsBilling();
                    sec_PatientsResults();
                } else {
                    echo "You don't have permission to access resources! Please contact your administrator.";
                }
            ?>
            
        <?php } ?>

        <!-- Toast -->
        <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" id="cusTos" style="position:fixed; bottom:10px; right:10px; z-index:9999;" 
            <?php if(ErrorsInLogin() || ErrorsInSignup()) { ?>
                data-bs-autohide="false"
            <?php } ?>
        >
            <div class="toast-header">
                <strong class="me-auto">
                    <?php if(ErrorsInLogin() || ErrorsInSignup()) { ?>
                        <div class="form-error text-danger mb-2" id="toast_header_text">Alert!</div>
                    <?php } else if((isset($_GET["signup"])  && $_GET["signup"] === "success") || (isset($_GET["login"])  && $_GET["login"] === "success")) {?>
                        <div class="form-error text-success mb-2" id="toast_header_text">Login Success!</div>
                    <?php } ?>

                    <!-- lab_staff -->
                    <?php if(isset($_SESSION["errors_insertLabTest"])) {?>
                        <div class="form-error text-danger mb-2" id="toast_header_text">Alert!</div>
                    <?php } else if (isset($_GET["insertLabTest"])  && $_GET["insertLabTest"] === "success") { ?>
                        <div class="form-error text-success mb-2" id="toast_header_text">Insert Success!</div>
                    <?php }?>

                    <?php if(isset($_SESSION["errors_deleteLabTest"])) {?>
                        <div class="form-error text-danger mb-2" id="toast_header_text">Alert!</div>
                    <?php } else if (isset($_GET["deleteLabTest"])  && $_GET["deleteLabTest"] === "success") { ?>
                        <div class="form-error text-success mb-2" id="toast_header_text">Delete Success!</div>
                    <?php }?>


                    <?php if(isset($_SESSION["errors_insertPatientResult"])) {?>
                        <div class="form-error text-danger mb-2" id="toast_header_text">Alert!</div>
                    <?php } else if (isset($_GET["insertPatientResult"])  && $_GET["insertPatientResult"] === "success") { ?>
                        <div class="form-error text-success mb-2" id="toast_header_text">Insert Success!</div>
                    <?php }?>

                    <?php if(isset($_SESSION["errors_deletePatientResult"])) {?>
                        <div class="form-error text-danger mb-2" id="toast_header_text">Alert!</div>
                    <?php } else if (isset($_GET["deletePatientResult"])  && $_GET["deletePatientResult"] === "success") { ?>
                        <div class="form-error text-success mb-2" id="toast_header_text">Delete Success!</div>
                    <?php }?>

                    <!-- secretaries -->
                    <?php if(isset($_SESSION["errors_insertAppointment"])) {?>
                        <div class="form-error text-danger mb-2" id="toast_header_text">Alert!</div>
                    <?php } else if (isset($_GET["insertAppointment"])  && $_GET["insertAppointment"] === "success") { ?>
                        <div class="form-error text-success mb-2" id="toast_header_text">Insert Success!</div>
                    <?php }?>

                    <?php if(isset($_SESSION["errors_deleteAppointment"])) {?>
                        <div class="form-error text-danger mb-2" id="toast_header_text">Alert!</div>
                    <?php } else if (isset($_GET["deleteAppointment"])  && $_GET["deleteAppointment"] === "success") { ?>
                        <div class="form-error text-success mb-2" id="toast_header_text">Delete Success!</div>
                    <?php }?>


                    <?php if(isset($_SESSION["errors_insertBilling"])) {?>
                        <div class="form-error text-danger mb-2" id="toast_header_text">Alert!</div>
                    <?php } else if (isset($_GET["insertBilling"])  && $_GET["insertBilling"] === "success") { ?>
                        <div class="form-error text-success mb-2" id="toast_header_text">Insert Success!</div>
                    <?php }?>

                    <?php if(isset($_SESSION["errors_deleteBilling"])) {?>
                        <div class="form-error text-danger mb-2" id="toast_header_text">Alert!</div>
                    <?php } else if (isset($_GET["deleteBilling"])  && $_GET["deleteBilling"] === "success") { ?>
                        <div class="form-error text-success mb-2" id="toast_header_text">Delete Success!</div>
                    <?php }?>
                </strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                <?php checkLoginErrors(); ?>
                <?php checkSignupErrors(); ?>
                <?php checkInsertLabTestErrors(); ?>
                <?php checkDeleteLabTestErrors(); ?>
                <?php //checkDeleteSamplingTypeErrors(); ?>
                <?php checkInsertPatientResultErrors(); ?>
                <?php checkDeletePatientResultErrors(); ?>
                <?php checkInsertAppointmentErrors(); ?>
                <?php checkDeleteAppointmentErrors(); ?>
                <?php checkInsertBillingErrors(); ?>
                <?php checkDeleteBillingErrors(); ?>
            </div>
        </div>
        <script>
            $("#signupForm").hide();
            $("#toLogin").click(() => {
                $("#loginForm").show();
                $("#signupForm").hide();
            })
            $("#toSignup").click(() => {
                $("#loginForm").hide();
                $("#signupForm").show();
            })
            if(session.hasOwnProperty('errors_signup')) {
                $("#loginForm").hide();
                $("#signupForm").show();
            }

            $(document).ready(() =>{
                callToast();
            })

            function callToast() {
                const urlParams = new URLSearchParams(window.location.search);
                if (
                    (session.hasOwnProperty('errors_login') || session.hasOwnProperty('errors_signup') || session.hasOwnProperty('user_id')) && $('#toast_header_text').length || 
                    urlParams.get("signup") === "success" ||
                    urlParams.get("insertLabTest") === "success" ||
                    session.hasOwnProperty('errors_insertLabTest' ||
                    urlParams.get("deleteLabTest") === "success" ||
                    session.hasOwnProperty('errors_deleteLabTest') ||

                    urlParams.get("insertPatientResult") === "success" ||
                    session.hasOwnProperty('errors_insertPatientResult') ||
                    urlParams.get("deletePatientResult") === "success" ||
                    session.hasOwnProperty('errors_deletePatientResult') ||
                    
                    urlParams.get("insertAppointment") === "success" ||
                    session.hasOwnProperty('errors_insertAppointment') ||
                    urlParams.get("deleteAppointment") === "success" ||
                    session.hasOwnProperty('errors_deleteAppointment') ||

                    urlParams.get("insertBilling") === "success" ||
                    session.hasOwnProperty('errors_insertBilling') ||
                    urlParams.get("deleteBilling") === "success" ||
                    session.hasOwnProperty('errors_deleteBilling') 
                    )
                ){
                    let bsAlert = new bootstrap.Toast($('#cusTos'));
                    bsAlert.show();
                }
            }

            function checkEmptyBlock(blockData) {
                if(blockData === undefined || blockData === null){
                    return '-'
                } else {
                    return blockData
                }
            }

            const formatting = new Intl.NumberFormat("zh-HK", {
                currency: "HKD",
                style: "currency"
            })

            document.addEventListener("DOMContentLoaded", function(event) {
                console.log("DOM fully loaded and parsed");
            });

        </script>
    </div>

</body>
</html>