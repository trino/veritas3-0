var lastelement, oldcolor;

Element.prototype.hasClass = function(className) {
    return this.className && new RegExp("(^|\\s)" + className + "(\\s|$)").test(this.className);
};

function validate_data(Data, DataType){
    if(Data) {
        //alert("Testing: " + Data + " for " + DataType);
        switch (DataType.toLowerCase()) {
            case "email":
                var re = /\S+@\S+\.\S+/;
                return re.test(Data);
                break;
            case "postalcode":
                Data = Data.replace(/ /g, '').toUpperCase();
                var regex = new RegExp(/^[ABCEGHJKLMNPRSTVXY]\d[ABCEGHJKLMNPRSTVWXYZ]?\d[ABCEGHJKLMNPRSTVWXYZ]\d$/i);
                return regex.test(Data);
                break;
            case "phone":
                var phoneRe = /^[2-9]\d{2}[2-9]\d{2}\d{4}$/;
                Data = Data.replace(/\D/g, "");
                return (Data.match(phoneRe) !== null);
                break;
            case "sin":
                Data = Data.replace(/\D/g, "");//removes non-numeric
                return Data.length == 9;
                break;
            default:
                alert(DataType + " is unhandled");
        }
    }
    return true;
}

function clean_data(Data, DataType){
    Data = Data.trim();
    if(Data) {
        switch (DataType.toLowerCase()) {
            case "alphabetic":
                Data = Data.replace( /[^a-zA-Z]/, "");
                break;
            case "alphanumeric":
                Data = Data.replace(/\W/g, '');
            break;
            case "number":
                Data = Data.replace(/\D/g, "");
                break;
            case "email":
                Data = Data.toLowerCase();
                break;
            case "postalcode":
                Data = clean_data(replaceAll(" ", "", Data.toUpperCase()), "alphanumeric");
                Data = Data.substring(0,3) + " " + Data.substring(3);
                break;
            case "phone":
                Data = clean_data(Data, "number");
                Data = Data.replace(/(\d{3})(\d{3})(\d{4})/, "($1) $2-$3");
                break;
            case "sin":
                Data = clean_data(Data, "number");
                Data = Data.substring(0,3) + "-" + Data.substring(3,3) + "-" + Data.substring(6,3);
                break;
        }
    }
    return Data;
}

function hasClass(elem, className) {
    return new RegExp(' ' + className + ' ').test(' ' + elem.className + ' ');
}

function strip(html) {
    var tmp = document.createElement("DIV");
    tmp.innerHTML = html.trim();
    return tmp.textContent || tmp.innerText || "";
}

function checkalltags(TabID){
    var inputs = checktags(TabID, 'input');
    if (!inputs['Status']){return false;}
    inputs = checktags(TabID, 'select');
    if (!inputs['Status']){return false;}
    return true;
}

function isVisible (element) {
    return element.clientWidth !== 0 && element.clientHeight !== 0 && element.style.opacity !== 0 && element.style.visibility !== 'hidden';
}

function checktags(TabID, tagtype){
    var element, inputs;
    resetelement();
    if(TabID) {
        element = document.getElementById(TabID);
        inputs = element.getElementsByTagName(tagtype);
    } else {
        inputs = document.getElementsByTagName(tagtype);
    }
    var RET = new Array();
    RET['Status'] = true;

    for (index = 0; index < inputs.length; ++index) {
        element = inputs[index];
        if(isVisible(element)) {//ignores invisible elements
            isrequired = hasClass(element, "required") || element.hasAttribute("required");
            var value = element.value;
            var name = element.getAttribute("name");
            if (element.hasAttribute("type")) {
                tagtype = element.getAttribute("type").toLowerCase().trim();
            }
            var isValid = true;
            var Reason = "";
            if (tagtype == "checkbox"){
                if (!element.checked){value = "";}
            }

            if (!value && isrequired) {
                Reason = "required";
                isValid = false;
            } else if (element.hasAttribute("role")) {
                Reason = element.getAttribute("role");
                isValid = validate_data(value, Reason);
            }
            if (isValid && Reason) {
                value = clean_data(value, Reason);
                element.value = value;
            } else if (!isValid) {
                RET['Name'] = name;
                RET['Type'] = tagtype;
                name = getName(element);
                RET['Status'] = false;
                RET['Element'] = name;
                RET['Reason'] = Reason;
                RET['Value'] = value;
                scrollto(RET, element);
                return RET;
            }
        }
    }
    return RET;
}

function resetelement(){
    if(lastelement){
        lastelement.style.borderColor = oldcolor;
    }
}

function alertfail(Reason){
     if(!Reason["Status"]){
         if (Reason['Reason'] == "required"){
            var text = reasons["required"];
         } else {
            var text = reasons['fail'];
         }
         text = replaceAll("%name%", Reason["Element"], text);
         text = replaceAll("%value%", Reason["Value"], text);
         text = replaceAll("%type%", reasons[Reason["Reason"]], text);
         alert(text);
         //alert("Name: " + Reason["Element"] + "\r\n (" + Reason["Value"] + ") is not valid (" + Reason['Reason'] + ")");
     }
    return false;
}

function findLableForControl(element) {
    var idVal = element.id;
    labels = document.getElementsByTagName('label');
    for( var i = 0; i < labels.length; i++ ) {
        if (labels[i].htmlFor == idVal)
            return labels[i];
    }
}

function scrollto(Reason, element){
    /*
    var value = element.value;
    var name = element.getAttribute("name");
    alert(name + " = " + value);
    */
    //element.scrollIntoView();
    alertfail(Reason);
    $('html,body').animate({ scrollTop: $(element).offset().top}, 'slow');
    //if(Reason["Type"] == "checkbox"){element = findLableForControl(element);}
    oldcolor=element.style.borderColor;
    element.style.borderColor = "red";
    lastelement = element;
}

function getName(element){
    var name;
    if (element.hasAttribute("placeholder")) {
        name = element.getAttribute("placeholder");
    } else {
        var ele = element.previousElementSibling;
        if (ele === null) {ele = element.parentElement.previousElementSibling;}
        if (ele === null) {ele = element.parentElement.parentElement;}
        name = ele.innerHTML;
        name = strip(name.replace(":", "")).trim();
    }
    return name.trim();
}

function replaceAll(find, replace, str) {
    return str.replace(new RegExp(find, 'g'), replace);
}