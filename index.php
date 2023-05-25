<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>OXBURY - Pathfind</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
    <style>
        @import url(https://fonts.googleapis.com/css?family=Merriweather);
        *,
        *:before,
        *:after {
            -moz-box-sizing: border-box;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
        }
        html, body {
            background: #f1f1f1;
            font-family: 'Merriweather', sans-serif;
            padding: 1em;
        }
        h1 {
            text-align: center;
            color: #aaa;
            text-shadow: 1px 1px 0 white;
        }
        form {
            max-width: 600px;
            text-align: center;
            margin: 20px auto;
        }
        form input, form textarea {
            border: 0;
            outline: 0;
            padding: 1em;
            -moz-border-radius: 8px;
            -webkit-border-radius: 8px;
            border-radius: 8px;
            display: block;
            width: 100%;
            margin-top: 1em;
            font-family: 'Merriweather', sans-serif;
            -moz-box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
            -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
            box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
            resize: none;
        }
        form input:focus, form textarea:focus {
            -moz-box-shadow: 0 0px 2px #e74c3c !important;
            -webkit-box-shadow: 0 0px 2px #e74c3c !important;
            box-shadow: 0 0px 2px #e74c3c !important;
        }
        form #input-submit {
            color: white;
            background: #e74c3c;
            cursor: pointer;
        }
        form #input-submit:hover {
            -moz-box-shadow: 0 1px 1px 1px rgba(170, 170, 170, 0.6);
            -webkit-box-shadow: 0 1px 1px 1px rgba(170, 170, 170, 0.6);
            box-shadow: 0 1px 1px 1px rgba(170, 170, 170, 0.6);
        }
        form textarea {
            height: 126px;
        }
        .half {
            float: left;
            width: 48%;
            margin-bottom: 1em;
        }
        .right {
            width: 50%;
        }
        .left {
            margin-right: 2%;
        }
        @media (max-width: 480px) {
            .half {
                width: 100%;
                float: none;
                margin-bottom: 0;
            }
        }
        /* Clearfix */
        .cf:before,
        .cf:after {
            content: " ";
            /* 1 */
            display: table;
            /* 2 */
        }
        .cf:after {
            clear: both;
        }
        tr td {
            border: solid 2px black;
            padding: 10px;
        }
    </style>
</head>
<body translate="no">
<h1>Oxbury Pathfind Test Run</h1>
<center><span>Please keep in mind you can only have one charecter per cell & only 2 vectors (P & Q)</span></center>
<form class="cf" action="?" method="post">
    <div class="half left cf">
        <center>
            <h3>DATA:</h3>
            <table name='data'>
                <tr>
                    <td contenteditable><input type="text" name="00" value="."/></td>
                    <td contenteditable><input type="text" name="01" value="P"/></td>
                    <td contenteditable><input type="text" name="02" value="."/></td>
                    <td contenteditable><input type="text" name="03" value="."/></td>
                    <td contenteditable><input type="text" name="04" value="."/></td>
                </tr>
                <tr>
                    <td contenteditable><input type="text" name="10" value="."/></td>
                    <td contenteditable><input type="text" name="11" value="#"/></td>
                    <td contenteditable><input type="text" name="12" value="#"/></td>
                    <td contenteditable><input type="text" name="13" value="#"/></td>
                    <td contenteditable><input type="text" name="14" value="."/></td>
                </tr>
                <tr>
                    <td contenteditable><input type="text" name="20" value="."/></td>
                    <td contenteditable><input type="text" name="21" value="."/></td>
                    <td contenteditable><input type="text" name="22" value="."/></td>
                    <td contenteditable><input type="text" name="23" value="."/></td>
                    <td contenteditable><input type="text" name="24" value="."/></td>
                </tr>
                <tr>
                    <td contenteditable><input type="text" name="30" value="."/></td>
                    <td contenteditable><input type="text" name="31" value="."/></td>
                    <td contenteditable><input type="text" name="32" value="Q"/></td>
                    <td contenteditable><input type="text" name="33" value="."/></td>
                    <td contenteditable><input type="text" name="34" value="."/></td>
                </tr>
                <tr>
                    <td contenteditable><input type="text" name="40" value="."/></td>
                    <td contenteditable><input type="text" name="41" value="."/></td>
                    <td contenteditable><input type="text" name="42" value="."/></td>
                    <td contenteditable><input type="text" name="43" value="."/></td>
                    <td contenteditable><input type="text" name="44" value="."/></td>
                </tr>
            </table>
        </center>
        <input type="submit" value="Run" id="input-submit">
    </div>
    <div class="half right cf">
        <center>

            <?php

            $graph1 = array(array(),array(),array(),array(),array());

            if(isset($_POST))
            {
                foreach($_POST as $inputName => $inputValue)
                {

                    if($inputName=="00"||$inputName=="01"||$inputName=="02"||$inputName=="03"||$inputName=="04") {
                        array_push($graph1[0], $inputValue);
                    }
                    if($inputName=="10"||$inputName=="11"||$inputName=="12"||$inputName=="13"||$inputName=="14") {
                        array_push($graph1[1], $inputValue);
                    }
                    if($inputName=="20"||$inputName=="21"||$inputName=="22"||$inputName=="23"||$inputName=="24") {
                        array_push($graph1[2], $inputValue);
                    }
                    if($inputName=="30"||$inputName=="31"||$inputName=="32"||$inputName=="33"||$inputName=="34") {
                        array_push($graph1[3], $inputValue);
                    }
                    if($inputName=="40"||$inputName=="41"||$inputName=="42"||$inputName=="43"||$inputName=="44") {
                        array_push($graph1[4], $inputValue);
                    }


                }

                $current_column = 0;
                foreach ($graph1 as &$value) {
                    $current_row = 0;
                    foreach ($value as $value2) {

                        if ($value2 == "P") {
                            $starting_column = $current_column;
                            $starting_row = $current_row;
                        }

                        $coordinates_array[$current_column . $current_row] = $value2;
                        $current_row += 1;
                    }
                    $current_column += 1;
                }

                $destination_found = 0;

                if (array_key_exists($starting_column + 1 . $starting_row, $coordinates_array)) {
                    if ($coordinates_array[$starting_column + 1 . $starting_row] == '.') {
                        $coordinates_array[$starting_column + 1 . $starting_row] = 1;
                    } else if ($coordinates_array[$starting_column + 1 . $starting_row] == 'Q') {
                        $destination_found = 1;
                    }
                }
                if (array_key_exists($starting_column - 1 . $starting_row, $coordinates_array)) {
                    if ($coordinates_array[$starting_column - 1 . $starting_row] == '.') {
                        $coordinates_array[$starting_column - 1 . $starting_row] = 1;
                    } else if ($coordinates_array[$starting_column - 1 . $starting_row] == 'Q') {
                        $destination_found = 1;
                    }
                }
                if (array_key_exists($starting_column . ($starting_row + 1), $coordinates_array)) {
                    if ($coordinates_array[$starting_column . ($starting_row + 1)] == '.') {
                        $coordinates_array[$starting_column . ($starting_row + 1)] = 1;
                    } else if ($coordinates_array[$starting_column . ($starting_row + 1)] == 'Q') {
                        $destination_found = 1;
                    }
                }
                if (array_key_exists($starting_column . ($starting_row - 1), $coordinates_array)) {
                    if ($coordinates_array[$starting_column . ($starting_row - 1)] == '.') {
                        $coordinates_array[$starting_column . ($starting_row - 1)] = 1;
                    } else if ($coordinates_array[$starting_column . ($starting_row - 1)] == 'Q') {
                        $destination_found = 1;
                    }
                }

                $current_number = 1;

                if($destination_found==0){
                    do {

                        foreach (array_keys($coordinates_array, $current_number) as $current_num_neighbor) {

                            $split_current_num_neighbor = (string)$current_num_neighbor;
                            $current_column_neighbor = $split_current_num_neighbor[0];
                            $current_row_neighbor = $split_current_num_neighbor[1];


                            if (array_key_exists($current_column_neighbor + 1 . $current_row_neighbor, $coordinates_array)) {
                                if ($coordinates_array[$current_column_neighbor + 1 . $current_row_neighbor] == '.') {
                                    $coordinates_array[$current_column_neighbor + 1 . $current_row_neighbor] = $current_number + 1;
                                } else if ($coordinates_array[$current_column_neighbor + 1 . $current_row_neighbor] == 'Q') {
                                    $destination_found = 1;
                                }
                            }
                            if (array_key_exists($current_column_neighbor - 1 . $current_row_neighbor, $coordinates_array)) {
                                if ($coordinates_array[$current_column_neighbor - 1 . $current_row_neighbor] == '.') {
                                    $coordinates_array[$current_column_neighbor - 1 . $current_row_neighbor] = $current_number + 1;
                                } else if ($coordinates_array[$current_column_neighbor - 1 . $current_row_neighbor] == 'Q') {
                                    $destination_found = 1;
                                }
                            }
                            if (array_key_exists($current_column_neighbor . ($current_row_neighbor + 1), $coordinates_array)) {
                                if ($coordinates_array[$current_column_neighbor . ($current_row_neighbor + 1)] == '.') {
                                    $coordinates_array[$current_column_neighbor . ($current_row_neighbor + 1)] = $current_number + 1;
                                } else if ($coordinates_array[$current_column_neighbor . ($current_row_neighbor + 1)] == 'Q') {
                                    $destination_found = 1;
                                }
                            }
                            if (array_key_exists($current_column_neighbor . ($current_row_neighbor - 1), $coordinates_array)) {
                                if ($coordinates_array[$current_column_neighbor . ($current_row_neighbor - 1)] == '.') {
                                    $coordinates_array[$current_column_neighbor . ($current_row_neighbor - 1)] = $current_number + 1;
                                } else if ($coordinates_array[$current_column_neighbor . ($current_row_neighbor - 1)] == 'Q') {
                                    $destination_found = 1;
                                }
                            }


                        }

                        if ((!in_array(".", $coordinates_array))&&$destination_found==0) {
                            die('destination not reachable');
                        }


                        $current_number += 1;
                    } while ($destination_found != 1);
                }
                echo "<h2>ANSWER: " . ($current_number) . " </h2>";


                echo '
<style>
table, th, td {
  border: 1px solid;
}
</style>
<table>
    <tr>';

                $counter = 1;

                unset($value);
                foreach ($coordinates_array as $value) {
                    if (!(($counter++) % 5)) {
                        echo "<td>$value</td></tr><tr>";
                    } else {
                        echo "<td>$value</td>";
                    }
                }

                echo '</table>';

            }

            ?>


        </center>
    </div>

</form>
</body>
</html>