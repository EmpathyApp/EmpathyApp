<?php

/* 
 * Copyright (C) 2015 sunyata
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

function ea_console_debug($iData){
    
    if(is_null($iData) == true){
        $outStr = "<script> console.log( 'ea_debug_single is NULL') </script>";
    }elseif(is_array($iData) == true){
        $outStr = "<script> console.log( 'ea_debug_array: " . implode(', ', $iData) . "') </script>";
    }else{
        $outStr = "<script> console.log( 'ea_debug_single: " . $iData . "') </script>";
    }
    
    echo $outStr;
    
}

function ea_var_export($iData){
    
    $tVarExp = var_export($iData, true);
    $outStr = "<script> console.log( ' . $tVarExp . ') </script>";
    
    echo $outStr;
}



