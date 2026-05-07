<?php
    session_start(); 
    $pageTitle = "Home";
    include 'header.php';
?>

<head>
    <link rel="stylesheet" href="index.css">
</head>


<main>
    <div id='wrap'>
        <div id="homeImg">
            <img src="logo_1.JPG" alt='homePageImg'>
        </div>
        <!-- <h1>Student Market Exchange</h1> -->
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
        <?php } else{ ?>
            <div class='sign'>
                <form action="listing.php">
                    <!-- <input class='button' type='submit' name='sign_in' value='Sign In'> -->
                    <div class="buttonLine">
                        <button type="submit" name="sell" class="greenButton">Sell</button>
                    </div>
                </form>
                <form action="product.php">
                    <!-- <input class='button' type='submit' name='sign_up' value='Sign Up'> -->
                    <div class="buttonLine">
                        <button type="submit" name="buy" class="greenButton">Buy</button>
                    </div>
                </form>
            </div>
        <?php }?>

        <div class="homeText" style="margin-top: 100px;">
            <h2>What Is SMX?</h2>
            <p>
                Welcome to Student Market Exchange (SMX), a marketplace built exclusively for students. Browse a wide 
                range of categories including books, clothing, electronics, furniture, appliances, and more, 
                with listings like old textbooks, TVs, couches, kitchen essentials, and everyday campus needs. 
                Whether you’re buying or selling, you’ll find great deals within a safe, student-only community. 
                Explore the collection and start shopping today.
            </p>
        </div>

        <div class="homeText">
            <h2>Our Goal</h2>
            <p>
                Created in 2026, SMX is an exclusive academic marketplace designed for students. Every year, 
                students struggle to buy and sell the essential items of college: textbooks, furniture, kitchen 
                supplies, etc. Some students turn to platforms like eBay or Facebook Marketplace to sell their 
                items, why others throw them away to avoid the hassle of finding someone to buy their items. 
                Students often meet strangers, deal with scams, or face unreliable transactions. Our proposed 
                solution to this problem is the Student Market Exchange (SMX).
            </p>
        </div>

        <div class="homeText">
            <h2>How It Works</h2>
            <p>
                By requiring a valid academic email upon account creation, we ensure that every buyer and seller 
                is part of a university. We enable students who use our platform to list items quickly and easily, 
                browse and buy essentials from students at the same university or students nearby, negotiate prices 
                through our built-in negotiation system, and complete transactions securely. Our goal is safety and 
                implicity. By consolidating everything into a student-only platform, SMX eliminates risks and 
                frustrations of traditional marketplaces while making it easier for students to buy, sell, and 
                connect with others in their communities.
            </p>
        </div>

    </div>
</main>
<?php include 'footer.php'; ?>