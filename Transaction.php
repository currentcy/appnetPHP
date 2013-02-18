{\rtf1\ansi\ansicpg1252\cocoartf1187\cocoasubrtf340
{\fonttbl\f0\fmodern\fcharset0 Courier;}
{\colortbl;\red255\green255\blue255;}
\margl1440\margr1440\vieww10800\viewh8400\viewkind0
\deftab720
\pard\pardeftab720

\f0\fs26 \cf0 \
<?php\
\
// connecting to the DB\
$con = mysql_connect("xxxxxxxx","xxxxxxx","xxxxxxxx");\
if (!$con)\
  \{\
  die('Could not connect: ' . mysql_error());\
  \}else\{\
\
    echo "Connection Successful!!!!!";\
  \}\
\
  mysql_select_db("Currentcy", $con);\
\
//selecting all of the information out of the mentions table\
$query = "SELECT * FROM Mentions"; \
   \
$result = mysql_query($query) or die(mysql_error());\
\
while($row = mysql_fetch_array($result))\{\
  //creating array out sql query\
$row = mysql_fetch_array($result) or die(mysql_error());\
\
\
$user = $row['User'];\
\
$result1 ="SELECT * FROM Account_info WHERE Username = '$user'";\
\
//update the users balance.\
mysql_query("UPDATE Account_info SET Balance= Balance-1 WHERE Username='$user'") or die(mysql_error());\
\
$results = mysql_query($result1) or die(mysql_error());\
\
$row1 = mysql_fetch_array($results);\
\
//\
$mentioned = $row['Mentioned'];\
$result2 = $row1['Balance'];\
\
\
\
\
echo "</br>".$user."</>";\
echo "/".$mentioned."/";\
echo "/".$result2."/";\
//echo $result2."/";\
\
//creating query to see if they exist\
$check_for_user=mysql_query("SELECT * FROM Account_info WHERE Username='".mysql_real_escape_string($mentioned)."'");\
\
\
\
//determining if it is an old user or new user\
if(mysql_num_rows($check_for_user)>0) \{\
echo"old user</br>";\
mysql_query("UPDATE Account_info SET Balance= Balance+1 WHERE Username='".mysql_real_escape_string($mentioned)."'") or die(mysql_error());\
     // they have an account they are credited\
\} else \{\
 echo"new user</br>";//new account created for them\
 mysql_query("INSERT INTO Account_info (Username,Balance) VALUES ('$mentioned',1)");\
\}\
\
\
\
\}\
//closing the DB connection\
  mysql_close($con);\
?>}