<?php
// This is deprecated 
ini_set('session.save_path','C:\\Apache24\\PHPSessions');
ini_set('session.gc_maxlifetime', 14400);
session_start();
?>

<html>

    <script>
        //to avoid form resubmission!
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
    </script>

    <title>Reece Brogden's Portfolio</title>
    <style>
        
        .Header{
            text-align:center;
            font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            margin-top: 2%;
        }

        .feedback{
            position:fixed;
            bottom:0;
        }
        .projects{
            /*border: 1px black solid;*/
            float:left;
            height:fit-content;
        }
        
        
        #work{
            margin-left:20%;
            width: 30%;  
        }
        #personal{
            margin-left:10%;
            width: 30%;
        }
        .pProject{
            border: 2px gray solid;
        }

    </style>
<body>
    <!-- Header div -->
    <div class="Header">
        <h1> Reece Brogden's Portfolio </h1>
        <!--<p>
        I <i>would</i> have my own domain if my ISP didn't use CGnat for the ip on my router, and I really don't feel like spending 100+$/year on something that could cost 8$/year.
        So sorry about the ugly looking domain, it's the only static one that I can get with the tunneling software I <b>have</b> to use BECAUSE--while I understand why my ISP
        has to use CGnat due to the IPv4 limit--MY ISP SUCKS.  
        
        </p>-->
        <?php
            // ERROR TESTING:
            // ini_set('display_errors', '1');
            // ini_set('display_startup_errors', '1');
            // error_reporting(E_ALL);
            
            // check if a new user visted the site!
            $visited = "visted";
            if(!isset($_SESSION[$visited])){
                writeVisit();
                $_SESSION[$visited] = "vist!";
            }
            // foreach($_SERVER as $key => $value){
            //     print($key." ".$value."<br/>");
            // }

            // Button press for posting feedback
            if(array_key_exists("feedbackText",$_POST)){
                writeFeedback();
            }

            function writeFeedback(){
                $file = fopen("feedback.txt","a");
                fwrite($file,"\n");
                fwrite($file,$_POST["feedbackText"]);
                fwrite($file, ": ".date("m/d/Y")." ".time());
            }

            function writeVisit(){
                $file = fopen("vist.txt","a");
                fwrite($file,"\n");
                fwrite($file,"user: ".$_SERVER['HTTP_CF_CONNECTING_IP']);
                fwrite($file, ": ".date("m/d/Y")." ".time());
            }
        ?>
    </div>

<!-- List of projects -->
    <!-- Work experience -->
    <div class="projects" id="work">
        <h3>Work Experience</h3>
        <p class="pProject" id="ATS">
            <b>Active Therapy Systems LLC (ATS)</b>
            <br/>
            Responsibilities:
            <br/>
            &nbsp&nbsp&nbsp&nbsp
            -I performed system checks on a website and Android application that is responsible for parkinsins patients and their PTs to contact eachother.
            <br/>
            &nbsp&nbsp&nbsp&nbsp
            -I created an Android application to graph blood pressure.
            <br/>
            &nbsp&nbsp&nbsp&nbsp
            -I created PHP files to display patient information automatically on pdf files using the fpdf library.
        </p>
    </div>

        <!-- Personal Projects -->
    <div class="projects" id="personal">
        <h3>Personal Projects</h3>
        
        <p class="pProject" id="ThisWebsite">
            <b>THIS WEBSITE!:</b><br/>
            &nbsp&nbsp&nbsp&nbsp
            -I am using apache24 to host this website on my computer at home
            <br/>
            &nbsp&nbsp&nbsp&nbsp
            -I have written all the HTML, PHP, and JavaScript/ECMAScript that runs on this site
            <br/>
            &nbsp&nbsp&nbsp&nbsp
            -I have setup a tunneling system that allows me to avoid using a static IP that I could have gotten through my ISP
        </p>
        
        <p class="pProject" id="Bingo">
            <b>Bingo:</b><br/>
            &nbsp&nbsp&nbsp&nbsp
            A simple auto mark off Bingo. It works as per the rules of Bingo, and runs a php script off my PC to do so:
            <a href="Bingo.php" style="color:blue">Bingo.php</a>
        </p>
        <p class="pProject" id="Bingo">
            <b>The Weather:</b><br/>
            &nbsp&nbsp&nbsp&nbsp
            An example of using JavaScript/ECMAScript to make calls to an online API for data on weather from anywhere in the world. The user enters
            longitude and latitude along with their prefered units, and the site spits back out information. You can see all the JS used 
            with the inspect tool! <a href="Weather.html" style="color:blue">Weather.html</a>
        </p>
        <p class="pProject" id="unity">
            <b>Unity Projects:</b>
            <br/>
            &nbsp&nbsp&nbsp&nbsp
            -I have made a bunch of mini projects where I test out the limits on unity by trying out many different aspects that the software offers.
            <br/>
            <br/>
            &nbsp&nbsp&nbsp&nbsp
            -I made a small 2D game that allows the player to walk through a museum of NASA projects they have worked on.
            <br/>
            &nbsp&nbsp&nbsp&nbsp
            -A walkthrough of the supreme court ruling on a case, allowing the player to see judges opinions on the specific cases selected.
            <br/>
            &nbsp&nbsp&nbsp&nbsp
            -I have made simple AIs in 2D worlds to act as enemies against a player.
            <br/>
            &nbsp&nbsp&nbsp&nbsp
            -I have made a <u>very</u> simple batte arena game where the player must fight off infinitly spawning enemies
        </p>
        <p class="pProject" id="blender">
            <b>Blender:</b>
            <br/>
            &nbsp&nbsp&nbsp&nbsp
            -Rigging models
            <br/>
            &nbsp&nbsp&nbsp&nbsp
            -Animation
            <br/>
            &nbsp&nbsp&nbsp&nbsp
            -Creating simple 3D objects to import into things like unity
            <br/>
            &nbsp&nbsp&nbsp&nbsp
            -Creating simple models for 3D printing
        </p>
        <p class="pProject" id="UE4/5">
            <b>Unreal Engine:</b>
            <br/>
            &nbsp&nbsp&nbsp&nbsp
            -Created a short horror game in which you must find a key and escape while being hunted by a monster.
            <br/>
            &nbsp&nbsp&nbsp&nbsp
            -Created a basic 2D game in which you control a sprite character that can interact with the environment 
            <br/>
            &nbsp&nbsp&nbsp&nbsp
            -General testing/trying new mechanics that can be made within Unreal Engine
        </p>
        <p class="pProject" id="birdbot">
            <b>Discord Bot:</b>
            <br/>
            &nbsp&nbsp&nbsp&nbsp
            -I made a simple bot for discord that would respond to any commands I had created
            <br/>
            &nbsp&nbsp&nbsp&nbsp
            -The bot could use the internet and grab a random photo of a bird and post into the discord chat
            <br/>
            &nbsp&nbsp&nbsp&nbsp
            -It can send and add imjur links that it could then display
            
    </div>

    <div class="feedback">
        <h3>Resume feedback</h3>
        <form method="POST">
            <textarea id="feedbackText" name="feedbackText" rows="5" cols="100" placeholder="Your feedback here!"></textarea>
            <input type="submit" name="feedbackIn"/>
        </form>
    </div>
</body>
</html>
