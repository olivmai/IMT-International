<?php

  $manager = new Manager();

  $countrystatAllTime = $manager->countryStat();
  $shortagestatAllTime = $manager->shortageStat();
  $countryStatCurrentMonth = $manager->countryStatOfTheMonth();

  $totalStat = $manager->totalStat();

  include $_SESSION['app_root'].'/admin/view/stat.php';

?>