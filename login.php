<?php include('config.php');

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $email = $_POST["email"];
    $password = $_POST["password"];

    $select = "SELECT * FROM users WHERE email = '$email'";
    $select = mysqli_query($conn, $select);

    if($select->num_rows > 0){
        $row = $select->fetch_assoc();

        if(password_verify($password, $row["password"])){
          session_start();
          $_SESSION["user_id"] = $row["id"];
          $_SESSION["name"] = $row["name"];
          header("Location: dashboard.php?success=Login successful! Ready to vote");  
          exit();
        }else{
            header("Location: login.php?error=Invalid email or password");
            exit();
        }
    }else{
        header("Location: login.php?error=Invalid email or password");
        exit();
    }
}

?>


<?php include('header.php'); ?>
<?php include("alert.php"); ?>

<div class="min-h-screen flex fle-col items-center justify-center py-6 px-4">
    <div class="  items-center gap-10 max-w-6xl max-md:max-w-md w-full">


        <form class="max-w-md mx-auto w-full" method="POST">
            <h3 class="text-slate-900 lg:text-3xl text-2xl font-bold mb-8">
                Login for Vote
            </h3>

            <div class="space-y-6">
                <div>
                    <label class='text-sm text-slate-800 font-medium mb-2 block'>Email</label>
                    <input name="email" type="email" required
                        class="bg-slate-100 w-full text-sm text-slate-800 px-4 py-3 rounded-md outline-none border focus:border-blue-600 focus:bg-transparent"
                        placeholder="Enter Email" />
                </div>
                <div>
                    <label class='text-sm text-slate-800 font-medium mb-2 block'>Password</label>
                    <input name="password" type="password" required
                        class="bg-slate-100 w-full text-sm text-slate-800 px-4 py-3 rounded-md outline-none border focus:border-blue-600 focus:bg-transparent"
                        placeholder="Enter Password" />
                </div>
                <div class="flex flex-wrap items-center justify-between gap-4">
                    <div class="flex items-center">
                        <input id="remember-me" name="remember-me" type="checkbox"
                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-slate-300 rounded" />
                        <label for="remember-me" class="ml-3 block text-sm text-slate-500">
                            Remember me
                        </label>
                    </div>
                    <div class="text-sm">
                        <a href="jajvascript:void(0);" class="text-blue-600 hover:text-blue-500 font-medium">
                            Forgot your password?
                        </a>
                    </div>
                </div>
            </div>

            <div class="!mt-12">
                <button type="submit"
                    class="w-full pointer shadow-xl py-2.5 px-4 text-sm font-semibold rounded text-white bg-blue-600 hover:bg-blue-700 focus:outline-none">
                    Log in
                </button>
            </div>

            <p>Don't have an account? <a href="register.php" class=" py-2 text-blue-600 hover:text-blue-500 font-medium">Register</a></p>
        </form>
    </div>
</div>

<?php include('footer.php'); ?>