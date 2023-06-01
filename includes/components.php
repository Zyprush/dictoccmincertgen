<?php

function inputElement($id, $name, $text){
    $ele ="
        <div class=\"form group\">
            <label for='$name'>$text</label>
            <input type=\"text\" class=\"form-control\" id='$id' name='$name' required>
        </div>
    ";
    echo $ele;
}

function inputElementnot($id, $name, $text){
    $ele ="
        <div class=\"form group\">
            <label for='$name'>$text</label>
            <input type=\"text\" class=\"form-control\" id='$id' name='$name'>
        </div>
    ";
    echo $ele;
}

function inputElementStyle($id, $name, $text){
    $ele ="
        <div class=\"container\">
            <div class=\"form-group shadow p-3 mb-5 bg-white rounded border\">
                <div class=\"form group\">
                    <label for='$name'>$text</label>
                    <input type=\"text\" class=\"form-control\" id='$id' name='$name' placeholder=\"Your Answer\" required style=\"border: none; border-bottom: 1px solid black;\">
                </div>
            </div>
        </div>    
    ";
    echo $ele;
}

function formCheck($name, $id, $value){
    $ele ="
        <div class=\"form-check form-check-inline\">
            <input class=\"form-check-input\" type=\"radio\" name='$name' id='$id' value='$value' required>
            <label class=\"form-check-label\" for='$id'>$value</label>
        </div>
    ";
    echo $ele;
}
?>