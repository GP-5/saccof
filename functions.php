<?php
function login(){
	$con=mysqli_connect("localhost","root","","SACCO");
?>	

<h1><center>FAMILY SACCO AUTOMATED SYSTEM</center></h1>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>FSAS</title>
<script type = "text/javacsript" event="onclick">
<link rel = "stylesheet" type ="text/css" href = "projectcss.css">
<link rel = "stylesheet" type ="text/css" href = "styles.css">
</head>
<body id ="bodylicious">	
<div id ="cssmenu2">
<ul>


<p style = "font-family:freestyle script;" align="center"><font size ="6">login !</font></p>
	<center>    
<div id ="cssmenu">
 <form action="caloz.php"?action="views" method="POST">
<table>
    <tr>
        <tr>
         <td>UserName:</td>
         <td><input type="text" name="username" required="required" placeholder="username" /></td>
    </tr>
        <td>Password:</td>
        <td><input type="password" name="pass" required="required"  placeholder="password" /></td>
    </tr>
<?php


if(isset($_POST['login'])){
if(empty($_POST['userName'])|| empty($_POST['password'])){
echo "<br><p style = 'font-family:freestyle script;' align='center'><font size ='6'>Hello, \n".$_POST['userName'].
		"Name Or Password missing!....Enjoy the system!!!</font></p>";
}

else{
$d=$_POST['userName'];
$c=$_POST['password'];      
$con=mysql_connect("localhost","root","","SACCO");
//$db=mysql_select_db("SACCO",$con);
$select=mysql_query("SELECT * FROM Member WHERE password='$c' AND username='$d' ",$con);
}

@$row=mysql_num_rows($select);
if($row >0){
  
  while($row=mysql_fetch_row($select,MYSQL_ASSOC)){
  $_SESSION["id"]=$row["username"]; 
  }
  
  
  header("?action=###");
}

else{
  echo "<br><p style = 'font-family:freestyle script;' align='center'><font size ='6'>Hello, \n".$_POST['username'].
  " Invalid Name or Password!....Retry!!!</font></p>";
}

mysql_close($con);

}

?>	

  </table>
	<input value="login" type="Submit" name="login" onclick="?action###?">
	<input value="Clear form" type="Reset"/><br><br>
	
	<p><a href="onclick="windows.prompt('Please enter in your email !!!')">Forgot your username or password/a></p>
	
	<p><a href="#">Register</a></p>
</form></span>
</div>
</center>


</body>
<div id = "footer">
Copyright &copy FSAS. All rights reserved.
</div>
</html>

<?php

}
//connecting the server
$con=mysqli_connect("localhost","root","");

//creating the database
mysqli_query($con, "create database FSACCO");

//selecting database 
mysqli_select_db($con, 'FSACCO');

//creating and validating member table
mysqli_query($con, "create table Member(memberid int primary key not null auto_increment, password varchar(30) not null, 
			username char(25) not null, person_name varchar(25) not null, emailAdress varchar(30) not null,date date not null)");

if (isset($_POST['memberid']) &&
	isset($_POST['password']) &&
	isset($_POST['username']) &&
	isset($_POST['email']) &&
	set($_POST['date']) &&
	isset($_POST['person_name'])) {

	$memberid = $_POST['memberid'];
    $password = $_POST['password'];
    $username = $_POST['username'];
    $emailAddress = $_POST['email'];
    $person_name = $_POST['person_name'];

    mysqli_query($con,"INSERT INTO Member(memberid, password, username, person_name,date) 
    VALUES ('$_POST[memberid]','$_POST[password]','$_POST[username]','$_POST[person_name]','$_POST[email]','$_POST[date]')");
}
    //creating and validating loan table
mysqli_query($con, "create table Loan(loanid varchar(5) primary key not null, loanname varchar(25) not null, 
			person_name varchar(25) not null, lAmount varchar(30) not null, dateofrequest varchar(25) not null)");

if (isset($_POST['loanid']) &&
	isset($_POST['loanname']) &&
	isset($_POST['person_name']) &&
	isset($_POST['lamount']) &&
	isset($_POST['dateofrequest']) &&
	isset($_POST['repaymentdate'])){ 

	$loanid = $_POST['loanid'];
    $loanname = $_POST['loanname'];
    $person_name = $_POST['person_name'];
    $lamount = $_POST['lamount'];
    $dateofrequest = $_POST['dateofrequest'];
    $repaymentdate = $_POST['repaymentdate'];
   

    mysqli_query($con,"INSERT INTO loan(loanid, loanname, person_name, amount, dateofrequest,) 
				VALUES ('$_POST[loanid]','$_POST[loanname]','$_POST[person_name]','$_POST[lAmount]', 
				'$_POST[repaymentdate]')");
}
        //creating and validating investment table
mysqli_query($con, "create table Investment(investmentid varchar(5) primary key not null auto_increment, businessidea varchar(50) not null,
				username varchar(25) not null, initialinvestmentprice varchar(25) not null, profits varchar(30) not null, loses varchar(30) not null,
				 dateofinvestment varchar(25) not null)");

if (isset($_POST['investmentid']) &&
	isset($_POST['businessidea']) &&
	isset($_POST['username']) &&
	isset($_POST['initialinvestmentprice']) &&
	isset($_POST['profits']) &&
	isset($_POST['loses']) &&
	isset($_POST['dateofinvestment'])){ 

	$investmentid = $_POST['investmentid'];
    $businessidea = $_POST['businessidea'];
    $username = $_POST['username'];
    $initialinvestmentprice = $_POST['initialinvestmentprice'];
    $profits = $_POST['profits'];
    $loses = $_POST['loses'];
    $dateofinvestment = $_POST['dateofinvestment'];

    mysqli_query($con,"INSERT INTO Investment(investmentid, businessidea, username, initialinvestmentprice, profits, loses, dateofinvestment)
				VALUES ('$_POST[investmentid]','$_POST[businessidea]','$_POST[username]','$_POST[initialinvestmentprice]', '$_POST[profits]',
				'$_POST[loses]','$_POST[dateofinvestment]')");

}
        //creating and validating contribution table
mysqli_query($con, "create table Contribution(contributionid int primary key not null auto_increment, 
			amount varchar(30) not null, person_name varchar(25) not null, date date not null, receipt_number int not null auto_increment, 
			memberid varchar(5) not null)");

if (isset($_POST['contributionid']) &&
	isset($_POST['amount']) &&
	isset($_POST['person_name']) &&
	isset($_POST['date']) &&
	isset($_POST['receipt_number']) &&
	isset($_POST['memberid'])){ 

	$contributionid = $_POST['contributionid'];
    $amount = $_POST['amount'];
    $person_name = $_POST['person_name'];
    $date = $_POST['date'];
    $receipt_number = $_POST['receipt_number'];
    $memberid = $_POST['memberid'];
  

    mysqli_query($con,"INSERT INTO Contribution(contributionid, amount, person_name, date, receipt_number, memberid) 
					VALUES ('$_POST[contributionid]','$_POST[amount]','$_POST[person_name]','$_POST[date]', '$_POST[receipt_number]','$_POST[memberid]')");   
}

//creating and validating benefits table
mysqli_query($con, "create table Benefits(memberid varchar(5) not null, businessIdea varchar(30) not null, amountGenerated varchar(25) not null)");

if ( isset($_POST['businessIdea']) &&
	 isset($_POST['memberid'])&&
     isset($_POST['amountGenerated'])){ 
		 
	
    $memberid = $_POST['memberid'];
    $businessidea = $_POST['businessIdea'];
    $amountGenerated = $_POST['amountGenerated'];

    mysqli_query($con,"INSERT INTO Benefits(memberid,businessIdea, amountGenerated) 
    VALUES ('$_POST[memberid]','$_POST[businessIdea]', '$_POST[amountGeanerated]')");
}
//creating and validating loan repayment
mysqli_query($con, "create table LoanRepayment(loanid varchar(5) primary key not null, loanname varchar(25) not null,
 person_name varchar(25) not null, ramount varchar(30) not null, repaymentdate varchar(25) not null, interest varchar(10) not null)");

if (isset($_POST['loanid']) &&
    isset($_POST['loanname']) &&
    isset($_POST['person_name']) &&
    isset($_POST['amount']) &&
    isset($_POST['dateofrequest']) &&
    isset($_POST['repaymentdate']) &&
    isset($_POST['interest'])){ 

    $loanid = $_POST['loanid'];
    $loanname = $_POST['loanname'];
    $person_name = $_POST['person_name'];
    $amount = $_POST['amount'];
    $dateofrequest = $_POST['dateofrequest'];
    $repaymentdate = $_POST['repaymentdate'];
    $interest = $_POST['interest'];

    mysqli_query($con,"INSERT INTO LoanRepayment(loanid, loanname, person_name, amount, repaymentdate, interest) 
    VALUES ('$_POST[loanid]','$_POST[loanname]','$_POST[person_name]','$_POST[ramount]','$_POST[repaymentdate]','$_POST[interest]')");}


function Display_File(){
	$lines = file('member.txt',FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
	

$i=1;
	echo "<table border='1'style='background-color:#FFFFFF;border-collapse:collapse;border:3px solid #6699FF;color:#000000;width:800'>";
	echo "<tr><td>File Number</td><th>submission details</th><td>Verify</td></tr>";
	foreach($lines as $file){
		
		
		
?>

<tr>
	
    <td>
        <?php echo $i++;?>

    </td>
    <td>
        <?php echo $file;?>
    </td>
    <td>
        <form method="post">
            <input type="hidden" name="form" value="<?php echo $file; ?>" />
            <input type="submit" name="Accept" value="Accept"/>
			 <input type="submit" name="Deny" value="Deny" />
        </form>
    </td>
</tr>


<?php
	}

echo "</table>";
	if(isset($_POST['Accept'])){ //check if button has been clicked or not
		//$array=explode("\t",$file);
	list($a,$b,$c,$d)=explode(" ",$file,4);
		//var_dump($name,$amount,$date);
		$con=mysqli_connect("localhost","root","");//conncting to the DB
		$db=mysqli_select_db($con,"aSACCO");//selecting the DB
		
		if($a=="contribution"){//check if contribution
		$query=mysqli_query($con,"insert into Contribution values('$b','$c','$d')");
		if($query){
		echo "contribution is inserted  successfully";
		//cutline('member.txt',$file);	
			
		}else{
		echo "Error not taken";
		}		
		}
		else if($a=="loan Request"){
			$rowsql= mysqli_query($conn,"SELECT sum(amount) AS totalContribution from Contribution where person_name=$c");
			$row=mysqli_fetch_array($rowsql);
			$tConribution=$row['tConribution'];
	
		if($lAmount >=1/2*ltConribution){
		$query=mysqli_query($con,"insert into Loan values('$b','$c','$d')");//query string
		if($query){
		echo "Loan request is inserted  successfully";
		//cutline('member.txt',2);	
			
		}else{
		echo "Error: not inserted";
		}
		}
		
		//else if($a=="MemberDetails"){
		//$query=mysqli_query($con,"insert into Member values('$b','$c','$d')");//query string
		//if($query){
		//echo "member added is inserted  successfully";
		//cutline('member.txt',2);	
			
		}else{
		echo "Error: not inserted";
		}
		}
		else if($a=="Investment"){
		$query=mysqli_query($con,"insert into Investment values('$b','$c','$d')");
		if($query){
		echo "idea  inserted successfully";
			
			
		}else{
		echo "Error: not inserted";
		}
		}
		else{
		echo "not inerted";
		}
		
		cutline('member.txt',$file);
		
	}
<?php	
}

//function  for cuting lines from the text file
function cutline($filename,$line_no) {
<?php
$strip_return=FALSE;

$data=file($filename);
$fp=fopen($filename,'r');//opens the file for reading
$linesInFile=count($data);
foreach($data as $line_no){
if($line_no) $skip=$linesInFile-1;
else $skip=$line_no-1;
}
for($line=0;$line<$linesInFile;$line++)
if($line!=$skip)
fputs($fp,$data[$line]);
else
$strip_return=TRUE;

return $strip_return;
} 

?>

	
<?php

function View_reports(){
	
?>
<style>
	table{
	width:100%;
	background-color:grey;	
	}
	th{
	background-color:blue;
	color:white;	
	}
	td{
	background-color:white;
	margin:auto 0;
		
		text-align:center;
	}
	h1{
	text-align:left;
	color:red;	
	}
	
</style>
<h1>Reports </h1>
<div><?php Contributions();?></div>
<div><?php BusinesIdeas();?></div>
<div><?php LoanRequests();?> </div>
<div><?php LoansPaid();?> </div>
<div><?php AmountInLoans();?> </div>
<div><?php AmountInBenefits();?> </div>
<div><?php RegularMembers();?> </div>








<?php
}

function contributions(){
		$con=mysqli_connect("localhost","root","","SACCO");
?>
<h1>contributions </h1>
<table>
		<tr>
		<th>person_name</th>
			<th>amount</th>
			<th>Date</th>
			<th>receipt_number</th>
			
	</tr>
	<?php
	$a="select * from Contribution";
	$results=mysqli_query($con,$a);
	
	if(mysqli_num_rows($results)>0){
		while($row=mysqli_fetch_array($results)){
		?>
	<tr>
		<td><?php echo $row["person_name"];?></td>
		<td><?php echo $row["Amount"];?></td>
		<td><?php echo $row["Date"];?></td>
		<td><?php echo $row["receip_number"];?></td>
		
		<?php
		}
		}
		
		?>
	
		</table>
<?php
}


function ideas(){
	$con=mysqli_connect("localhost","root","","SACCO");
?>
<h1>BusinessIdeas </h1>
<table>
		<tr>
		<th>person_name</th>
			<th>BusinessIdea</th>
			<th>InitialInvestmentPrice</th>
			
	</tr>
	<?php
	$a="select * from Investment";
	$results=mysqli_query($con,$a);
	
	if(mysqli_num_rows($results)>0){
		while($row=mysqli_fetch_array($results)){
		?>
	<tr>
		<td><?php echo $row["perso_name"];?></td>
		<td><?php echo $row["BusinessIdea"];?></td>
		<td><?php echo $row["IntialInvestmentPrice"];?></td>
		
		<?php
		}
		}
		
		?>
	
		</table>
<?php
}

function loanRequests(){
	$con=mysqli_connect("localhost","root","","SACCO");
?>
<h1>Loan Request</h1>
<table>
		<tr>
		<th>person_nameName</th>
			<th>lAmount</th>
			<th>DateofRequest</th>
			
	</tr>
	<?php
	$a="select * from Loan_request";
	$results=mysqli_query($con,$a);
	
	if(mysqli_num_rows($results)>0){
		while($row=mysqli_fetch_array($results)){
		?>
	<tr>
		<td><?php echo $row["person_name"];?></td>
		<td><?php echo $row["Amount"];?></td>
		<td><?php echo $row["DateofRequest"];?></td>
		<td><?php echo $row["RepaymentDate"];?></td>
		
		<?php
		}
		}
		
		?>
	
		</table>
<?php
}

function AmountInBenefits(){
	$con=mysqli_connect("localhost","root","","SACCO");
?>
<h1>AmountInBenefits</h1>
<table>
		<tr>
		<th>person_nameName</th>
			<th>Amount</th>
			
	</tr>
	<?php
	$a="select * from Benefit";
	$results=mysqli_query($con,$a);
	
	if(mysqli_num_rows($results)>0){
		while($row=mysqli_fetch_array($results)){
		?>
	<tr>
		<td><?php echo $row["person_name"];?></td>
		<td><?php echo $row["Amount"];?></td>
		
		
		<?php
		}
		}
		
		?>
	
		</table>
<?php
}

function AmountInLoans(){
	$con=mysqli_connect("localhost","root","","SACCO");
?>
<h1>AmountInLoans</h1>
<table>
		<tr>
		<th>person_nameName</th>
			<th>Amount</th>
			<th>RepaymentDate</th>
			<th>DateofRequest</th>
			
	</tr>
	<?php
	$a="select * from Loan_request";
	$results=mysqli_query($con,$a);
	
	if(mysqli_num_rows($results)>0){
		while($row=mysqli_fetch_array($results)){
		?>
	<tr>
		<td><?php echo $row["person_name"];?></td>
		<td><?php echo $row["Amount"];?></td>
		<td><?php echo $row["DateofRequest"];?></td>
		<td><?php echo $row["RepaymentDate"];?></td>
		
		<?php
		}
		}
		
		?>
	
		</table>
<?php
}

function RegularMembers(){
	$con=mysqli_connect("localhost","root","","SACCO");
?>
<h1>regularMembers</h1>
<table>
		<tr>
		<th>person_nameName</th>
			<th>amount</th>
			<th>receipt_number</th>
			<th>Date</th>
			
	</tr>
	<?php
	$a="select * from Member";
	$results=mysqli_query($con,$a);
	
	if(mysqli_num_rows($results)>0){
		while($row=mysqli_fetch_array($results)){
		?>
	<tr>
		<td><?php echo $row["person_name"];?></td>
		<td><?php echo $row["Amount"];?></td>
		<td><?php echo $row["receipt_number"];?></td>
		<td><?php echo $row["Date"];?></td>
		
		<?php
		}
		}
		
		?>
	
		</table>
<?php
}
			
function loanPaid(){
	$con=mysqli_connect("localhost","root","","SACCO");
?>
<h1>Loan Payment</h1>
<table>
	<tr>
		<th>person_nameame</th>
			<th>rAmount</th>
			<th>repaymentdateDate</th>	
	</tr>
	<?php
	$w="select * from loan_request";
	$results=mysqli_query($con,$w);
	
	if(mysqli_num_rows($results)>0){
		while($row=mysqli_fetch_array($results)){
		?>
	<tr>
		<td><?php echo $row["Name"];?></td>
		<td><?php echo $row["Amount"];?></td>
		<td><?php echo $row["Date"];?></td>
		</tr>
		<?php
		}
		}
		
		?>
	
		</table>
<?php
}
function Register(){
	$con=mysqli_connect("localhost","root","","SACCO");
?>
<h1><center>FAMILY SACCO AUTOMATED SYSTEM</center></h1>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>FSAS</title>
<link rel = "stylesheet" type ="text/css" href = "projectcss.css">
<link rel = "stylesheet" type ="text/css" href = "styles.css">
</head>
<body id ="bodylicious">	
<div id ="cssmenu2">
<ul>


<p style = "font-family:freestyle script;" align="center"><font size ="6">Registration Form</font></p>
	<center>    
<div id ="cssmenu">
 <form action="caloz.php" method="POST">
<table>
    
	<tr>
        <td>person_name:</td>
        <td><input type="text" name="person_name" placeholder="myname"></td>
    </tr>
    <tr>
        <td>username:</td>
        <td><input type="text" name="username" placeholder="username"></td>
    </tr>
    <tr>
        <td>Password:</td>
        <td><input type="password" name="password" required="required"/></td>
    </tr>
    <tr>
    <td>Confirm Password:</td>
    <td><input type ="password" maxlegth = "25" name = "veripassword" required ="required" /></p>
	</tr>
	</tr>
    <tr>
    <td>Email Address:</td>
    <td><input type ="text" maxlegth = "25" name = "email" required ="required" /></p>
	</tr>
	<tr>
	<td>Contribution Amount:</td>
    <td><input type ="text" name = "amount" required ="required" /></p>
	</tr>
	<tr>
	<td>Date:</td>
    <td><input type ="text" name = "date" required ="required" /></p>
	</tr>
 
 <?php
if(isset($_POST['register'])) {
	$conn=mysql_connect("localhost","root","","SACCO");
	
	$person_name=$_POST['person_name'];
	$username=$_POST['username'];
	$password=$_POST['password'];
	$password=$_POST['amount'];
	$password=$_POST['email'];
	
	$rowsql= mysqli_query($conn,"SELECT MAX(amount) AS Amount from Contibution");
	$row=mysqli_fetch_array($rowsql);
	$largestContribution=$row['Amount'];
	
	if($contribution >=3/4*largestContribution){
	
			//$c=insert in to Contribution values($_POST['person_name'],$_POST['amount'],$_POST['date'],$_POST['username']);
			
	$c="INSERT INTO Member(memberid, password, username, person_name) 
           VALUES ('$_POST[memberid]','$_POST[password]','$_POST[username]','$_POST[person_name]','$_POST[email]')";
		
	$d="INSERT INTO Contribution(contributionid, amount, person_name, date, receipt_number, memberid) 
					VALUES ('$_POST[contributionid]','$_POST[amount]','$_POST[person_name]','$_POST[date]', '$_POST[receipt_number]','$_POST[memberid]')";
			
			//$d=insert in to Member values($_POST['person_name'],$_POST['username'],$_POST['password'],$_POST['amount'],$_POST['email']);
			$e= mysqli_query($conn,$c);
			$f=mysqli_query($conn,$d);
			}
		else{
			echo "member addition rejected, please add more amont thank!!";
		}
	}

?> 
  </table>
	<input value="Register" type="Submit" name="register">
	<input value="Clear form" type="Reset"/><br><br>

</form></span>
</div>
</center>
</body>
<div id = "footer">
Copyright &copy FSAS. All rights reserved.
</div>

<?php
}

function Reset_passwordUserName(){
	$conn=mysql_connect("localhost","root","","SACCO");
?>
<h1><center>FAMILY SACCO AUTOMATED SYSTEM</center></h1>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>FSAS</title>
<link rel = "stylesheet" type ="text/css" href = "projectcss.css">
<link rel = "stylesheet" type ="text/css" href = "styles.css">
</head>
<body id ="bodylicious">	
<div id ="cssmenu2">
<ul>
<p style = "font-family:freestyle script;" align="center"><font size ="6">Reset_passwordUserName</font></p>
	<center>    
<div id ="cssmenu">
 <form action="caloz.php" method="POST">
<table>
    
    <tr>
        <td>username:</td>
        <td><input type="text" name="username" placeholder="username"></td>
    </tr>
    <tr>
        <td>Password:</td>
        <td><input type="password" name="password" required="required"/></td>
    </tr>
    <tr>
    <td>Confirm Password:</td>
    <td><input type ="password" maxlegth = "25" name = "veripassword" required ="required" /></p>
	</tr>
	</tr>
    <tr>
    <td>Email Address:</td>
    <td><input type ="text" maxlegth = "25" name = "email" required ="required" /></p>
	</tr>
<?php
if(isset($_POST['reset'])){
if(empty($_POST['userName'])|| empty($_POST['password'])){
echo "<br><p style = 'font-family:freestyle script;' align='center'><font size ='6'>Hello, \n".$_POST['userName'].
		"Name Or Password missing!....Enjoy the system!!!</font></p>";
}

else{
$d=$_POST['userName'];
$c=$_POST['password'];   
$e=$_POST['email'];    
$con=mysql_connect("localhost","root","","SACCO");
//$db=mysql_select_db("SACCO",$con);
$select=mysql_query("SELECT * FROM Member WHERE  email=$e ",$con);
}

@$row=mysql_num_rows($select);
if($row >0){
  
  while($row=mysql_fetch_row($select,MYSQL_ASSOC)){
  $_SESSION["id"]=$row["emailAddress"]; 
  }
			
	$c="INSERT INTO Member( password, username) 
           VALUES ('$_POST[password]','$_POST[username]')";
		
			$c= mysqli_query($conn,$c);
			
  
  header("?action=####");
}

mysql_close($con);

}
?>	

  </table>
	<input value="Reset" type="Submit" name="reset">
	<input value="Clear form" type="Reset"/><br><br>

</form></span>
</div>
</center>
</body>
<div id = "footer">
Copyright &copy FSAS. All rights reserved.
</div>

<?php
}
function logout(){
$conn= mysql_connect("localhost","root","","SACCO");	
session_start();
$logedinId=$_SESSION["id"];
$update=mysql_query("update member set active=0 where userName='$logedinId'");
if(!$update) echo mysql_error();

if($update) {
	
	header("?action=###");
}
}
?>

