<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>

<?php
if (isset($_POST['submit'])){
    $to = "alexx1984@ukr.net";
    $from = $_POST['email'];
    $subject = wordwrap($_POST['subject']);
    $body = $_POST['body'];

    mail("alexx1984@ukr.net", $subject,$body,$from);

}
?>


<!-- Navigation -->

<?php  include "includes/navigation.php"; ?>


<!-- Page Content -->
<div class="container">

    <section id="login">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-xs-offset-3">
                    <div class="form-wrap">
                        <h1>Contact</h1>

                        <form role="form" action="contact.php" method="post" id="login-form" autocomplete="off">
                            <div class="form-group">
                                <label for="email" class="sr-only">Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                            </div>
                            <div class="form-group">
                                <label for="subject" class="sr-only">Subject</label>
                                <input type="text" name="subject" id="subject" class="form-control" placeholder="Enter Your subject">
                            </div>
                            <div class="form-group">
                                <label for="body" class="sr-only">SMessage</label>
                                <textarea name="body" id="body" class="form-control"  cols="50"></textarea>
                            </div>

                            <input type="submit" name="submit" id="btn-send" class="btn btn-custom btn-lg btn-block" value="submit">
                        </form>

                    </div>
                </div> <!-- /.col-xs-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </section>


    <hr>



    <?php include "includes/footer.php";?>
