<?php
session_start();
?>
<html>
<style>
    td{
        border:1px solid black;
        float:left;
        font-size:50px;
        width:60px;
        text-align:center;
    }
    #drawnNumsTable td{
        font-size:20px;
        width:80px;
        float:top;
    }
    #bingoName td{
        background-color:darkgreen;
        color:goldenrod;
        font-family:sans-serif;  

    }
    div{
        float:left;
    }
    #buttonsDiv{
        margin-left:33%;
    }
    body{
        text-align:center;
    }
    #drawnDiv{
        overflow:scroll;
        height:500px;
        background-color:#997d51;
    }
    
    
</style>
<title>Bingo</title>
<body>
<h1 style="text-align:center">Auto mark-off Bingo!</h1>

<!--
1. Divide into 3 parts
    a. Buttons
    b. Bingo card
    c. Drawn numbers

-->
<?php
    //PRINT ERRORS!
    // error_reporting(E_ALL);
    // ini_set('display_errors',1);
    // ini_set('display_startup_errors',1);

    $bKey = 'bingoData'; //Key to access bingo card
    $dKey = 'drawnNumber';
    $mKey = 'markedNums';
    if(!array_key_exists($bKey,$_SESSION)){
        GenerateNewBingo();
    }
    if(isset($_POST['function'])){
        if($_POST['function'] == 'reset'){
            GenerateNewBingo();
        }
    }
    

    //repop session with new nums for bingo
    //reset drawn nums
    function GenerateNewBingo(){
        global $bKey;
        global $dKey;
        global $mKey;
        //generate row by row
        $_SESSION[$bKey] = array(); // replace old array with new one
        $_SESSION[$dKey] = array();
        $_SESSION[$mKey] = array_fill(0,25,0);
        for($i=0;$i<5;$i++){
            for($i2=0;$i2<5;$i2++){
                $randNum = rand(1+($i2*15),15+($i2*15));
                while(in_array($randNum,$_SESSION[$bKey])){
                    $randNum = rand(1+($i2*15),15+($i2*15));   
                }
                array_push($_SESSION[$bKey],$randNum);
            }
        }
    }

    //draw a random number that is unique
    function drawNumber(){
        global $dKey;
        $randNum = rand(1,75);
        while(in_array($randNum,$_SESSION[$dKey])){
            $randNum = rand(1,75);   
        }
        array_push($_SESSION[$dKey],$randNum);
        markNum();
    }


    function markNum(){
        global $dKey;
        global $bKey;
        global $mKey;
        foreach($_SESSION[$dKey] as $drawn){
            for($i=0;$i<count($_SESSION[$bKey]); $i++){
                if($drawn == $_SESSION[$bKey][$i]){
                    print("<style> #n".$i."{ background-color:#c7c7c7; }</style>");
                    $_SESSION[$mKey][$i] = 1;
                    checkBingo();
                }
            }
        }
    }

    function checkBingo(){
        global $mKey;
        //col check
        for($i=0;$i<5;$i++){
            if($_SESSION[$mKey][$i] == 1){
                checkCol($i);
            }
        }
        //row check
        for($i=0;$i<5;$i++){
            if($_SESSION[$mKey][5*$i] == 1){
                checkRow($i*5);
            }
        }

        checkDiagonals();
    }

    # IM LAZY I KNOW!
    function checkDiagonals(){
        global $mKey;
        $i = 0;
        if($_SESSION[$mKey][0] == 1){
            $i++;
        }
        if($_SESSION[$mKey][6] == 1){
            $i++;
        }
        if($_SESSION[$mKey][12] == 1){
            $i++;
        }
        if($_SESSION[$mKey][18] == 1){
            $i++;
        }
        if($_SESSION[$mKey][24] == 1){
            $i++;
        }
        $d1 = [0,6,12,18,24];
        if($i == 5){
            print("<style> #n".$d1[0]."{ background-color:#ff0000 !important; }</style>");
            print("<style> #n".$d1[1]."{ background-color:#ff0000 !important; }</style>");
            print("<style> #n".$d1[2]."{ background-color:#ff0000 !important; }</style>");
            print("<style> #n".$d1[3]."{ background-color:#ff0000 !important; }</style>");
            print("<style> #n".$d1[4]."{ background-color:#ff0000 !important; }</style>");
        }

        $i = 0;
        if($_SESSION[$mKey][4] == 1){
            $i++;
        }
        if($_SESSION[$mKey][8] == 1){
            $i++;
        }
        if($_SESSION[$mKey][12] == 1){
            $i++;
        }
        if($_SESSION[$mKey][16] == 1){
            $i++;
        }
        if($_SESSION[$mKey][20] == 1){
            $i++;
        }
        $d1 = [4,8,12,16,20];
        if($i == 5){
            print("<style> #n".$d1[0]."{ background-color:#ff0000 !important; }</style>");
            print("<style> #n".$d1[1]."{ background-color:#ff0000 !important; }</style>");
            print("<style> #n".$d1[2]."{ background-color:#ff0000 !important; }</style>");
            print("<style> #n".$d1[3]."{ background-color:#ff0000 !important; }</style>");
            print("<style> #n".$d1[4]."{ background-color:#ff0000 !important; }</style>");
        }
    }
    function checkCol($x){
        global $mKey;
        $isBingo = True;
        for($i=$x;$i<=(20+$x);$i+=5){
            if($_SESSION[$mKey][$i] == 0){
                $isBingo = False;
                break;
            }
        }
        if($isBingo){
            for($i=$x;$i<=(20+$x);$i+=5){
                print("<style> #n".$i."{ background-color:#ff0000 !important; }</style>");
            }
        }
    }
    function checkRow($y){
        global $mKey;
        $isBingo = True;
        for($i=$y;$i<=(4+$y);$i++){
            if($_SESSION[$mKey][$i] == 0){
                $isBingo = False;
                break;
            }
        }
        if($isBingo){
            for($i=$y;$i<=(4+$y);$i++){

                print("<style> #n".$i."{ background-color:#ff0000 !important; }</style>");
            }
        }

    }
?>

<!-- Buttons -->
<div id="buttonsDiv">
    <h3>Game Controls</h3>
    <form action method="POST">
        <input type="hidden" name="function" value="reset">
        <button type="submit" class="ui-button">New Card</button> 
    </form>
    <form action method="POST">
        <input type="hidden" name="function" value="draw">
        <button type="submit" class="ui-button">Draw a Number</button> 
    </form>
</div>

<!-- Bingo card -->
<div>
    <table>
        <thead>
            <tr id="bingoName">
                <td>B</td>
                <td>I</td>
                <td>N</td>
                <td>G</td>
                <td>O</td>
            </tr>
        </thead>
        <?php
            //DRAW THE REST OF THE BOARD!
            $index = 0;
            for($i=0;$i<5;$i++){
                print("<tr>");
                for($i2=0;$i2<5;$i2++){
                    print("<td id=\"n".$index."\">".$_SESSION[$bKey][$index]."</td>");
                    $index++;
                }
                print("</tr>");
            }
        ?>
    </table>
</div>

<!-- Drawn numbers -->
<div id="drawnDiv">

<table id="drawnNumsTable">
    <thead>
        <tr>
            <td style="background-color:#998254;">Drawn Numbers</td>
        </tr>
    <thead>
        <?php
            if(isset($_POST['function'])){
                if($_POST['function'] == 'draw'){
                    drawNumber();
                    $alternate = True;
    
                    for($i=0;$i<count($_SESSION[$dKey]);$i++){
                        if($alternate){
                            print("<tr><td style=\"background-color:#948d8d;\">".$_SESSION[$dKey][$i]."</td></tr>");
                            $alternate = !$alternate;
                        } else {
                            print("<tr><td style=\"background-color:#997d51;\">".$_SESSION[$dKey][$i]."</td></tr>");
                            $alternate = !$alternate;
    
                        }
                    }
                }
            }
        ?>

</div>

</body>
</html>