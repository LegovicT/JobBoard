<?php
echo '
<!doctype html>
<html lang ="en">
    <head>
        <title>JobBoard</title>
        <meta charset ="utf -8">
        <script type="text/javascript" src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="Style/styleL.css">
        <link rel="stylesheet" href="Style/styleS.css">
        <link rel="stylesheet" href="Style/styleM.css">
        
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <!--Fonts : Orbitron, Press Start 2P, Raleway-->
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Orbitron&family=Press+Start+2P&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&family=Raleway:wght@100;200&family=Source+Sans+Pro:ital,wght@0,300;1,200&display=swap" rel="stylesheet"> 
     
    </head>
    <body>
        <script type="text/javascript" src="Script/script.js"></script>';
    if(isset($_SESSION['User']) && $_SESSION['User']{'statut'} != 3)
    {
        
        if($_SESSION['User']{'statut'} == 2)
        {
            echo '
            <header>
                <nav>
                    <ol id="ol1">
                        <a href="index.php?main=home"><div id="home"></div></a>
                    </ol>
                    <h1 class="appTitle">JobBoard</h1>
                    <div class="main_pages">
                        <label for="toggle">☰</label>
                        <input type="checkbox" id="toggle">  
                        <ul class="mderoule">
                            <li><a href="index.php?main=home">Home</a></li>
                            <li><a href="index.php?main=postOffer">Post offer</a></li>
                            <li><a href="index.php?main=viewProfile">My profile</a></li>
                            <li><a href="index.php?main=myOffers">My offers</a></li>
                            <li><a href="index.php?main=myApplies">My applies</a></li>
                            <li><a href="index.php?main=profiles">View profiles</a></li>
                            <li><a href="index.php?main=companies">View companies</a></li>
                            <li><a href="index.php?main=fields">View fields</a></li>
                            <li><a href="index.php?main=disconnect">Log out</a></li>
                        </ul>  
                    </div>
                    <ol id="ol2">
                        <form id="searchBar"> 
                            <input type="search" id="query" name="q" placeholder="Search...">
                            <button>Search</button>
                        </form>
                    </ol>
                    <ol id="ol3">
                        <a href="index.php?main=postOffer"><div id="postOffer"></div></a>
                    </ol>
                    <ol id="ol4">
                        <li class="deroulant"><div id="profile"></div>
                            <ul class="sous">
                                <li><a href="index.php?main=viewProfile">My profile</a></li>
                                <li><a href="index.php?main=myOffers">My offers</a></li>
                                <li><a href="index.php?main=myApplies">My applies</a></li>
                                <li><a href="index.php?main=profiles">View profiles</a></li>
                                <li><a href="index.php?main=companies">View companies</a></li>
                                <li><a href="index.php?main=fields">View fields</a></li>
                                <li><a href="index.php?main=disconnect">Log out</a></li>
                            </ul>
                        </li>
                    </ol>
                </nav>
            </header>
            <main>';
        }        
        else if($_SESSION['User']{'statut'} == 1)
        {
            echo '
            <header>
                <nav>
                    <ol id="ol1">
                        <a href="index.php?main=home"><div id="home"></div></a>
                    </ol>
                    <h1 class="appTitle">JobBoard</h1>
                    <div class="main_pages">
                        <label for="toggle">☰</label>
                        <input type="checkbox" id="toggle">  
                        <ul class="mderoule">
                            <li><a href="index.php?main=home">Home</a></li>
                            <li><a href="index.php?main=postOffer">Post offer</a></li>
                            <li><a href="index.php?main=viewProfile">My profile</a></li>
                            <li><a href="index.php?main=myOffers">My offers</a></li>
                            <li><a href="index.php?main=myApplies">My applies</a></li>
                            <li><a href="index.php?main=disconnect">Log out</a></li>
                        </ul>  
                    </div>
                    <ol id="ol2">
                        <form id="searchBar"> 
                            <input type="search" id="query" name="q" placeholder="Search...">
                            <button>Search</button>
                        </form>
                    </ol>
                    <ol id="ol3">
                        <a href="index.php?main=postOffer"><div id="postOffer"></div></a>
                    </ol>
                    <ol id="ol4">
                        <li class="deroulant">
                            <div id="profile"></div>
                            <ul class="sous">
                                <li><a href="index.php?main=viewProfile">My profile</a></li>
                                <li><a href="index.php?main=myOffers">My offers</a></li>
                                <li><a href="index.php?main=myApplies">My applies</a></li>
                                <li><a href="index.php?main=disconnect">Log out</a></li>
                            </ul>
                        </li>
                    </ol>
                </nav>
            </header>
            <main>';
        }        
        else if($_SESSION['User']{'statut'} == 0)
        {
            echo '
            <header>
                <nav>
                    <ol id="ol1">
                        <a href="index.php?main=home"><div id="home"></div></a>
                    </ol>
                    <h1 class="appTitle">JobBoard</h1>
                    <div class="main_pages">
                        <label for="toggle">☰</label>
                        <input type="checkbox" id="toggle">  
                        <ul class="mderoule">
                            <li><a href="index.php?main=home">Home</a></li>
                            <li><a href="index.php?main=viewProfile">My profile</a></li>
                            <li><a href="index.php?main=myApplies">My applies</a></li>
                            <li><a href="index.php?main=disconnect">Log out</a></li>
                        </ul>  
                    </div>
                    <ol id="ol2">
                        <form id="searchBar"> 
                            <input type="search" id="query" name="q" placeholder="Search...">
                            <button>Search</button>
                        </form>
                    </ol>
                    <ol id="ol4">
                        <li class="deroulant">
                            <div id="profile"></div>
                            <ul class="sous">
                                <li><a href="index.php?main=viewProfile">My profile</a></li>
                                <li><a href="index.php?main=myApplies">My applies</a></li>
                                <li><a href="index.php?main=disconnect">Log out</a></li>
                            </ul>
                        </li>
                    </ol>
                </nav>
            </header>
            <main>';
        }
    }  
    else
    {
        echo '
        <header>
            <nav>
                <ol id="ol1">
                    <a href="index.php?main=home"><div id="home"></div></a>
                </ol>
                <h1 class="appTitle">JobBoard</h1>
                <div class="main_pages">
                    <label for="toggle">☰</label>
                    <input type="checkbox" id="toggle">  
                    <ul class="mderoule">
                        <li><a href="index.php?main=home">Home</a></li>
                    </ul>  
                </div>
            </nav>
        </header>
        <main>';
    }
?>