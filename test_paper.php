<?php namespace Track;

//dropouts
$file = fopen("test_paper.csv", "r");
$i = 0;
while ($line = fgetcsv($file)) {

    if ($i == 0) {
        $i++;
        continue;
    }

    $dropouts_num = 0; //落第点の教科数
    for ($i = 1; $i < 7; $i++) {
        if ($line[$i] < 49) {
            $dropouts_num++;
        }
    }
    if ($dropouts_num > 2) {
        $dropouts_array[] = $line[0];
    }
}

printf("\"ID\"" . PHP_EOL);

for ($i = 0; $i < count($dropouts_array); $i++) {
    $dropouts_ID = $dropouts_array[$i];
    printf("\"%s\"" . PHP_EOL, $dropouts_ID);
    // if (count($dropouts_array)-1 == $i) {
    //     printf("\"%s\"" . PHP_EOL, $dropouts_ID);
    // }
    // else {
    //     printf("\"%s\"," . PHP_EOL, $dropouts_ID);
    // }
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
    $average_points = 0; //平均点
    $total = 0; //合計点

    for ($i = 1; $i < 7; $i++) {
        $total += $line[$i];
    }
    $average_points = round($total/6, 2);

    // 最高点
    if ($average_points >= $highest_score) {
        $hs_array[] = $student_ID;
        $hs_score_array[] = $average_points;
        if ($average_points > $highest_score) {
            $highest_score = $average_points;
        }
    }

    //最低点
    if ($average_points <= $lowest_score) {
        $ls_array[] = $student_ID;
        $ls_score_array[] = $average_points;
        if ($average_points < $lowest_score) {
            $lowest_score = $average_points;
        }
    }
}

printf("\"ID\",\"Mean\"" . PHP_EOL);
for ($i = 0; $i < count($hs_score_array); $i++) {
    if ($highest_score == $hs_score_array[$i]) {
        printf("\"%s\",\"%s\"" . PHP_EOL, $hs_array[$i], $hs_score_array[$i]);
    }
}

for ($i = 0; $i < count($ls_score_array); $i++) {
    if ($lowest_score == $ls_score_array[$i]) {
        printf("\"%s\",\"%s\"" . PHP_EOL, $ls_array[$i], $ls_score_array[$i]);
        // if (count($ls_score_array)-1 == $i) {
        //     printf("\"%s\",\"%s\"" . PHP_EOL, $ls_array[$i], $ls_score_array[$i]);
        // }
        // else {
        //     printf("\"%s\",\"%s\"," . PHP_EOL, $ls_array[$i], $ls_score_array[$i]);
        // }
    }
}

fclose($file);
