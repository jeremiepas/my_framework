var userApi = new rest(route+'/user', 'list');
function viewsuser() {
    document.getElementById('listtask').innerHTML = '';
    userApi.views();
}
function viewuser(id){
    document.getElementById('listtask').innerHTML = '';
    userApi.view(id);
    taskApi.view(id);
 };
 function deletuser(id){
     userApi.delete(id);
 };
 function insertuser(){
        var tab = {name: document.getElementById('name').value, email:document.getElementById('email').value};
      userApi.insert(tab);
 }
 function appelfrom(id){
      userApi.xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
          document.getElementById('list').innerHTML = '';
              data = JSON.parse(this.responseText)[0];
              document.getElementById('name').value = data.name;
              document.getElementById('email').value = data.email;
      }
      };
              userApi.xhttp.open("get", userApi.lienServer+'/'+id, true);
              userApi.xhttp.send();
      document.getElementById('submituser').value = 'modifie user';
      document.getElementById('submituser').setAttribute('onclick',  "updateuser("+id+")");
 }
 function updateuser(id){
     var tab = {name: document.getElementById('name').value, email:document.getElementById('email').value};
     userApi.update(tab,id);
 }
