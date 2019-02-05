<?php namespace Track;

//dropouts
$file = fopen("test_paper.csv", "r");
$i = 0;
while ($line = fgetcsv($file)) {

    if ($i == 0) {
        $i++;
        continue;
    }

    $dp = 0; //落第点の教科数
    for ($i = 1; $i < 7; $i++) {
        if ($line[$i] < 49) {
            $dp++;
        }
    }
    if ($dp > 2) {
        $dropouts_array[] = $line[0];
    }
}

printf("ID," . PHP_EOL);

for ($i = 0; $i < count($dropouts_array); $i++) {
    $dropouts_ID = $dropouts_array[$i];
    if (count($dropouts_array)-1 == $i) {
        printf("%s" . PHP_EOL, $dropouts_ID);
    }
    else {
        printf("%s," . PHP_EOL, $dropouts_ID);
    }
}

fclose($file);


//top-va-bottom
$i = 0;
$highest_score = 0;
$lowest_score = 100;

$file = fopen("test_paper.csv", "r");
while ($line = fgetcsv($file)) {

    if ($i == 0) {
        $i++;
        continue;
    }

    $student_ID = $line[0];
    $ap = 0; //平均点
    $total = 0; //合計点

    for ($i = 1; $i < 7; $i++) {
        $total += $line[$i];
    }
    $ap = round($total/6, 2);

    // 最高点
    if ($ap > $highest_score) {
        $hs_array[] = $student_ID;
        $hs_score_array[] = $ap;
        $highest_score = $ap;
    }
    elseif ($ap == $highest_score) {
        $hs_array[] = $student_ID;
        $hs_score_array[] = $highest_score;
    }

    //最低点
    if ($ap < $lowest_score) {
        $ls_array[] = $student_ID;
        $ls_score_array[] = $ap;
        $lowest_score = $ap;
    }
    elseif ($ap == $lowest_score) {
        $ls_array[] = $student_ID;
        $ls_score_array[] = $lowest_score;
    }
}

printf("ID,Mean," . PHP_EOL);
for ($i = 0; $i < count($hs_score_array); $i++) {
    if ($highest_score == $hs_score_array[$i]) {
        printf("%s,%s," . PHP_EOL, $hs_array[$i], $hs_score_array[$i]);
    }
}

for ($i = 0; $i < count($ls_score_array); $i++) {
    if ($lowest_score == $ls_score_array[$i]) {
        if (count($ls_score_array)-1 == $i) {
            printf("%s,%s" . PHP_EOL, $ls_array[$i], $ls_score_array[$i]);
        }
        else {
            printf("%s,%s," . PHP_EOL, $ls_array[$i], $ls_score_array[$i]);
        }
    }
}

fclose($file);
