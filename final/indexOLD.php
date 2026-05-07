
<!--<head>
    <link rel="stylesheet" href="index.css">
</head>
-->

<?php
    session_start(); 
    $pageTitle = "Home";
    include 'header.php';
?>
    <main>
        <div id='wrap'>
        <h1>Student Market Exchange</h1>
        <div id= 'heroText'>Sell What You Don't Need. Find What You Do</div>
        <?php if (!isset($_SESSION["user"])) { ?>
            <div class='sign'>
                <form action="signin.php">
                    <!-- <input class='button' type='submit' name='sign_in' value='Sign In'> -->
                    <div class="buttonLine">
                        <button type="submit" name="sign_in" class="greenButton">Sign In</button>
                    </div>
                </form>
                <form action="accountCreate.php">
                    <!-- <input class='button' type='submit' name='sign_up' value='Sign Up'> -->
                    <div class="buttonLine">
                        <button type="submit" name="sign_up" class="greenButton">Sign Up</button>
                    </div>
                </form>
            </div>
        </div>
    <?php } ?>
</main>
<?php include 'footer.php'; ?>