
<?php 
//calls.php 
require_once("functions.php");

$c = mysqli_connect("localhost","root","","SACCO");
If(!$c){  echo mysql_error(); exit();}
$act = $_REQUEST["action"];
?>

  < head>
<style>
body {background-color: #00ffff;
      background-image:url("image.jpg");
      background-repeat:repeat-x;
      background-attachment: fixed;
      background-position: 50%*50%;
      width:80%;
	height:50%;
    margin:150px;}
h1   {color: #808000;}
p    {color: #808000;
      font-size:20px;}
.eng{
	background-color:pink;
	color: white;
	text-align:center;
}
.eng h1{
	font-size:50px;
	font-weight:bold;
	
}

.boy{
	width:100%;
	height:50px;
	color:black;
	background-color:green;
	cursor:pointer;
	}
.boy ul li{
	display:inline;
	text-decoration:none;
	font-size:20px;
	font-weight:bold;
	padding-left:40px;
}
.boy a{
	color:black;
	text-decoration:none;
}
.boy a:hover{
	color:black;
	text-decoration:none;
	background:#ffe9de; 
}	
.vip{
	display:inline-block;
	position:relative;
}
.grievance{
	display:none;
	color:blue;
	position:absolute;
	margin-left:230px;
	border:1px solid black;
	width:270px;
	height:auto;
}
.vip:hover .grievance{
	display:block;
}
.grievance{
	background-color:#c2d6d6;
}
.grievance ul li{
	display:block;
	color:#000000;
	
}

footer{
	background:#8c8cc7;
}
footer p{margin-left:15px;}
</style>
</head>
<body>
<section style="margin-top:-50px;">
    <header>
    <div class="eng">

        <h1>FAMILY SACCO </h1>
    </div>
    </header>
</section>        
  <section>
  <marquee><p>welcome to family sacco</p></marquee>
<div class="boy">
     <ul>
       <li><a href="?action=home">Home</a>     
       <li><a href="?action=login">Login</a>     
       <li><a href="?ction=Display_File"> View_File</a>
       <li><a href="?action=Reg">Register</a>
       <li class="vip"><a href="?action=view_report">Report</a>
       <div class="grievance">
          <ul>
             <li><a href="?acition=contributions">contributions</a></li>
             <li><a href="?acition=BusinessIdeas">Business Ideas</a></li>
             <li><a href="?acition=LoansRequested">Loans Requested</a></li>
             <li><a href="?acition=LoansPaid">Loans Paid</a></li>
             <li><a href="?acition=AmountInLoans">Amount In Loans</a></li>
             <li><a href="?acition=AmountInBenefits">Amount In Benefits</a></li>
             <li><a href="?acition=RegularMembers">Regular Members</a></li>
          </ul> 
        </div>

      
  </ul>
  </div>
  </section>
  </br></br></br></br></br></br></br>
  <section>
  	<marquee direction="left" ><img src="SACCO.jpg" height="300" width="1090" alt="jpeg"><img src="image1.jpg" height="300" width="1090" alt="jpeg"><img src="Banners.jpg" height="300" width="1090" alt="jpeg"><img src="online.jpg" height="300" width="1090" alt="jpeg"><img src="app.jpg" height="300" width="1090" alt="jpeg"></marquee>
  	<marquee direction="down" width="250" height="200" behavior="alternate" ></marquee>
  	<footer>Copyright&copy;2017 <b>Family Sacco</b></footer>
  </section>
   




<td><br><br>
<!--  all your content including forms and tables of results will be displayed here. So put your ifs/ switch here   -->

<?php 

switch($act){
	
	
	case "login":
	return login();
	break;
	
	case "Reg":
	return register();
	break;
	
	case "View_Report":
	return View_report();
	break;
	
	case "Display_File()":
	return Display_File();
	break;
	
	case "ideas":
	return ideas();
	break;
	
	case "logout":
	return logout();
	break;
	case "loanrequests":
	return loanrequest();
	break;



}

?>



</td>

   </tr>


</table>
</body>


<!--  End of calls.php -->
