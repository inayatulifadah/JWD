<?php
include 'header.php';
?>
<br><br><br><br>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg rounded-4">
                <div class="card-header btn-pink text-white text-center">
                    <h3>Login</h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="../function/proses_login.php">
                        <!-- input email -->
                         <div class="mb-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" id="email" name="email" class="form-control" required>
                        </div>
                        <!-- input password -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Password:</label>
                            <input type="password" id="password" name="password" class="form-control" required>
                        </div>
                        <!-- button login -->
                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-primary btn-pink">Login</button>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center">
                    <small>Don't have an account? <a href="register.php" style="color: #532567;">Register</a></small>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Bootstrap untuk notifikasi -->
<div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="errorModalLabel">Login Failed</h5>
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

<br><br><br><br>

<?php
include 'footer.php';
?>

<script>
    // Show modal if there is an "error" parameter in the URL
    <?php if (isset($_GET['error'])): ?>
        var errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
        errorModal.show();
    <?php endif; ?>
</script>
