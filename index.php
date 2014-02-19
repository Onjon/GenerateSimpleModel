<?php
/*
@Author Name : Onjon Shahadat Hossain
@Email : onjon_sh@yahoo.com

@Project Name : Generate A Simple Model 
@Version : 1.0.1
@Release Date : 16th June, 2013

@Only For Test Purpose 
*/

// Errors and Warning Response Status 
error_reporting( E_ALL ); 

// Get Generate Dynamic Spaces and Line Break
function generateSpace( $cn ) {
    $arr = "\n" ;
    for( $i = 0 ; $i < $cn ; $i++ ) {
        $arr .= "   " ;            
    }
    return $arr ;
}

// Set Connection Start 
$conn = mysql_connect( "localhost" , "root" , "natasha143#" ) or die( "Connection Fail" ) ;
mysql_select_db( "btrc_project" , $conn ) or DIE( "Database connection fail." ) ;
// Set Connection End 


// Get Table List 
$s = mysql_query( "SHOW TABLES" );
$counter = 1 ; 
while ( $f = mysql_fetch_array( $s ) ) {
    // Show Table Name AS Comments 
    echo "// Table Name : <b>" . $f[ 0 ] . "</b> <br/>" ;
    
    
    // Find First Column
    $s1 = mysql_query( "SHOW COLUMNS FROM ".$f[ 0 ]." " );
    $f1 = mysql_fetch_array( $s1 );
        $data = "" ;
        $spacing_cnt = 1 ;        
        $data .= generateSpace( $spacing_cnt ) ;
        $data .= 'public static function check'.$counter++.' () {' ;        
        $spacing_cnt++ ;
        $data .= generateSpace( $spacing_cnt ) ;
        $data .= '$res = array();' ;
        $data .= generateSpace( $spacing_cnt ) ;
        $data .= '$s = mysql_query( "SELECT '.$f1[ 0 ].' FROM '.$f[ 0 ].' " );' ;
        $data .= generateSpace( $spacing_cnt ) ;
        $data .= 'if( mysql_num_rows( $s ) >= 1 ) {' ;
        $spacing_cnt++ ;
        $data .= generateSpace( $spacing_cnt ) ;        
        $data .= '$res[0][] = 1;' ;
        $data .= generateSpace( $spacing_cnt ) ;        
        $data .= 'while( $f = mysql_fetch_array( $s ) ) {' ;
        $data .= generateSpace( $spacing_cnt ) ;        
        $data .= '$res[1][] = $f[ "'.$f1[ 0 ].'" ];' ;
        $data .= generateSpace( $spacing_cnt ) ;        
        $data .= '}' ;
        $spacing_cnt-- ;
        $data .= generateSpace( $spacing_cnt ) ;
        $data .= '}' ;
        $data .= generateSpace( $spacing_cnt ) ;
        $data .= 'else {' ;
        $spacing_cnt++ ;
        $data .= generateSpace( $spacing_cnt ) ;
        $data .= '$res[0][] = 0;' ;
        $data .= generateSpace( $spacing_cnt ) ;
        $data .= '$res[1][] = "";' ;
        $spacing_cnt-- ;
        $data .= generateSpace( $spacing_cnt ) ;
        $data .= '}' ;
        $data .= generateSpace( $spacing_cnt ) ;
        $data .= 'return $res;' ;
        $spacing_cnt-- ;
        $data .= generateSpace( $spacing_cnt ) ;
        $data .= '}' ;
        echo "<pre>" ;
        echo $data  ;
        echo "</pre>" ;
    // End Find Column
        
}

?>