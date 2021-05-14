<!-- Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModal">Login to My-Forum</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/My-Forum/partials/_handleLogin.php" method="post">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="LoginEmail" class="form-label">Username</label>
                        <input type="text" class="form-control" id="LoginEmail" name="LoginEmail"
                            aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="Password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="LoginPassword" name="LoginPassword">
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
            </form>
        </div>
    </div>
</div>