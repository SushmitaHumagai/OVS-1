<?php
session_start();
if (!isset($_SESSION['userdata'])) {
    header("location:../");
}


$userdata = $_SESSION['userdata'];
$groupsdata = $_SESSION['groupsdata'];

if($_SESSION['userdata']['status']==0){
    $status = '<b style = "color:red">Not Voted</b>';
}else{
    $status = '<b style = "color:green">Voted</b>';
}
?>
<html>

<head>
    <title>Online Voting System</title>
    <link rel="stylesheet" href="../css/stylesheet.css">
    
</head>

<body>

<style>
        body {
            background-color: #05baff;
        }

        #backbtn {
            padding: 5px;
            background-color: #6ab04c;
            color: white;
            font-size: 15px;
            border-radius: 5px;
            float: left;
            margin: 10px;
        }

        #logoutbtn {
            padding: 5px;
            background-color: #6ab04c;
            color: white;
            font-size: 15px;
            border-radius: 5px;
            float: right;
            margin: 10px;
        }

        #Profile{
            background-color: white;
            width: 30%;
            padding: 20px;
            float: left;
        }

        #Group{
            background-color: white;
            width: 60%;
            padding: 20px;
            float: right;
        }

        #votebtn
        {
            padding: 5px;
            background-color: #6ab04c;
            color: white;
            font-size: 15px;
            border-radius: 5px;
            float: left;
        }

        #mainpanel{
            padding: 10px;
        }

        #voted{
            padding: 5px;
            background-color: red;
            color: white;
            font-size: 15px;
            border-radius: 5px;
            float: left;
        }

       

    </style>

    <div id="mainSection">
        <center>
    <div id="headerSection">
    <a href="../"><button id="backbtn">Back</button></a>
    <a href="logout.php"><button id="logoutbtn">Log out</button></a>

    <h1>Online Voting System</h1>
    </div>
        </center>
    <hr>

    <div id = "mainpanel">
    <div id="Profile">
        <center><img src="../uploads/<?php echo $userdata['photo']?>" height="100" width="100"><br><br></center>
        <b>Name: <?php echo $userdata['name']?></b><br><br>
        <b>Mobile: <?php echo $userdata['mobile']?></b><br><br>
        <b>Address: <?php echo $userdata['address']?></b><br><br>
        <b>Status: <?php echo $status?></b><br><br>
    </div>
    <div id="Group">
        <?php
        if($_SESSION['groupsdata']){
            for($i=0; $i<count($groupsdata); $i++){
                ?>
                <div>
                    <img style="float: right" src="../uploads/<?php echo $groupsdata[$i]['photo']?>" height="100" width="100">
                    <b>Group Name: </b><?php echo $groupsdata[$i]['name'] ?><br><br>
                    <b>Votes: </b><?php echo $groupsdata[$i]['votes'] ?><br><br>
                    <form action="../api/vote.php" method="POST"> 
                        <input type="hidden" name="gvotes" value="<?php echo $groupsdata[$i]['votes'] ?>">
                        <input type="hidden" name="gid" value="<?php echo $groupsdata[$i]['id'] ?>">
                        <?php
                            if($_SESSION['userdata']['status']==0){
                                ?>
                                    <input type ="submit" name="votebtn" value="Vote" id="votebtn">
                                <?php
                            }else{
                                ?>
                                    <button disabled type ="button" name="votebtn" value="Vote" id="voted">Voted</button>
                                <?php
                            }
                        ?>
                    </form>
                </div>
                <br><br><hr>
                <?php
            }
        }else{

        }
        ?>
    </div>
    </div>
   
    </div>

   
</body>

</html>