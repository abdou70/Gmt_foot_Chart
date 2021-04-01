function notNumber(champs){
    if( champs.value.trim() !== ""){
    
        if(isNaN(champs.value) === false ){
           champs.style.color = 'red'
           champs.value = ''
        }
        if(isNaN(champs.value) === true ){
            champs.style.color = 'black'
        }
    }
    
    }
    
    function isNumber(champs){
        if( champs.value.trim() !== ""){
        
            if(isNaN(champs.value) === false ){
               champs.style.color = 'black'
            }
            if(isNaN(champs.value) === true ){
                champs.style.color = 'red'
                champs.value = ''
            }
        }
        
    }
    function telephoneCheck(champs) {
        if( champs.value.trim() !== "" ){
        
            if(isNaN(champs.value) === false &&  champs.value.toString().length === 9 
            && (champs.value.substr(0, 2) === '77' || champs.value.substr(0, 2) === '76' || champs.value.substr(0, 2) === '70' 
            || champs.value.substr(0, 2) === '75' || champs.value.substr(0, 2) === '78' || champs.value.substr(0, 2) === '33' ) ){
               champs.style.color = 'black'

            }else
            {
                champs.style.color = 'red'
                champs.value = ''
            }
           
        }
    }

