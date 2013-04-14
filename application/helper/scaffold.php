<?php
/*
 * Process PHP Array and convert it to Forum Input fields.
 * @todo humanize the label name from the input name.
 */
/*
<div class="clearfix">
	<label for="default_role">{ NAME }</label>
	<div class="input">
		{ INPUT }
	</div>
</div>
*/


class  scaffold
{
    static public function construct_form()
    {
        echo '<form>';
    }


    static public function process_this( $scaffold_data )
    {  
        $return_data = "";

        if ( $scaffold_data[ 'display' ] == 'admin' ):
            // Remove the display key because it is not used for rendering the forms.
            unset($scaffold_data[ 'display' ]);

			foreach ($scaffold_data as $input):
			
				$input_name = string::underscore( string::camelize( $input['name']) );

                if ( in_array( 'notes', $input ) )
                    $input_notes = $input['notes'];
                else
                    $input_notes = '';


	            // var_dump($input);
	            /*  
	            echo $input['name'];
	            echo $input['label_name'];
	            echo $input['input'];
	            echo $input['type'];
	            echo $input['notes'];
	            echo $input['options'];
	            */

                switch($input['type']) {
                    case 'text':
                        $return_data .= '<div class="clearfix">
                                            <label for="scaffold'.$input_name.'">'.$input['name'].'</label>
                                            <div class="input">
                                                <input type="text" class="xlarge" name="'.$input_name.'" />
                                                <span class="help-block">'.$input_notes.'</span>
                                            </div>
                                        </div>';
                    break;
                    case 'password':
                        $return_data .= '<div class="clearfix">
                                            <label for="'.$input_name.'">'.$input['name'].'</label>
                                            <div class="input">
                                                <input type="password" class="xlarge" name="'.$input_name.'" />
                                                <span class="help-block">'.$input_notes.'</span>
                                            </div>
                                        </div>';
                    break;
                    case 'button':

                        if ( $scaffold_data[ 'display' ] != 'admin' ):
                            $return_data .= self::create_button($input['button_name']);
                        endif;
                    break;
                    case 'option':
                        $return_data .= '<div class="clearfix">
                                    <label for="'.$input_name.'">'.$input['name'].'</label>
                                    <div class="input">
                                        <select name="'.$input_name.'">';
                                            foreach ($input['options'] as $option) {
                                                $return_data .= '<option value="'.$option.'">'.$option.'</option>';
                                            }
                                            $return_data .= '</select>
                                    </div>
                                </div>';
                    break;
                    case 'multiline':
                        $return_data .= '<div class="clearfix">
                                <label for="'.$input_name.'">'.$input['name'].'</label>
                                <div class="input">
                                    <textarea cols="40" rows="5" name="'.$input_name.'" class="xxlarge"></textarea>
                                    <span class="help-block">'.$input_notes.'</span>
                                </div>
                            </div>';
                    break;
                    default:

                    break;
                }// switch

            endforeach;

        endif;
        
        echo $return_data;
        
    }


    static public function populate_this( $data, $get_page_meta )
    {
	if ( $page_id = '' )
		return false;

        $return_data = "";
		
        if ( $data[ 'display' ] == 'admin' ):

            // Remove the display key because it is not used for rendering the forms.
            unset($data[ 'display' ]);

			foreach ($data as $key => $input):

                $input_name = string::underscore( string::camelize( $input['name']) );
				
	            if ($input['input'] == 'input'):
	                switch($input['type']) {
	                    case 'text':
	                        $return_data .= '<div class="clearfix"><label for="'.$input_name.'">'.$input['name'].'</label><div class="input"><input type="text" class="xlarge" name="'.$input_name.'" value="'.$get_page_meta->$input_name.'"/></div></div>';
						break;
						case 'password':
	 						$return_data .= '<div class="clearfix"><label for="'.$input['name'].'">'.$input['name'].'</label><div class="input"><input type="password" class="xlarge" name="'.$input['name'].'" value="'.$get_page_meta->$input_name.'"/></div></div>';
						break;    
					    case 'button':
							
							if ( $data[ 'display' ] != 'admin' ):
								$return_data .= self::create_button($input['button_name']);
							endif;
	                    break;               
	                    }// switch 
	                elseif($input['input'] == 'option'):
		
						$return_data .= '<div class="clearfix">
											<label for="'.$input_name.'">'.$input['name'].'</label>
											<div class="input">
												<select name="'.$input_name.'">';
											foreach ($input['options'] as $option) {	
												$return_data .= '<option value="'.$option.'">'.$option.'</option>';
											}
						$return_data .= '		</select>
											</div>
										</div>';
						
	                elseif ($input['input'] == 'multiline'):
	                    $return_data .= '<div class="clearfix"><label for="'.$input_name.'">'.$input['name'].'</label><div class="input"><textarea cols="40" rows="5" name="'.$input_name.'">'.$get_page_meta->$input_name.'</textarea></div></div>';
	                endif;
	            endforeach;
	
			endif;
        
        echo $return_data;
        
    }


	static public function create_button( $name = '' )
	{
		if (isset($name)):
			$button =  '<input type="submit" value="'.$name.'" class="btn"><br />';
		else:
			$button =  '<input type="submit" value="Submit" class="btn"><br />';
		endif;
		
		return $button;
	}


	static public function destruct_form() {
        echo '</form>';
    }
}