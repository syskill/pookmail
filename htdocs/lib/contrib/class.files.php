<?php
// ---------------------------------------------------------------------------
// Image Validator by Alfred Reinold Baudisch<alfred_baudisch@hotmail.com>
// Copyright © 2003, 2004 AuriumSoft - www.auriumsoft.com.br
// ---------------------------------------------------------------------------
// This program is free software; you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation; either version 2 of the License, or
// (at your option) any later version.
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with this program; if not, write to the Free Software
// Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
// ---------------------------------------------------------------------------

/**
* Common functions to file manipulation
*
* @author Alfred Reinold Baudisch<alfred_baudisch@hotmail.com>
* @since Jan 19, 2004
* @package Files
*/
class files
{
    /**
    * GetFileList
    *
    * Creates an array with a list of files of a given dir. 
    * You can choice specific types of files or all files of the dir.
    *
    * @param string $directory The dir name that have the files you want
    * to create the filelist
    * @param mixed $type File types that will be added to the list. That can be:
    * images, pages, videos or docs. Default is all files of the dir.
    * @param boolean $print_list For debugging
    * @return array
    * @access public
    * @since Nov 11, 2003
    */
    function get_file_list($directory, $type = "img_creation", $print_list = false)
    {
        // Checks the dir
        if(!is_dir($directory))
        {
            $this->_error("Invalid Directory: " . $diretorio, E_USER_ERROR);
        }
        
        // File types regex
        Switch($type)
        {
            Case "img_creation":
                $types_regex = "jpeg|jpg|png";
            break;

            Case "img":
                $types_regex = "gif|jpeg|jpg|png|bmp";
            break;

            Case "pag":
                $types_regex = "txt|htm|html|php|asp|aspx";
            break;

            Case "vid":
                $types_regex = "avi|swf|mpg|mpeg|wmv|asx|mov";
            break;

            Case "doc":
                $types_regex = "txt|doc|rtf|xsl";
            break;

            Default:
                $types_regex = false;
        }
        
        // Open dir handle
        if(!$dir_handle = @opendir($directory))
        {
            $this->_error("I couldn't open the dir: " . $directory, E_USER_ERROR);
        }
        
        // Initilization of the list array
        $file_list = array();
        
        // Starts dir navigation
        while (false !== ($file = @readdir($dir_handle)))
        { 
            if ($file == "." || $file == "..")
            { 
                continue;
            }
            
            // The list will be generate with specific types, according to the regex
            if($types_regex)
            {
                if(eregi( "\.(" . $types_regex . ")$", $file))
                {
                    $file_list[] = $file;
                }
            }

            // The list will be generate with all dir's files
            else
            {
                // Add only files to the list
                if(is_file($directory . $file))
                {
                    $file_list[] = $file;
                }
            }
        }
        
        // Close dir handle
        @closedir($dir_handle);
        
        // Has no files in the dir
        if(!sizeof($file_list))
        {
            $this->_error("The directory: " . $directory . " is empty!", E_USER_NOTICE);
        }

        // If debugging...
        if($print_list)
        {
            echo "<pre>";
            print_r($file_list);
            echo "</pre>";
        }
        
        // Returns file list
        return $file_list;
    }

    /**
    * Prints errors messages
    *
    * @param string $mensagem The error message
    * @param integer $tipo Error type
    * @access private
    * @since Jan 19, 2004
    */
	function _error($mensagem, $tipo)
	{
        if($tipo == E_USER_ERROR)
        {
            $topo = "Error!";
        }
        else
        {
            $topo = "Notification";
        }

        echo "<span style=\"background-color: #FFD7D7\"><font face=verdana size=2><font color=red><b>" . $topo . "</b></font>: " . $mensagem . "</font></span><br><br>";

        if($tipo == E_USER_ERROR)
        {
            exit;
        }
	}
}
?>