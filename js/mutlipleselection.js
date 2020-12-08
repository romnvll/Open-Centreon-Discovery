function change_host(src_name,dst_name) {
    
    var template = document.getElementsByName(dst_name);
    var choix = document.getElementsByName(src_name);
    var size = template.length;
   
    for (key = 0; key < size; key++) {

       template[key].value = choix[0].value;
    }
    
   
}



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
