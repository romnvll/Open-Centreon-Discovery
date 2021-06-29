function f1(){
 
    let json_global={}
    let indice=1;
     
        let  lignes = document.getElementById("tableau").getElementsByTagName("tbody")[0].getElementsByTagName("tr");
       
        //console.log(lignes);
        for(let l of lignes){
            let json={};
          //  console.log(l.getElementsByTagName("td")[0].children[0].checked);
           isChecked = l.getElementsByTagName("td")[0].children[0].children[0].checked
           
           if(isChecked)
           {
       
            json.nom_serveur=l.getElementsByTagName("td")[1].children[0].innerText
            json.os=l.getElementsByTagName("td")[2].innerText
            json.ip=l.getElementsByTagName("td")[3].innerText
            json.hostTemplate=l.getElementsByTagName("td")[5].children[0].firstChild.value
            json.appsTemplate1=l.getElementsByTagName("td")[6].children[0].firstChild.value
            json.appsTemplate2=l.getElementsByTagName("td")[7].children[0].firstChild.value
            json.poller=l.getElementsByTagName("td")[8].children[0].firstChild.value
            json.community=l.getElementsByTagName("td")[9].innerText
            json.snmpVersion=l.getElementsByTagName("td")[10].innerText
            
            
            json_global[indice++]=json;
           }
           
          let data = JSON.stringify( json_global);
          
          document.getElementById("transmettre").value = data;
          //alert (document.getElementById("transmettre").value)
          
        }
        console.log(JSON.stringify( json_global)) 
       document.forms["data"].submit();
        
        
        //
        

    }

function f2(methode) {

  let json_global={}
  let indice=1;
   
      let  lignes = document.getElementById("tableau").getElementsByTagName("tbody")[0].getElementsByTagName("tr");
     
      console.log(lignes);

      for(let l of lignes){
        let json={};
        json.nom_serveur=l.getElementsByTagName("td")[0].innerText
        json.ip=l.getElementsByTagName("td")[1].innerText
        json.hostTemplate=l.getElementsByTagName("td")[2].innerText
        json.appsTemplate1=l.getElementsByTagName("td")[3].innerText
        json.appsTemplate2=l.getElementsByTagName("td")[4].innerText
        json.poller=l.getElementsByTagName("td")[5].innerText
        json.community=l.getElementsByTagName("td")[6].innerText
        json.snmpVersion=l.getElementsByTagName("td")[7].innerText

        json_global[indice++]=json;
      }
      let data = JSON.stringify( json_global);
      console.log(JSON.stringify( json_global)) ;
      
      if (methode == 'apply'){
        
        document.getElementById("data").action = "add.php?method=apply";
       document.getElementById("transmettre").value = data;
       document.getElementById("data").submit();
      }

      if (methode == 'applyAndReload'){
        
        document.getElementById("data").action = "add.php?method=applyandreload";
        document.getElementById("transmettre").value = data;
        document.getElementById("data").submit();

      }
      
      
}