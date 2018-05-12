<?php
class Name
{
   // Instance attributes
   private $name         = array('FIRST'=>"", 'LAST'=>""); 

   
   // Operations
   // name() prototypes:
   //   string name()                          returns name in "Last, First" format.
   //                                          If no first name assigned, then return in "Last" format.
   //                                         
   //   void name(string $value)               set object's $name attribute in "Last, First" 
   //                                          or "Last" format.
   //                                         
   //   void name(array $value)                set object's $name attribute in [first, last] format
   //
   //   void name(string $first, string $last) set object's $name attribute
   function name() 
   {
     // string name()
     if( func_num_args() == 0 )
     {
       if( empty($this->name['FIRST']) ) return $this->name['LAST'];
       else                              return $this->name['LAST'].', '.$this->name['FIRST']; 
     }
     
     // void name($value)
     else if( func_num_args() == 1 )
     {
       $value = func_get_arg(0);
       
       if( is_string($value) ) 
       {
         $value = explode(',', $value); // convert string to array 
         
         if ( count($value) >= 2 ) $this->name['FIRST'] = htmlspecialchars(trim($value[1]));
         else                      $this->name['FIRST'] = '';
         
         $this->name['LAST']  = htmlspecialchars(trim($value[0]));          
       }
       
       else if( is_array ($value) )
       {
         if ( count($value) >= 2 ) $this->name['LAST'] = htmlspecialchars(trim($value[1]));
         else                      $this->name['LAST'] = '';
         
         $this->name['FIRST']  = htmlspecialchars(trim($value[0])); 
       }         
     }
     
     // void name($first_name, $last_name)
     else if( func_num_args() == 2 )
     {
         $this->name['FIRST'] = htmlspecialchars(trim(func_get_arg(0)));
         $this->name['LAST']  = htmlspecialchars(trim(func_get_arg(1))); 
     }
     
     return $this;
   }
   
  
   
   
   
   function __construct($name="")
   {
     // delegate setting attributes so validation logic is applied
     $this->name($name);

   }
   
   
   
   function __toString()
   {
     return (var_export($this, true));
   }
   
   
   
   // Returns a tab separated value (TSV) string containing the contents of all instance attributes   
   function toTSV()
   {
       return implode("\t", [$this->name()]);
   }
   
   
   
   // Sets instance attributes to the contents of a string containing ordered, tab separated values 
   function fromTSV(string $tsvString)
   {
     // assign each argument a value from the tab delineated string respecting relative positions
     list($name) = explode("\t", $tsvString);
     $this->name($name);

   }
} // end class Name

?>

