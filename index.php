<?php
// handle your form
// Declare Variable $success
$err = NULL;
$success = false;

// message
if (isset($_POST["sb"])) {
    
    //clean up your array
    foreach ($_POST as $k => $v) {
        $_POST[$k] = filter_var($_POST[$k], FILTER_SANITIZE_STRING);
        $_POST[$k] = trim($_POST[$k]);
    }

// evaluate full-name
    if ($_POST["fullname"]) {
        $fn = $_POST["fullname"];
    } else {
        $err = "<p>Your name?</p>";
    }

// evaluate email
    if ($_POST["email"]) {
        $em = $_POST["email"];
    } else {
        $err .= "<p>Email?</p>";
    }

// checkbox
    $st = $_POST["student"];
    
    if($st === "default" ){
        // this part runs if checkbox is not checked
        if (!empty($fn) && !empty($em)) {
            $success = true;
            $feedback = "<p>Hello $fn. Thank you for your email. You are not registered in any of the current programs. We are going to email you at $em if any new programs are opened.</p>";
        }
        
    } else {
        
        //this part runs if checkbox is checked
        $mr = $_POST["major"];
        
        if ( $mr === "default" ) {
            // create error message for radio button
            $err .= "<p>Major: Web Scripting or Web Design ?</p>";
        }
        
        $courseLoad = $_POST["course-load"];

        if ( $courseLoad === "default") {
            //create error message for radio course load
            $err .= "<p>What is the course load ?</p>";
        }
        
        //Create long feedback here
        if(!empty($fn) && !empty($em) && $st !== "default" && $mr !== "default" && $courseLoad !== "default" ){
            
            //Also turn success to true
        
            $feedback = "<p>Hello $fn. You are registered as follows: 
            <br>
            Name: $fn
            <br>
            Email: $em
            <br>
            Major: $mr
            <br>
            Course load: $courseLoad
            <br>
            We are going to email you at $em if any change happens in your program.</p>";

        }
    } 

}

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>Form-Assignment-1</title>
        <link rel="stylesheet" href="font-awesome/font-awesome.css">
        <link rel="stylesheet" href="font-awesome/font-awesome.min.css">
        <link rel="stylesheet" href="css/styles.css">
    </head>

    <body>

        <header>
            <div class="box">
                <ul>
                    <li><i class="fa fa-home" aria-hidden="true"></i><a href="#">Home</a></li>
                    <li><i class="fa fa-envelope-o" aria-hidden="true"></i><a href="#">Contact</a></li>
                    <li><i class="fa fa-pencil" aria-hidden="true"></i><a href="#">Blog</a></li>
                </ul>
            </div>
            <div class="masthead">
                <h1>Let yourself be silently drawn by the stronger pull of what you really love.</h1>
            </div>
        </header>

        <!--Starting Form-->

        <main>
            <h2><i class="fa fa-pencil" aria-hidden="true"></i>Student Registration Form</h2>

            <!--------------------------form -------------------------->
            <form method="post" action="index.php">
                <div class="name">
                    <label for="fullname"><i class="fa fa-user" aria-hidden="true"></i> Full Name</label>
                    <input type="text" id="fullname" name="fullname" value="<?php if (isset($fn) && !$success) { echo $fn; } ?>">
                </div>

                <div class="email">
                    <label for="email"><i class="fa fa-envelope" aria-hidden="true"></i> Email</label>
                    <input type="text" id="email" name="email" value="<?php if (isset($em) && !$success) { echo $em; } ?>">
                </div>


                <!-------------------------- hidden form -------------------------->
                <div class="hiddenform">
                    <input type="hidden" name="student" value="default" class="student">
                    <input type="checkbox" name="student" class="program" value="student"
                    <?php if (isset($st) && $st === "Multimedia") { echo 'checked'; } ?>><label><i class="fa fa-gg" aria-hidden="true"></i> Student of Multimedia</label>

                    <div class="hide-info">
                        <section class="mr">
                            <p>Major in:</p>
                            <input type="hidden" name="major" value="default">
                            <input type="radio" name="major" value="Web Scripting">Web Scripting
                            <br>
                            <input type="radio" name="major" value="Web Design">Web Design
                        </section>

                        <section class="course">
                            <select name="course-load">
                                <option value="default">Course Load</option>
                                <option <?php if (isset($courseLoad) && $courseLoad === "Full-Time") { echo 'selected="true" '; } ?>>Full-Time</option>
                                <option <?php if (isset($courseLoad) && $courseLoad === "Part-Time") { echo 'selected="true" '; } ?> >Part-Time</option>
                            </select>
                        </section>
                    </div>
                </div>
                <!-------------------------- submit button -------------------------->
                <div>
                    <input type="submit" name="sb" id="submitbutton" value="Insert Data">
                </div>
            </form>
        </main>
        <div class="result">
            <?php
         
                if(isset($err)){
                    echo $err;
                    }


                if(isset($feedback)){
                    echo $feedback;
                    }
            ?>
        </div>

        <footer>
            <div class="footer">
                <p class= "info">Mini Makhija <i class="fa fa-copyright" aria-hidden="true"></i> 2017</p>
                <p class= "info">270A Dalehurst <br>Nepean, Ottawa <br> K2G4M8 <br>343.777.7940</p>
                <a class="smedia" href="https://www.facebook.com/"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                <a class="smedia" href="https://twitter.com/"><i class="fa fa-twitter" aria-hidden="true" ></i></a>
                <a class="smedia" href="https://www.instagram.com/"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                <a class="smedia" href="https://in.pinterest.com/"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a>
            </div>
        </footer>
    </body>

    </html>
