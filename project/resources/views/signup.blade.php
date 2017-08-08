<title>Sign Up</title>
@extends('header')
@section('content')
    <link href="{{ asset('/css/default.css') }}" rel="stylesheet"/>

    <script type="text/javascript">
    function CheckCampus(campusname)
    {
        if (campusname == 'other')
            document.getElementById('div1').innerHTML = '<span class="glyphicon glyphicon-education"></span> <input type = "text" name = "Other" id = "Other" placeholder = "Campus Name"/>'
        else
            document.getElementById('div1').innerHTML='';
    }



    function CheckEducation(education)
    {
        if (education == 'other')
            document.getElementById('div2').innerHTML = '<span class="glyphicon glyphicon-book"></span> <input type = "text" name = "Other" id = "Other" placeholder = "Education Name"/>'
        else
            document.getElementById('div2').innerHTML='';
    }

    function CheckInterest(interest)
    {
        if (interest == 'other')
            document.getElementById('div3').innerHTML = '<span class="glyphicon glyphicon-list-alt"></span> <input type = "text" name = "Other" id = "Other" placeholder = "Area of Interest"/>'
        else
            document.getElementById('div3').innerHTML='';
    }

    function CheckPassword(input) 
    {
        if (input.value != document.getElementById('password').value) 
        {
            input.setCustomValidity('Password must be matching.');
        } 
        else 
        {
            // input is valid -- reset the error message
            input.setCustomValidity('');
        }
    }
    </script>

    <div class="container">
    <div class="imgcontainer">
        <img src="images/blogo2.png" alt = "blogo2" class = "img-rounded center-block img-responsive">
    </div>
        
    <h4>Come join the MONSTA community! Let's set up your account. Already have one? <a href="signin" id = "signin">Sign in</a> here.</h4>

    <div class="page-login-form box">
        <form role="form" class="login-form" method="POST" action="/checksignup" enctype="multipart/form-data">
         <input type = "hidden" name = "_token" value = "<?php echo csrf_token();?>">
            <div class="form-group">
                <div class="input-icon">
                    <span class="glyphicon glyphicon-user"></span> <input type="text" id="firstName" class="form-control" name="firstName" placeholder="First Name" required>
                </div>
            </div>

            <div class="form-group">
                <div class="input-icon">
                    <span class="glyphicon glyphicon-user"></span> <input type="text" id="lastName" class="form-control" name="lastName" placeholder="Last Name" required>
                </div>
            </div>

            <div class="form-group">
                <div class="input-icon">
                    <span class="glyphicon glyphicon-envelope"></span> <input type="email" id="email" class="form-control" name="email" placeholder="Email Address" required>
                </div>
            </div>

            <div class="form-group">
                <div class="input-icon">
                    <span class="glyphicon glyphicon-lock"></span> <input type="password" id = "password" class="form-control" name="password" placeholder="Password" required>
                </div>
            </div>

            <div class="form-group">
                <div class="input-icon">
                    <span class="glyphicon glyphicon-lock"></span> <input type="password" id = "confirmpw" name="confirmpw" class="form-control" placeholder="Retype Password" oninput="CheckPassword(this)" required>
                </div>               
            </div>

            <div class="form-group">
                <div class="input-icon">
                    <span class="glyphicon glyphicon-calendar"></span> <input type="text" name="dob" id = "dob" placeholder="DOB: YYYY-MM-DD"
                    pattern="(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))" 
                    title="Enter a date in this format YYYY-MM-DD"  required>
                </div>
            </div>
                    
            <div class="form-group">
                <div class="input-icon">
                    <span class="glyphicon glyphicon-phone-alt"></span> <input type="number" id="phone" class="form-control" name="phone" placeholder="Phone Number" required>
                </div>
            </div>
                  
            <div class="form-group">
                <div class="input-icon"> <span class="glyphicon glyphicon-education"></span>
                <select name = "campus" id ="campus" onchange='CheckCampus(this.options[this.selectedIndex].value);' required>
                    <option value = "" selected disabled>Campus </option>
                    <option value="iics">INTI SUBANG UNIVERSITY </option>
                    <option value="sunway">SUNWAY UNIVERSITY </option>
                    <option value="taylor">TAYLOR UNIVERSITY </option>
                    <option value="segi">SEGI UNIVERSITY </option>
                    <option value="tarc">TARC UNIVERSITY </option>
                    <option value="other">Other </option>
                </select>
                <div id = "div1"></div>
                </div>
            </div>

            <div class="form-group">
                <div class="input-icon"> <span class="glyphicon glyphicon-user"></span>
                <select name = "gender" id ="gender" required>
                    <option value = "" selected disabled>Gender </option>
                    <option value="male">Male </option>
                    <option value="female">Female </option>
                </select>
                </div>
            </div>

            <div class="form-group">
                <div class="input-icon"> <span class="glyphicon glyphicon-book"></span>
                <select name = "education" id ="education" onchange='CheckEducation(this.options[this.selectedIndex].value);' required>
                    <option value = "" selected disabled>Education </option>
                    <option value="business">Bachelor of Business </option>
                    <option value="accounting">Bachelor of Accounting </option>
                    <option value="cs">Bachelor of Computer Science </option>
                    <option value="commerce">Bachelor of Commerce </option>
                    <option value="engineering">Bachelor of Engineering </option>
                    <option value="other">Other </option>
                </select>
                <div id = "div2"></div>
                </div>
            </div>

            <div class="form-group">
                <div class="input-icon"> <span class="glyphicon glyphicon-list-alt"></span>
                <select name = "interest" id ="interest" onchange='CheckInterest(this.options[this.selectedIndex].value);' required>
                    <option value = "" selected disabled>Area of Interest </option>
                    <option value="art">Art </option>
                    <option value="it">Information Technology</option>
                    <option value="business">Business </option>
                    <option value="mass">Mass Comm </option>
                    <option value="law">Law</option>
                    <option value="other">Other </option>
                </select>
                <div id = "div3"></div>
                </div>
            </div>

            <div class="form-group">
                <div class="input-icon"> <span class="glyphicon glyphicon-camera"></span> <input type="file" id="image" name="image" required/>
                </div>
            </div>

            <div class="form-group">
                <div class="input-icon">
                    <span style="vertical-align:top;" class="glyphicon glyphicon-Pencil"></span> <textarea rows="3" cols="60" maxlength="100" id="aboutme" placeholder = "About me" required></textarea>
                </div>
            </div>

            <button type="submit" class = "btn btn-default login-btn">Sign Up</button>
        </form>
    </div>
</div>

@include('footer')
@stop