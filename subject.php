<?php
include('config.php');

session_start();

if(!isset($_SESSION["user_id"])){
    header("Location: login.php");
    exit();
};

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $subject = $_POST["subject"];

    $user_id = $_SESSION["user_id"];
    $user = "SELECT * FROM users WHERE id = $user_id";
    $user = mysqli_query($conn, $user);

    if($user->num_rows > 0){
        $row = $user->fetch_assoc();
        if($row["role"] == "admin"){
            $insert = "INSERT INTO candidates(name) VALUES('$subject')";

            $submit = mysqli_query($conn, $insert);

            if($submit){
                header("Location: dashboard.php?success=Candidate added successfully");
                exit();
            }else{
                header("Location: subject.php?error=Failed to add candidate");
                exit();
            }
        }else{
            header("Location: dashboard.php?error=You are not authorized to add candidate");
            exit();
        }
    }
}
?>


<?php include('header.php'); ?>
<?php include('navigation.php'); ?>

<div class="min-h-screen flex fle-col items-center justify-center py-6 px-4">
    <div class="items-center gap-10 max-w-6xl max-md:max-w-md w-full">


        <form class="max-w-md mx-auto w-full" method="POST">
            <h3 class="text-slate-900 lg:text-3xl text-2xl font-bold mb-8">
               Add Vote Candidate
            </h3>

            <div class="space-y-6">
                <div>
                    <label class='text-sm text-slate-800 font-medium mb-2 block'>Subject/Candidate to Vote</label>
                    <input name="subject" type="subject" required
                        class="bg-slate-100 w-full text-sm text-slate-800 px-4 py-3 rounded-md outline-none border focus:border-blue-600 focus:bg-transparent"
                        placeholder="Enter subject" />
                </div>
              
            </div>

            <div class="!mt-12">
                <button type="submit"
                    class="w-full pointer shadow-xl py-2.5 px-4 text-sm font-semibold rounded text-white bg-blue-600 hover:bg-blue-700 focus:outline-none">
                    Add
                </button>
            </div>

            <a href="dashboard.php" class="mt-2 inline-block text-blue-500">Back to Result</a>
        </form>
    </div>
</div>

<?php include('footer.php'); ?>