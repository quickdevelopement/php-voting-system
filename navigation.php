<?php
    
    $admin = false;
    $isLogin = false;
    if(isset($_SESSION["user_id"])){
        $user_id = $_SESSION["user_id"];
        $isLogin = true;

        $user = "SELECT * FROM users WHERE id = $user_id";
        $user = mysqli_query($conn, $user);

        if($user->num_rows > 0){
            $row = $user->fetch_assoc();
            if($row["role"] == "admin"){
                $admin = true;
            }else{
                $admin = false;
            }
        }
    }
?>


<nav class="navbar shadow z-50 bg-base-100 py-3 mb-5">
    <div class="container mx-auto">
        <div class="w-full flex">
            <div class="flex items-center justify-between">
                <div class="navbar-start items-center justify-between max-md:w-full">
                    <a class="link text-base-content link-neutral text-xl font-semibold no-underline"
                        href="index.php">Quick Development</a>
                    <div class="md:hidden">
                        <button type="button" class="collapse-toggle btn btn-outline btn-secondary btn-sm btn-square"
                            data-collapse="#default-navbar-collapse" aria-controls="default-navbar-collapse"
                            aria-label="Toggle navigation">
                            <span class="icon-[tabler--menu-2] collapse-open:hidden size-4"></span>
                            <span class="icon-[tabler--x] collapse-open:block hidden size-4"></span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="ml-auto">
                <ul class="flex items-center">
                    <li><a class="px-5 py-2.5" href="index.php">Home</a></li>
                    <?php if ($admin): echo '<li><a class="px-5 py-2.5" href="subject.php">Vote Subject</a></li>'; endif; ?>
                    <li>
                        <?php if ($isLogin): echo '<a href="logout.php"
                            class=" inline-block text-red-100 py-2.5 px-5 text-sm font-medium text-center text-white rounded-lg  bg-red-500">Logout</a>'; else: echo '<a class="inline-block text-green-100 py-2.5 px-5 text-sm font-medium text-center text-white rounded-lg  bg-green-500" href="login.php">Login</a>'; endif; ?>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>