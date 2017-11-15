var newMainJSON;

function setMainJSON(data) {
        //console.log(data);
        sessionStorage.setItem('mainJSON',JSON.stringify(data));
        newMainJSON = data;
}
