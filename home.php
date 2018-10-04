<?php 
    session_start();
    include 'connection.php';
    include "header.php";
    if(isset($_SESSION['error'])){
        echo ($_SESSION['error']);
        unset($_SESSION['error']);
    }
    echo "<div class='container'>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus elementum
    vehicula est vitae sollicitudin. Ut pulvinar ultricies posuere. Integer
    ac iaculis dui, vel rhoncus erat. In tortor nisl, vulputate quis ante
    vel, vestibulum luctus nunc. Phasellus id lectus ante. Vivamus ultrices,
    nunc ut sollicitudin hendrerit, leo tellus lacinia nulla, at porta orci
    orci eget eros. Nullam id ullamcorper mauris, sit amet cursus risus.
    Nullam a commodo metus, et facilisis velit. Maecenas volutpat mattis
    odio vel dignissim. Etiam ac fringilla diam, suscipit sodales ipsum. Nam
    in velit quam. Nunc luctus tempor leo, vel rhoncus mi mattis nec. Lorem
    ipsum dolor sit amet, consectetur adipiscing elit. Nullam felis massa,
    ultrices sit amet turpis vel, accumsan blandit est. Etiam nec eros
    commodo, cursus turpis pulvinar, volutpat odio.<br><br></div>
    ";

    if(isset($_SESSION['login']) && $_SESSION['login']){
        echo "<div class='container'>Sed vitae turpis ac nisi malesuada blandit. Quisque eu molestie eros. Donec
        facilisis hendrerit augue, eu adipiscing sem lacinia non. Integer
        sodales purus odio, non pharetra massa accumsan in. In vitae nunc non
        erat posuere tempus a id ipsum. Suspendisse enim augue, bibendum eget
        nunc in, lacinia ultrices tortor. Nam enim lorem, gravida eget varius
        eu, euismod et purus. Etiam egestas sem eu nisi porttitor pharetra.
        Donec eu libero eu lorem convallis porta. Nullam interdum vitae lorem
        sit amet dignissim. Proin sit amet tortor ac odio varius dapibus nec at
        sem.</div>";
    }
    else {
        echo "<div class='container' style='color:grey'><a href='login.php'>Login</a> to view more</div>";
    }
?>