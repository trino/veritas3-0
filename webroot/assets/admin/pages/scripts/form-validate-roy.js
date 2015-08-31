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
            case "email":
                Data = Data.toLowerCase();
                break;
            case "postalcode":
                Data = replaceAll(" ", "", Data.toUpperCase());
                Data = Data.substring(0,3) + " " + Data.substring(3);
                break;
            case "phone":
                Data = Data.replace(/[^0-9]/g, '');
                Data = Data.replace(/(\d{3})(\d{3})(\d{4})/, "($1) $2-$3");
                break;
            case "sin":
                Data = Data.replace(/\D/g, "");//removes non-numeric
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

function checkalltags(){
    var inputs = checktags(false, 'input');
    if (!inputs){return false;}
    inputs = checktags(false, 'select');
    if (!inputs){return false;}
    return inputs;
}

function checktags(TabID, tagtype){
    var element, inputs;
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
        isrequired = hasClass(element, "required") || element.hasAttribute("required");
        var value = element.value;
        var isValid = true;
        var Reason = "";
        if(!value && isrequired){
            Reason = "required";
            isValid = false;
        } else if (element.hasAttribute("role")){
            Reason= element.getAttribute("role");
            isValid = validate_data(value, Reason);
        }
        if(isValid && Reason) {
            value = clean_data(value, Reason);
            element.value = value;
        } else if(!isValid) {
            var name = getName(element);
            RET['Status'] = false;
            RET['Element'] = name;
            RET['Reason'] = Reason;
            RET['Value'] = value;
            scrollto(element);
            return RET;
        }
    }
    return RET;
}

function scrollto(element){
    //element.scrollIntoView();
    $('html,body').animate({ scrollTop: $(element).offset().top}, 'slow');
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