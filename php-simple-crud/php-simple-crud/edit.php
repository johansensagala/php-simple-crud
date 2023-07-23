<?php

include("header.php");
include("nav.php");

session_start();

?>
<div class="container">

    <?php
    include_once("connector.php");

    if  (isset($_GET['id'])) {
        $id = $_GET['id'];

        $sql = "SELECT * FROM user WHERE id=$id";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $username = $row['username'];
                $password = $row['password'];
                $email = $row['email'];
                $tgl_lahir = $row['tgl_lahir'];
            }
        }
        else {
            echo "ID not found";
        }

        $conn->close();

    }
    ?>
    </table>

    <?php if (isset($_SESSION['message'])) { ?>
        <div class="alert alert-<?= $_SESSION['message_type']?> alert-dismissible fade show" role="alert">
            <?= $_SESSION['message']?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php session_unset(); } ?>


    <h4 class="mt-3">Update user</h4>
    <form action="update.php" method="POST">

        <div class="mb-3">
            <label for="username">Username</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">@</span>
                </div>
                <input type="text" class="form-control" id="username" name="username" placeholder="Username" value="<?php echo $username; ?>" required>
                <div class="invalid-feedback" style="width: 100%;">
                    Your username is required.
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" value="<?php echo $password; ?>" placeholder="Type your password here">
            <div class="invalid-feedback">
                Please enter a valid email address for shipping updates.
            </div>
        </div>

        <div class="mb-3">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>" placeholder="you@example.com">
        </div>

        <div class="mb-3">
            <label for="tgl_lahir">Tanggal Lahir</span></label>
            <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" value="<?php echo $tgl_lahir; ?>">
        </div>

        <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">

        <input type="submit" name="update" class="btn btn-primary btn-md btn-block" value="Update">
    </form>
</div>

<?php include("footer.php"); ?>

</body>
</html>