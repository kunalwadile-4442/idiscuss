<!-- Modal -->
<div class="modal fade" id="signupModal" tabindex="-1" role="dialog" aria-labelledby="signupModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="signupModalLabel">Signup for an iDiscuss account</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/forum/partials/_handleSignup.php" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="signupEmail1">User Name</label>
                        <input type="text" required name="signupEmail" class="form-control" id="signupEmail1" aria-describedby="emailHelp">
                        <!-- <input type="email" required name="signupEmail" class="form-control" id="signupEmail1" aria-describedby="emailHelp"> -->
                        <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                    </div>
                    <div class="form-group">
                        <label for="signuppassword">Password</label>
                        <input type="password" required name="signupPassword" class="form-control" id="signupPassword">
                    </div>
                    <div class="form-group">
                        <label for="signupcpassword">Confirm Password</label>
                        <input type="password" required name="signupcPassword" class="form-control" id="signupcPassword" autocomplete="new-password">
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" required class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label"  for="exampleCheck1">Accept Terms and Conditions</label>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="submit" class="btn btn-info mb-2">Sign up</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
