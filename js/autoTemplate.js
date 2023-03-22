
function autoTemplate() {

    let lignes = document.getElementById("tableau").getElementsByTagName("tbody")[0].getElementsByTagName("tr");

    const map = new Map()
    map.set("Ricoh", "htpl-os-printer-snmp")
    map.set("Unknown", "generic-host")
    map.set("HP LaserJet", "htpl-os-printer-snmp")


    for (let l of lignes) {
        os = l.getElementsByTagName("td")[2].innerText

        hostTemplate = l.getElementsByTagName("td")[5].children[0].firstChild
        let trouve = false
        //console.log (hostTemplate);
        for (i = 0; i < hostTemplate.length; i++) {

	//	console.log (hostTemplate[i].innerText)
	//	console.log ("--")
	//	console.log (os.toLowerCase())
            if (hostTemplate[i].innerText.toLowerCase().includes(os.toLowerCase())) {

                console.log("trouvé" + os)
                console.log(hostTemplate[i].innerText.toLowerCase())

                hostTemplate.selectedIndex = i
                $('.selectpicker').selectpicker('refresh');

                trouve = true
                break

            }


        }
        if (trouve == false) {
            hostTemplate.value = map.get(os)
            $('.selectpicker').selectpicker('refresh');
        }



    }

}

function autoTemplateApps() {
    let lignes = document.getElementById("tableau").getElementsByTagName("tbody")[0].getElementsByTagName("tr");
    for (let l of lignes) {
        services = l.getElementsByTagName("td")[4].children[0]
        console.log(services)
    }

}
