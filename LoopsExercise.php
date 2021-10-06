<?php
require_once ("GianlucaVendittiInclude.php");           


function ReadData($fileName)  //passing in file name allows for the function to be reuseable instead of hardcoding a ".dat" file.
{
    $handle = @fopen($fileName, "r"); // r means reading in file
    $total = 0;
    $strValues = ""; 
    if ($handle) {
        while (($buffer = fgets($handle, 4096)) !== false) {
            Echo "$buffer,";
            $strValues .= number_format($buffer,2) . ", "; //going through the data, for example 6.20 , etc etc, passing through the commas 
            $total += $buffer;
        }
        if (!feof($handle)) { //The feof() function checks if the "end-of-file" (EOF) has been reached.
                              //The feof() function is useful for looping through data of unknown length.
            echo "Error: unexpected fgets() fail\n";
        }
        fclose($handle);
    }

     echo rtrim($strValues, ", "); 

    return $total;
}

function CalculateNet($totalRevenues, $totalExpenses) // used to calculate net profit. i.e: revenue minus expenses! 
{
    $net = $totalRevenues - $totalExpenses;  // assign totalRevenue - Expenses to the variable net and return net with function.

    return $net;
}

function Output()
{                       
    $totalRevenues = ReadData("Revenues.dat"); // assinging revenue and expenses to ReadData function and passing in file name.
    $totalExpenses = ReadData("Expenses.dat"); // assinging revenue and expenses to ReadData function and passing in file name.

    $net = CalculateNet($totalRevenues, $totalExpenses);  // assigning CalculateNet function to $Net and passing in the newly assigned revenue
                                                          // and data variables.
   
    if ($net == 0) {                                // if $net is equal to 0, you broke even.
        echo "You broke even";
    } elseif ($net > 0) {                           //otherwise if net is greater than 0, you made profit.
        echo "Profit:$". number_format($net, 2);
    } elseif ($net < 0) {                           //otherwise if net is less than 0, you loss profit.
        echo "Loss: $" . number_format(($net * -1), 2);
    }
}

//main
WriteHeaders("Loops Exercise", "Loops Exercise");

Output(); // all the output is dealt with in the OutPut function so we just call this once  

?>