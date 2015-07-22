<button class="btn btn-primary" onclick="newlanguage();">New Language</button><BR>
<select id="languages" name="languages" size="<?= count($languages); ?>">
    <?php
        foreach($languages as $language) {
            echo '<option value="' . $language . '">' . $language . '</option>';
        }
    ?>
</select><BR>
<button class="btn btn-danger" onclick="deletelanguage();">Delete Language</button>

<SCRIPT>
    var languages = ['<?= implode("', '", $languages) ?>'];

    function addselectoption(SelectID, Text, Value){
        var option = document.createElement("option");
        option.text = Text;
        option.value = Value;
        var select = document.getElementById(SelectID);
        select.appendChild(option);
    }
    function increasesize(SelectID){
        var select = document.getElementById(SelectID);
        var size = parseInt(select.getAttribute("size"));
        select.setAttribute("size", size+1);
    }

    function removeselectoption(SelectID, Index){
        var select = document.getElementById('selectId');
        if (Index<0){Index = select.selectedIndex;}
        select.remove(Index);
    }

    function ucfirst(str) {
        str += '';
        var f = str.charAt(0)
            .toUpperCase();
        return f + str.substr(1);
    }

    function newlanguage(){
        var language = prompt("What would you like the new language to be called?");
        if(language){
            language = ucfirst(language);
            if (languages.indexOf(language) >-1){
                alert(language + " already exists");
            } else {
                languages.push(language);
                addselectoption("languages", language, language);
                increasesize("languages");
                AJAX("newlanguage", "language=" + language);
            }
        }
    }

    function deletelanguage(){
        var element = document.getElementById("languages");
        if(element.value == "English" || element.value == "French"){
            alert(element.value + " can't be deleted");
        } else {
            removeselectoption("languages", -1);
            AJAX("deletelanguage", "language=" + element.value);
        }
    }

    function AJAX(type, Data){
        $.ajax({
            url: "<?php echo $this->request->webroot;?>profiles/products",
            type: "post",
            dataType: "HTML",
            data: "Type=" + type + "&" + Data,
            success: function (msg) {
                switch(type){

                    default:
                        alert(msg);
                }
            },
        })
    }
</SCRIPT>
