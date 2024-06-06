<?php
// Start session if not already started
session_start();
?>

<!-- author: Tilak K Chudasama
    file name: summary.php
    file description: This page shows a summary of all the user input/selected information awaiting final confirmation.
    -->

<include href="views/header.html"></include>

<!-- Navbar -->
<nav class="navbar navbar-expand-xl navbar-dark bg-transparent py-4">
    <div class="container-fluid">
        <!-- Brand name -->
        <a class="navbar-brand px-3 fs-1" href="home">AppTrackerHQ</a>
    </div>
</nav>
<!-- Navbar End -->

<!-- Container box -->
<section class="summary">
    <div class="mask d-flex align-items-center gradient-custom">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-9 col-xl-7">
                    <div class="card">
                        <div class="card-body p-4 p-md-5">
                            <h3 class="mb-4 pb-2">Summary</h3>

                            <!-- Personal information section -->
                            <div class="summary-section mb-4">
                                <h5 class="mb-3">Personal Information</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <strong>First Name:</strong> <?php echo isset($_SESSION['applicant']) ? unserialize($_SESSION['applicant'])->getFname() : ''; ?>
                                    </div>
                                    <div class="col-md-6">
                                        <strong>Last Name:</strong> <?php echo isset($_SESSION['applicant']) ? unserialize($_SESSION['applicant'])->getLname() : ''; ?>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-6">
                                        <strong>Email Address:</strong> <?php echo isset($_SESSION['applicant']) ? unserialize($_SESSION['applicant'])->getEmail() : ''; ?>
                                    </div>
                                    <div class="col-md-6">
                                        <strong>Phone Number:</strong> <?php echo isset($_SESSION['applicant']) ? unserialize($_SESSION['applicant'])->getPhone() : ''; ?>
                                    </div>
                                    <div class="col-md-6">
                                        <strong>State:</strong> <?php echo isset($_SESSION['applicant']) ? unserialize($_SESSION['applicant'])->getState() : ''; ?>
                                    </div>
                                </div>
                            </div>

                            <!-- Experience Section -->
                            <div class="summary-section mb-4">
                                <h5 class="mb-3">Experience</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <strong>Biography:</strong> <?php echo isset($_SESSION['applicant']) ? unserialize($_SESSION['applicant'])->getBio() : ''; ?>
                                    </div>
                                    <div class="col-md-6">
                                        <strong>Github Link:</strong> <?php echo isset($_SESSION['applicant']) ? unserialize($_SESSION['applicant'])->getGithub() : ''; ?>
                                    </div>
                                    <div class="col-md-6">
                                        <strong>Experience:</strong> <?php echo isset($_SESSION['applicant']) ? unserialize($_SESSION['applicant'])->getExperience() : ''; ?>
                                    </div>
                                    <div class="col-md-6">
                                        <strong>Willing to Relocate:</strong> <?php echo isset($_SESSION['applicant']) ? unserialize($_SESSION['applicant'])->getRelocate() : ''; ?>
                                    </div>
                                </div>
                            </div>

                            <!-- Mailing list selection section -->
                            <?php if (isset($_SESSION['Mailing']) && $_SESSION['Mailing']) : ?>
                            <div class="summary-section">
                                <h5 class="mb-3">Mailing List Selected</h5>
                                <div class="row">
                                    <!-- Display mailing list selections here -->
                                </div>
                            </div>
                            <?php endif; ?>

                            <div class="mt-4">
                                <a href="#" class="btn btn-success btn-lg">Submit</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


</body>
</html>
