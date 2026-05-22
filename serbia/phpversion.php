<?php
// Pre-defined user data array (Inbuilt data)
$allowed_application_id = "50912-42144-49935";
$allowed_verification_code = "a14a170-1566-4418-9d3c-Ja56413";

$userData = [
    "surname" => "MUHAMMAD",
    "name" => "KHAN",
    "dob" => "01/01/1991",
    "gender" => "MALE",
    "nationality" => "PAKISTANI",
    "passport" => "LM0154193",
    "visa_id" => "DGT303156",
    "validity" => "27/04/2026 - 26/07/2026",
    "stay" => "90 Days",
    "entries" => "Single Entry",
    "approval_date" => "27/04/2026",
    "photo" => "images/1777009282.png" // Replace with actual path to the applicant's image
];

$error_message = "";
$show_result = false;

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $app_id = trim($_POST['application_id'] ?? '');
    $ver_code = trim($_POST['verification_code'] ?? '');

    if ($app_id === $allowed_application_id && $ver_code === $allowed_verification_code) {
        $show_result = true;
    } else {
        $error_message = "Invalid Application ID or Verification Code.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ministry of Serbia - E-Visa Verification System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f6f9;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
        }
        .header-banner {
            background-color: #0b46a0;
            color: #ffffff;
            padding: 15px 20px;
        }
        .header-banner h1 {
            font-size: 1.15rem;
            margin: 0;
            font-weight: 500;
            line-height: 1.4;
        }
        .card-custom {
            background: #ffffff;
            border: none;
            border-radius: 4px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }
        .form-control {
            border: 1px solid #ced4da;
            padding: 10px 12px;
            border-radius: 4px;
        }
        .form-control:focus {
            box-shadow: none;
            border-color: #0b46a0;
        }
        .btn-verify {
            background-color: #0b46a0;
            border-color: #0b46a0;
            color: #fff;
            padding: 10px;
            font-weight: 500;
            width: 100%;
        }
        .btn-verify:hover, .btn-verify:focus {
            background-color: #08357a;
            color: #fff;
        }
        .status-approved {
            color: #198754;
            font-weight: 700;
            font-size: 1.1rem;
        }
        .data-label {
            font-size: 0.75rem;
            color: #6c757d;
            text-transform: capitalize;
            margin-bottom: 2px;
        }
        .data-value {
            font-size: 0.95rem;
            font-weight: 700;
            color: #000000;
        }
        .data-row {
            background-color: #f8f9fa;
            padding: 8px 12px;
            border-radius: 4px;
            margin-bottom: 8px;
        }
        .applicant-photo {
            width: 100px;
            height: auto;
            border: 1px solid #dee2e6;
            border-radius: 4px;
        }
        .section-title {
            font-size: 1.1rem;
            font-weight: 700;
            margin-top: 15px;
            margin-bottom: 10px;
            border-bottom: 1px solid #dee2e6;
            padding-bottom: 5px;
        }
        #loading-spinner {
            display: none;
        }
    </style>
</head>
<body>

    <div class="header-banner">
        <div class="container-fluid max-width-md">
            <h1>Ministry of Serbia<br>E-Visa Verification System</h1>
        </div>
    </div>

    <div class="container my-4" style="max-width: 500px;">
        <div class="card card-custom p-4 mb-4">
            <h2 class="h4 fw-bold mb-4">Check Your Visa</h2>
            
            <?php if (!empty($error_message)): ?>
                <div class="alert alert-danger py-2 px-3 fs-6" role="alert">
                    <?= htmlspecialchars($error_message) ?>
                </div>
            <?php endif; ?>

            <form id="visaForm" method="POST" action="">
                <div class="mb-3">
                    <input type="text" class="form-control" name="application_id" placeholder="Enter Application ID" value="<?= htmlspecialchars($app_id ?? '') ?>" required>
                </div>
                <div class="mb-3">
                    <input type="text" class="form-control" name="verification_code" placeholder="Enter Verification Code" value="<?= htmlspecialchars($ver_code ?? '') ?>" required>
                </div>
                <button type="submit" class="btn btn-verify">Verify Visa</button>
            </form>
        </div>

        <div id="loading-spinner" class="text-center my-4">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <p class="mt-2 text-muted">Verifying data with security servers...</p>
        </div>

        <?php if ($show_result): ?>
        <div id="results-container">
            <div class="text-center my-3 status-approved">
                <span class="me-1">✓</span> VISA APPROVED
            </div>

            <div class="card card-custom p-4 mb-3">
                <div class="section-title mt-0">Applicant Information</div>
                
                <div class="row g-2">
                    <div class="col-8">
                        <div class="data-row">
                            <div class="data-label">Surname</div>
                            <div class="data-value"><?= $userData['surname'] ?></div>
                        </div>
                        <div class="data-row">
                            <div class="data-label">Name</div>
                            <div class="data-value"><?= $userData['name'] ?></div>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <img src="<?= $userData['photo'] ?>" alt="Applicant Photo" class="applicant-photo">
                    </div>
                </div>

                <div class="data-row">
                    <div class="data-label">DOB</div>
                    <div class="data-value"><?= $userData['dob'] ?></div>
                </div>
                <div class="data-row">
                    <div class="data-label">Gender</div>
                    <div class="data-value"><?= $userData['gender'] ?></div>
                </div>
                <div class="data-row">
                    <div class="data-label">Nationality</div>
                    <div class="data-value"><?= $userData['nationality'] ?></div>
                </div>
                <div class="data-row">
                    <div class="data-label">Passport</div>
                    <div class="data-value"><?= $userData['passport'] ?></div>
                </div>

                <div class="section-title">Visa Details</div>
                
                <div class="data-row">
                    <div class="data-label">Visa ID</div>
                    <div class="data-value"><?= $userData['visa_id'] ?></div>
                </div>
                <div class="data-row">
                    <div class="data-label">Validity</div>
                    <div class="data-value"><?= $userData['validity'] ?></div>
                </div>
                <div class="data-row">
                    <div class="data-label">Stay</div>
                    <div class="data-value"><?= $userData['stay'] ?></div>
                </div>
                <div class="data-row">
                    <div class="data-label">Entries</div>
                    <div class="data-value"><?= $userData['entries'] ?></div>
                </div>
                <div class="data-row">
                    <div class="data-label">Approval</div>
                    <div class="data-value"><?= $userData['approval_date'] ?></div>
                </div>
            </div>
        </div>
        <?php endif; ?>

    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {
            // Check if PHP passed a successful state; if so, simulate loading first
            <?php if ($show_result): ?>
                // Temporarily hide results to show the fake loader simulation
                $('#results-container').hide();
                $('#loading-spinner').show();
                
                setTimeout(function() {
                    $('#loading-spinner').fadeOut('fast', function() {
                        $('#results-container').fadeIn('slow');
                    });
                }, 1200); // 1.2-second smooth loading effect
            <?php endif; ?>

            // Simple UI loading feedback on form submit before page reload
            $('#visaForm').on('submit', function() {
                $('.btn-verify').prop('disabled', true).text('Processing...');
            });
        });
    </script>
</body>
</html>