<!DOCTYPE html>
<!--
   Author : Vikram, K
   Date : 09 January, 2020
   PHP : Hashing and Unhashing
-->
<?php
    
    if(isset($_POST["hash"])) {$hashstring = $_POST["hash"];} else {$hashstring = "";}
    if(isset($_POST["unhash"])) {$unhashnum = $_POST["unhash"];} else {$unhashnum = "";}
            
    //Hashing - Input $s 
    //$s = "leepadg" or "promenade";
    function hashing($s){
        $letters = "acdegilmnoprstuw";
        $h = 7;
        if(!empty($s)){
            $chars = str_split($s);
            foreach($chars as $char){
                $h = bcadd(bcmul($h,37), stripos($letters,$char));
            }
            return $h;
        }
    }

    //Unhashing - Input $num
    //$num = 680131659347 or 945924806726376;
    function unhashing($num){
        $letters = "acdegilmnoprstuw";
        $result="";
        if(!empty($num)){
            while($num > 7)
            {
                $result = $letters[bcmod($num,37)].$result;
                $num = bcdiv($num,37); 
            }

            if($num != 7){
                return "Invalid Number Entered";
            }
        }
        return $result;
    }
?>
<html>
    <head>
        <meta charset="utf-8">         
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Hashing and Unhashing</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/main.css">
        <script>
            function ClearAll(){
               document.getElementById("hash").value = ""; 
               document.getElementById("unhash").value = "";
               document.getElementById("hashErr").innerHTML = "";
               document.getElementById("unhashErr").innerHTML = "";
               document.getElementById("hashresult").innerHTML = "";
               document.getElementById("unhashresult").innerHTML = "";
            }
        </script>
    </head>
    <body>
      <div class="container">
          
          <hr>
           <div class="row">
               <div class="col-md-12"><h3 align="center" style="font-family: Stardos Stencil">HASHING AND UNHASHING</h3></div>
           </div>
          <hr><br/>
          
        <form action="index.php" method="POST">
                <div class="row">
                    <div class="col-md-4" style="font-family: Merienda">Hash the string to number:</div>
                    <div class="col-md-4"><input type="text" id="hash" class="form-control" name="hash" value="<?php if(isset($hashstring)) { echo $hashstring; } ?>" placeholder="Enter a string" /></div>
                    <div class="col-md-4" id="hashErr">
                    <?php
                    
                    $hash = TRUE;
                    
                    if(isset($_POST['submit']) && (empty($_POST['hash']) || !isset($_POST['hash']))){
                        echo "<div style='color:blue'>Enter a Hash String</div>";
                        $hash = FALSE;
                    }
                    
                    $pattern = "/^[acdegilmnoprstuw]*$/";
                    if(isset($_POST['submit']) && !empty($hashstring) && !preg_match_all($pattern,$hashstring)){
                        echo "<div style='color:red'>Hash string must have only these characters 'acdegilmnoprstuw' and is case-sensitive</div>";
                        $hash = FALSE;
                    }
                    
                    ?>
                    </div>
                </div><br/>
                <div class="row">
                    <div class="col-md-4" style="font-family: Merienda">Unhash the number to string:</div>
                    <div class="col-md-4"><input type="text" id="unhash" class="form-control" name="unhash" value="<?php if(isset($unhashnum)) { echo $unhashnum; } ?>" placeholder="Enter a number" /></div>
                    <div class="col-md-4" id="unhashErr">
                    <?php
                    
                    $unhash = TRUE;
                    
                    if(isset($_POST["submit"]) && (empty($_POST['unhash']) || !isset($_POST['unhash']))){
                        echo "<div style='color:blue'>Enter an Unhash Number</div>";
                        $unhash = FALSE;
                    }
                    
                    if(isset($_POST["submit"]) && !empty($unhashnum) && !is_numeric($unhashnum)){
                        echo "<div style='color:red'>UnHash number must be numeric</div>";
                        $unhash = FALSE;
                    }
                    
                    ?>   
                    </div>
                </div><br/> 
            <div class="row">
                <div class="col-md-12">
                    <input type="submit" value="Submit" name="submit" class="btn btn-primary"/>
                    <input type="button" value="Clear" class="btn btn-default" onclick="ClearAll()"/>
                </div>
            </div>
            
            <br/><br/>
            
            <div class="row">
                <div class="col-md-12">
                    <hr><b style="font-family: Kaushan Script; font-size: 18px">ANSWERS:</b><hr>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-4" style="font-family: Merienda">Hash(String) -> Number: </div>
                <div class="col-md-4" id="hashresult" style="color:brown; font-weight: bold"><?php if($hash) { echo hashing($hashstring); } ?></div>
                <div class="col-md-4"></div>
            </div><br/>
            <div class="row">
                <div class="col-md-4" style="font-family: Merienda">Unhash(Number) -> String: </div>
                <div class="col-md-4" id="unhashresult" style="color:brown; font-weight: bold"><?php if($unhash) { echo unhashing($unhashnum); } ?></div>
                <div class="col-md-4"</div>
            </div>
            
        </form>
      </div>
    </body>
</html>
