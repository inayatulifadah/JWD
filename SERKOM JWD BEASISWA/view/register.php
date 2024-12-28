<?php
include 'header.php';
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg rounded-4">
                <div class="card-header btn-pink text-white text-center">
                    <h3>Register</h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="../function/proses_register.php">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username:</label>
                            <input type="text" id="username" name="username" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" id="email" name="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password:</label>
                            <input type="password" id="password" name="password" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="confirm_password" class="form-label">Confirm Password:</label>
                            <input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
                        </div>
                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-pink btn-lg">Register</button>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center">
                    <small>Already have an account? <a href="login.php" style="color: #532567;">Login here</a></small>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Bootstrap untuk notifikasi -->
<div class="modal fade" id="notificationModal" tabindex="-1" aria-labelledby="notificationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="notificationModalLabel">Registration Error</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php
                // Display error message from URL if exists
                if (isset($_GET['error'])) {
                    echo htmlspecialchars($_GET['error']);
                }
                ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<br>

<?php
include 'footer.php';
?>

<script>
    // Show modal if there is an "error" parameter in the URL
    <?php if (isset($_GET['error'])): ?>
        var notificationModal = new bootstrap.Modal(document.getElementById('notificationModal'));
        notificationModal.show();
    <?php endif; ?>
</script>
