<?php

include("header.php");
include("nav.php");

session_start();

?>
<div class="container">

    <div class="row mt-3">
        <div class="col-md-4">
            <h2>Data User</h2>
        </div>
    </div>
    <table class="table">
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Password</th>
            <th>Email</th>
            <th>Tanggal Lahir</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        <?php
        include_once("connector.php");

        $sql = "SELECT * FROM user";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>" . $row["id"] . "</td>" .
                    "<td>" . $row["username"] . "</td>" .
                    "<td>" . $row["password"] . "</td>" .
                    "<td>" . $row["email"] . "</td>" .
                    "<td>" . $row["tgl_lahir"] . "</td>" .
                    "<td>" . "<a class='btn btn-secondary' href='edit.php?id=" . $row["id"]. "'>" . "Edit" . "</a>" . "</td>" .
                    "<td>" . "<a class='btn btn-danger' onclick='return confirm(\"Hapus data?\")' href='delete.php?id=" . $row["id"]. "'>" . "Delete" . "</a>" . "</td>" .
                    "</tr>";
            }
        }
        else {
            echo "No result";
        }

        $conn->close();
        ?>
    </table>

    <?php if (isset($_SESSION['message'])) { ?>
        <div class="alert alert-<?= $_SESSION['message_type']?> alert-dismissible fade show" role="alert">
            <?= $_SESSION['message']?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php session_unset(); } ?>

    <h4 class="mb-3">Add a new user</h4>
    <form action="add.php" method="POST">
        <div class="mb-3">
            <label for="username">Username</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">@</span>
                </div>
                <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
            </div>
        </div>

        <div class="mb-3">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Type your password here">
        </div>

        <div class="mb-3">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com">
        </div>

        <div class="mb-3">
            <label for="tgl_lahir">Tanggal Lahir</span></label>
            <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir">
        </div>

        <input type="submit" name="simpan" class="btn btn-primary btn-md btn-block" value="Simpan">
    </form>
</div>

<?php include("footer.php"); ?>

</body>
</html>