<?php /** @noinspection PhpUndefinedVariableInspection */
/** @noinspection PhpWrongStringConcatenationInspection */
/** @noinspection DuplicatedCode */

function pathfind($graph1){

    $current_column = 0;
    foreach ($graph1 as $value) {
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
            $destination_found = 2;
        }
    }
    if (array_key_exists($starting_column - 1 . $starting_row, $coordinates_array)) {
        if ($coordinates_array[$starting_column - 1 . $starting_row] == '.') {
            $coordinates_array[$starting_column - 1 . $starting_row] = 1;
        } else if ($coordinates_array[$starting_column - 1 . $starting_row] == 'Q') {
            $destination_found = 2;
        }
    }
    if (array_key_exists($starting_column . ($starting_row + 1), $coordinates_array)) {
        if ($coordinates_array[$starting_column . ($starting_row + 1)] == '.') {
            $coordinates_array[$starting_column . ($starting_row + 1)] = 1;
        } else if ($coordinates_array[$starting_column . ($starting_row + 1)] == 'Q') {
            $destination_found = 2;
        }
    }
    if (array_key_exists($starting_column . ($starting_row - 1), $coordinates_array)) {
        if ($coordinates_array[$starting_column . ($starting_row - 1)] == '.') {
            $coordinates_array[$starting_column . ($starting_row - 1)] = 1;
        } else if ($coordinates_array[$starting_column . ($starting_row - 1)] == 'Q') {
            $destination_found = 2;
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
                        $destination_found = 2;
                    }
                }
                if (array_key_exists($current_column_neighbor - 1 . $current_row_neighbor, $coordinates_array)) {
                    if ($coordinates_array[$current_column_neighbor - 1 . $current_row_neighbor] == '.') {
                        $coordinates_array[$current_column_neighbor - 1 . $current_row_neighbor] = $current_number + 1;
                    } else if ($coordinates_array[$current_column_neighbor - 1 . $current_row_neighbor] == 'Q') {
                        $destination_found = 2;
                    }
                }
                if (array_key_exists($current_column_neighbor . ($current_row_neighbor + 1), $coordinates_array)) {
                    if ($coordinates_array[$current_column_neighbor . ($current_row_neighbor + 1)] == '.') {
                        $coordinates_array[$current_column_neighbor . ($current_row_neighbor + 1)] = $current_number + 1;
                    } else if ($coordinates_array[$current_column_neighbor . ($current_row_neighbor + 1)] == 'Q') {
                        $destination_found = 2;
                    }
                }
                if (array_key_exists($current_column_neighbor . ($current_row_neighbor - 1), $coordinates_array)) {
                    if ($coordinates_array[$current_column_neighbor . ($current_row_neighbor - 1)] == '.') {
                        $coordinates_array[$current_column_neighbor . ($current_row_neighbor - 1)] = $current_number + 1;
                    } else if ($coordinates_array[$current_column_neighbor . ($current_row_neighbor - 1)] == 'Q') {
                        $destination_found = 2;
                    }
                }


            }

    if (!in_array(".", $coordinates_array)) {
        if ($destination_found==0) {
            $destination_found+=1;
        } else if ($destination_found==1) {
        die('destination not reachable');
        }
    }


            $current_number += 1;
        } while ($destination_found != 2);
    }
    return $current_number;
}

