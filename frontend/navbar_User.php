<style>
    .nav-link{
        color: rgb(186,227,222) !important;
    }
    .nav-link-active{
        color: rgb(140, 124, 250) !important;
    }
    
    .bg-dark{
        background-color: #1f2022 !important;
    }
    
    .navbar-brand img{
        width:100px;
        height: 35px;
    }
</style>

<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark" aria-label="label">

    <nav>
        <a class="navbar-brand" href="home.php">
            <img src="images/logo_nobackground.png" class="d-inline-block align-top" alt="logo for navbar"> 
        </a>
    </nav>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
                <a class="nav-link" href="home.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="faq.php">FAQ</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="aboutus.php">About Us</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="user_profile.php">User Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="home.php?logout='1'">Logout</a>
            </li>
        </ul>
    </div>
</nav>