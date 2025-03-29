<?php include('header.php'); ?>

<?php include('config.php'); 


    if(!isset($_SESSION["user_id"])){
        header("Location: login.php");
        exit();
    };

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $candidate_id = $_POST["candidate_id"];

        $user_id = $_SESSION["user_id"];

        // check if user has already voted
        $check = "SELECT has_voted FROM users WHERE id = $user_id";
        $check = mysqli_query($conn, $check);

        $row = $check->fetch_assoc();

        if($row["has_voted"]){
           header("Location: dashboard.php?error=You have already voted.");
           exit(); 
        }else{
            $udate = "UPDATE users SET has_voted = 1 WHERE id = $user_id";
            $udate = mysqli_query($conn, $udate);

            $update = "UPDATE candidates SET votes = votes + 1 WHERE id = $candidate_id";
            $update = mysqli_query($conn, $update);

            header("Location: dashboard.php?success=You have successfully voted.");
            exit();
        }
    }


    
    


    $result = "SELECT * FROM candidates ORDER BY votes DESC";
    $result = mysqli_query($conn, $result);
?>

<?php include('navigation.php'); ?>
<?php include('alert.php'); ?>

<div class="container mx-auto  mt-5">
    <div class="grid md:grid-cols-2 gap-4">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2>Welcome, <strong class="text-green-500 text-4xl"><?= $_SESSION["name"]; ?></strong></h2>
            <p>You can now vote for your favorite candidate.</p>
        </div>
        <div class="bg-white hover:shadow-xl duration-300 p-6 rounded-lg shadow-md text-center">
            <h2 class="text-2xl font-bold mb-4">Vote for a Candidate</h2>
            <form method="POST">
                <?php while($row = $result->fetch_assoc()): ?>
                    <button type="submit" name="candidate_id" value="<?= $row['id'] ?>"
                    class="w-full cursor-pointer text-green-900 hover:bg-blue-800 bg-blue-200 hover:text-white p-2 rounded mb-2">
                    <?= $row['name'] ?>
                </button>
                <?php endwhile;
                ?>
            </form>
            <a href="index.php" class="mt-2 inline-block text-blue-500">View Results</a>

        </div>
    </div>
</div>

<?php include('footer.php'); ?>