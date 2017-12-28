var taskApi = new rest(route+'task', 'listtask');
taskApi.renderligne =     function(data){
        document.getElementById(this.lisid).innerHTML += '<tr>';
            for (value in data) {
                document.getElementById(this.lisid).innerHTML += (value !== 'id' && value !== 'user_id')?'<td>'+value+'</td><td>'+data[value]+'</td>' : '';
            }
            document.getElementById(this.lisid).innerHTML += '<td><button type="button" onclick="appelfromtask('+data['id']+','+data['user_id']+')">edit</button></td><td><button type="button" onclick="delettask('+data['id']+')">delete</button></td><td><button type="button" ';
        document.getElementById(this.lisid).innerHTML += '</tr>';

    };
function fromtask(id){
     document.getElementById('form_task').setAttribute('style', '')
     document.getElementById('submittask').value = 'nouvelle tâche';
     document.getElementById('submittask').setAttribute('onclick',  "inserttask("+id+")");
}
function appelfromtask(id, iduser){
    document.getElementById('form_task').setAttribute('style', '')
    document.getElementById('submittask').value = 'modifie la tache';
    document.getElementById('submittask').setAttribute('onclick',  "updatetask("+id+','+iduser+")");
}
function updatetask(id, iduser){
       var tab = {user_id: iduser, title: document.getElementById('title').value, description: document.getElementById('description').value, status: document.getElementById('status').value,};
         taskApi.update(tab,id);
     document.getElementById('form_task').setAttribute('style', 'display:none')
     document.getElementById('title').value = '';
      document.getElementById('status').value = '';
       document.getElementById('description').value = '';
}
function inserttask(id){

        var tab = {user_id: id, title: document.getElementById('title').value, description: document.getElementById('description').value, status: document.getElementById('status').value,};
        taskApi.insert(tab);

      document.getElementById('form_task').setAttribute('style', 'display:none')
}
function viewtask(id){
document.getElementById('listtask').innerHTML = '';
document.getElementById('list').innerHTML = '';
    taskApi.view(id);
 };
 function delettask(id){
     taskApi.delete(id);
 };
