
function setCheckBoxes(frm, fname) {

    var frm = document.forms[frm];
    if (frm == 'undefined') {

        return;
    }

    var chkBoxs = frm.elements[fname];
    if (chkBoxs == 'undefined') {
        return;
    }

    for ($k in chkBoxs) {


        chkBoxs[$k].checked = true;

        if (document.getElementById("cocher").checked == false) {
            chkBoxs[$k].checked = false
        }

    }

}
