function roomDetails() {
    var x = document.getElementById("spaceFormm");
    x.innerHTML = "";

    var soundproofLevel1 = document.createElement("input");
    soundproofLevel1.setAttribute("type", "radio");
    soundproofLevel1.setAttribute("id", "low");
    soundproofLevel1.setAttribute("name", "soundproofLevel");
    soundproofLevel1.setAttribute("value", "Low");
    soundproofLevel1.required = true;

    var label1 = document.createElement("label");
    label1.setAttribute("for", "low");
    label1.textContent = "  Low";

    var soundproofLevel2 = document.createElement("input");
    soundproofLevel2.setAttribute("type", "radio");
    soundproofLevel2.setAttribute("id", "medium");
    soundproofLevel2.setAttribute("name", "soundproofLevel");
    soundproofLevel2.setAttribute("value", "Medium");

    var label2 = document.createElement("label");
    label2.setAttribute("for", "medium");
    label2.textContent = "  Medium";

    var soundproofLevel3 = document.createElement("input");
    soundproofLevel3.setAttribute("type", "radio");
    soundproofLevel3.setAttribute("id", "high");
    soundproofLevel3.setAttribute("name", "soundproofLevel");
    soundproofLevel3.setAttribute("value", "High");

    var label3 = document.createElement("label");
    label3.setAttribute("for", "high");
    label3.textContent = "  High";

    var text1 = document.createElement("p");
    text1.textContent = "SOUNDPROOF LEVEL";

    var low = document.createElement("div");
    low.className = "radioGroup";

    var med = document.createElement("div");
    med.className = "radioGroup";

    var high = document.createElement("div");
    high.className = "radioGroup";

    var spann = document.createElement("span");
    spann.textContent = "  *";
    text1.append(spann)

    var breakline = document.createElement("br");
    x.append(text1)
    low.append(soundproofLevel1, label1)
    med.append(soundproofLevel2, label2)
    high.append(soundproofLevel3, label3)
    
    x.append(low, med, high)
}

function workspaceDetails() {
    var x = document.getElementById("spaceFormm");
    x.innerHTML = "";

    var isSharedY = document.createElement("input");
    isSharedY.setAttribute("type", "radio");
    isSharedY.setAttribute("id", "yes_shared");
    isSharedY.setAttribute("name", "is_shared");
    isSharedY.setAttribute("value", "yes");
    isSharedY.required = true;

    var label1 = document.createElement("label");
    label1.setAttribute("for", "yes_shared");
    label1.textContent = "  Yes";

    var issharedN = document.createElement("input");
    issharedN.setAttribute("type", "radio");
    issharedN.setAttribute("id", "no_shared");
    issharedN.setAttribute("name", "is_shared");
    issharedN.setAttribute("value", "no");

    var label2 = document.createElement("label");
    label2.setAttribute("for", "no_shared");
    label2.textContent = "  No";

    var text1 = document.createElement("p");
    text1.textContent = "SHARED";

    var text2 = document.createElement("p");
    text2.textContent = "LOCKER";

    var hasLockerY = document.createElement("input");
    hasLockerY.setAttribute("type", "radio");
    hasLockerY.setAttribute("id", "yes_locker");
    hasLockerY.setAttribute("name", "has_locker");
    hasLockerY.setAttribute("value", "yes");
    hasLockerY.required = true;

    var label3 = document.createElement("label");
    label3.setAttribute("for", "yes_locker");
    label3.textContent = "  Yes";

    var hasLockerN = document.createElement("input");
    hasLockerN.setAttribute("type", "radio");
    hasLockerN.setAttribute("id", "no_locker");
    hasLockerN.setAttribute("name", "has_locker");
    hasLockerN.setAttribute("value", "no");

    var label4 = document.createElement("label");
    label4.setAttribute("for", "no_locker");
    label4.textContent = "  No";

    var breakline = document.createElement("br");

    var spann = document.createElement("span");
    spann.textContent = "  *";
    text1.append(spann)

    var spann = document.createElement("span");
    spann.textContent = "  *";
    text2.append(spann)

    var SharedY = document.createElement("div");
    SharedY.className = "radioGroup"
    SharedY.append(isSharedY, label1) 

    var SharedN = document.createElement("div");
    SharedN.className = "radioGroup"
    SharedN.append(issharedN, label2)   

    var LockerY = document.createElement("div");
    LockerY.className = "radioGroup"
    LockerY.append(hasLockerY, label3)  

    var LockerN = document.createElement("div");
    LockerN.className = "radioGroup"
    LockerN.append(hasLockerN, label4)  

    x.append(breakline)
    x.append(text1, SharedY, SharedN, breakline, text2, LockerY, LockerN)


}

function back(){
    window.open("spaceoverview.html", "_self");
}

function dashboard(){
    window.open("../Admin/index.html", "_self");
}