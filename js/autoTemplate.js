function autoTemplate() {

    let  lignes = document.getElementById("tableau").getElementsByTagName("tbody")[0].getElementsByTagName("tr");
    const map = new Map()
    map.set ("Ricoh", "htpl-os-printer-snmp")
    map.set ("Unknown", "generic-host")
    map.set ("HP LaserJet","htpl-os-printer-snmp")


    for(let l of lignes){
        os=l.getElementsByTagName("td")[2].innerText

        hostTemplate=l.getElementsByTagName("td")[4].children[0]
        let trouve = false 
        for (i=0; i<hostTemplate.length ; i++) {
                     
            if (hostTemplate[i].value.includes(os.toLowerCase())) { 
                console.log(hostTemplate[i].innerText);
                hostTemplate.selectedIndex = i 
                trouve = true
                 break

            }
      
           
        }
        if (trouve==false) {
            hostTemplate.value = map.get(os)
        }

    

    }

}