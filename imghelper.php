<?php
function display_image($src)
{
    echo 
    '
    <form method="post">
		<input type="hidden" value="'.$src.'" name="image" >
        <img src="'.$src.'" >
        <button type="submit" name="delete" >
            <img src="./images/_/X.png">
        </button>
    </form>
    ';
}

function delete_image($src)
{
	unlink($src);
}
?>
