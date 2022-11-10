<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>萬年曆 Calendar</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
    <style>

    </style>
</head>
<body class="<?= $bg ?>">
 <?php
    $preCal = [];  //上個月
    $cal = [];     //該月份
    $nextCal = []; //下個月
    $year = (isset($_GET['y'])) ? $_GET['y'] : date("Y");
    $month = (isset($_GET['m'])) ? $_GET['m'] : date("n");
    // 把系統時間抓出來給 變數 $year $month


    $prevmonth = $month - 1;
    $nextmonth = $month + 1;
    $prevyear = $year;
    $nextyear = $year;

    if ($nextmonth == 13) {
        $nextmonth = 1;
        $nextyear = $year + 1;
    } elseif ($prevmonth == 0) {
        $prevmonth = 12;
        $prevyear = $year - 1;
    }

    $year = str_pad($year, 4, "0", STR_PAD_LEFT);
    // str_pad() 函數將字符串填充到新的長度。
    // echo $year."<br>";
    // echo date("Y-1-1",strtotime("$year-1-1"))."<br>";


    // 月份第一天
    $firstday = $year . "-" . $month . "-1";
    // 本月第一天是星期幾
    $firstdayweek = date("N", strtotime($firstday));
    // 本月共有幾天
    $monthdays = date("t", strtotime($firstday));
    // 本月前的空白天數
    $spacedays = $firstdayweek - 1;
    // 本月共有幾週
    $weeks = ceil(($monthdays + $spacedays) / 7);
    // 本月的日期
    $days = date("Y-m-d", strtotime("$year-$month-d"));
    // 今天的日期
    $today = date("Y-m-d");

    // echo $firstDay."<br>";
    // echo $firstDayWeek."<br>";
    // echo $monthDays."<br>";
    // echo $spaceDays."<br>";
    // echo $weeks."<br>";
    // echo $days."<br>";
    // echo $today."<br>";


    // 上個月的第一天
    $lastfirstday = date("Y-m-d", strtotime("-1 month", strtotime($firstday)));
    // 上個月共有幾天
    $lastmonthday = date("t", strtotime($lastfirstday));
    // 上個月的日期
    $lastmonthdays=date("Y-m-d", strtotime("-1 month", strtotime("$year-$month-d")));
    // echo $lastfirstday."<br>";
    // echo $lastmonthday."<br>";
    // echo $lastmonthdays."<br>";


    // 下個月的第一天
    $nextfirstday = date("Y-m-d", strtotime("+1 month", strtotime($firstday)));
    // 上個月共有幾天
    $nextmonthday = date("t", strtotime($nextfirstday));
    // 上個月的日期
    $nextmonthdays=date("Y-m-d", strtotime("+1 month", strtotime("$year-$month-d")));
    // echo $nextfirstday."<br>";
    // echo $nextmonthday."<br>";
    // echo $monthdays."<br>";


    // 上個月的陣列
    for ($p = 0; $p < $lastmonthday; $p++) {
        $preCal[] = date("Y-m-d", strtotime("+$p days", strtotime($lastfirstday)));
    }
    // echo "<pre>";
    // print_r($preCal);
    // echo "</pre>";

    // 這個月的陣列
    // for ($i = 0; $i < $spaceDays; $i++) {
    //     $cal[] = '';
    // }

    for ($i = 0; $i < $monthdays; $i++) {
        $cal[] = date("Y-m-d", strtotime("+$i days", strtotime($firstday)));
    }
    // echo "<pre>";
    // print_r($cal);
    // echo "</pre>";

    // 下個月的陣列
    for ($n = 0; $n < $nextmonthday; $n++) {
        $nextCal[] = date("Y-m-d", strtotime("+$n days", strtotime($nextfirstday)));
    }
    // echo "<pre>";
    // print_r($nextCal);
    // echo "</pre>";

?>

<?php
    switch ($month) {
        case 1:
            $bg = "bg1";
            break;
        case 2:
            $bg = "bg2";
            break;
        case 3:
            $bg = "bg3";
            break;
        case 4:
            $bg = "bg4";
            break;
        case 5:
            $bg = "bg5";
            break;
        case 6:
            $bg = "bg6";
            break;
        case 7:
            $bg = "bg7";
            break;
        case 8:
            $bg = "bg8";
            break;
        case 9:
            $bg = "bg9";
            break;
        case 10:
            $bg = "bg10";
            break;
        case 11:
            $bg = "bg11";
            break;
        case 12:
            $bg = "bg12";
            break;
    }

    ?>



<div class="calender">
    <div class="top">
        <div class="time">
        <div class="top_left">
            <div class="premonth bg">
                <a href="?y=<?= $prevyear ?>&m=<?= $prevmonth ?>">
                <i class="fa-solid fa-backward color"></i>
                </a>
            </div>
        </div>
        <div class="top_mid">


            <div class="showyear">
            <div class="title">萬年曆</div>
<!-- 下落表單 -->

                <div class="select">
                    <label class="lab">
                        <select name='y' onChange="location = this.value;" alt="請選擇年份">
                            <?php
                            for ($i = date("Y") - 121; $i < date("Y") + 89; $i++) {
                                if ($i == $year) {
                                    echo "<option selected>";
                                    echo $i."年";
                                } else {
                                    echo "<option value=\"?y=$i&m=$month\">";
                                    echo $i."年";
                                }
                                echo "</option>";
                            }
                            ?>
                        </select>
                    </label>

                    <label>
                        <select name="m" onChange="location = this.value;" alt="請選擇月份">
                            <?php
                            for ($i = 1; $i <= 12; $i++) {
                                if ($i == $month) {
                                    echo "<option selected value=\"?y=$year&m=$i\">";
                                    echo $i."月";
                                } else {
                                    echo "<option value=\"?y=$year&m=$i\">";
                                    echo $i."月";
                                }
                                echo "</option>";
                            }
                            ?>
                        </select>

                    </label>
                </div>

            </div>
        </div>
<!--  -->

        <div class="top_right">
            <div class="nextmonth bg"> 
                <a href="?y=<?= $nextyear ?>&m=<?= $nextmonth ?>">
                <i class="fa-solid fa-forward color"></i>
                </a>
            </div>
        </div>
        </div>
    </div>

    <div class="mid">
        <div class="week">

                <div class="weeksday">星期一</div>
                <div class="weeksday">星期二</div>
                <div class="weeksday">星期三</div>
                <div class="weeksday">星期四</div>
                <div class="weeksday">星期五</div>
                <div class="weeksday">星期六</div>
                <div class="weeksday">星期日</div>
            
        </div>
        <div class="days">
    <?php

        // 印出上個月
        for ($p = $lastmonthday - $spacedays; $p < $lastmonthday; $p++) {
            echo "<div class='dday preday'>";
            // echo $p;
            echo date('j', strtotime($preCal[$p]));
            echo "</div>";
                }

        // 印出這個月
            foreach ($cal as $i => $days) {
                    // echo $days;
                if ($today == $days) {
                        echo "<div class='dday thisday'>";
                        echo "<div class='today'>";
                        echo date('j', strtotime($days));
                        echo "</div>";
                        echo "</div>";
                } else {
                        echo "<div class='dday'>";
                        // echo $days;
                        echo date('j', strtotime($days));
                        echo "</div>";
                }
            }

            // 印出下個月
            for ($n = 0; $n < $weeks*7 -($monthdays + $spacedays); $n++) {
                echo "<div class='dday nextday'>";
                echo date('j', strtotime($nextCal[$n]));
                echo "</div>";
            }

    ?>
</div>                    
    </div>
</div>

<div class="today">Today</div>
</body>
</html>