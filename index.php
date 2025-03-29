<?php include('config.php'); 
    $result = "SELECT * FROM candidates ORDER BY votes DESC";
    $result = mysqli_query($conn, $result);
    $totalVotes = mysqli_query($conn, "SELECT SUM(votes) AS total_votes FROM candidates")->fetch_assoc()['total_votes'];
?>
<?php include('header.php'); ?>
<?php include('navigation.php'); ?>
<?php include('alert.php'); ?>

  <div class="container mx-auto">
  <div class="bg-white p-6 rounded-lg shadow-md text-center">
    <h2 class="text-4xl font-bold mb-4 text-orange-500">Voting Results <?php echo $totalVotes; ?> </h2>
    <ul class="md:w-1/2 w-full mx-auto bg-slate-200 p-6">
    <?php while ($row = $result->fetch_assoc()): ?>
        <?php

        $votePercent = $totalVotes > 0 ? round(($row['votes'] / $totalVotes) * 100, 2) : 0;
        ?>
        <li class="mb-2 border border-gray-200 rounded-lg p-4 bg-green-100">
          <span class="font-bold text-md md:text-2xl"><?= $row['name'] ?></span>: <strong class="text-green-500"> <br><?= $row['votes'] ?>
            votes</strong> <span>(<?php echo $votePercent ?>%)</span>
        </li>
      <?php endwhile; ?>
    </ul>
    <a href="dashboard.php" class="mt-2 inline-block text-blue-500">Back to Voting</a>
  </div>
</div>
  

<?php include('footer.php'); ?>