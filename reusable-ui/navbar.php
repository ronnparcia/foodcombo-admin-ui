<nav>
    <div class="container d-flex justify-content-between align-items-center">
        <!-- Logo -->
        <img src="assets/logo.png" id="logo" alt="">    

        <!-- Links -->
        <ul>
            <li><a href="menu.php">Menu Items</a></li>
            <li><a href="combos.php">Combos</a></li>
            <li><a href="report.php">Daily Report</a></li>
        </ul>
        
        <!-- Logout -->
        <div id="logout-wrapper" class="">
            <span class="nav-user"><?php echo $_SESSION["account_name"]; ?></span>
            <a href="logout.php">Logout</a>
        </div>
    </div>
</nav>