<?php
    include('config.php');

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $name = $_POST["name"];
        $email = $_POST["email"];
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
        $role = "user";

        $user = "SELECT * FROM users";
        $user = mysqli_query($conn, $user);

        if(!$user->num_rows > 0){
            $role = "admin";
        };

        $exist = "SELECT * FROM users WHERE email = '$email'";
        $exist = mysqli_query($conn, $exist);

        if($exist->num_rows > 0){
            header("Location: login.php?error=Email already exists");
            exit();
        };

        $insert = "INSERT INTO users(name, email, password, role) VALUES('$name', '$email', '$password', '$role')";
        $insert = mysqli_query($conn, $insert);

        if($insert){
            header("Location: login.php?success=Registration successful! please login");
            exit();
        }else{
            header("Location: register.php?error=Registration failed");
            exit();
        }

    }
?>
<?php include("header.php"); ?>
<?php include("alert.php"); ?>


<div class="min-h-screen flex fle-col items-center justify-center py-6 px-4">
    <div class="items-center gap-10 max-w-6xl max-md:max-w-md w-full">


        <form class="max-w-md mx-auto w-full" method="POST" action="">
            <h3 class="text-slate-900 lg:text-3xl text-2xl font-bold mb-8">
                Resgister for Participant
            </h3>

            <div class="space-y-6">
                <div>
                    <label class='text-sm text-slate-800 font-medium mb-2 block'>Full Name</label>
                    <input name="name" type="name" required
                        class="bg-slate-100 w-full text-sm text-slate-800 px-4 py-3 rounded-md outline-none border focus:border-blue-600 focus:bg-transparent"
                        placeholder="Enter Full Name" />
                </div>
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

            </div>

            <button type="submit"
                class="w-full pointer shadow-xl mt-5 py-2.5 px-4 text-sm font-semibold rounded text-white bg-blue-600 hover:bg-blue-700 focus:outline-none">
                Sign Up
            </button>

            <p>Already have an account? <a href="login.php"
                    class="text-blue-600 py-2 hover:text-blue-500 font-medium">Login
                    Now</a></p>
        </form>
    </div>
</div>

<?php include('footer.php'); ?>