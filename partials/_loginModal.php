<!-- Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Login to iDiscuss</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/forum/partials/_handleLogin.php" method="post">
                <div class="modal-body">


                    <div class="form-group">
                        <label for="exampleInputEmail1">User Name</label>
                        <!-- <input type="email" name="loginEmail" required class="form-control" id="loginEmail" aria-describedby="emailHelp"> -->
                        <input type="text" name="loginEmail" required class="form-control" id="loginEmail" aria-describedby="emailHelp">
                        <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                            else.</small> -->
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" name="loginPassword" required class="form-control" id="loginPassword">
                    </div>
                    <div class="modal-footer  justify-content-center">
                        <button type="submit" class="btn btn-success mb-2">Login</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>