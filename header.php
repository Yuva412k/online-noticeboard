<?php
    if (!isset($_SESSION)) session_start();
    $home_active = '';
    $department_active = '';
    $contact_active = '';
    $login_active = '';
    $profile_active = '';
    if(isset($_SESSION['current_page'])){
        switch($_SESSION['current_page']){
            case "home": $home_active = ' active';break;
            case "department": $department_active = ' active';break;
            case "contact": $contact_active = ' active';break;
            case "login": $login_active = ' active';break;
            case "profile": $profile_active = ' active';break;
        }
        $active = $_SESSION['current_page'];
    }
?>

<!-- partial:index.partial.html -->
<nav class="navbar navbar-expand-custom navbar-mainbg">
        <a class="navbar-brand navbar-logo" href="index.php">Noticeboard</a>
                <form method="post" style="margin: 8px;width:220px;float:left" action="search.php"><input class="form-control" style="font-size: 14px" type="search" name="search" placeholder="Search posts, contacts, departments and clubs.." required/></form>
	
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fas fa-bars text-white"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <div class="hori-selector"><div class="left"></div><div class="right"></div></div>
                <li class="nav-item <?=$home_active?>">
                    <a class="nav-link" href="index.php"><i class="fas fa-home"></i>Home</a>
                </li>
                <li class="nav-item <?=$department_active?>">
                    <a class="nav-link" href="clubs.php"><i class="fas fa-book"></i>Departments</a>
                </li>
                <li class="nav-item <?=$contact_active?>">
                    <a class="nav-link" href="contact.php"><i class="fas fa-address-book"></i>Contact</a>
                </li>
                <?php
                    if(isset($_SESSION['username'])){
                ?>
                <li class="nav-item <?=$login_active?>">
                    <a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
                </li>
                <li class="nav-item <?=$profile_active?>">
                    <a class="nav-link" href="profile.php"><i class="fas fa-user"></i><?php echo $_SESSION['name'] ?></a>
                </li>
                <?php
                    }else{
                ?>
                <li class="nav-item <?=$login_active?>">
                    <a class="nav-link" href="login.php"><i class="fas fa-user"></i>Login</a>
                </li>
                <?php } ?>
            </ul>
        </div>
    </nav>

