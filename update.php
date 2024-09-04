<?php
include("connection.php")
?>
<!doctype html>
<html lang="en">
    <head>
        <title>Title</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
   
        
    </head>
    <?php 
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $query = $pdo->prepare("select * from marksheet whereid=:pid");
        $query->bindParam("pid",$id);
        $query->execute();
        $data = $query->fetch(PDO::FETCH_ASSOC);
    }
    ?>
<body>
<div class="container">
        <form action="" method="post">
            <div class="mb-3">
                <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
                <label for="" class="form-label">name</label>
                <input 
                    type="text"
                    name="name"
                    id=""
                    class="form-control"
                    placeholder="enter your name"
                    value="<?php echo $data['name'];?>"
                />
                <div class="mb-3">
            <div class="mb-3">
            <label for="" class="form-label">math</label>
                <input 
                    type="number"
                    name="math"
                    id=""
                    class="form-control"
                    placeholder="enter your marks"
                    value="<?php echo $data['math'];?>"
                />
                </div>
                <div class="mb-3">
                <label for="" class="form-label">physics</label>
                <input 
                    type="number"
                    name="physics"
                    id=""
                    class="form-control"
                    placeholder="enter your marks"
                    value="<?php echo $data['physics'];?>"
                />
                </div>
                <div class="mb-3">
                <label for="" class="form-label">chmistry</label>
                <input 
                    type="number"
                    name="chmistry"
                    id=""
                    class="form-control"
                    placeholder="enter yiour marks"
                    value="<?php echo $data['chmistry'];?>"
                />
                </div>
                <div class="mb-3">
                <label for="" class="form-label">english</label>
                <input 
                    type="number"
                    name="english"
                    id=""
                    class="form-control"
                    placeholder="enter your name"
                    value="<?php echo $data['english'];?>"
                />
                </div>
                <div class="mb-3">
                <label for="" class="form-label">urdu</label>
                <input 
                    type="number"
                    name="urdu"
                    id=""
                    class="form-control"
                    placeholder="enter your marks"
                    value="<?php echo $data['urdu'];?>"
                />
                </div>
        

            <button 
        type="submit"
        class="btn btn-success"
        name="update"
        
    >
   submit
</button>
        </form>
    </div>
    <?php
if(isset($_POST['update'])){
    $id=$_POST['id'];
    $name=$_POST['name'];
    $math=$_POST['math'];
    $physics=$_POST['physics'];
    $chmistry=$_POST['chmistry'];
    $english=$_POST['english'];
    $urdu=$_POST['urdu'];
    $totalmarks=500;
    $obtained=$math+$physics+$chmistry+$english+$urdu;
    $percentage=$obtained/$totalmarks*100;
    $grade="";
    $remarks="";
    if($percentage>=80 && $percentage<=100){
        $grade="A1";
        $remarks="excellent";
    }
   else if($percentage>=70 && $percentage<80){
        $grade="A";
        $remarks="very good";
    }
    else if($percentage>=60 && $percentage<70){
        $grade="B";
        $remarks="good";
    }
    else if($percentage>=50 && $percentage<60){
        $grade="c";
        $remarks="fair";
    }
    else {
        $grade="fail";
        $remarks="batter luck next time";
    }
   $query=$pdo->prepare("update marksheet set name=:pn,math=:pm,physics=:pp,chmistry=:pc,english=:pe,urdu=:pu,obtained=:po,percentage=:pper,grade=:pg,remarks=:pr where id = :pid");
   $query->bindParam("pid",$id);
   $query->bindParam("pn",$name);
   $query->bindParam("pm",$math);
   $query->bindParam("pp",$physics);
   $query->bindParam("pc",$chmistry);
   $query->bindParam("pe",$english);
   $query->bindParam("pu",$urdu);
   $query->bindParam("po",$obtained);
   $query->bindParam("pper",$percentage);
   $query->bindParam("pg",$grade);
   $query->bindParam("pr",$remarks);

   if(isset($_GET['deleteid'])){
       $id = $_GET['deleteid'];
       $query = $pdo->prepare("delete * from marksheet where id=:pid");
       $query->bindParam("pid",$id);



   $query->execute();
   echo "<script>alert('update successfully');
   location.assign('ne.php');
   </script>";
}
    ?>
    </div>
        


    <?php
}
?>
    </body>
</html>

